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
<?php
foreach (Yii::$app->session->getAllFlashes() as $message) {
    echo SweetAlert::widget([
        'options' => [
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
            'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
            'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_BASIC,
            'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
            'animation' => false,
            'type' => SweetAlert::TYPE_WARNING,
            'theme' => SweetAlert::THEME_FACEBOOK,
            'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true
        ]
    ]);
}
?>
<?php $this->beginBody() ?>

<div id="wrapper" class="skin-3">

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?= $this->render('header', ['directoryAsset' => $directoryAsset]) ?>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <?php if (isset($this->blocks['content-header'])) { ?>
                <?= $this->blocks['content-header'] ?>
            <?php } else { ?>
                <div class="col-sm-<?= isset($this->blocks['content-header-actions']) ? 6 : 12 ?>">


                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'activeItemTemplate' => "<li class=\"active\"><strong>{link}</strong></li>\n"
                    ])
                    ?>
                </div>
                <?php if (isset($this->blocks['content-header-actions'])): ?>
                    <div class="col-sm-6">
                        <div class="title-action">
                            <?= $this->blocks['content-header-actions'] ?>
                        </div>
                    </div>
                <?php endif ?>
            <?php } ?>

        </div>

        <div class="wrapper wrapper-content">

            <div class="row ">
                <div class="col-lg-12">
                    <?= $content ?>
                </div>
            </div>
        </div>
        <?= $this->render('footer', ['directoryAsset' => $directoryAsset]) ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
