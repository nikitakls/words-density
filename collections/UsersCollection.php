<?php

namespace app\collections;

use app\models\User;

class UsersCollection
{

    public function find($id)
    {
        return User::findOne($id);
    }

    public function findByUsername(string $username)
    {
        return User::find()
            ->where(['username' => $username])
            ->orderBy('id DESC')
            ->limit(1)
            ->one();
    }

    public function save(User $user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

}