<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $taskForm app\forms\TaskCreateForm */
/* @var $dataProvider yii\data\ArrayDataProvider */


$this->title = 'Task list';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="user-index">

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $taskForm,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'title',
                        'value' => function ($model) {
                            return Html::a(Html::encode($model['title']), ['view', 'id' => $model['id']]);
                        },
                        'format' => 'raw',
                    ],
                    'type',
                    'status',
                    'priority',
                    ['class' => ActionColumn::class],
                ],
            ]) ?>
        </div>
    </div>
</div>

