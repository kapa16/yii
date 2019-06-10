<?php

namespace app\widgets;

use app\entities\task\Tasks;
use app\forms\task\CommentForm;
use yii\bootstrap\Widget;
use yii\data\ActiveDataProvider;

class CommentsWidget extends Widget
{
    /** @var Tasks $task */
    public $task;

    public function run()
    {
        $form = new CommentForm();

        $comments = $this->task->getComments();
        $dataProvider = new ActiveDataProvider([
            'query' => $comments,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('comments/comments', [
            'task' => $this->task,
            'commentForm' => $form,
            'dataProvider' => $dataProvider
        ]);
    }
}