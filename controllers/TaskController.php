<?php

namespace app\controllers;

use app\entities\task\Task;
use app\forms\TaskCreateForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class TaskController extends Controller
{
    public function actionIndex(): string
    {
        $taskForm = new TaskCreateForm();
        $dataProvider = new ArrayDataProvider([
            'allModels' => Task::generate(),//$this::$data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id', 'name'],
            ],
        ]);

        return $this->render('index', [
            'taskForm' => $taskForm,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id): string
    {
        return $this->render('view', [
            'task' => Task::generate()[$id],
        ]);
    }

    public function actionCreate()
    {
        $form = new TaskCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            return $this->redirect(['view', 'id' => 1]);
        }

        return $this->render('create', [
            'model' => $form
        ]);
    }
}