<?php

use yii\helpers\Html;

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                <span class="d-none d-md-inline">
                                                       <?php
            if (!Yii::$app->user->isGuest) {
                echo Yii::$app->user->identity->fullnameOffice;
            }?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">

                    <p>
                                   <?php
            if (!Yii::$app->user->isGuest) {
                echo Yii::$app->user->identity->fullnameOffice;
            }?>
                    </p>
                </li>
                <!-- Menu Body -->

                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <?= Html::a('เปลี่ยนรหัสผ่าน', ['/site/reset-password','token'=>@Yii::$app->user->identity->password_reset_token], ['class' => 'btn btn-success btn-flat float']) ?>
                    <?= Html::a('ออกจากระบบ', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat float-right']) ?>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                        class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>