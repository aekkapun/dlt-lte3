<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Manual */

$this->title = 'Update Manual: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'รายการคู่มือต่างๆ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
