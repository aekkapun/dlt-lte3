<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'เข้าสู่ระบบ';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">

    <div class="col-md-10 col-md-offset-1 main" >
        <div class="col-md-6 left-side" >
            <h3>Live Service</h3>
            <p>Computer Support Department Of Landtransport</p>
            <br>


        </div><!--col-sm-6-->

        <div class="col-md-6 right-side">
            <h3>Login</h3>

            <!--Form with header-->
            <div class="form">

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->label('ชื่อผู้ใช้งาน') ?>
                <?= $form->field($model, 'password')->passwordInput()->label('รหัสผ่าน') ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= Html::resetButton('ยกเลิก', ['class' => 'btn btn-danger', 'name' => 'reset-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>


            </div>
            <!--/Form with header-->

        </div><!--col-sm-6-->


    </div><!--col-sm-8-->

</div><!--container-->