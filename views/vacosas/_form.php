<?php

use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vacosa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacosa-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="form-group col-sm-6">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="form-group col-sm-6">
            <?= $form->field($model, 'tipo_id')->dropDownList(ArrayHelper::map(\app\models\Tipo::find()->all(), 'id', 'nome'), ['prompt' => 'Selecione']) ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-4">
            <?= $form->field($model, 'valor')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'R$ ',
                    'allowNegative' => false,
                    'thousands' => '.',
                    'decimal' => ',',
                    'precision' => 2,
                    'allowZero' => false
                ]
            ]); ?>
        </div>
        <div class="form-group col-sm-4">
            <?= $form->field($model, 'responsavel_id')->dropDownList(ArrayHelper::map(\app\models\User::find()->all(), 'id', 'name'), ['prompt' => 'Selecione']) ?>
        </div>
        <div class="form-group col-sm-4">
            <?= $form->field($model, 'status')->dropDownList([
                    0 => "Inativo",
                    1 => "Em andamento",
                    2 => "Finalizado"
            ], ['prompt' => 'Selecione']) ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint("Link do marketplace onde está vendendo esse produto.") ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12">
            <?= $form->field($model, 'descricao')->textarea(['rows' => 6])->hint("Descreva detalhes e também a utilidade desse produto.") ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Alterar'), ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
