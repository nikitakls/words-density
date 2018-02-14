<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'word',
            'count',
        ],
    ]); ?>
<?php Pjax::end() ?>