<?php

namespace app\services;

use app\entities\task\Task;
use app\forms\task\TaskCreateForm;
use app\repositories\StatusRepository;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;

class TaskService
{
    private $tasks;
    private $statuses;
    private $users;

    /**
     * TaskService constructor.
     * @param TaskRepository $tasks
     * @param StatusRepository $statuses
     * @param UserRepository $users
     */
    public function __construct(TaskRepository $tasks, StatusRepository $statuses, UserRepository $users)
    {
        $this->tasks = $tasks;
        $this->statuses = $statuses;
        $this->users = $users;
    }

    public function create($creatorId, TaskCreateForm $form): Task
    {
        $creator = $this->users->get($creatorId);
        $responsible = $this->users->get($form->responsible);
        $status = $this->statuses->get($form->status);

        $task = Task::create(
            $form->name,
            $form->description,
            $status->id,
            $creator->id,
            $responsible->id,
            date('Y.m.d',strtotime($form->deadline))
        );
        $this->tasks->save($task);
        return $task;
    }
}