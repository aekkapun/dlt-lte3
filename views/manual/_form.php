<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Manual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'th',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ])->label('รายละเอียด')?>

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
