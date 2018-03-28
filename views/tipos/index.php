<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de tipos - ');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listagem de Tipos</h2>
                    <div class="clearfix"></div>
                </div>
                <?= Html::a(Yii::t('app', 'Cadastrar Tipo'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
                <div class="x_content">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'nome',
                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'noWrap' => true,
                                'template' => '{view}{update}{delete}',
                                'visible' => Yii::$app->user->can('tipos/view')
                                    || Yii::$app->user->can('tipos/update')
                                    || Yii::$app->user->can('tipos/delete'),
                                'viewOptions' => [
                                    'class' => 'btn btn-warning btn-xs btn_view_list',
                                    'disabled' => !Yii::$app->user->can('tipos/view')
                                ],
                                'updateOptions' => [
                                    'class' => 'btn btn-success btn-xs',
                                    'disabled' => !Yii::$app->user->can('tipos/update')
                                ],
                                'deleteOptions' => [
                                    'class' => 'btn btn-danger btn-xs',
                                    'disabled' => !Yii::$app->user->can('tipos/delete')
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
