<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div id="page">

    <!-- Navigation -->
    <!-- /.nav-wrp --><!-- Extra-section -->
    <!-- /extra-section --><!-- Navigation -->
    <!-- /.nav-wrp --><!-- Extra-section -->
    <!-- /extra-section --><!-- Footer section -->
    <!-- ./Footer section --><!-- Navigation -->
    <nav class="nav-wrp dark nav-6">
        <div class="container">

            <div class="nav-header">
                <a class="navbar-brand" href="#"><img src="<?php echo Url::home(true)?>/images/vaca.png" width="50" alt="Brand logo" class=""></a>
            </div>
        </div><!-- /.container -->
    </nav><!-- /.nav-wrp --><!-- Extra-section -->
    <?= $content ?>
    <section class="footer-section footer-section-5">
        <div class="container">
            <img src="<?php echo Url::home(true)?>/images/rgen-logo.png" alt="Company logo" class="">
            <p class="">Grupo Jedi's Dev</p>
        </div>
    </section><!-- ./Footer section --></div>
<!-- /#page -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>