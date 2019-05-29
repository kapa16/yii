<?php

namespace app\entities;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $last_name
 * @property string auth_key
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class Users extends ActiveRecord
{
    public const SCENARIO_AUTH = 'auth';

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['login'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['login'], 'string', 'max' => 100],
            [['password', 'name', 'last_name', 'email'], 'string', 'max' => 255],
            [['login'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'login',
            'password' => 'Password',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields()
    {
        if (self::SCENARIO_AUTH) {
            return [
                'id' => 'id',
                'username' => 'login',
                'password' => 'password',
            ];
        }
        return parent::fields();
    }
}