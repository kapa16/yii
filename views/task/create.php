<?php

use app\helpers\TaskHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
        <?= $form->field($model, 'title') ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'type')->dropDownList(TaskHelper::typesList()) ?>
            </div>
            <div class="mb-1 col-md-4">

                <?= $form->field($model, 'status')->dropDownList(TaskHelper::statusList()) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'priority')
                    ->textInput(['type' => 'number', 'max' => 10, 'value' => 1]) ?>
            </div>
        </div>

        <?= $form->field($model, 'implementer')->textInput() ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>

</div>
