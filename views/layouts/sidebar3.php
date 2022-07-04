<nav class="navbar-default navbar-static-side skin-3  " role="navigation" style="position: fixed;">
    <div class="sidebar-collapse-fixed" >
        <li class="nav-header">
            <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="images/logocrm.png">
                             </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= Yii::$app->name ;?></strong>
                             </span> <span class="text-muted text-xs block">แจ้งปัญหาการใช้งาน คอมพิวเตอร์</b></span> </span> </a>
            </div>
            <div class="logo-element">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
            </div>
        </li>
        <?php
            $menu=[
                ['label' => '<i class="fa fa-home" aria-hidden="true"></i> หน้าแรก', 'url' => ['/site/index']],
                ['label' => '<i class="fa fa-desktop" aria-hidden="true"></i> รายการอุปกรณ์', 'url' => ['/base/master/index']],
                ['label' => '<i class="fa fa-list-alt" aria-hidden="true"></i> รายการแจ้งซ่อม', 'url' => ['/base/master-notify/index']],
                ['label' => '<i class="fa fa-list-alt" aria-hidden="true"></i> ประวัติการแจ้งซ่อม', 'url' => ['/base/master-notify/history']],
//                Yii::$app->user->isGuest ?
//                    ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']] :
//                    ['label' => '<i class="fa fa-user-o" aria-hidden="true"></i> ข้อมูลผู้ใช้งาน',
//                        //['label' => 'ดำเนินการยื่นขอขึ้นทะเบียน', 'url' => Yii::$app->urlManagerBackend->createUrl(['site/index'])],
//                        'items' => [
//                            //['label' => 'ดำเนินการยื่นขอขึ้นทะเบียน', 'url' => Yii::$app->urlManagerBackend->createUrl(['site/index'])],
//                            ['label' => 'ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
//                            ['label' => 'ตั้งค่า', 'url' => ['/user/settings/account']],
//                           // ['label' => 'ออกจากระบบ', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
//                        ]],
            ];
            if(isset($this->context->menu))
                $menu = array_merge([['label' => \Yii::$app->name, 'options' => ['class' => 'nav-header']]], $this->context->menu);

        ?>
        <?= jcabanillas\inspinia\widgets\Menu::widget(
            [
                'options' => ['class' => 'nav metismenu', 'id'=>'side-menu'],
                'submenuTemplate' => "\n<ul class='nav nav-second-level collapse' {show}>\n{items}\n</ul>\n",
                'items' => $menu,
                'encodeLabels' => false,
            ]
        ) ?>
    </div>
</nav>