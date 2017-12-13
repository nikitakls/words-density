<?php

namespace tests\models;

use app\forms\LoginForm;
use app\forms\SignupForm;
use app\services\UserService;
use Yii;
use yii\web\IdentityInterface;

class AuthServiceTest extends \Codeception\Test\Unit {
	protected $tester;

	private function getService() {
		return Yii::$container->get( UserService::class );
	}

	public function testSignup() {
		$user = $this->getService()->signup( new SignupForm( [
			'username' => 'username',
			'password' => 'password',
		] ) );

		expect( $user->username )->equals( 'username' );
		expect_that( $user->validatePassword( 'password' ) );
		expect_not( $user->validatePassword( 'not_valid' ) );
	}

	public function testSuccessLogin() {
		$identity = $this->getService()->auth( new LoginForm( [
			'username' => 'okirlin',
			'password' => 'password_0',
		] ) );

		expect( $identity->username )->equals( 'okirlin' );
		expect_that( Yii::$app->user->isGuest );
		expect_that( $identity instanceof IdentityInterface );

		Yii::$app->user->login( $identity );
		expect( Yii::$app->user->isGuest )->false();
		Yii::$app->user->logout();

	}

	public function testFailLogin() {

		$this->tester->expectException( 'DomainException', function () {
			$this->getService()->auth( new LoginForm( [
				'username' => 'okirlin',
				'password' => 'not_valid',
			] ) );
		} );
	}

}
