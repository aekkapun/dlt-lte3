<nav class="navbar-default navbar-static-side skin-3  " role="navigation" style="position: fixed;">
    <div class="sidebar-collapse-fixed" >
        <li class="nav-header">
            <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="images/logocrm.png">
                             </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= Yii::$app->name ;?></strong>
                             </span> <span class="text-muted text-xs block">ระบบจองห้องประชุม</b></span> </span> </a>
            </div>
            <div class="logo-element">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
            </div>
        </li>
        <?php
            $menu=[
                ['label' => '<i class="fa fa-calendar" aria-hidden="true"></i> ปฏิทินการจองห้องประชุม', 'url' => ['/site/index']],
                ['label' => '<i class="fa fa-plus-circle" aria-hidden="true"></i> จองห้องประชุม', 'url' => ['/meetting/booking']],
                ['label' => '<i class="fa fa-list-ol" aria-hidden="true"></i> รายการการจอง', 'url' => ['/meetting/index']],
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
