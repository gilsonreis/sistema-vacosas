<?php

use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contribuicao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contribuicao-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="form-group col-sm-6">
            <?= $form->field($model, 'contribuinte_id')->dropDownList(ArrayHelper::map(\app\models\User::find()->all(), 'id', 'name'), ['prompt' => 'Selecione']) ?>
        </div>
        <div class="form-group col-sm-6">
            <?= $form->field($model, 'vacosa_id')->dropDownList(ArrayHelper::map(\app\models\Vacosa::find()->all(), 'id', 'nome'), ['prompt' => 'Selecione']) ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-4">
            <?= $form->field($model, 'valor', ['options' => ['class' => 'text-right']])->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'R$ ',
                    'allowNegative' => false,
                    'thousands' => '.',
                    'decimal' => ',',
                    'precision' => 2,
                    'allowZero' => false
                ]
            ]) ?>
        </div>
        <div class="form-group col-sm-4">
            <?= $form->field($model, 'comprovante')->fileInput() ?>
        </div>
        <div class="form-group col-sm-4">
            <p></p>
            <?= $form->field($model, 'comprovado')->checkbox() ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12">

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Alterar'), ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
