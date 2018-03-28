<?php

use kartik\widgets\FileInput;

$this->title = "";
?>
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?php echo $vaca->nome ?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <?php echo nl2br($vaca->descricao) ?>
                            <hr>
                            <a href="<?php echo $vaca->url ?>" target="_blank">Visualizar demo</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informações</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 col-xs-12 tile text-center">
                                <h2>Valor da vacosa</h2>
                                <h1 class="text-success">R$ <?php echo number_format($vaca->valor, 2, ",", ".")?></h1>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 tile text-center">
                                <h2>Valor arrecadado</h2>
                                <h1 class="text-warning">R$ <?php echo number_format($valor_contribuido, 2, ",", ".")?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="x_panel col-md-12 col-sm-12 col-xs-12">
                <div class="x_title">
                    <h2>Contribuição</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-sm-6">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                                   value="<?= Yii::$app->request->csrfToken ?>"/>
                            <div class="col-md-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 form-group">
                                <p>Informe o valor da contribuição no campo abaixo</p>
                                <?php echo \kartik\money\MaskMoney::widget([
                                    'name' => 'valor',
                                    'value' => $valor,
                                    'options' => [
                                        'class' => 'text-center input-lg',
                                    ],
                                    'pluginOptions' => [
                                        'prefix' => 'R$ ',
                                        'allowNegative' => false,
                                        'thousands' => '.',
                                        'decimal' => ',',
                                        'precision' => 2,
                                        'allowZero' => false
                                    ]
                                ]); ?>
                                <br>

                                <?php
                                echo FileInput::widget([
                                    'name' => 'comprovante',
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary btn-block btn-lg',
                                        'browseIcon' => '<i class="fa fa-photo"></i> ',
                                        'browseLabel' => 'Selecione o comprovante'
                                    ],
                                    'options' => ['accept' => 'image/*']
                                ]);
                                ?>

                                <hr>
                                <?php echo \yii\bootstrap\Html::submitButton('<i class="fa fa-money"></i> Salvar Contribuição', [
                                    'class' => 'btn btn-info btn-lg text-center btn-block'
                                ])
                                ?>

                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h2>Quem já contribuiu</h2>
                        <?php if (count($vaca->contribuicoes) > 0): ?>
                            <ul class="list-inline">
                                <?php
                                $contribuintes = $valor = [];
                                foreach ($vaca->contribuicoes as $contribuicao):
                                    $contribuintes[$contribuicao->contribuinte_id] = $contribuicao;
                                    $valor[$contribuicao->contribuinte_id] = isset($valor[$contribuicao->contribuinte_id]) ? $valor[$contribuicao->contribuinte_id] + $contribuicao->valor : $contribuicao->valor;
                                endforeach;


                                foreach ($contribuintes as $i => $contribuicao):
                                    $base_img = ($contribuicao->contribuinte->photo == "no-picture.png") ? "/images/" : "/uploads/usuarios/";
                                    $msg_contribuinte = $contribuicao->contribuinte->name . " contribuiu com R$ " . number_format($valor[$i], 2, ",", ".");
                                    ?>
                                    <li>
                                        <img style="width: 80px;height: 80px;"
                                             src="<?php echo $base_img . $contribuicao->contribuinte->photo ?>"
                                             class="img-thumbnail img-circle" title="<?php echo $msg_contribuinte ?>"
                                             alt="<?php echo $msg_contribuinte ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-danger">Nenhum contribuínte ainda.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>