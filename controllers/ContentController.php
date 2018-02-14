<?php

namespace app\controllers;

use app\services\ContentService;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class ContentController extends Controller
{

    /**
     * Displays density for text via ajax request.
     *
     * @throws
     * @return string
     */
    public function actionGetLast()
    {
        try {
            $service = Yii::$container->get(ContentService::class);
            $data = $service->getLastTextDensity(Yii::$app->user->id);
            $dataProvider = new ArrayDataProvider([
                'allModels' => array_map(function ($count, $word) {
                    return ['word' => $word, 'count' => $count];
                }, $data, array_keys($data))

            ]);

            return $this->renderAjax('content', [
                'dataProvider' => $dataProvider
            ]);
        } catch (\DomainException $e) {
            return $this->renderAjax('error', [
                'message' => $e->getMessage()
            ]);
        }
    }

}
