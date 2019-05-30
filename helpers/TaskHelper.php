<?php

namespace app\helpers;

use app\entities\task\Status;
use app\entities\Users;
use yii\helpers\ArrayHelper;

class TaskHelper
{

    public static function statusList(): array
    {
        return ArrayHelper::map(Status::find()->asArray()->all(), 'id', 'name');
    }

    public static function responsibleList(): array
    {
        return ArrayHelper::map(Users::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }
}