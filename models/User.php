<?php

namespace app\models;

use app\forms\SignupForm;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 */
class User extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName(): string {
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(): array {
		return [
			[ [ 'username', 'password_hash' ], 'required' ],
			[ [ 'username', 'password_hash' ], 'string', 'max' => 255 ],
			[ [ 'username' ], 'unique' ],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(): array {
		return [
			'id'            => 'ID',
			'username'      => 'Username',
			'password_hash' => 'Password Hash',
		];
	}

	public static function signup( SignupForm $form ): User {
		$user           = new static();
		$user->username = $form->username;
		$user->generatePassword( $form->password );
		$user->generateAuthKey();

		return $user;
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @throws
	 *
	 * @param string $password
	 */
	public function generatePassword( $password ) {
		$this->password_hash = Yii::$app->security->generatePasswordHash( $password );
	}

	/**
	 * Generates auth key
	 * @throws
	 */
	public function generateAuthKey() {
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	public function validatePassword( $password ) {
		return Yii::$app->security->validatePassword( $password, $this->password_hash );
	}

}
