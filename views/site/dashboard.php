<?php
$this->title = "Dashboard - ";
?>
<div class="">
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-code"></i></div>
                <div class="count"><?php echo $qtde_participacoes?></div>
                <h3>Participações</h3>
                <p>Total de vacosas que participou</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-calendar-times-o"></i></div>
                <div class="count"><?php echo $qtde_participacoes_6_meses?></div>
                <h3>6 meses</h3>
                <p>Quantidade de vacosas nos últimos 6 meses</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-dollar"></i></div>
                <div class="count">R$ <?php echo number_format($valor_contribuicao, 2, ",", ".")?></div>
                <h3>Total</h3>
                <p>Total de contribuições</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count"><?php echo $valor_contribuicao_por_mim?></div>
                <h3>Indicações</h3>
                <p>Vacosas indicadas por mim.</p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Vacosas disponíveis</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php echo $this->render("//vacosas/_table-listar-vacosas", ['vacosas' => $vacosas]);?>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <?php if(Yii::$app->user->can('vacosa/sugerir-vacosa')):?>
            <a href="/vacosas/sugerir-vacosa" class="btn btn-success btn-lg btn-block"><i class="fa fa-commenting fa-3x fa-pull-left"></i> Sugerir <br>nova Vacosa</a>
            <?php endif;?>
            <a href="#" class="btn btn-info btn-lg btn-block"><i class="fa fa-user fa-3x fa-pull-left"></i> Ver <br>Perfil</a>
            <a href="#" class="btn btn-primary btn-lg btn-block"><i class="fa fa-trophy fa-3x fa-pull-left"></i> Minhas <br>contribuições</a>
        </div>
    </div>
</div>