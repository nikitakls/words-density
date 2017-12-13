<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\data\BaseDataProvider;

class AjaxDensityWidget extends Widget {

	public $visible = true;

	/**
	 * @var string url route for loading data via ajax.
	 */

	public $loadUrl;

	/**
	 * @var BaseDataProvider.
	 */
	public $dataProvider;


	/**
	 * {@inheritdoc}
	 */
	public function run() {
		if ( ! $this->visible ) {
			return '';
		}

		if($this->dataProvider == null)
			$this->registerJs();

		return $this->render( '_density', [
			'id'           => $this->id,
			'dataProvider' => $this->dataProvider,
		] );
	}

	public function registerJs() {
		$view = Yii::$app->getView();
		$view->registerJs( '
			$.pjax.reload({container:"#density-' . $this->id . '", url:"' . $this->loadUrl . '", "push":false,"replace":false})
		' );
	}

}
