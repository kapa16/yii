<?php

namespace app\forms\task;

use app\entities\task\Tasks;
use app\helpers\TaskHelper;
use app\behaviors\TranslateBehavior;
use yii\base\Model;

/**
 * Class TaskForm
 * @package app\forms\task
 * @mixin TranslateBehavior
 */
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

    public function behaviors(): array
    {
        return [
            TranslateBehavior::class
        ];
    }

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
        $labels = [];
        foreach ($this->attributes as $key => $attribute) {
            $labels[$key] = $this->translateTask($key);
        }
        return $labels;
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