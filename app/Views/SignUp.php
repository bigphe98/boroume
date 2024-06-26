<?php
// Check if the URL contains "childSignup"
$isChildSignup = strpos(current_url(), 'childSignup') !== false;
/**
 * @var $isAdult bool
 */
?>

<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-1"></div>
        <div class="col-2">
            <button class="roundbutton" onclick="location.href = '<?=base_url()?>AuthController/login';">
                <span class="material-symbols-outlined">keyboard_return</span>
            </button>
        </div>
        <div class="col-6 row justify-content-center">
            <h2 id="Type"> <?= lang("Text.SignUpHeader")?> </h2>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>

<div class="container col-md-12 scrollable-container signUpForm" id="signUpForm">
    <div class="row justify-content-center">
        <div class="col-4"></div>

        <form id="SignUp-form" class="col-4" style="margin-top: 10px" action="<?= base_url()?>AuthController/create_login" method="POST" autocomplete="off" >

            <?php $validation = \Config\Services::validation(); ?>

            <?= csrf_field(); ?>

                <?php if( !empty( session()->getFlashdata('fail') ) ) : ?>
                    <div class="alert alert-danger" id="alertpopup"><?= session()->getFlashdata('fail'); ?></div>
                <?php endif ?>

                <?php if( !empty( session()->getFlashdata('success') ) ) : ?>
                    <div class="alert alert-success" id="alertpopup"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>

            <!--div class="form-group">
                <div style="display: flex; align-items: center; margin-left: 20px;">
                    <label for="terms_of_service">
                        I read the <a href="<?=base_url()?>AuthController/VolunteersGuide">Volunteers Guide</a> and agree to it
                        <input type="checkbox" id="terms_of_service" name="terms_of_service" value="1">
                    </label>
                    <small class="text-danger"><?= isset($validation) ? display_error($validation, 'terms_of_service') : '' ?></small>

                </div>
            </div-->

                <div class="form-group">
                    <?php if(session()->has('validation')): ?>
                        <small class="text-danger"><?= display_error(session('validation'), 'name') ?></small>
                    <?php endif ?>
                    <div style="display: flex; align-items: center;">

                        <label for="first_name" style="width: 100px;"> <?= lang("Text.FirstNameText")?></label>
                        <input id="first_name" style="font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="name" class="form-control" placeholder="<?= lang("Text.FirstNameText")?> " value="<?= set_value('name') ?>" autocomplete="off">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px">
                    <?php if(session()->has('validation')): ?>
                        <small class="text-danger"><?= display_error(session('validation'), 'surname') ?></small>
                    <?php endif ?>
                    <div style="display: flex; align-items: center;">
                        <label for="last_name" style="width: 100px;"> <?= lang("Text.LastNameText")?>  </label>
                        <input id="last_name" style= "font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="surname" class="form-control" placeholder="<?= lang("Text.LastNameText")?> " value="<?= set_value('surname') ?>" autocomplete="off">
                    </div>
                </div>
            <?php if ($isChildSignup): ?>
            <div class="form-group" id="nameKid">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'nameKid') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="first_nameKid" style="width: 100px;"> <?= lang("Text.FirstNameKidText")?> </label>
                    <input id="first_nameKid" style="font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="nameKid" class="form-control" placeholder="<?= lang("Text.FirstNameKidText")?> " value="<?= set_value('nameKid') ?>" autocomplete="off">
                </div>
            </div>

            <div class="form-group" style="margin-top: 10px" id="surnameKid">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'surnameKid') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="last_nameKid" style="width: 100px;"> <?= lang("Text.LastNameKidText")?>  </label>
                    <input id="last_nameKid" style= "font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="surnameKid" class="form-control" placeholder="<?= lang("Text.LastNameKidText")?> " value="<?= set_value('surnameKid') ?>" autocomplete="off">
                </div>
            </div>
            <?php endif ?>

                <div class="form-group">
                    <?php if(session()->has('validation')): ?>
                        <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                    <?php endif ?>
                    <div style="display: flex; align-items: center;">
                        <label for="email" style="width: 100px;"> <?= lang("Text.EmailText")?> </label>
                        <input id="email" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="email" class="form-control" placeholder="<?= lang("Text.EmailText")?>" value="<?= set_value('email') ?>" autocomplete="off">
                    </div>
                </div>
            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'telephone') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="telephoneNumberSignIn" style="width: 100px"><?= lang("Text.TelephoneNumberText")?></label>
                    <input id="telephoneNumberSignIn" type="text" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" name="telephone" class="form-control" placeholder="<?= lang("Text.TelephoneNumberText")?>" value="<?= set_value('telephone') ?>" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <div style="display: flex; align-items: center;">
                    <label for="locationSignIn" style="width: 100px"><?= lang("Text.LocationText")?></label>
                    <div style="width: 300px;margin-left: 10px;">
                        <select id="locationSignIn" style="font-family: 'Canada', sans-serif; width: 295px;" name="location">
                            <option value="Athens"><?= lang("Text.Athens")?></option>
                            <option value="Thessaloniki"><?= lang("Text.Thessaloniki")?></option>
                            <!-- Add more country codes and names as needed -->
                        </select>
                    </div>
                </div>
            </div>


                <div class="form-group">
                    <?php if(session()->has('validation')): ?>
                        <small class="text-danger"><?= display_error(session('validation'), 'password') ?></small>
                    <?php endif ?>
                    <div style="display: flex; align-items: center;">
                        <label for="password" style="width: 100px;"> <?= lang("Text.PasswordText")?> </label>
                        <input id="password" style="font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="password" name="password" class="form-control" placeholder="<?= lang("Text.PasswordText")?>" autocomplete="off">
                        <span class="material-symbols-outlined" id="showPswd11" style="display: block; cursor: pointer; left: 350px" onclick="togglePassword(document.getElementById('password'), document.getElementById('showPswd11'), document.getElementById('hidePswd11'))">
    visibility
