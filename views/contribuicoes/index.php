<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de contribuições - ');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listagem de contribuições</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if (Yii::$app->user->can('contribuicao/create')): ?>
                        <?= Html::a(Yii::t('app', 'Cadastrar Contribuição'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
                    <?php endif; ?>
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'contribuinte_id',
                                'value' => function ($model) {
                                    return \app\models\User::find()->where(['id' => $model->contribuinte_id])->one()->name;
                                }
                            ],
                            [
                                'attribute' => 'vacosa_id',
                                'value' => function ($model) {
                                    return \app\models\Vacosa::find()->where(['id' => $model->vacosa_id])->one()->nome;
                                }
                            ],
                            'valor:currency',
                            'comprovante',
                            'comprovado:boolean',
                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'noWrap' => true,
                                'template' => '{view}{update}{delete}',
                                'visible' => Yii::$app->user->can('contribuicoes/view')
                                    || Yii::$app->user->can('contribuicoes/update')
                                    || Yii::$app->user->can('contribuicoes/delete'),
                                'viewOptions' => [
                                    'class' => 'btn btn-warning btn-xs btn_view_list',
                                    'disabled' => !Yii::$app->user->can('contribuicoes/view')
                                ],
                                'updateOptions' => [
                                    'class' => 'btn btn-success btn-xs',
                                    'disabled' => !Yii::$app->user->can('contribuicoes/update')
                                ],
                                'deleteOptions' => [
                                    'class' => 'btn btn-danger btn-xs',
                                    'disabled' => !Yii::$app->user->can('contribuicoes/delete')
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
