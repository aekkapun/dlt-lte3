<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SystemList */
?>
<div class="system-list-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ref',
            'org_id',
            'system_title',
            'system_detail:ntext',
            'system_img',
            'system_option',
            'system_line',
        ],
    ]) ?>

</div>
