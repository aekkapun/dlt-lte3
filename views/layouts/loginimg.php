<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);


$this->registerCss("
	@import url('https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=latin-ext');


#playground-container {
    height: 500px;
    overflow: hidden !important;

}
body{
-webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
-moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
padding:0px;

    background-position: 50% 0;
    -ms-background-size: cover;
    -o-background-size: cover;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    background-size: cover;
}
.main{margin-top:70px;
-webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
-moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
padding:0px;
background:#07080c;
 opacity: 0.8;

    background-repeat: no-repeat;
    background-position: 50% 0;
    -ms-background-size: cover;
    -o-background-size: cover;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    background-size: cover;
}
.fb:focus, .fb:hover{color:FFF !important;}


.left-side{
	padding:0px 0px 0px;

	background-size:cover;
}
.left-side h3{
	font-size: 30px;
    font-weight: 900;
	color:#FFF;
	padding: 50px 10px 00px 26px;
	}

	.left-side p{
    font-weight:600;
	color:#FFF;
	padding:10px 10px 10px 26px;
	}


	.fb{background: #2d6bb7;
    color: #FFF;
    padding: 10px 15px;
    border-radius: 18px;
    font-size: 12px;
    font-weight: 600;
    margin-right: 15px;
	margin-left:26px;-webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
-moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);}
	.tw{background: #20c1ed;
    color: #FFF;
    padding: 10px 15px;
    border-radius: 18px;
    font-size: 12px;
    font-weight: 600;
    margin-right: 15px;-webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
-moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);}

	.right-side{
	padding:0px 0px 0px;
	background:#FFF;
	background-size:cover;
	min-height:514px;
}

	.right-side h3{
	font-size: 30px;
    font-weight: 700;
	color:#000;
	padding: 50px 10px 00px 50px;
	}
	.right-side p{
    font-weight:600;
	color:#000;
	padding:10px 50px 10px 50px;
	}
	.form{padding:10px 50px 10px 50px;}
    .form-control{box-shadow: none !important;
    border-radius: 0px !important;
    border-bottom: 1px solid #2196f3 !important;
    border-top: 1px !important;
    border-left: none !important;
    border-right: none !important;}
	.btn-deep-purple {
    background: #2196f3;
    border-radius: 18px;
    padding: 5px 19px;
    color: #FFF;
    font-weight: 600;
    float: right;
	-webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
-moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.24);
}
    ");
//$this->registerCssFile('@web/statics/css/soon.css');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon2.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="cs-bg">
<?php $this->beginBody() ?>



<div class="">
    <?=$content?>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

