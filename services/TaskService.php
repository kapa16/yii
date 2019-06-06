<?php

namespace app\services;

use app\entities\task\Task;
use app\forms\task\TaskForm;
use app\repositories\StatusRepository;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use Faker\Factory;

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

    public function create(TaskForm $form): Task
    {
        $responsible = $this->users->get($form->responsible);
        $status = $this->statuses->get($form->status);

        $task = Task::create(
            $form->name,
            $form->description,
            $status->id,
            $responsible->id,
            date('Y.m.d',strtotime($form->deadline))
        );
        $this->tasks->save($task);
        return $task;
    }

    public function edit($d, TaskForm $form): Task
    {
        $task = $this->tasks->get($d);
        $responsible = $this->users->get($form->responsible);
        $status = $this->statuses->get($form->status);

        $task->edit(
            $form->name,
            $form->description,
            $status->id,
            $responsible->id,
            date('Y.m.d',strtotime($form->deadline))
        );
        $this->tasks->save($task);
        return $task;
    }

    public function createFakeData(): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 50; $i++) {
            $task = Task::create(
                $faker->text(15),
                $faker->text(),
                $faker->numberBetween(1, 7),
                $faker->numberBetween(1, 2),
                date('Y-m-d H:i:s')
            );
            $this->tasks->save($task);
        }
    }
}