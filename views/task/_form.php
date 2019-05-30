<?php

use app\forms\task\TaskForm;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model TaskForm */
/* @var $form ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList($model->statusList()) ?>
        </div>
        <div class="col-md-offset-1 col-md-5">
            <?= $form->field($model, 'deadline')
                ->widget(DatePicker::class, [
                    'options' => ['class' => 'form-control'],
                ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'responsible')->dropDownList($model->responsibleList()) ?>
        </div>
        <div class="col-md-offset-1 col-md-5">
            <?= $form->field($model, 'created_at')->textInput(['disabled' => '']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model->creator, 'name')->textInput(['disabled' => ''])->label('Creator') ?>
        </div>
        <div class="col-md-offset-1 col-md-5">
            <?= $form->field($model, 'updated_at')->textInput(['disabled' => '']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
