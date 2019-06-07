<?php

namespace app\controllers;

use app\forms\task\TaskForm;
use app\forms\task\TaskSearchForm;
use app\repositories\TaskRepository;
use app\services\TaskService;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;

class TaskController extends Controller
{
    private $service;
    private $request;
    private $tasks;

    public function __construct(
        $id,
        $module,
        TaskRepository $tasks,
        TaskService $service,
        Request $request,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->tasks = $tasks;
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
        $task = $this->tasks->get($id);

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
        $task = $this->tasks->get($id);
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

    public function actionDelete($id): Response
    {
        $task = $this->tasks->get($id);
        $task->delete();
        return $this->redirect(['index']);
    }

    public function actionFake(): Response
    {
        $this->service->createFakeData();
        return $this->redirect(['index']);
    }

}