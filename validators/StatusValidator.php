<?php

namespace app\validators;

use yii\validators\Validator;

class StatusValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $statusList = $model->statusList();
        if (!in_array((int)$model->attributes[$attribute], $statusList, false)) {
            $this->addError($model,$attribute, 'Status must be one of status');
        }
    }
}