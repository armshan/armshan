<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>鹿客</title>
    <meta name="Keywords" content="鹿客">
    <meta name="description" content="鹿客">
    <link rel="stylesheet" href="/static/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/public.css">
<style>
    .admin{color:black;}
</style>
</head>
<body class="page-login">
    <div class="page-header-wrap">
        <header class="page-header navbar no-menu-icon">
            <div class="page-header-inner">
                <!-- Begin of menu icon toggler  -->
                <button class="navbar-toggler site-menu-icon" id="navMenuIcon">
                    <span class="menu-icon">
                        <span class="bars">
                            <span class="bar1"></span>
                            <span class="bar2"></span>
                            <span class="bar3"></span>
                        </span>
                    </span>
                </button>
                <!--  End of menu icon toggler -->
                <!-- Begin of logo/brand -->
                <a class="navbar-brand" href="/">
                    <span class="logo">
                        <img class="-logo" title="鹿客" src="/static/images/logo.png" alt="鹿客">
                    </span>
                </a>
                <!-- End of logo/brand -->
                
                <!-- begin of menu wrapper -->
                <div class="all-menu-wrapper" id="navbarMenu">
                    <!-- Begin of top menu -->
                    <nav class="navbar-topmenu" id="topBarMenu">
                        <ul class="navbar-nav navbar-nav-menu">
                            <li class="nav-item link-active">
                                <a class="nav-link" href="/">返回首页</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of top menu -->   
                </div>
                <!-- end of menu wrapper -->
            </div>
        </header>
    </div>


    <!-- BEGIN OF page main content -->
    <main class="page-main" id="mainpage">
        <!-- Begin of login section -->
        <div class="section section-login" data-section="login" id="login">
            <!-- Begin of section wrapper -->
            <div class="section-wrapper">
                <!-- content -->
                <div class="section-content">
                    <div class="section-text">
                        <div class="title-desc">
                            <h2 class=""><span class="line-block">学会PHP，离统治宇宙就不远了</span></h2>
                            <h4 class="">助力商家移动营销新生态，畅享流量红利</h4>
                        </div>
                    </div>

                    <div class="sign-wrap">
                            <div class="user-form">
                                    <h2>小鹿RBAC测试登录</h2>
                                    <ul>
                                       <!-- <li class="form-item">
                                            <label class="login-nameicon">手机号/邮箱</label>
                                            <input type="text" id="loginName" placeholder="手机号码/邮箱" class="ipt">
                                            <a href="javascript:;" tabindex="-1" class="icon-close">x</a>
                                        </li>
                                        <li class="form-item">
                                            <label class="login-pwdicon">密码</label>
                                            <input type="password" id="loginPwd" placeholder="请输入密码" class="ipt">
                                            <a href="javascript:;" tabindex="-1" class="icon-close">x</a>
                                        </li>-->
                                        <div class="admin">
                                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                        <?= $form->field($model, 'UserName')->textInput(['autofocus' => true]) ?>
                                        <?= $form->field($model, 'Password')->passwordInput() ?>

                                        <div class="form-group">
                                            <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                        </div>
                                    </ul>
                                </form>
                            </div>
                    </div>
                    
    
                </div>

            </div>
            <!-- End of section wrapper -->
        </div>
        <!-- End of login section -->

    </main>
    <!-- End OF page main content -->




    <!-- Begin of footer section -->
    <div class="section section-footer" data-section="footer">
        <!-- Begin of section wrapper -->
        <div class="section-wrapper">
            <!-- content -->
            <div class="section-content">
                <div class="copyright">
                    <p>小鹿点睛助手     小鹿竞价百度版     小鹿竞价点睛版     鹿客小程序     精准大师</p>
                    版权所有：河南九维网络科技有限公司 Copyright &copy;2017-2019 JIUWEI Interactive Co.,Ltd. All rights reserved. 豫ICP备17023437号-4
                </div>
            </div>
            
        </div>
        <!-- End of section wrapper -->
    </div>
</body>
</html>