<?php

use app\widgets\AjaxDensityWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

  <div class="jumbotron">
    <h1>Main Page!</h1>
    <p class="lead">You have successfully created your Yii-powered application.</p>
  </div>

  <div class="body-content">
	  <?= AjaxDensityWidget::widget( [
			  'loadUrl' => Url::toRoute( 'content/get-last' ),
			  'visible' => ! Yii::$app->user->isGuest && Yii::$app->user->identity->isAfterLogin()
		  ]
	  ); ?>

  </div>
</div>
