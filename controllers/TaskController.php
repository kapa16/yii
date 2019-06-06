<?php

namespace app\controllers;

use app\entities\task\Tasks;
use app\forms\task\TaskForm;
use app\forms\task\TaskSearchForm;
use app\services\TaskService;
use Faker\Factory;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class TaskController extends Controller
{
    private $service;
    private $request;

    public function __construct($id, $module, TaskService $service, Request $request, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->request = $request;
    }

    public function actionIndex(): string
    {
        $searchModel = new TaskSearchForm();
        $dataProvider = $searchModel->search($this->request->post());
        $this->service->cacheDataProvider($dataProvider);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id): string
    {
        $task = $this->findModel($id);

        return $this->render('view', [
            'task' => $task,
        ]);
    }

    public function actionCreate()
    {
        $form = new TaskForm();

        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $task = $this->service->create($form);
                return $this->redirect(['view', 'id' => $task->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $task = $this->findModel($id);
        $form = new TaskForm();
        $form->loadData($task);

        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $this->service->edit($task->id, $form);
                return $this->redirect(['view', 'id' => $task->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
        ]);
    }

    public function actionDelete($id): \yii\web\Response
    {
        $task = $this->findModel($id);
        $task->delete();
        return $this->redirect(['index']);
    }

    public function actionFake(): \yii\web\Response
    {
        $this->service->createFakeData();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id): Tasks
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}