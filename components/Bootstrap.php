<?php

namespace app\components;

use app\entities\task\Tasks;
use app\services\TaskSubscribeService;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\mail\MailerInterface;

class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {

        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(TaskSubscribeService::class, [], [
            $app->params['senderEmail']
        ]);

        Event::on(
            Tasks::class,
            Tasks::EVENT_AFTER_INSERT,
            [$container->get(TaskSubscribeService::class), 'SendNotificationHandler']
        );
    }
}