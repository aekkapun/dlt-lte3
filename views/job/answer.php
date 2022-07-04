<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobRequest */

$this->title = 'รายการแจ้งปัญหา : ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'รายการแจ้งปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ตอบปัญหา/คำแนะนำ';
?>
<div class="job-request-update">
    <div class="card card-primary">
        <div class="card-header ">
            <h3 class="card-title">รายละเอียด / วิธีแก้ไข</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>

        </div>

        <div class="card-body">
            <?= $this->render('_form-answer', [
                'model' => $model,
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig'=>$initialPreviewConfig
            ]) ?>
        </div>

    </div>

</div>
