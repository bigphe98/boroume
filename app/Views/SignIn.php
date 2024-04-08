<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-1"></div>
        <div class="col-2">
            <button class="roundbutton" onclick="location.href = '<?=base_url()?>AuthController/login';">
                <span class="material-symbols-outlined">keyboard_return</span>
            </button>
        </div>
        <div class="col-6 row justify-content-center">
            <h2 id="Type"> <?= lang("Text.SignInHeader")?></h2>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
            </div >
            <form style="margin-top: 10px;" class="col-4" action="<?= base_url()?>AuthController/check_login" method="post" autocomplete="off"   >

                <?php $validation = \Config\Services::validation(); ?>

                <?= csrf_field(); ?>

                    <?php if( !empty( session()->getFlashdata('fail') ) ) : ?>
                        <div class="alert alert-danger" id="alertpopup"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>

                    <?php if( !empty( session()->getFlashdata('success') ) ) : ?>
                        <div class="alert alert-success" id="alertpopup3"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>


                    <div class="form-group ">
                        <?php if(session()->has('validation')): ?>
                                <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                        <?php endif ?>
                        <div style="display: flex; align-items: center;">
                            <label for="emailSignIn" style="width: 100px"> <?= lang("Text.EmailText")?> </label>
                            <input id="emailSignIn" type="text" style="font-family: 'Canada', sans-serif; width: 300px" name="email" class="form-control" placeholder="<?= lang("Text.EmailText")?>" value="<?= set_value('email') ?>" autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group ">
                        <?php if(session()->has('validation')): ?>
                            <small class="text-danger"><?= display_error(session('validation'), 'password') ?></small>
                        <?php endif ?>
                        <div style="display: flex; align-items: center; ">
                            <label for="passwordSignIn" style="width: 100px"> <?= lang("Text.PasswordText")?> </label>
                            <input id="passwordSignIn" style="font-family: 'Canada', sans-serif; width: 300px" type="password" name="password" class="form-control" placeholder="<?= lang("Text.PasswordText")?>" value="<?= set_value('password') ?>" autocomplete="off">
                            <span class="material-symbols-outlined" id="showPswd10" style="display: block; cursor: pointer; left: 330px" onclick="togglePassword(document.getElementById('passwordSignIn'), document.getElementById('showPswd10'), document.getElementById('hidePswd10'))">
    visibility
</span>
                            <span class="material-symbols-outlined" id="hidePswd10" style="cursor: pointer; display: none;left: 330px" onclick="togglePassword(document.getElementById('passwordSignIn'), document.getElementById('showPswd10'), document.getElementById('hidePswd10'))">
    visibility_off
</span>
                        </div>
                    </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <input type="hidden" name="button1" value="button?>">
                    <button class="textbuttonsmall" id="SignInButton"><?= lang("Text.LoginSmallText")?></button>
                </div>

            </form>
            <div class="col-4"></div>
    </div>
    <div class="row justify-content-center">
            <div style="display: flex; align-items: center; margin-top: 10px;">
                <input type="hidden" name="button1" value="button">
                <p style="margin-right: 20px">
                    <a id="forgotPassword" href="<?= base_url()?>AuthController/forgotPassword"><?= lang("Text.ForgotPasswordText")?></a>
                </p>
                <input type="hidden" name="button1" value="button">
                <p>
                    <?= lang("Text.NewText")?>
                    <a id="createAccount" href="<?= base_url()?>AuthController/SignUp"><?= lang("Text.CreateAccountText")?></a>
                </p>
            </div>
    </div>
</div>

