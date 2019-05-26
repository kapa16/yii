<?php

use app\forms\task\TaskCreateForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $model TaskCreateForm */


$this->title = 'New task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'id' => 'task-create-form',
            'options' => ['class' => 'form-horizontal'],
        ]); ?>
        <?= $form->field($model, 'name') ?>

        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'status')->dropDownList($model->statusList()) ?>
            </div>
            <div class="col-md-offset-2 col-md-5">
                <?= $form->field($model, 'deadline')
                    ->widget(DatePicker::class, [
                            'options' => ['class' => 'form-control'],
//                            'dateFormat' => 'yyyy.MM.dd'
                    ]) ?>
            </div>
        </div>

        <?= $form->field($model, 'responsible')->dropDownList($model->responsibleList()) ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>

</div>
