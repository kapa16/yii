<?php

namespace app\entities\task;

use ReflectionClass;

class Status
{
    public const NEW = 1;
    public const WORK = 2;
    public const CANCELLED = 3;
    public const COMPLETED = 4;

}