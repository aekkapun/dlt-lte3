<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserDlt */
?>
<div class="user-dlt-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token:ntext',
            'email:email',
            'role',
            'status',
            'positionDesc',
            'orgFullNameDes',
            'offLocDesc',
            'offLocCode',
            'id_no',
            'title',
            'name',
            'surname',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
