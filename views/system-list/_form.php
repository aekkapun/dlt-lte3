<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SystemList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'org_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'system_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'system_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'system_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'system_option')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'system_line')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
