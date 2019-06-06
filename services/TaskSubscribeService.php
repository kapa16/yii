<?php

namespace app\services;

use app\entities\task\Tasks;
use app\entities\Users;
use yii\mail\MailerInterface;

class TaskSubscribeService
{
    private $senderEmail;
    private $mailer;
    private $task;

    public function __construct($senderEmail, MailerInterface $mailer)
    {
        $this->senderEmail = $senderEmail;
        $this->mailer = $mailer;
    }

    public function SendNotificationHandler($event): void
    {
        /** @var Tasks $eventSender */
        $this->task = $event->sender;
        if (!is_a($this->task, Tasks::class)) {
            throw new \UnexpectedValueException ('Invalid event sender type');
        }

        $this->SendNotification($this->task->responsible);
    }

    private function SendNotification(Users $user): void
    {
        $this->mailer->compose(
            ['html' => 'task/createNotification-html'],
            [
                'user' => $user,
                'task' => $this->task,
            ])
            ->setTo($user->email)
            ->setFrom($this->senderEmail)
            ->setSubject('New task')
            ->send();
    }

}