<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin()
?>
    <img src="/images/vaca.png" alt="" width="200">
    <?php echo $form->field($model, 'username')->textInput(['placeholder' => "Usuário"])->label(false);?>
    <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => "Senha"])->label(false);?>
    <div>
        <?= Html::submitButton('Login', ['class' => 'btn btn-info submit btn-block', 'name' => 'login-button']) ?>
<!--        <a class="reset_pass" href="#">Esqueceu a senha?</a>-->
    </div>

    <div class="clearfix"></div>

    <div class="separator">

        <div class="clearfix"></div>
        <br/>

        <div>
            <h1>Vacosas - Jedi's Dev</h1>
            <p>©<?php echo date("Y")?> All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and
                Terms</p>
        </div>
    </div>
<?php
    ActiveForm::end();
?>