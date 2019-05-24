<?php

namespace app\validators;

use app\entities\task\Status;
use yii\validators\Validator;

class StatusValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $statusList = Status::getAll();
        if (!in_array($model->attributes, $statusList, true)) {
            $this->addError($model,$attribute, "Status must be one of {$statusList}");
        }
    }
}