<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Users Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="panel panel-success">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
 //                   'id',
                    'username',
//                    'auth_key',
//                    'password_hash',
//                    'password_reset_token',
                    'email:email',
 //                   'role',
                    [
                        'format'=>'html',
                        'label' => 'Status',
                        'value' =>$model->approve,
                    ],
  //                  'status',
                    'org.OFF_LOC_DESC',
//                    'province_code',
                    'fullname',
                    'id_no',
                    'position',
//                    'created_at',
//                    'updated_at',
                ],
            ]) ?>
        </div>
    </div>
</div>
