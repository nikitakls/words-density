<?php

namespace tests\models;

use app\fixtures\UserFixture;
use app\helpers\UserIdentity;

class UserTest extends \Codeception\Test\Unit
{
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testFindUserById()
    {
        expect_that($user = UserIdentity::findIdentity(1));
        expect($user->username)->equals('okirlin');

        expect_not(UserIdentity::findIdentity(999));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = UserIdentity::findByUsername('okirlin'));
        expect_not(UserIdentity::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = UserIdentity::findByUsername('okirlin');

        expect_that($user->validatePassword('password_0'));
        expect_not($user->validatePassword('123456'));
    }

}
