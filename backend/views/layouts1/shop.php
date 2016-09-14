<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\web\View;
use yii\helpers\Url;


AppAsset::register($this);//css引入
$this->registerJs('jQuery(document).ready(function() {App.init();});',View::POS_END);//注册JS
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-header-fixed">
<?php $this->beginBody() ?>

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">

    <!-- BEGIN TOP NAVIGATION BAR -->

    <div class="navbar-inner">

        <div class="container">

            <!-- BEGIN LOGO -->

            <a class="brand" href="index.html">

                <img src="style/image/logo.png" alt="logo">

            </a>

            <!-- END LOGO -->

            <!-- BEGIN RESPONSIVE MENU TOGGLER -->

            <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

                <img src="style/image/menu-toggler.png" alt="">

            </a>

            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN TOP NAVIGATION MENU -->

            <ul class="nav pull-right">


                <li class="dropdown user">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <img alt="" src="style/image/avatar1_small.jpg">

                        <span class="username" user-id="<?= \yii::$app->user->identity->id?>"><?= \yii::$app->user->identity->username?></span>

                        <i class="icon-angle-down"></i>

                    </a>

                    <ul class="dropdown-menu">

                        <li class="divider"></li>

                        <li><a href="<?=\yii\helpers\Url::to(['site/logout'])?>" data-method="post"><i class="icon-key"></i>退出</a></li>

                    </ul>

                </li>

                <!-- END USER LOGIN DROPDOWN -->

            </ul>

            <!-- END TOP NAVIGATION MENU -->

        </div>

    </div>

    <!-- END TOP NAVIGATION BAR -->
    <!-- END HEADER -->
</div>
<!-- END HEADER -->
<div class="container">
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar nav-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu">

                <li class="start">
                    <a href="<?= Url::to([ 'admin/index']) ?>">
                        <i class="icon-home"></i>
                        <span class="title">管理员首页</span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;">
                        <i class="icon-cogs"></i>
                        <span class="title">管理员操作</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <!--<li >
                            <a href="http://localhost/YII1/yii/backend/web/index.php?r=admin/add">
                                添加管理员</a>
                        </li>
                        <li >
                            <a href="http://localhost/YII1/yii/backend/web/index.php?r=admin/modify">
                                修改管理</a>
                        </li>-->
                        <li >
                            <a href="<?= Url::to([ 'admin/adminlist']) ?>">
                                管理员列表</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:;">
                        <i class="icon-bookmark-empty"></i>
                        <span class="title">站点管理</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="<?= Url::to([ 'product/index']) ?>">
                                产品管理</a>
                        </li>
                        <li >
                            <a href="<?= Url::to([ 'producttype/index']) ?>">
                                产品分类管理</a>
                        </li>
                        <li >
                            <a href="<?= Url::to([ 'subscribe/index']) ?>">
                                订阅信息</a>
                        </li>

                        <li >
                            <a href="<?= Url::to([ 'productmodel/index']) ?>">
                                机型管理</a>
                        </li>
                        <li >
                            <a href="<?= Url::to([ 'info/index']) ?>">
                                客户信息</a>
                        </li>
                        <li >
                            <a href="<?= Url::to([ 'infotype/index']) ?>">
                                客户管理</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:;">
                        <i class="icon-table"></i>
                        <span class="title">系统设置</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="form_layout.html">
                                Form Layouts</a>
                        </li>
                        <li >
                            <a href="form_samples.html">
                                Advance Form Samples</a>
                        </li>
                        <li >
                            <a href="form_component.html">
                                Form Components</a>
                        </li>
                        <li >
                            <a href="form_wizard.html">
                                Form Wizard</a>
                        </li>
                        <li >
                            <a href="form_validation.html">
                                Form Validation</a>
                        </li>
                        <li >
                            <a href="form_fileupload.html">
                                Multiple File Upload</a>
                        </li>
                        <li >
                            <a href="form_dropzone.html">
                                Dropzone File Upload</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                    <h3>portlet Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here will be a configuration form</p>
                </div>
            </div>
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <h3 class="page-title">
                            后台首页<small>logo</small>
                        </h3>
                        <!--
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.html">后台</a>
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">管理员</a>
                                <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">管理员操作</a></li>
                        </ul>-->
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <?= $content;?>
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="footer">

    <div class="container">

        <div class="footer-inner">

            2013 © Metronic by keenthemes.

        </div>

        <div class="footer-tools">

				<span class="go-top">

				<i class="icon-angle-up"></i>

				</span>

        </div>

    </div>

</div>
<!-- END FOOTER -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
