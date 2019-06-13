<?php

namespace app\controllers;

use app\entities\task\Comments;
use app\entities\task\Images;
use app\forms\task\CommentForm;
use app\forms\task\ImageForm;
use app\forms\task\TaskForm;
use app\forms\task\TaskSearchForm;
use app\repositories\TaskRepository;
use app\services\TaskService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use yii\web\Response;
use yii\web\UploadedFile;

class TaskController extends Controller
{
    private $service;
    private $request;
    private $tasks;
    private $comments;
    private $images;

    public function __construct(
        $id,
        $module,
        TaskRepository $tasks,
        TaskService $service,
        Request $request,
        Comments $comments,
        Images $images,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->tasks = $tasks;
        $this->service = $service;
        $this->request = $request;
        $this->comments = $comments;
        $this->images = $images;
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
            'task' => $task,
            'imageForm' => new ImageForm(),
        ]);
    }

    public function actionDelete($id): Response
    {
        $task = $this->tasks->get($id);
        $task->delete();
        return $this->redirect(['index']);
    }

    public function actionComment($id): Response
    {
        $task = $this->tasks->get($id);
        $form = new CommentForm();

        if ($form->load($this->request->post()) && $form->validate()) {
            $this->comments->create($form->text, $task->id);
        }
        return $this->redirect(['update', 'id' => $task->id]);
    }
    
    public function actionUpload($id): Response
    {
        $task = $this->tasks->get($id);
        $form = new ImageForm();

        if ($form->load($this->request->post())) {
            $form->image = UploadedFile::getInstance($form, 'image');
            if ($form->upload()) {
                $this->images->create($form, $task->id);
            }
        }
        return $this->redirect(['update', 'id' => $task->id]);

    }

    public function actionFake(): Response
    {
        $this->service->createFakeData();
        return $this->redirect(['index']);
    }

}