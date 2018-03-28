<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de usuários - ');
?>

<div class="">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listagem de Usuários</h2>
                    <div class="clearfix"></div>
                </div>
                <?= Html::a(Yii::t('app', 'Cadastrar Usuário'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
                <div class="x_content">
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'name',
                            'email:email',
                            'username',
                            // 'auth_key',
                             [
                                 'attribute' => 'photo',
                                 'value' => function($model) {
                                     return Html::img("/images/img.jpg", ['width' => '60', 'class' => 'img-thumbnail img-responsive']);
                                 },
                                 'format' => 'raw',
                                 'filter' => false
                             ],
                            // 'status',
                             [
                                 'attribute' => 'last_login',
                                 'format' => 'datetime',
                                 'filter' => false
                             ],
                            // 'create_at',
                            // 'update_at',

                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'template' => '{view}{update}{delete}',
                                'noWrap' => true,
                                'visible' => Yii::$app->user->can('usuarios/view')
                                    || Yii::$app->user->can('usuarios/update')
                                    || Yii::$app->user->can('usuarios/delete'),
                                'viewOptions' => [
                                    'class' => 'btn btn-warning btn-xs btn_view_list',
                                    'disabled' => !Yii::$app->user->can('usuarios/view')
                                ],
                                'updateOptions' => [
                                    'class' => 'btn btn-success btn-xs',
                                    'disabled' => !Yii::$app->user->can('usuarios/update')
                                ],
                                'deleteOptions' => [
                                    'class' => 'btn btn-danger btn-xs',
                                    'disabled' => !Yii::$app->user->can('usuarios/delete')
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

