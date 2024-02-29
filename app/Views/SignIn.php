<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-1"></div>
        <div class="col-2">
            <button class="roundbutton" onclick="location.href = '<?=base_url()?>AuthController/login';">
                <span class="material-symbols-outlined">keyboard_return</span>
            </button>
        </div>
        <div class="col-6 row justify-content-center">
            <h1 id="Type"> Sign In To Your Account </h1>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group ">

                    <div style="display: flex; align-items: center;">
                        <h5 id="emailText" type="text" style="font-family: 'Canada', sans-serif; margin-left: 180px; margin-top: 17px;"> Email : </h5>
                    </div>

                </div>
                <div class="form-group ">

                    <div style="display: flex; align-items: center;">
                        <h5 id="emailText" type="text" style="font-family: 'Canada', sans-serif; margin-left: 180px; margin-top: 12px;"> Password : </h5>
                    </div>

                </div>
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

                        <div style="display: flex; align-items: center;">
                            <input id="emailSignIn" type="text" style="font-family: 'Canada', sans-serif; margin-left: 20px;" name="email" class="form-control" placeholder="Email" value="Your Email">
                            <small class="text-danger" style="margin-left: 10px;"><?= isset($validation) ? display_error($validation, 'email') : '' ?></small>
                        </div>
                    </div>

                    <div class="form-group ">

                        <div style="display: flex; align-items: center; ">
                            <input id="passwordSignIn" style="font-family: 'Canada', sans-serif; margin-left: 10px;" type="password" name="password" class="form-control" placeholder="Password" value="">

                            <small class="text-danger" style="margin-left: 10px;"><?= isset($validation) ? display_error($validation, 'password') : '' ?></small>
                            <span class="material-symbols-outlined" id="showPswd10" style="display: block; cursor: pointer;" onclick="togglePassword(document.getElementById('passwordSignIn'), document.getElementById('showPswd10'), document.getElementById('hidePswd10'))">
    visibility
</span>
                            <span class="material-symbols-outlined" id="hidePswd10" style="cursor: pointer; display: none;" onclick="togglePassword(document.getElementById('passwordSignIn'), document.getElementById('showPswd10'), document.getElementById('hidePswd10'))">
    visibility_off
</span>
                        </div>
                    </div>

                    <div  class="row justify-content-center">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <input type="hidden" name="button1" value="button?>">
                            <button class="textbuttonsmall" id="SignInButton">Login</button>
                        </div>
                    </div>
                    <div  class="row justify-content-center">
                        <div class="col-5" style="display: flex; align-items: center; font-family: 'Viga', sans-serif; color: #EB6F31;">
                            <input type="hidden" name="button1" value="button">
                            <a id="forgotPassword" href="<?= base_url()?>/public/AuthController/recoverPassword">Forgot password</a>
                        </div>
                        <div class="col-7" style="display: flex; align-items: center; font-family: 'Viga', sans-serif">
                            <input  type="hidden" name="button1" value="button">
                            <a id="createAccount" href="<?= base_url()?>AuthController/SignUp">New?Create a new account</a>
                        </div>
                    </div>

        </form>
            <div class="col-4"></div>
    </div>
</div>

