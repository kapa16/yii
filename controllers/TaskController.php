<?php

namespace app\controllers;

use app\entities\task\Task;
use app\forms\task\TaskForm;
use app\forms\task\TaskSearchForm;
use app\services\TaskService;
use Faker\Factory;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    private $service;

    public function __construct($id, $module, TaskService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex(): string
    {
        $searchModel = new TaskSearchForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $task = $this->service->create(Yii::$app->user->id, $form);
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

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
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

    public function actionFake(): \yii\web\Response
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 50; $i++) {
            $task = new Task();
            $task->name = $faker->text(15);
            $task->description = $faker->text();
            $task->status_id = $faker->numberBetween(1, 7);
            $task->creator_id = $faker->numberBetween(1, 2);
            $task->responsible_id = $faker->numberBetween(1, 2);
            $task->deadline = date('Y-m-d H:i:s');
            $task->save();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id): Task
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}