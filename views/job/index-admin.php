<?php

use yii\helpers\Html;
use  kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการแจ้งปัญหา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">
    <?php
    if (Yii::$app->user->identity->role == 99) {
        echo $this->render('_search-admin', ['model' => $searchModel]);
    } else {
        echo $this->render('_search', ['model' => $searchModel]);
    }
    ?>
    <p>
        <?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> บันทึกรายการแจ้งปัญหา', ['create'], ['class' => 'btn btn-danger']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'pjax' => true,
        'responsive' => true,
        'responsiveWrap' => false,
        'striped' => true,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'hover' => true,
        'floatHeader' => false,
        'panel' => [
            'type' => GridView::TYPE_SUCCESS,
            'heading' => '<i class="fa fa-th-list" aria-hidden="true"></i> '.$this->title,
        ],
        'columns' => [
            [   'class' => 'yii\grid\SerialColumn',
                'options'=> ['style'=>'width:4%;'],
            ],
            [
                'format'=>'raw',
                'attribute' => 'job_ref',
                'options'=> ['style'=>'width:4%;'],
            ],
            [
                'format'=>'raw',
                'attribute' => 'job_request_date',
                'options'=> ['style'=>'width:12%;'],
                'value' => function ($model, $key, $index, $widget) {
                    return \app\models\MyDate::getDateThaifull($model->job_request_date);
                },
            ],
            [
                'label'=>'หน่วยงาน',
                'format'=>'raw',
                //'attribute' => 'question_by',
                'options'=> ['style'=>'width:7%;'],
                'value' => function ($model, $key, $index, $widget) {
                    return $model->dltOffice->OFF_LOC_ABREV;
                },
            ],
            [
                'label'=>'ระบบ',
                'format'=>'raw',
                'attribute' => 'sys_ref',
                'options'=> ['style'=>'width:5%;'],
                'value' => function ($model, $key, $index, $widget) {
                    return $model->sys_ref;
                },
            ],
            'title',



          //  'content_answer',
//            [
//                    'format'=>'raw',
//                'attribute' => 'job_status',
//                'headerOptions' => ['width' => 'auto'],
//                'options'=> ['style'=>'width:10%;'],
//                'value' => function ($model, $key, $index, $widget) {
//                    return $model->status;
//                },
//            ],


            [
               // 'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'job_status',
                'format'=>'html',
                'options'=> ['style'=>'width:13%;'],
                'value' => function ($model, $key, $index, $widget) {
                    return $model->status;
                },/*
                'editableOptions'=> function ($model, $key, $index, $widget) {
                    $appttypes = [
                        '1'=>'รอตรวจสอบ',
                        '2'=>'กำลังตรวจสอบ',
                        '3'=>'ยุติปัญหาโดยแอดมิน',

                    ];
                    return [
                        'header' => 'สถานะ',
                        'attribute' => 'job_status',
                        'size' => 'sm',
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'displayValueConfig' => $appttypes,
                        'data' => $appttypes,
                        'formOptions'=> ['action' => ['/job/update-editable']] // point to new action
                    ];
                    }
*/
            ],

            // 'create_at',
            //'update_at',
            //'create_by',
            //'update_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group">{view} {update}</div>',
                'options'=> ['style'=>'width:10%;'],
            ],
        ],
    ]); ?>
</div>
