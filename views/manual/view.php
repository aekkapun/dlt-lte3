<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Manual */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'รายการคู่มือต่างๆ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manual-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'create_at',
            'update_at',
            'create_by',
            'update_by',
        ],
    ]) ?>

</div>
