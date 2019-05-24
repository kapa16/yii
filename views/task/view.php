<?php

use yii\helpers\Html;

/* @var $task array */

$this->title = 'Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

 ?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="user-index">

    <p>
        <?= Html::a('Edit', ['edit', 'id' => $task['id']], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $task['id']], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <h3><?=$task['title']?></h3>
            <hr>
            <div class="row">
                <div class="col-md-4"><strong>Type:</strong> <?=$task['type']?></div>
                <div class="col-md-4"><strong>Status:</strong> <?=$task['status']?></div>
                <div class="col-md-4"><strong>Priority:</strong> <?=$task['priority']?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <strong>Description:</strong>
                    <p><?=$task['description']?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6"><strong>Author:</strong> <?=$task['author']?></div>
                <div class="col-md-6"><strong>Implementer:</strong> <?=$task['implementer']?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6"><strong>Created:</strong> <?=$task['created']->format('d.m.Y')?></div>
                <div class="col-md-6"><strong>Updated:</strong> <?=$task['updated']->format('d.m.Y')?></div>
            </div>
        </div>
    </div>

</div>
