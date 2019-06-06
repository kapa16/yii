<?php

use app\forms\task\TaskSearchForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel TaskSearchForm */
/* @var $dataProvider yii\data\ArrayDataProvider */


$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="task-index">

    <div class="box">
        <div class="col-md-9">
            <?php $form = ActiveForm::begin([
                'id' => 'filter-form',
                'options' => [
                    'class' => 'form-inline',
                ],
            ]) ?>
            <?= $form->field($searchModel, 'month', ['template' => "{label}\n{input}"])->dropDownList($searchModel->monthsList()) ?>

            <?= Html::submitButton('Find', ['class' => 'btn btn-primary form-control']) ?>
            <?php ActiveForm::end() ?>

        </div>
        <div class="col-md-3">

            <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Fake data', ['fake'], ['class' => 'btn btn-primary']) ?>
        </div>
        <p class="row"></p>
    </div>

    <div class="box">
        <div class="box-body clearfix">
            <?= ListView::widget(['dataProvider' => $dataProvider,
                                  'itemView' => '_card',
                                  'layout' => '{items}',]) ?>
        </div>

        <div class="box-body">

            <?= ListView::widget(['dataProvider' => $dataProvider,
                                  'itemView' => '_card',
                                  'layout' => '{pager}',
                                  'options' => ['class' => 'center-block']]) ?>
        </div>
    </div>
</div>

