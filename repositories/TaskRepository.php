<?php

namespace app\repositories;

use app\entities\task\Status;
use app\entities\task\Tasks;
use DateTime;

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

    public function findIncompleteByDeadline(DateTime $from, DateTime $to)
    {
        return $this->tasks::find()
            ->where(['not in', 'status_id', [Status::DONE, Status::CANCELLED, Status::CLOSED]])
            ->andWhere(['>=', 'deadline', $from->format('Y-m-d H:i:s')])
            ->andWhere(['<=', 'deadline', $to->format('Y-m-d H:i:s')])
            ->all();
    }
}