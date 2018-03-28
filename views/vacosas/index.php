<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de vacosas - ');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listagem de Vacosas</h2>
                    <div class="clearfix"></div>
                </div>
                <?= Html::a(Yii::t('app', 'Cadastrar Vacosa'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
                <div class="x_content">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'nome',
                            [
                                'attribute' => 'tipo_id',
                                'value' => function ($model) {
                                    return \app\models\Tipo::find()->where(['id' => $model->tipo_id])->one()->nome;
                                }
                            ],
                            'valor:currency',
                            'url:url',
                            [
                                'attribute' => 'responsavel_id',
                                'value' => function ($model) {
                                    return \app\models\User::find()->where(['id' => $model->responsavel_id])->one()->name;
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    $statuses = [
                                        0 => "Inativo",
                                        1 => "Em andamento",
                                        2 => "Finalizado"
                                    ];

                                    return $statuses[$model->status];
                                }
                            ],
                            'create_at:date',
                            // 'update_at',

                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'noWrap' => true,
                                'template' => '{view}{update}{delete}',
                                'visible' => Yii::$app->user->can('vacosa/view')
                                    || Yii::$app->user->can('vacosa/update')
                                    || Yii::$app->user->can('vacosa/delete'),
                                'viewOptions' => [
                                    'class' => 'btn btn-warning btn-xs btn_view_list',
                                    'disabled' => !Yii::$app->user->can('vacosa/view')
                                ],
                                'updateOptions' => [
                                    'class' => 'btn btn-success btn-xs',
                                    'disabled' => !Yii::$app->user->can('vacosa/update')
                                ],
                                'deleteOptions' => [
                                    'class' => 'btn btn-danger btn-xs',
                                    'disabled' => !Yii::$app->user->can('vacosa/delete')
                                ]
                            ],
                            
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
