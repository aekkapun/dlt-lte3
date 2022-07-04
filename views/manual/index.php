<?php

use yii\helpers\Html;
use  kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการคู่มือต่างๆ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> บันทึกรายการ', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
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
            ['class' => 'yii\grid\SerialColumn'],
            'title',
           [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group">{view} {update}{delete}</div>',
               'visibleButtons' => [
                   'update' => Yii::$app->user->identity->role==99,
                   'delete' => Yii::$app->user->identity->role==99,
               ],
                                        'buttons'=>[
                            'view' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-folder-close"></i> อ่านเพิ่มเติม..',$url,['class'=>'btn btn-primary']);
                            },
                        ],
                'options'=> ['style'=>'width:120px;'],
            ],
        ],
    ]); ?>
</div>
