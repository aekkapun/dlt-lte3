<?php
/* @var $this \yii\web\View */
/* @var $content string */

use jcabanillas\inspinia\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;
use aryelds\sweetalert\SweetAlert;
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);

use xj\bootbox\BootboxAsset;

BootboxAsset::register($this);
BootboxAsset::registerWithOverride($this);
AppAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/jcabanillas/yii2-inspinia/assets');
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="<?= Yii::$app->charset ?>">
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?php
    $this->registerCss("
            div.required label.control-label:after {
                content: \" *\";
                color: red;
            }
           "
    );
    ?>
    <body>
<?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]) ?>
    <?php $this->beginBody() ?>

        <div id="wrapper" class="skin-1">
            <?php

             echo $this->render('sideguest', ['directoryAsset' => $directoryAsset]);

            ?>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <?= $this->render('header', ['directoryAsset' => $directoryAsset]) ?>
                </div>


                <div class="wrapper wrapper-content">


<?= $content ?>

                </div>
<?= $this->render('footer', ['directoryAsset' => $directoryAsset]) ?>
            </div>
        </div>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
