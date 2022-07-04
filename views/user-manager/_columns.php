<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'username',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fullname',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'roles',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'statusx',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'positionDesc',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'orgFullNameDes',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'offLocDesc',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'offLocCode',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_no',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'title',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'name',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'surname',
    // ],
    [
        'header' => 'กำหนดสิทธ์',
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
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   