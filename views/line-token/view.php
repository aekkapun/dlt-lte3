<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LineToken */
?>
<div class="line-token-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'line_token',
            'status',
            'zone',
            'line_desc',
        ],
    ]) ?>

</div>
