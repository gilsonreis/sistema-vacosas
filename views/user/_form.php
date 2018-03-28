<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->hint('Informe uma nova senha para altera-la.') ?>

    <div class="row">
        <div class="form-group col-sm-6">
            <?php echo $form->field($model, 'role_name')->dropDownList([
                "Administrador" => "Administrador",
                "Contribuinte" => "Contribuinte"
            ], ['prompt' => 'Selecione'])?>
        </div>
        <div class="form-group col-sm-6">
            <?php if(!$model->isNewRecord):?>
                <?php echo $form->field($model, 'status')->checkbox()->hint("Deixe marcado para ativar o usuário.");?>
            <?php endif;?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Alterar'), ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
