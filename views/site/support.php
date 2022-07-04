<?php
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\setting\models\OffLocCode;
use app\modules\setting\models\SettingBrand;
use app\modules\setting\models\SettingDevice;
use app\modules\setting\models\SettingProject;
use aryelds\sweetalert\SweetAlert;
$this->title = 'บริษัท นิปด้าคอมพิวเทค จำกัด :CRM';

foreach (Yii::$app->session->getAllFlashes() as $message) {
    echo SweetAlert::widget([
        'options' => [
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
            'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
            'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
            'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
            'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true
        ]
    ]);
}
?>
    <div class="site-index ">

    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">จำนวนอุปกรณ์ทั้งหมด</span>
                    <h5>อุปกรณ์</h5>
                </div>
                <div class="ibox-content" style="background-color: #2e7d32;color: #EBF2F1;">
                    <div class="ibox-content" style="background-color: #2e7d32;color: #EBF2F1;">
                        <?php
                        $column_count = 0;
                        foreach($data as $img) {
                            $column_count++;
                            ?>  <div style="width:auto; height:auto; text-align:center; display:inline-block; margin:0 10px 10px 0;">
                                <h1 class="no-margins"><?= $img['device']?></h1><small><?= $img['name']?></small>

                            </div>
                            <?php
                            if ($column_count == 10) {
                                $column_count = 0;
                                echo '<br>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">รายการแจ้งซ่อม</span>
                    <h5>รายการแจ้งซ่อม</h5>
                </div>
                <div class="ibox-content" style="background-color: #6a1b9a; color: #EBF2F1;">
                    <h1 class="no-margins"><?= $countNotify ?></h1>
                    <small>รายการ</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">รอซ่อม</span>
                    <h5>รอซ่อม</h5>
                </div>
                <div class="ibox-content" style="background-color: #c62828; color: #EBF2F1;">
                    <h1 class="no-margins"><?= $countPending?></h1>
                    <small>รายการ</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row panelibox float-e-margins">
        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,

            'rowOptions'=>function($model){
                if($model->status == 0)
                {
                    return ['class'=>'danger'];
                }
            },
            'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
            'emptyCell'=>'-',
            'tableOptions' =>['class' => 'table table-striped table-bordered'],
            'panel' => [
                'heading'=>'<h3 class="panel-title"><i class="fa fa-desktop" aria-hidden="true"></i> รายการอุปกรณ์</h3>',
                'type'=>'primary',
                'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                'footer'=>false
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn',
                    'header'=>'ลำดับ'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttonOptions' => ['class' => 'btn btn-default'],
                    'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view-ajax}{call-support}</div>',
                    'options' => ['style' => 'width:300px;'],
                    'buttons' => [
                        'view-ajax' => function($url, $model, $key) {
                            $url = Url::to(['/base/master/view-ajax', 'id' => $model->id,'project_code'=>$model->project_code,'off_loc_code'=>$model->off_loc_code]);
                            return Html::a('<i class="fa fa-eye-slash" aria-hidden="true"></i> ', $url, [
                                'class' => 'btn btn-primary',
                                'data-pjax' => '0',
                                'data-toggle' => 'modal',
                                'data-target' => '#myModal',
                                'data-title' => " ข้อมูลอุปกรณ์",
                                'data-pjax' => '0',
                            ]);
                        },
                        'call-support' => function($url, $model, $key) {
                            $url = Url::to(['/base/master-notify/create-ajax', 'device_id' => $model->id,'project_code'=>$model->project_code,'off_loc_code'=>$model->off_loc_code]);
                            return $model->status == 1 ?  Html::a('<i class="fa fa-bell-slash" aria-hidden="true"></i>  ', $url, [
                                'class' => 'btn btn-danger',
                                'data-pjax' => '0',
                                'data-toggle' => 'modal',
                                'data-target' => '#myModal',
                                'data-title' => " แจ้งซ่อม ",
                                'data-pjax' => '0',
                            ]):'<span class="label label-danger"></span> ';
                        },
                    ]
                ],
                [
                    'attribute'=>'project_code',
                    'value' => function ($model, $key, $index) {
                        return $model->project->name;
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(SettingProject::find()->orderBy('id')->asArray()->all(), 'code', 'name'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'contentOptions' => ['class' => 'text-left'],
                    'filterInputOptions' => ['placeholder' => 'กรองตามโครงการ'],
                ],
                [
                    'attribute'=>'off_loc_code',
                    'value' => function ($model, $key, $index) {
                        return $model->office->OFF_LOC_DESC;
                    },
                    'filter'=>false,
//                    'filterType' => GridView::FILTER_SELECT2,
//                    'filter' => ArrayHelper::map(OffLocCode::find()->orderBy('id')->asArray()->all(), 'OFF_LOC_CODE', 'OFF_LOC_DESC'),
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'contentOptions' => ['class' => 'text-left'],
//                    'filterInputOptions' => ['placeholder' => 'กรองตาม สนง.'],
                ],
                'building_no',
                'work_part',
                [
                    'attribute'=>'device_type',
                    'value' => function ($model, $key, $index) {
                        return $model->category->name;
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(SettingDevice::find()->orderBy('id')->asArray()->all(), 'code', 'name'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'contentOptions' => ['class' => 'text-left'],
                    'filterInputOptions' => ['placeholder' => 'กรองตามประเภทอุกรณ์'],
                ],
                [
                    'attribute'=>'brand_code',
                    'value' => function ($model, $key, $index) {
                        return $model->brands->name;
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(SettingBrand::find()->orderBy('id')->asArray()->all(), 'code', 'name'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'contentOptions' => ['class' => 'text-left'],
                    'filterInputOptions' => ['placeholder' => 'กรองตามยี่ห้อ'],
                ],
                'model',
                // 'material_code',
                'serial_no',
                // 'ip_address',
                // 'warranty_status',
                // 'warranty_enddate',
                // 'status',
                // 'comment',
                // 'create_at',
                // 'update_at',
                // 'create_by',
                // 'update_by',

            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
<?php
/*
$x =  \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id);
$current_user_roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
\yii\helpers\VarDumper::dump($current_user_roles);
*/
?>
    <br/>
<?php
/*
if(Yii::$app->user->can('root-admin')){
    echo '<h1>Yes I do</h1>';
}
*/
?>
<?php
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title fa fa-th-large ">...</h4>',
    'size' => 'modal-lg',
]);

echo '...';

Modal::end();
?>

<?php
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title')
        var href = button.attr('href')
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-pulse\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
?>