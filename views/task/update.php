<?php

use app\entities\task\Comments;
use app\entities\task\Tasks;
use app\forms\task\TaskForm;
use app\widgets\CommentsWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model TaskForm */
/* @var $task Tasks */
/* @var $comment Comments */

$this->title = $model->translateControl('edit') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="task-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?= CommentsWidget::widget([
            'task' => $task
    ]) ?>

</div>
