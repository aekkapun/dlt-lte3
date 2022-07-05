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
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-bookmark" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
           <?= $model->content ?>
        </div>

        <div class="card-footer">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            เขียนโดย : <?= $model->creator->fullname?> || <?= $model->create_at?>
        </div>

    <?php /*
    DetailView::widget([
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
    ])
 */
 ?>

</div>
