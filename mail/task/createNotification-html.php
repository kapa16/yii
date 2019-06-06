<?php

use app\entities\task\Task;
use app\entities\Users;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $user Users */
/* @var $task Task */

$taskLink = Yii::$app->urlManager->createAbsoluteUrl(['task/view', 'id' => $task->id]);
?>
<div>
    <p>Hello <?= Html::encode($user->name . ' ' . $user->last_name) ?>,</p>

    <p>Yuo have new task: <?= Html::encode($task->name) ?></p>

    <p>Follow the link below to open task:</p>

    <p><?= Html::a(Html::encode($taskLink), $taskLink) ?></p>

</div>
