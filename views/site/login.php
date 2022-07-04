<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'ระบบงานบริหารจัดการ ควบคุม กำกับดูแลการใช้เครื่องหมายพิเศษ(ป้ายแดง) กรมการขนส่งทางบก';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form-rpms',
    'options'=>[
        'class'=>'form-signin lock-box text-center'
    ]
]); ?>

<a href="<?=Url::home()?>" class="logo text-center"><img alt="" src="<?=Yii::getAlias('@web')?>/statics/img/logo.png"> </a>

<div class="login-wrap">
    <h4 class="text-center" >ระบบงานบริหารจัดการ ควบคุม กำกับดูแลการใช้เครื่องหมายพิเศษ(ป้ายแดง)</h4>
    <?= $form->field($model, 'username',[
        'inputOptions' => ['class'=>'form-control', 'placeholder' => 'username'],
        'inputTemplate' => '<div class="input-group m-bot15">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {input}
                            </div>',
    ])->label(false) ?>
    <?= $form->field($model, 'password',[
        'inputOptions' => ['class'=>'form-control', 'placeholder' =>  'password'],
        'inputTemplate' => '<div class="input-group m-bot15">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {input}
                            </div>',
    ])->passwordInput()->label(false) ?>

    <?= $form->field($model, 'rememberMe',[
        'inputTemplate'=>'{input}',
        'options' => [
        ],
    ])->checkbox() ?>

    <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-lg btn-login btn-block  btn-primary', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>


