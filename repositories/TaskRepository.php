<?php

namespace app\repositories;

use app\entities\task\Task;

class TaskRepository
{
    public function get($id): Task
    {
        if (!$task = Task::findOne($id)) {
            throw new NotFoundException('Task not found');
        }
        return $task;
    }

    public function save(Task $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}