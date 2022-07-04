<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Booking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_SUCCESS,
            'heading' => '<i class="fa fa-th-list" aria-hidden="true"></i> '.$this->title,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                    [
            'attribute' => 'builder_ref',
            'headerOptions' => ['width' => 'auto'],
            'value' => function ($model, $key, $index, $widget) {
                return $model->builder->b_desc;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\app\models\Builder::find()->orderBy('id')->asArray()->all(), 'b_code', 'b_desc'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'contentOptions' => ['class' => 'text-rght'],
            'filterInputOptions' => ['placeholder' => 'กรองตามอาคาร'],
        ],
            'title',
             [

                'label' => 'รายละเอียด',
                'format'=>'raw',
                'value'=>function ($model, $key, $index) {
                    return @$model->content;
                }
            ],
            [
                'attribute' => 'builder_ref',
                'headerOptions' => ['width' => 'auto'],
                'value' => function ($model, $key, $index, $widget) {
                    return $model->builder->b_desc;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Builder::find()->orderBy('id')->asArray()->all(), 'b_code', 'b_desc'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'contentOptions' => ['class' => 'text-rght'],
                'filterInputOptions' => ['placeholder' => 'กรองตามอาคาร'],
            ],
            [
                'label'=>'ห้องประชุม',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->room->room_title;
                },
            ],
            [
                'label'=>'เริ่ม',
                'format' => 'raw',
                'value' => function($model) {
                    return \app\models\MyDate::getDateThaifull($model->start_meet);
                },
            ],
            [
                'label'=>'สิ้นสุด',
                'format' => 'raw',
                'value' => function($model) {
                    return \app\models\MyDate::getDateThaifull($model->end_meet);
                },
            ],
            //'booking',
            'approve',
            //'create_at',
            //'update_at',
            //'create_by',
            //'update_by',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
