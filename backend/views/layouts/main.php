<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\LayoutAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;


LayoutAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="wrapper <?= $this->context->module->id == 'console' ? ' has-submenu' : '' ?>">
        <header class="main-header">
            <!-- Logo -->
            <div class="page-brand">
                <a class="logo" href="/">
                    <img src="/static/images/logo.png" alt="鹿客">
                </a>
            </div>
            <!-- nav-->
            <div class="pull-left">
                <ul class=" nav-xl">
<!--                    <li class="selected"><a href="--><?//= Url::toRoute(['/auth-info/index']) ?><!--">小程序</a></li>-->
                </ul>
            </div>

            <div class="navbar-custom-menu pull-right">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="">
                        <a href="#" class="">
                            <em class="icon24 icon24-header-help"></em>
                        </a>
                    </li>
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="">
                        <a href="#" class="">
                            <em class="icon24 icon24-header-message"></em>
                        </a>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/static/images/avator.png" class="user-image" alt="User Image">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <!--                        <li><a href="profile.html"><i class="ti-user"></i>Profile</a></li>-->
                            <!--                        <li><a href="profile.html"><i class="ti-settings"></i>Settings</a></li>-->
                            <!--                        <li><a href="javascript:;"><i class="ti-support"></i>Support</a></li>-->
                            <li class="divider"></li>
                            <li><a href="<?= Url::toRoute(['/site/logout']) ?>"><i class="fa fa-power-off"></i>退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>

        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <ul class="nav side-menu metismenu " id="menu">

                    <li class="">
                        <a class="" href="<?= Url::toRoute(['/index']) ?>" aria-expanded="false">
                            <i class="sidebar-item-icon sidebar-item-icon-dashboard"></i>
                            <span class="nav-label">概览</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="javascript:;" aria-expanded="true">
                            <i class="sidebar-item-icon sidebar-item-icon-list"></i>
                            <span class="nav-label">权限配置</span>
                            <i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav nav-2-level collapse" aria-expanded="true">
                            <li class="">
                                <a href="<?= Url::toRoute(['/admin']) ?>" target="_blank">管理员</a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:;" aria-expanded="true">
                            <i class="sidebar-item-icon sidebar-item-icon-list"></i>
                            <span class="nav-label">帮助中心</span>
                            <i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav nav-2-level collapse" aria-expanded="true">
                            <li class="">
                                <a href="<?= Url::toRoute(['/problem-cate']) ?>">问题分类</a>
                            </li>
                            <li class="">
                                <a href="<?= Url::toRoute(['/problem']) ?>">问题列表</a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="javascript:;" aria-expanded="true">
                            <i class="sidebar-item-icon sidebar-item-icon-list"></i>
                            <span class="nav-label">模板配置</span>
                            <i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav nav-2-level collapse" aria-expanded="true">
                            <li>
                                <a href="<?= Url::toRoute(['/template-cate']) ?>" >模板分类</a>
                            </li>

                            <li>
                                <a href="<?= Url::toRoute(['/template']) ?>" >模板管理</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </section>
        </aside>


        <div class="content-wrapper">
            <section class="page-content">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </section>
        </div>

        <?php
        // 公用Modal
        Modal::begin([
            'options' => [
                'tabindex' => false,
                'class' => 'mina-popup',
                'data-backdrop' => 'static', //点击空白不关闭弹窗
            ],
            'id' => 'common-modal',
            'header' => '<h4 class="modal-title"></h4>',
//        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
        ]);
        Modal::end();
        ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            var path_array = window.location.pathname.split('/');
            if (path_array[1] == '') {
                path_array[1] = 'index';
            }
            $('ul.nav-2-level > li').find('a[href="/' + path_array[1] + '"]').addClass('active').closest('ul.nav-2-level').addClass('in').parent('li').addClass('active');
            $('ul.side-menu>li').find('a[href="/' + path_array[1] + '"]').addClass('active');
        });
    </script>

    </html>
<?php $this->endPage() ?>