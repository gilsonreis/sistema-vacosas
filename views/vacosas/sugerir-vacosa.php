<?php

use kartik\helpers\Html;
use kartik\money\MaskMoney;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = "Sugestão de nova Vacosa - ";
?>
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Sugerir uma nova vacosa</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Aqui você pode fazer uma sugestão de uma nova Vacosa. Insira as informações no formulário abaixo
                        e os administradores do sistema irão avaliar seu pedido para aprovação.
                    </p>
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <?= $form->field($model, 'tipo_id')->dropDownList(ArrayHelper::map(\app\models\Tipo::find()->all(), 'id', 'nome'), ['prompt' => 'Selecione']) ?>
                        </div>
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
                            <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint("Link do marketplace onde está vendendo esse produto.") ?>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <?= $form->field($model, 'descricao')->textarea(['rows' => 6])->hint("Descreva detalhes e também a utilidade desse produto.") ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton("Fazer sugestão da vacosa", ['class' => 'btn btn-success btn-lg btn-block']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>