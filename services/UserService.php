<?php
/**
 * UserService.php
 * User: nikitakls
 * Date: 12.12.17
 * Time: 19:42
 */

namespace app\services;

use app\collections\UsersCollection;
use app\forms\LoginForm;
use app\forms\SignupForm;
use app\models\User;
use app\helpers\UserIdentity;

class UserService {

	private $users;

	public function __construct( UsersCollection $users ) {
		$this->users = $users;
	}

	/**
	 * Signup user
	 *
	 * @throws \RuntimeException
	 *
	 * @param SignupForm $form
	 *
	 * @return User
	 */
	public function signup( SignupForm $form ) {
		$user = User::signup( $form );
		$this->users->save( $user );

		return $user;
	}


	/**
	 * Auth user
	 *
	 * @throws \DomainException
	 *
	 * @param LoginForm $form
	 *
	 * @return UserIdentity
	 */

	public function auth( LoginForm $form ): UserIdentity {
		/* @var $user \app\models\User */
		$user = $this->users->findByUsername( $form->username );
		if ( ! $user || ! $user->validatePassword( $form->password ) ) {
			throw new \DomainException( 'Undefined user or password.' );
		}

		return new UserIdentity( $user );
	}

}