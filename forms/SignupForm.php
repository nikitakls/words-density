<?php

namespace app\forms;


use app\models\User;
use yii\base\Model;

class SignupForm extends Model {

	public $username;
	public $password;

	/**
	 * @return array the validation rules.
	 */
	public function rules() {
		return [
			// username and password are both required
			[ [ 'username', 'password' ], 'required' ],
			[ 'username', 'trim' ],
			[
				'username',
				'unique',
				'targetClass' => User::class,
				'message'     => 'This username has already been taken.'
			],
			[ 'username', 'string', 'min' => 2, 'max' => 255 ],
			[ 'password', 'string', 'min' => 6 ],

			// rememberMe must be a boolean value
			// password is validated by validatePassword()
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'username' => 'Username',
			'password' => 'Password',
		];
	}

}