<?php

namespace app\repositories;

use app\entities\task\Tasks;

class TaskRepository
{
    private $tasks;

    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }


    public function get($id): Tasks
    {
        if (!$task = $this->tasks::findOne($id)) {
            throw new NotFoundException('Task not found');
        }
        return $task;
    }

    public function save(Tasks $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function tableName()
    {
        return $this->tasks::tableName();
    }
}