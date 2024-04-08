<script src="<?=base_url()?>/public/js/forgotPassword.js"></script>

<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-1"></div>
        <div class="col-2">
            <button class="roundbutton" onclick="location.href = '<?=base_url()?>AuthController/login';">
                <span class="material-symbols-outlined">keyboard_return</span>
            </button>
        </div>
        <div class="col-6 row justify-content-center">
            <h1 id="Type">
                <?= lang("Text.recoverPasswordTitle")?>
            </h1>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>
<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-1"></div>
        <div class="col-2">
        </div>
        <div class="col-6 row justify-content-center">
            <div id="Type2">
                <?= lang("Text.recoverPasswordDescription")?>
            </div>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>
<div class="container col-md-12">
        <div class="row justify-content-center">
            <div class="col-3"></div>
            <div class="col-6 row justify-content-center">
                <form style="margin-top: 10px" action="<?= base_url()?>AuthController/recoverPassword" method="post" autocomplete="off">

                    <?= csrf_field(); ?>

                    <?php if( !empty( session()->getFlashdata('fail') ) ) : ?>
                        <div class="alert alert-danger" id="alertpopup"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>

                    <?php if( !empty( session()->getFlashdata('success') ) ) : ?>
                        <div class="alert alert-success" id="alertpopup"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>


                    <div class="form-group ">
                        <?php if(session()->has('validation')): ?>
                            <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                        <?php endif ?>
                        <div style="display: flex; align-items: center;">
                            <input id = "email" type="text" style="font-family: 'Viga', sans-serif" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
                        </div>
                    </div>


                        <div  class="row justify-content-center">
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <button class="textbuttonsmall" id="sendEmail" href="<?= base_url()?>AuthController/SignIn"><?= lang("Text.recoverPasswordButton")?></button>
                            </div>
                        </div>

                </form>
            </div>
            <div class="col-3"></div>
        </div>
</div>
