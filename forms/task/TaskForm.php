<?php

namespace app\forms\task;

use app\entities\task\Tasks;
use app\helpers\TaskHelper;
use yii\base\Model;

class TaskForm extends Model
{
    public $id;
    public $name;
    public $status;
    public $deadline;
    public $description;
    public $responsible;
    public $creator;
    public $created_at;
    public $updated_at;


    public function loadData(Tasks $model): void
    {
        $this->id = $model->id;
        $this->name = $model->name;
        $this->status = $model->status;
        $this->deadline = $model->deadline;
        $this->description = $model->description;
        $this->responsible = $model->responsible;
        $this->creator = $model->creator;
        $this->created_at = $model->created_at;
        $this->updated_at = $model->updated_at;
    }

    public function rules(): array
    {
        return [
            [['name', 'status', 'responsible', 'deadline'], 'required'],
            [['responsible', 'status'], 'integer'],
            ['description', 'string'],
            ['deadline', 'date'],
            [['creator', 'created_at', 'updated_at'], 'safe'],
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