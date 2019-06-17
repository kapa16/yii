<?php

namespace app\models;

use app\entities\Users;
use Yii;
use yii\base\BaseObject;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;


class UserIdentity extends BaseObject implements IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;


    public static function find()
    {
        return Users::find();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        if ($user = Users::findOne($id)) {
            return new static($user->toArray());
        }
        return null;
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        if ($user = Users::findOne(['login' => $username])) {
            return new static($user->toArray());
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     * @throws Exception
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
