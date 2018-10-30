<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

$bundle = yiister\gentelella\assets\Asset::register($this);
Yii::$app->name = "Octopus";

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <![endif]-->
    <style>
        body{
            font-family: "Cloud-Light";
            font-size: 14px;
        }
    </style>
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>" >
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.php?r=dashboard" class="site_title" style="font-family: Cloud-Bold"><i class="fa fa-thumbs-o-up"></i> <span>Octopus</span></a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <?=Html::img('@web/uploads/img/admin.jpg',['class'=>'img-circle profile_img'])?>
                       <!--  <img src="../web/uplaods/img/admin.jpg" alt="..." class="img-circle profile_img"> -->
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?=!Yii::$app->user->isGuest?Yii::$app->user->identity->username:'';?></h2>
                    </div>
                </div>
                <!-- /menu prile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                        <h3>Menu</h3>
                        <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    ["label" => "แดซบอร์ด", "url" => ["site/index"], "icon" => "dashboard"],
                                    [
                                        "label" => "ผู้ใช้งาน",
                                        "icon" => "users",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "กลุ่มผู้ใช้งาน", "url" => ["usergroup/index"]],
                                            ["label" => "ผู้ใช้งาน", "url" => ["user/index"]],
                                            ["label" => "สิทธิ์การใช้งาน", "url" => ["assignrole/index"]],
                                        ],

                                    ],

                                    [
                                        "label" => "ข้อมูลใบสั่งผลิต",
                                        "icon" => "shopping-cart",
                                        "url" => ["order/index"],

                                    ],
                                    ["label" => "ประเภทการจัดส่ง", "url" => ["delivertype/index"], "icon" => "truck"],
                                    ["label" => "แจ้งเตือน", "url" => ["message/index"], "icon" => "commenting"],


                                ],
                                'options' => ['style'=>'font-size: 16px']
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
<!--                <div class="sidebar-footer hidden-small">-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="Settings">-->
<!--                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">-->
<!--                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="Lock">-->
<!--                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="Logout">-->
<!--                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                </div>-->
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="http://placehold.it/128x128" alt=""><?=!Yii::$app->user->isGuest?Yii::$app->user->identity->username:'';?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;">  ข้อมูลผู้ใช้</a>
                                </li>
                                <!-- <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li> -->
                               <!--  <li>
                                    <a href="javascript:;">Help</a>
                                </li> -->
                                <li>
                                    <!-- <a href="index.php?r=site/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a> -->
                                     <?= Html::a(
                                            "<i class='fa fa-sign-out pull-right'></i> ออกจากระบบ",
                                            ['/site/logout'],
                                            ['data-method' => 'post']
                                     ) ?>

                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="http://placehold.it/128x128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="http://placehold.it/128x128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="http://placehold.it/128x128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="http://placehold.it/128x128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a href="/">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php
            echo Breadcrumbs::widget([
                'options' => ['class'=>'breadcrumb','style'=>'margin-top: -10px;'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

            ]);
            ?>
            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-left">
                <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
               <!--  Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a><br />
                Extension for Yii framework 2 by <a href="http://yiister.ru" rel="nofollow" target="_blank">Yiister</a> -->
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>

<!--<div id="custom_notifications" class="custom-notifications dsp_none">-->
<!--    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">-->
<!--    </ul>-->
<!--    <div class="clearfix"></div>-->
<!--    <div id="notif-group" class="tabbed_notifications"></div>-->
<!--</div>-->
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
