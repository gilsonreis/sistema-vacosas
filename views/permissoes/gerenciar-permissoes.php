<?php
$this->title = "";
?>
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Permissões de acesso para <?php echo $perfil ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="/permissoes/gerenciar-permissoes/<?php echo $perfil ?>" method="post">
                        <div class="row">
                            <?php foreach ($permissoes as $controller => $acoes): ?>
                                <div class="col-sm-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h4><?php echo $controller ?></h4></div>
                                        <div class="panel-body">
                                            <ul class="to_do">
                                                <?php foreach ($acoes as $acao):
                                                    $permissao = $controller . "/" . $acao;
                                                    ?>
                                                    <li>
                                                        <label><input type="checkbox" class="flat"
                                                                      name="form_permissoes[]" <?php echo in_array($permissao, $permissoes_perfils) ? "checked='checked'" : "" ?>
                                                                      value="<?php echo $permissao ?>"> <?php echo $acao ?>
                                                        </label>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="btn btn-success" type="submit">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>