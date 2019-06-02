<?php

use app\forms\task\TaskSearchForm;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel TaskSearchForm */
/* @var $dataProvider yii\data\ArrayDataProvider */


$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="user-index">

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Fake data', ['fake'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="box">
        <div class="box-body clearfix">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_card',
                'layout' => '{items}',
            ]) ?>
        </div>

        <div class="box-body">

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_card',
                'layout' => '{pager}',
                'options' => ['class' => 'center-block']
            ]) ?>
        </div>
    </div>
</div>

