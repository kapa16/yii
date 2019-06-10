<?php

use app\entities\task\Images;
use yii\helpers\Html;

/** @var Images $model */

?>

<div class="col-md-3 image__preview center-block">
    <?= Html::a(Html::img($model->preview), $model->file, [
        'target' => '_blank',
        'alt' => $model->alt,
    ]) ?>

    <?= Html::tag('p', $model->alt) ?>
</div>
