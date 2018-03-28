<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo */

$this->title = Yii::t('app', '{usuario} - Visualizando usuário - ', [
    'usuario' => $model->name,
]);
?>

<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Visualizando Usuário - <em><?php echo $model->name?></em></h2>
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
                            'name',
                            'email:email',
                            'username',
                            [
                                'attribute' => 'photo',
                                'value' => function($model) {
                                    return Html::img("/images/img.jpg", ['width' => '60', 'class' => 'img-thumbnail img-responsive']);
                                },
                                'format' => 'raw',
                                'filter' => false
                            ],
                             'status',
                            [
                                'attribute' => 'last_login',
                                'format' => 'datetime',
                                'filter' => false
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