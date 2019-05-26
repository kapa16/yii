<?php

namespace app\helpers;

use app\entities\task\Status;
use app\entities\User;
use yii\helpers\ArrayHelper;

class TaskHelper
{

    public static function statusList(): array
    {
        return ArrayHelper::map(Status::find()->asArray()->all(), 'id', 'name');
    }

    public static function responsibleList(): array
    {
        return ArrayHelper::map(User::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }
}