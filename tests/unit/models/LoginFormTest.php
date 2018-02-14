<?php

namespace tests\models;

use app\forms\LoginForm;

/**
 * Class LoginFormTest
 * @package tests\models
 * @mixin \UnitTester
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testLoginWrongParams()
    {
        $model = new LoginForm([
            'username' => '',
            'password' => '',
        ]);

        $this->assertFalse($model->validate());
        $this->assertArrayHasKey('username', $model->errors);
        $this->assertArrayHasKey('password', $model->errors);
        $this->assertArrayHasKey('content', $model->errors);
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'demoname',
            'password' => 'demopass',
            'content' => 'demo content',
        ]);
        $this->assertTrue($model->validate());
    }

}
