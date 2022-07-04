<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\typeahead\TypeaheadBasic;
//use bookin\aws\checkbox\AwesomeCheckbox;
use yii\helpers\Url;
use aekkapun\aws\checkbox\AwesomeCheckbox;
?>

<div class="booking-search" >
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'action' => ['index-admin'],
                'method' => 'get',
            ]); ?>

            <div class="row">
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'sys_ref')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\app\models\SystemList::find()->all(), 'ref','fullSystemName'),
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
                <div class="col-md-3">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('เรื่อง') ?>
                </div>
                <div class="col-md-2">
                    <?php
                    echo $form->field($model, 'job_status')->radioList(
                        [                            '1'=>'รอตรวจสอบ',
                            '2'=>'กำลังตรวจสอบ',
                            '3'=>'ยุติปัญหาโดยแอดมิน',
                            '4'=>'ยุติปัญหาโดยตนเอง'
                        ],
                        ['custom' => true, 'id' => 'custom-radio-list']
                    );
                    ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <br/>
                        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> ค้นหา', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('<i class="fa fa-undo" aria-hidden="true"></i> ยกเลิก', ['index'], ['class' => 'btn btn-warning']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</hr>
