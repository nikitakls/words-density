<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $dataProvider yii\data\BaseDataProvider.
 */

Pjax::begin(['id' => 'density-' . $id]);

if ($dataProvider != null) {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'word',
            'count',
        ],
    ]);
}

Pjax::end();
