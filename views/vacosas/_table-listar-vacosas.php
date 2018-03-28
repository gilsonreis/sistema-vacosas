<p>Essas são as vacosas que estão disponíveis para contribuição</p>
<table class="table table-striped table-hover projects">
    <thead>
    <tr>
        <th style="width: 1%">#</th>
        <th style="width: 20%">Nome</th>
        <th style="width: 10%">Valor</th>
        <th>Contribuintes</th>
        <th>Progresso</th>
        <th style="width: 18%">Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php use yii\bootstrap\Html;

    if (count($vacosas) == 0): ?>
        <tr>
            <td colspan="5">
                <p class="text-danger">Nenhuma vacosa disponível para contribuição</p>
            </td>
        </tr>
    <?php else:
        foreach ($vacosas as $vacosa):
            ?>
            <tr>
                <td></td>
                <td>
                    <?php if (Yii::$app->user->can('vacosa/contribuir')): ?>
                        <a href="/vacosas/contribuir/<?php echo $vacosa->id ?>"
                           title="Contribuir com essa vacosa!"><?php echo $vacosa->nome ?></a>
                    <?php else: ?>
                        <a><?php echo $vacosa->nome ?></a>
                    <?php endif; ?>
                    <br/>
                    <a href="<?php echo $vacosa->url ?>" target="_blank">
                        <small>Acessar live preview</small>
                    </a>
                </td>
                <td>R$ <?php echo number_format($vacosa->valor, 2, ",", ".") ?></td>
                <td>
                    <?php if (count($vacosa->contribuicoes) > 0): ?>
                        <ul class="list-inline">
                            <?php
                            $contribuintes = $valor = [];
                            foreach ($vacosa->contribuicoes as $contribuicao):
                                $contribuintes[$contribuicao->contribuinte_id] = $contribuicao;
                                $valor[$contribuicao->contribuinte_id] = isset($valor[$contribuicao->contribuinte_id]) ? $valor[$contribuicao->contribuinte_id] + $contribuicao->valor : $contribuicao->valor;
                            endforeach;

                            foreach ($contribuintes as $i => $contribuicao):

                                //TODO: Calcular todas as contribuições de um mesmo usuário.
                                $base_img = ($contribuicao->contribuinte->photo == "no-picture.png") ? "/images/" : "/uploads/usuarios/";
                                $msg_contribuinte = $contribuicao->contribuinte->name
                                    . " contribuiu com R$ " . number_format($valor[$i], 2, ",", ".");
                                ?>
                                <li>
                                    <img src="<?php echo $base_img . $contribuicao->contribuinte->photo ?>"
                                         class="img-circle img-thumbnail avatar"
                                         title="<?php echo $msg_contribuinte ?>"
                                         alt="<?php echo $msg_contribuinte ?>">
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-danger">Nenhum contribuínte ainda.</p>
                    <?php endif; ?>
                </td>
                <td class="project_progress">
                    <?php if (count($vacosa->contribuicoes) > 0):
                        $valor = .0;
                        foreach ($vacosa->contribuicoes as $contribuicao):
                            $valor += $contribuicao->valor;
                        endforeach;
                        $pct = ($valor / $vacosa->valor) * 100;
                        ?>
                        <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar"
                                 data-transitiongoal="<?php echo $pct ?>"></div>
                        </div>
                        <small><?php echo number_format($pct, 0) ?>% Completo</small>
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    $mostra_botao = Yii::$app->user->can('vacosa/contribuir')
                        || Yii::$app->user->can('vacosa/view')
                        || Yii::$app->user->can('vacosa/update')
                        || Yii::$app->user->can('vacosa/delete')
                    ?>
                    <?php if ($mostra_botao): ?>
                        <div class="btn-group">
                            <a href="/vacosas/contribuir/<?php echo $vacosa->id ?>" class="btn btn-primary" title="Contribuir com essa vacosa!"><i
                                        class="fa fa-money" ></i> Contribuir</a>
                            <?php
                            $acao_admin = Yii::$app->user->can('vacosa/view')
                                || Yii::$app->user->can('vacosa/update')
                                || Yii::$app->user->can('vacosa/delete');
                            ?>
                            <?php if ($acao_admin): ?>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Mostrar opções</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php if(Yii::$app->user->can('vacosa/view')):?>
                                    <li>
                                        <a href="/vacosas/view/<?php echo $vacosa->id?>"><i class="fa fa-eye"></i> Visualizar</a>
                                    </li>
                                    <?php endif;?>
                                    <?php if(Yii::$app->user->can('vacosa/update')):?>
                                    <li>
                                        <a href="/vacosas/update/<?php echo $vacosa->id?>"><i class="fa fa-pencil"></i> Editar</a>
                                    </li>
                                    <?php endif;?>
                                    <?php if(Yii::$app->user->can('vacosa/delete')):?>
                                    <li>
                                        <?php
                                        echo Html::a('<i class="fa fa-trash"></i> Excluir', ['delete', 'id' => $vacosa->id], [
                                            'class' => '',
                                            'data' => [
                                                'confirm' => 'Deseja realmente deletar essa vacosa?',
                                                'method' => 'post',
                                            ],
                                        ])
                                        ?>
                                    </li>
                                    <?php endif;?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
<!--                    --><?php //if (Yii::$app->user->can('vacosa/contribuir')): ?>
<!--                        <a href="/vacosas/contribuir/--><?php //echo $vacosa->id ?><!--"-->
<!--                           class="btn btn-primary btn-sm" title="Contribuir com essa vacosa!"><i-->
<!--                                    class="fa fa-money"></i> Contribuir</a>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (Yii::$app->user->can('vacosa/view')): ?>
<!--                        <a href="/vacosas/view/--><?php //echo $vacosa->id ?><!--"-->
<!--                           class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> </a>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (Yii::$app->user->can('vacosa/update')): ?>
<!--                        <a href="/vacosas/update/--><?php //echo $vacosa->id ?><!--"-->
<!--                           class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> </a>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (Yii::$app->user->can('vacosa/delete')):
//
//                        echo Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $vacosa->id], [
//                            'class' => 'btn btn-danger btn-sm',
//                            'data' => [
//                                'confirm' => 'Deseja realmente deletar essa vacosa?',
//                                'method' => 'post',
//                            ],
//                        ]) ?>
<!--                    --><?php //endif; ?>
                </td>
            </tr>
        <?php endforeach;
    endif; ?>
    </tbody>
</table>