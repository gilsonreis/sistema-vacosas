<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Vacosas Disponíveis</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php echo $this->render("//vacosas/_table-listar-vacosas", ['vacosas' => $vacosas]);?>
                </div>
            </div>
        </div>
    </div>
</div>