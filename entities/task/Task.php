<?php

namespace app\entities\task;

use app\entities\Users;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
        $responsible_id,
        $deadline
    ): self
    {
        $task = new static();
        $task->name = $name;
        $task->description = $description;
        $task->status_id = $status_id;
        $task->creator_id = $creator_id;
        $task->responsible_id = $responsible_id;
        $task->deadline = $deadline;
        $task->created_at = date('Y.m.d H:i:s');
        return $task;
    }

    public static function tableName()
    {
        return 'tasks';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['status_id', 'creator_id', 'responsible_id'], 'integer'],
            [['deadline', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['responsible_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status_id' => 'Status ID',
            'creator_id' => 'Creator ID',
            'responsible_id' => 'Responsible ID',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
