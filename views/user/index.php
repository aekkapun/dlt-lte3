<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลผู้ใช้งาน', ['create'], ['class' => 'btn btn-success']) ?>
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

           // 'id',
            'username',
           // 'auth_key',
           // 'password_hash',
            //'password_reset_token',
            //'email:email',
            //'role',
            //'status',
        [
            'attribute' => 'org_code',
            'headerOptions' => ['width' => '100'],
            'value' => function ($model, $key, $index, $widget) {
                return $model->org->OFF_LOC_DESC;
            },
           'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\app\models\OffLocCode::find()->orderBy('id')->asArray()->all(), 'OFF_LOC_CODE', 'OFF_LOC_DESC'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'contentOptions' => ['class' => 'text-rght'],
            'filterInputOptions' => ['placeholder' => 'กรองตามจสำนักงาน'],
        ],
            //'province_code',
            'fullname',
            'id_no',
            'position',
            //'created_at',
            [
                'header' => 'กำหนดสิทธ์การใช้งาน',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(' กำหนดสิทธ์', ['/admin/assignment/view', 'id' => $model->id], [
                        'class' => 'btn btn-primary fa fa-cogs',
                        'target'=>'_blank',
                        "data-pjax"=>"0"
                    ]);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group">{view} {update}{delete} </div>',
                'options'=> ['style'=>'width:140px;'],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
