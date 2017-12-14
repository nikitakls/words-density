<?php

namespace app\helpers;

use app\collections\UsersCollection;
use app\models\User;
use Yii;
use yii\base\Event;
use yii\base\Object;
use yii\web\IdentityInterface;

class UserIdentity extends Object implements IdentityInterface
{
    private $user;
    private $storage;
    const LOGIN_FLAG = 'after_login';

    public function __construct(User $user, array $config = [])
    {
        $this->user = $user;
        $this->storage = Yii::$app->session;
        parent::__construct($config);
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user->id;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->user->username;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::getRepository()->find($id);

        return $user ? new self($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::getRepository()->findByUsername($username);
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->user->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->user->validatePassword($password);
    }

    private static function getRepository(): UsersCollection
    {
        return Yii::$container->get(UsersCollection::class);
    }

    public function onAfterLogin(Event $event)
    {
        $this->storage->set(self::LOGIN_FLAG, self::LOGIN_FLAG);
    }


    /**
     * Check user after login request
     * @param bool $clearIfTrue clear flag if set
     * @return bool if user login now
     */
    public function isAfterLogin($clearIfTrue = true): bool
    {
        if ($this->storage->has(self::LOGIN_FLAG)) {
            $this->storage->remove(self::LOGIN_FLAG);

            return true;
        }

        return false;
    }


}
