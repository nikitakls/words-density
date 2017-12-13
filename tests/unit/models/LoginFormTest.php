<?php

namespace tests\models;

use app\forms\LoginForm;
use Codeception\Specify;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $model;

    public function testLoginWrongParams()
    {
        $this->model = new LoginForm([
            'username' => '',
            'password' => '',
        ]);

        expect_not($this->model->validate());
        expect($this->model->errors)->hasKey('username');
        expect($this->model->errors)->hasKey('password');
    }

    public function testLoginCorrect()
    {
        $this->model = new LoginForm([
            'username' => 'demo',
            'password' => 'demo',
        ]);

        expect_that($this->model->validate());
    }

}
