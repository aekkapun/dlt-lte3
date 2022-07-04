<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\select2\Select2;
use kartik\color\ColorInput;
/* @var $this yii\web\View */
/* @var $model app\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">
        <div class="panel-body">
            <?php //$form = ActiveForm::begin();
            //
            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
            ?>
            <?=$form->errorSummary($model) ?>
            <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>
            <div class="row">
                <div class="col" >
                    <?=
                    $form->field($model, 'sys_ref')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\app\models\SystemList::find()->orderBy([
                            'ref' => SORT_ASC
                        ])->all(), 'ref','fullSystemName'),
                        'disabled' => false,
                        'options' => ['placeholder' => 'เลือก  ระบบงาน',
                            'id' => 'ddl-builder',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('ระบบงาน');
                    ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('เรื่อง') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'content_question')->widget(\yii\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                           // 'imageManagerJson' => ['/redactor/upload/image-json'],
                           // 'imageUpload' => ['/redactor/upload/image'],
                            //'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'th',
                            'plugins' => ['clips', 'fontcolor','imagemanager']
                        ]
                    ])->label('รายละเอียด แบบย่อ')?>
                </div>
            </div>
            <div class="form-group field-upload_files">
                <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
                <div>
                    <?= FileInput::widget([
                        'name' => 'upload_ajax[]',
                        'options' => ['multiple' => true,'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                        'pluginOptions' => [
                            'initialPreview'=> $initialPreview,
                            'initialPreviewConfig'=> $initialPreviewConfig,
                            'encodeUrl'=>false,
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => true,
                            'overwriteInitial'=>false,

                            //'initialPreviewShowDelete'=>true,
                            //
                            'uploadUrl' => Url::to(['/job/upload-ajax']),

                            'uploadExtraData' => [
                                'ref' => $model->ref,
                            ],
                            'maxFileCount' => 100
                        ]
                    ]);
                    ?>
                </div>
            </div>
            <div class="row block ">
                <div class="col-md-6 col-xs-6">
                    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก' : 'อัพเดทข้อมูล', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . '   btn-block']) ?>
                </div>
                <div class="col-md-6 col-xs-6">
                    <?= Html::resetButton($model->isNewRecord ? '<i class="glyphicon glyphicon-refresh"></i> เคลียร์ข้อมูล' : 'คืนค่าเดิม', ['class' => ($model->isNewRecord ? 'btn btn-danger' : 'btn btn-warning') . '   btn-block']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
</div>
