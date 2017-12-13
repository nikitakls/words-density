<?php

namespace app\controllers;

use app\services\ContentService;
use app\widgets\AjaxDensityWidget;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class ContentController extends Controller {

	/**
	 * Displays density for text via ajax request.
	 *
	 * @throws
	 * @return string
	 */
	public function actionGetLast() {
		try {
			$service = Yii::$container->get( ContentService::class );
			$data    = $service->getLastTextDensity( Yii::$app->user->id );
			/*$data = [
				'w1' => 1,
				'w2' => 1,
				'w3' => 1,
				'w4' => 1,
				'w5' => 1,
			];*/
			$dataProvider = new ArrayDataProvider( [
				'allModels' => array_map( function ( $count, $word ) {
					return [ 'word' => $word, 'count' => $count ];
				}, $data, array_keys( $data ) )

			] );

			return AjaxDensityWidget::widget( [
					'dataProvider' => $dataProvider,
				]
			);

		} catch ( \DomainException $e ) {
			return [ 'status' => 'error', 'message' => $e->getMessage() ];
		}

	}

}
