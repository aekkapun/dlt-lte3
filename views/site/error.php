<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<style>
    .bs-callout+.bs-callout {
        margin-top: -5px;
    }
    .bs-callout-warning {
        border-left-color: #aa6708;
    }
    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eb9d43;
        border-left-width: 5px;
        border-radius: 3px;
    }
</style>

<div class="site-index ">

    <div class="row">
             <div class="ibox ">
                 <div class="bs-callout bs-callout-warning" id="callout-navs-accessibility"> 
                    <h4> <?= nl2br(Html::encode($message)) ?></h4> 
    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
     </div>
            </div> 
    </div>
</div>