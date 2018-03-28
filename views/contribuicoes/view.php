<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo */

$this->title = Yii::t('app', 'Visualizando contribuição - ');
?>

<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Visualizando contribuição</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Deletar'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'contribuinte_id',
                                'value' => function($model) {
                                    return \app\models\User::find()->where(['id' => $model->contribuinte_id])->one()->name;
                                }
                            ],
                            [
                                'attribute' => 'vacosa_id',
                                'value' => function($model) {
                                    return \app\models\Vacosa::find()->where(['id' => $model->vacosa_id])->one()->nome;
                                }
                            ],
                            'valor:currency',
                            'comprovante',
                            'comprovado:boolean',
                            'create_at:datetime',
                            'update_at:datetime',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>