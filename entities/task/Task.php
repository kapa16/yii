<?php

namespace app\entities\task;

use app\entities\Users;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status_id
 * @property int $creator_id
 * @property int $responsible_id
 * @property string $deadline
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $creator
 * @property Users $responsible
 * @property Status $status
 */
class Task extends ActiveRecord
{
    public static function create(
        $name,
        $description,
        $status_id,
        $creator_id,
        $responsible_id
    ): self
    {
        $task = new static();
        $task->name = $name;
        $task->description = $description;
        $task->status_id = $status_id;
        $task->creator_id = $creator_id;
        $task->responsible_id = $responsible_id;
//        $task->deadline = $deadline;
        $task->created_at = date('Y.m.d H:i:s');
        return $task;
    }

    public function edit($name, $description, $status_id, $responsible_id, $deadline): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->status_id = $status_id;
        $this->responsible_id = $responsible_id;
        $this->deadline = $deadline;
        $this->updated_at = date('Y.m.d H:i:s');
    }

    public static function tableName(): string
    {
        return 'tasks';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCreator(): ActiveQuery
    {
        return $this->hasOne(Users::class, ['id' => 'creator_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getResponsible(): ActiveQuery
    {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
}
