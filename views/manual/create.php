<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Manual */

$this->title = 'บันทึกรายการ';
$this->params['breadcrumbs'][] = ['label' => 'รายการคู่มือต่างๆ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manual-create">
    <div class="panel panel-default">
        <div class="panel-heading"><?= $this->title ?></div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
