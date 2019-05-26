<?php

namespace app\forms\task;

use app\helpers\TaskHelper;
use yii\base\Model;

class TaskCreateForm extends Model
{
    public $id;
    public $name;
    public $status;
    public $deadline;
    public $description;
    public $responsible;

    public function rules(): array
    {
        return [
            [['name', 'status', 'responsible', 'deadline'], 'required'],
            [['responsible', 'status'], 'integer'],
            ['description', 'string'],
            ['deadline', 'date'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'Number',
            'name' => 'Task name',
        ];
    }

    public function statusList(): array
    {
        return TaskHelper::statusList();
    }

    public function responsibleList(): array
    {
        return TaskHelper::responsibleList();
    }
}