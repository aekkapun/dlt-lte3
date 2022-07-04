<?php
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use aryelds\sweetalert\SweetAlert;
$this->title = 'ระบบถามตอบปัญหาต่างๆ';

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
                 <div class="bs-callout bs-callout-warning" id="callout-navs-accessibility"> <h4>Make navs used as navigation accessible</h4> <p>If you are using navs to provide a navigation bar, be sure to add a <code>role="navigation"</code> to the most logical parent container of the <code>&lt;ul&gt;</code>, or wrap a <code>&lt;nav&gt;</code> element around the whole navigation. Do not add the role to the <code>&lt;ul&gt;</code> itself, as this would prevent it from being announced as an actual list by assistive technologies.</p> </div>
            </div> 
    </div>
</div>

