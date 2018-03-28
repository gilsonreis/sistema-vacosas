<section class="other-section other-section-common edit-item" id="author">
    <div class="container">
        <div class="flex-row middle-md mb20">
            <div class="flex-col-md-3 align-c">
                <img src="<?php echo $img_contribuinte?>" class="img-responsive rd-150 mr-auto edit-item" alt="<?php echo $contribuinte?>">
            </div><!-- /column -->
            <div class="flex-col-md-8 flex-col-md-offset-1 sm-align-c">
                <h2 class="edit-item edit-content">Contribuição de</h2>
                <h3 class="edit-item edit-content"><?php echo $contribuinte?></h3>
                <hr class="edit-item">
                <p class="mr-b-30 edit-item edit-content">
                    Caro <strong><?php echo $admin?>,</strong><br>
                    <strong><?php echo $contribuinte?></strong> contribuiu com <strong>R$ <?php echo $valor_contribuicao?></strong> para a vacosa do <strong><?php echo $produto?></strong>.
                </p>
                <p class="edit-item edit-content">Para esse produto, já temos <strong>R$ <?php echo $valor?></strong> de <strong>R$ <?php echo $valor_vacosa?></strong></p>
                <p class="edit-item edit-content">Não esqueça de confirmar o pagamento através do sistema.</p>
                <hr class="edit-item">
                <p class="edit-item edit-content">Obrigado!</p>
            </div><!-- /column -->
        </div><!-- /row -->
    </div><!-- /container -->
</section><!-- /other-section --></div>