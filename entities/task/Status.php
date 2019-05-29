<?php

namespace app\entities\task;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "task_statuses".
 *
 * @property int $id
 * @property string $name
 */
class Status extends ActiveRecord
{
    public const NEW = 1;
    public const WORK = 2;
    public const CANCELLED = 3;
    public const COMPLETED = 4;

    public static function tableName()
    {
        return 'task_statuses';
    }

}