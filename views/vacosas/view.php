<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo */

$this->title = Yii::t('app', '{vacosa} - Visualizando vacosa - ', [
    'vacosa' => $model->nome,
]);
?>

<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Visualizando vacosa - <em><?php echo $model->nome?></em></h2>
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
                            'nome',
                            [
                                'attribute' => 'tipo_id',
                                'value' => function($model) {
                                    return \app\models\Tipo::find()->where(['id' => $model->tipo_id])->one()->nome;
                                }
                            ],
                            'valor:currency',
                            'url:url',
                            [
                                'attribute' => 'responsavel_id',
                                'value' => function($model) {
                                    return \app\models\User::find()->where(['id' => $model->responsavel_id])->one()->name;
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function($model) {
                                    $statuses = [
                                        0 => "Inativo",
                                        1 => "Em andamento",
                                        2 => "Finalizado"
                                    ];

                                    return $statuses[$model->status];
                                }
                            ],
                            'create_at:datetime',
                            'update_at:datetime',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>