</span>
                        <span class="material-symbols-outlined" id="hidePswd11" style="display: none; cursor: pointer; left: 350px" onclick="togglePassword(document.getElementById('password'), document.getElementById('showPswd11'), document.getElementById('hidePswd11'))">
    visibility_off
</span>
                    </div>
                </div>

                <div class="form-group">
                    <?php if(session()->has('validation')): ?>
                        <small class="text-danger"><?= display_error(session('validation'), 'cpassword') ?></small>
                    <?php endif ?>
                    <div style="display: flex; align-items: center;">
                        <label for="confirm_password" style="width: 100px;"> <?= lang("Text.ConfirmPasswordText")?> </label>
                        <input id ="confirm_password" style="font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="password" name="cpassword" class="form-control" placeholder="<?= lang("Text.ConfirmPasswordText")?>" autocomplete="off">
                        <span class="material-symbols-outlined" id="showPswd12" style="display: block; cursor: pointer; left: 350px" onclick="togglePassword(document.getElementById('confirm_password'), document.getElementById('showPswd12'), document.getElementById('hidePswd12'))">
    visibility
</span>
                        <span class="material-symbols-outlined" id="hidePswd12" style="display: none; cursor: pointer; left: 350px" onclick="togglePassword(document.getElementById('confirm_password'), document.getElementById('showPswd12'), document.getElementById('hidePswd12'))">
    visibility_off
</span>
                    </div>
                </div>

                <!--<div class="form-group">
                    <label for="code_of_conduct">
                        <input type="checkbox" id="code_of_conduct" name="code_of_conduct" value="1"> I agree to the Code of Conduct
                    </label>
                    <small class="text-danger"><?= isset($validation) ? display_error($validation, 'code_of_conduct') : '' ?></small>
                </div>-->



            <div class="row justify-content-center" id="create-account-div">
                <div  class="row justify-content-center">
                    <div style="display: flex; align-items: center; ">
                        <input type="hidden" name="button1" value="button1">
                        <button id="create_account_button" class="textbuttonsmall"><?= lang("Text.ProceedText")?></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-4"></div>

        <div  class="row justify-content-center">
                    <div style="display: flex; align-items: center; margin-top: 10px; ">
                        <input type="hidden" name="button1" value="button1">
                        <p> <div id="have_an_account" style="font-family: 'Viga', sans-serif"><?= lang("Text.AlreadyAccountText")?> </div>
                        <a id="sign_in_now" style="font-family: 'Viga', sans-serif" href="<?=base_url()?>AuthController/SignIn"><?= lang("Text.SignInNowText")?></a>

                        <p>

                    </div>
        </div>




            </div>
    </div>

