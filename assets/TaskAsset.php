<?php

namespace app\assets;

use yii\web\AssetBundle;

class TaskAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/style.css',
    ];

}