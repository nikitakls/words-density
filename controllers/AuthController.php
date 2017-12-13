<?php

namespace app\controllers;

use app\forms\LoginForm;
use app\forms\SignupForm;
use app\services\ContentService;
use app\services\UserService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

class AuthController extends \yii\web\Controller {
	private $service;

	public function __construct( $id, $module, UserService $service, array $config = [] ) {

		$this->service = $service;
		parent::__construct( $id, $module, $config );
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => [ 'logout' ],
				'rules' => [
					[
						'actions' => [ 'logout' ],
						'allow'   => true,
						'roles'   => [ '@' ],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => [ 'post' ],
				],
			],
		];
	}


	/**
	 * Login action.
	 * @throws
	 * @return Response|string
	 */
	public function actionLogin() {
		if ( ! Yii::$app->user->isGuest ) {
			return $this->goHome();
		}

		$form = new LoginForm();
		if ( $form->load( Yii::$app->request->post() ) && $form->validate() ) {
			try {
				$identity = $this->service->auth( $form );
				Yii::$app->user->login( $identity, Yii::$app->params['rememberMeDuration'] );
				Yii::$container->get( ContentService::class )
				               ->registerNewText( $form->content, Yii::$app->user->id );

			} catch ( \DomainException $e ) {
				Yii::$app->session->setFlash( 'error', $e->getMessage() );
			}

			return $this->goBack();
		}

		return $this->render( 'login', [
			'model' => $form,
		] );
	}

	/**
	 * Signup action.
	 *
	 * @return Response|string
	 */

	public function actionSignup() {
		$form = new SignupForm();
		if ( $form->load( Yii::$app->request->post() ) && $form->validate() ) {
			try {
				$this->service->signup( $form );
				Yii::$app->session->setFlash( 'info', 'Thank you for registration on service.' );

				return $this->goBack();

			} catch ( \RuntimeException $e ) {
				Yii::$app->errorHandler->logException( $e );
				Yii::$app->session->setFlash( 'error', $e->getMessage() );
			}
		}

		return $this->render( 'signup', [
			'model' => $form
		] );
	}

	/**
	 * Logout action.
	 *
	 * @return Response|string
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}

}
