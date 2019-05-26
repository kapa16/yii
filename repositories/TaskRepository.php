<?php

namespace app\repositories;

use app\entities\task\Task;

class TaskRepository
{
    public function save(Task $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}