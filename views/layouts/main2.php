<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favx.png" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
         NavBar::begin([
             'brandLabel' => 'SystemsInfo',
             'brandLabel' => Html::img('@web/images/logo.png', ['alt' => Yii::$app->name]),
             //'brandUrl' => Yii::$app->homeUrl,
             'options' => [
                 'class' => 'navbar-inverse navbar-fixed-top',
             ],
         ]);
         $menuItems = [
             ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
             ['label' => 'ข้อควรปฏิบัติ', 'url' => ['/site/about']],
             Yii::$app->user->isGuest ?
                     ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']] :
                     ['label' => 'Welcome (' . Yii::$app->user->identity->username . ')',
                 //['label' => 'ดำเนินการยื่นขอขึ้นทะเบียน', 'url' => Yii::$app->urlManagerBackend->createUrl(['site/index'])],
                 'items' => [
                     //['label' => 'ดำเนินการยื่นขอขึ้นทะเบียน', 'url' => Yii::$app->urlManagerBackend->createUrl(['site/index'])],
                     ['label' => 'ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
                     ['label' => 'ตั้งค่า', 'url' => ['/user/settings/account']],
                     ['label' => 'ออกจากระบบ', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                 ]],
             ['label' => 'ลงทะเบียน', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
         ];

         echo Nav::widget([
             'options' => ['class' => 'navbar-nav navbar-right'],
             'items' => $menuItems,
         ]);
         NavBar::end();
         ?>

    <div >
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
