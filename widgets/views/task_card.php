<?php

/* @var $model Task */

use app\entities\task\Task;
use yii\helpers\Html;

$str = <<<card
    <div class="panel panel-default">
        <div class="panel-heading">{$model->name}
            <span class="label label-success pull-right">{$model->deadline}</span>
            <span class="pull-right">&nbsp;</span>
            <span class="label label-info pull-right">{$model->status->name}</span>
        </div>
        <div class="panel-body">
            Panel content
        </div>
    </div>
card;


echo Html::a($str, ['task/update', 'id' => $model->id]);
