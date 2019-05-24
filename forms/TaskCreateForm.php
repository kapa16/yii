<?php

namespace app\forms;

use app\helpers\TaskHelper;
use app\validators\StatusValidator;
use yii\base\Model;

class TaskCreateForm extends Model
{
    public $id;
    public $title;
    public $type;
    public $status;
    public $priority;
    public $description;
    public $implementer;

    public function rules(): array
    {
        return [
            [['title', 'type', 'status', 'priority', 'implementer'], 'required'],
            [['type', 'status', 'priority'], 'integer'],
            ['description', 'string'],
            ['status', StatusValidator::class],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'Number',
            'title' => 'Task title',
        ];
    }

}