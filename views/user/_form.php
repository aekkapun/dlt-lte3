<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\OffLocCode;
use bookin\aws\checkbox\AwesomeCheckbox;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'id_no')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?=
            $form->field($model, 'org_code')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\OffLocCode::find()->all(), 'OFF_LOC_CODE','OFF_LOC_DESC'),
                'disabled' => false,
                'options' => ['placeholder' => 'เลือก  สำนักงาน',
                    'id' => 'ddl-org',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('สำนักงาน');
            ?>
        </div>
    </div>
<div class="row">
    <div class="col-md-4">
        <?php
        echo $form->field($model, 'status')->widget(AwesomeCheckbox::classname(),[
            'type'=>AwesomeCheckbox::TYPE_RADIO,
            'style'=>AwesomeCheckbox::STYLE_PRIMARY,
            'options'=>[
                'class'=>'form-controlradio'
            ],
            'list'=>[ // array data
                '10'=>'อนุมัติ',
                '0'=>'ไม่อนุมัติ'
            ]
        ]);
        ?>
    </div>
</div>



    <?php // $form->field($model, 'role')->textInput() ?>
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
