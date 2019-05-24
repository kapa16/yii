<?php


namespace app\helpers;


use app\entities\task\Status;
use app\entities\task\Type;

class TaskHelper
{
    public static function statusList(): array
    {
        return [
            Status::NEW => 'New',
            Status::WORK => 'Work',
            Status::CANCELLED => 'Cancelled',
            Status::COMPLETED => 'Completed',
        ];
    }
    public static function typesList(): array
    {
        return [
            Type::NEW_FEATURE => 'New feature',
            Type::FIX_BUG => 'Fix bug',
            Type::ERROR => 'Error',
        ];
    }
}