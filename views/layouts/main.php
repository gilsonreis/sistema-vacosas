<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\BowerAsset;
use aryelds\sweetalert\SweetAlert;
use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\JsHeadAsset;

AppAsset::register($this);
JsHeadAsset::register($this);
BowerAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>Vacosas Jedi's Dev</title>
    <?php $this->head() ?>
</head>

<body class="nav-md footer_fixed">
<?php $this->beginBody() ?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title"><span>Vacosas Jedi's Dev</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="/images/no-picture.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bem vindo,</span>
                        <h2><?php echo Yii::$app->user->identity->name?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->


                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                        <h3>&nbsp;</h3>
                        <ul class="nav side-menu">
                            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                            <?php if(Yii::$app->user->can('vacosa/index')):?>
                            <li><a href="/vacosas"><i class="fa fa-paw"></i> Gerenciar Vacosas </a></li>
                            <?php endif;?>
                            <?php if(Yii::$app->user->can('vacosa/listar-vacosas')):?>
                                <li><a href="/vacosas/listar-vacosas"><i class="fa fa-paw"></i> Vacosas Disponíveis! </a></li>
                            <?php endif;?>
                            <?php if(Yii::$app->user->can('tipos/index')):?>
                            <li><a href="/tipos"><i class="fa fa-bookmark-o"></i> Tipos </a></li>
                            <?php endif;?>
                            <?php if(Yii::$app->user->can('contribuicoes/index')):?>
                            <li><a href="/contribuicoes"><i class="fa fa-group"></i> Contribuições </a></li>
                            <?php endif;?>
                            <?php if(Yii::$app->user->can('usuarios/index')):?>
                            <li><a href="/user"><i class="fa fa-user"></i> Usuários</a></li>
                            <?php endif;?>
                            <?php if(Yii::$app->user->can('permissoes/gerenciar-permissoes')):?>
                            <li><a><i class="fa fa-key"></i> Perfis</a>
                                <ul class="nav child_menu">
                                    <li><a href="/permissoes/gerenciar-permissoes/Administrador">Administrador</a></li>
                                    <li><a href="/permissoes/gerenciar-permissoes/Contribuinte">Contribuinte</a></li>
                                </ul>
                            </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

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
                                <img src="/images/no-picture.png" alt=""><?php echo Yii::$app->user->identity->name?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> Perfil</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span>Configurações</span>
                                    </a>
                                </li>
                                <li><a href="/user/logout"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                            </ul>
                        </li>

<!--                        <li role="presentation" class="dropdown">-->
<!--                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"-->
<!--                               aria-expanded="false">-->
<!--                                <i class="fa fa-envelope-o"></i>-->
<!--                                <span class="badge bg-green">6</span>-->
<!--                            </a>-->
<!--                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">-->
<!--                                <li>-->
<!--                                    <a>-->
<!--                                        <span class="image"><img src="/images/img.jpg" alt="Profile Image"/></span>-->
<!--                                        <span>-->
<!--                          <span>John Smith</span>-->
<!--                          <span class="time">3 mins ago</span>-->
<!--                        </span>-->
<!--                                        <span class="message">-->
<!--                          Film festivals used to be do-or-die moments for movie makers. They were where...-->
<!--                        </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a>-->
<!--                                        <span class="image"><img src="/images/img.jpg" alt="Profile Image"/></span>-->
<!--                                        <span>-->
<!--                          <span>John Smith</span>-->
<!--                          <span class="time">3 mins ago</span>-->
<!--                        </span>-->
<!--                                        <span class="message">-->
<!--                          Film festivals used to be do-or-die moments for movie makers. They were where...-->
<!--                        </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a>-->
<!--                                        <span class="image"><img src="/images/img.jpg" alt="Profile Image"/></span>-->
<!--                                        <span>-->
<!--                          <span>John Smith</span>-->
<!--                          <span class="time">3 mins ago</span>-->
<!--                        </span>-->
<!--                                        <span class="message">-->
<!--                          Film festivals used to be do-or-die moments for movie makers. They were where...-->
<!--                        </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a>-->
<!--                                        <span class="image"><img src="/images/img.jpg" alt="Profile Image"/></span>-->
<!--                                        <span>-->
<!--                          <span>John Smith</span>-->
<!--                          <span class="time">3 mins ago</span>-->
<!--                        </span>-->
<!--                                        <span class="message">-->
<!--                          Film festivals used to be do-or-die moments for movie makers. They were where...-->
<!--                        </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <div class="text-center">-->
<!--                                        <a>-->
<!--                                            <strong>See All Alerts</strong>-->
<!--                                            <i class="fa fa-angle-right"></i>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php foreach (Yii::$app->session->getAllFlashes() as $message) {
                echo SweetAlert::widget([
                    'options' => [
                        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                        'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
                        'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
                        'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
                        'showConfirmButton' => (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true,
                        'html' => (!empty($message['html'])) ? $message['html'] : true
                    ]
                ]);
            } ?>
            <?php echo $content;?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>