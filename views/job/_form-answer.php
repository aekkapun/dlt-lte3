<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use bookin\aws\checkbox\AwesomeCheckbox;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">
    <hr/>
    <div class="panel panel-primary">
        <div class="panel-heading"><h4> <i class="fa fa-retweet" aria-hidden="true"></i> <?= $this->title ?></h4></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?=$form->errorSummary($model) ?>
            <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'format'=>'html',
                        'label' => 'เรื่อง',
                        'value' => $model->title . ' ('.$model->status.')',
                    ],
                    [
                        'format'=>'html',
                        'label' => 'ระบบงาน',
                        'value' => $model->system->system_title,
                    ],
                    [
                        'format'=>'html',
                        'label' => 'รายละเอียด',
                        'value' => '<span style="color:green;">'.$model->content_question.'</span>'
                    ],
                    [
                        'format'=>'html',
                        'label' => 'จาก',
                        'value' => $model->dltOffice->OFF_LOC_DESC
                    ],
                    /*
                    [
                        'format'=>'raw',
                        'label' => 'QR_CODE',
                        'value' => '<img src="'.$qr->render($data).'" class="rounded mx-auto d-block" alt="...">'
                    ],
                    */
                ],
            ]) ?>
            <div class="panel-body">
                <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->title)]);?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'content_answer')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                           'imageManagerJson' => ['/redactor/upload/image-json'],
                           'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'th',
                            'plugins' => ['clips', 'fontcolor','imagemanager']
                        ]
                    ])->label('รายละเอียด / วิธีแก้ไข')?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php
                    echo $form->field($model, 'job_status')->radioList(
                        [                            '1'=>'รอตรวจสอบ',
                            '2'=>'กำลังตรวจสอบ',
                            '3'=>'ยุติปัญหาโดยแอดมิน',
                            '4'=>'ยุติปัญหาโดยตนเอง'
                        ],
                        ['custom' => true, 'id' => 'cucomposer stom-radio-list']
                    );
                    ?>
                </div>
                <div class="col-md-4">
                    <h5>ผู้ตอบ <span class="label label-info"><?= Yii::$app->user->identity->fullName?></span></h5>
                    <?= $form->field($model, 'answer_by')->hiddenInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'job_close_date')->textInput(['disabled' => true]) ?>
                </div>
            </div>
            <div class="row block ">
                <div class="col-md-6 col-xs-6">
                    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก' : 'บันทึก', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . '   btn-block']) ?>
                </div>
                <div class="col-md-6 col-xs-6">
                    <?= Html::resetButton($model->isNewRecord ? '<i class="glyphicon glyphicon-refresh"></i> เคลียร์ข้อมูล' : 'คืนค่าเดิม', ['class' => ($model->isNewRecord ? 'btn btn-danger' : 'btn btn-warning') . '   btn-block']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
