<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo */

$this->title = Yii::t('app', '{tipo} - Editando tipo - ', [
    'tipo' => $model->nome,
]);
?>
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Editando tipo - <em><?php echo $model->nome?></em></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>