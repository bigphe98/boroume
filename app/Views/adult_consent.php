<div class="row justify-content-center">
    <div class="col-3"></div>
    <div class="col-6 row justify-content-left">
        <h1><?= lang("Text.consentTitle")?></h1>
    </div>
    <div class="col-3"></div>
</div>
<div class="row justify-content-center scrollable-container">
    <div class="col-3"></div>
    <div class="col-6 row justify-content-left">
        <form action="<?= base_url()?>AuthController/confirmAdultConsent" method="POST" autocomplete="off">
            <p><?= lang("Text.ac1")?> <strong>ONOMA</strong> <?= lang("Text.ac2")?> </p>
            <p><?= lang("Text.ac3")?> <strong>ONOMA</strong> <?= lang("Text.ac4")?> <strong>DATE</strong>  <?= lang("Text.ac5")?> <strong>DATE</strong> </p>
            <p><?= lang("Text.ac6")?></p>
            <p><?= lang("Text.ac7")?></p>
            <p><?= lang("Text.ac8")?></p>
            <div class="row justify-content-center" id="create-account-div">
                <div  class="row justify-content-center">
                    <div style="display: flex; align-items: center; ">
                        <input type="hidden" name="button1" value="button1">
                        <button id="create_account_button" class="textbuttonsmall"><?= lang("Text.cocAgreeButton")?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>