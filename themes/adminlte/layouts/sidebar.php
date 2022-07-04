
<?php
use frontend\models\PlateForm;
?>
<aside class="main-sidebar elevation-4 sidebar-light-indigo">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img alt="" src="<?=Yii::getAlias('@web')?>/statics/img/logo.png" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">กรมการขนส่งทางบก</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block text-center">ระบบถามตอบปัญหาระบบงานต่างๆ</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    ['label' => 'หน้าแรก', 'url' => ['site/admin'],'icon' => 'tachometer-alt','visible' => Yii::$app->user->identity->role==99],
                    ['label' => 'หน้าแรก', 'url' => ['site/index'],'icon' => 'tachometer-alt','visible' => Yii::$app->user->identity->role==10],
                    ['label' => 'รายการแจ้งปัญหา', 'url' => ['/job/index-admin'],'icon' => 'fa fa-list-alt','visible' => Yii::$app->user->identity->role==99],
                    ['label' => 'รายการแจ้งปัญหา', 'url' => ['/job/index'],'icon' => 'fa fa-list-alt','visible' => Yii::$app->user->identity->role==10],
                    ['label' => 'คู่มือการใช้งาน ต่างๆ', 'url' => ['/manual/index'],'icon' => 'fa fa-book'],
                    [
                        'label' => 'รายงาน',
                        'iconClass' => 'nav-icon far fa fa-sitemap text-warning',
                        'badge' => '<span class="right badge badge-warning">2</span>',
                        'items' => [
                            ['label' => 'รายงานที่1', 'url' => ['report/index'], 'iconStyle' => 'far',],
                            ['label' => 'รายงานที่ 2', 'url' => ['report/find-plate-detail'], 'iconStyle' => 'far',],

                        ]
                    ],
                    [
                        'label' => 'Setting',
                        'iconClass' => 'nav-icon fa fa-cogs text-primary',
                        'badge' => '<span class="right badge badge-warning">2</span>',
                        'items' => [
                            ['label' => 'ระบบต่างๆ', 'url' => ['/system-list/index'], 'iconStyle' => 'far',],
                            ['label' => 'Line Token', 'url' => ['/line-token/index'], 'iconStyle' => 'far',],

                        ],
                        'visible' => Yii::$app->user->identity->role==99,
                    ],
                    [
                        'label' => 'RBAC',
                        'iconClass' => 'nav-icon fa fa-cogs text-primary',
                        'badge' => '<span class="right badge badge-warning">5</span>',
                    'items' => [
                        ['label' => 'User Management', 'url' => ['/user-manager/index'], 'iconStyle' => 'far',],
                        ['label' => 'Assignments', 'url' => ['/admin/assignment'], 'iconStyle' => 'far',],
                        ['label' => 'Role', 'url' => ['/admin/role'], 'iconStyle' => 'far',],
                        ['label' => 'Permission', 'url' => ['/admin/permission'], 'iconStyle' => 'far',],
                        ['label' => 'Route', 'url' => ['/admin/route'], 'iconStyle' => 'far',],
                    ]
                ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>