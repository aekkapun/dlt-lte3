<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobRequest */

$this->title = 'แจ้งปัญหา การใช้งานระบบงานต่างๆ';
$this->params['breadcrumbs'][] = ['label' => 'รายการแจ้งปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-request-create">
    <div class="card bg-light mb-3">
        <div class="text-white bg-secondary card-header"><?= $this->title?> </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
                'initialPreview'=>[],
                'initialPreviewConfig'=>[]
            ]) ?>
        </div>
    </div>
</div>
