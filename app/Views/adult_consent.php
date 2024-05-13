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
        <form action="<?= base_url()?>AuthController/acceptAdultConsent" method="POST" autocomplete="off">
            <p><?= lang("Text.ac0")?> <strong> <?php
                    if (isset($_COOKIE['LoggedUser'])){
                        //echo $_COOKIE['LoggedUser'];
                        $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
                        $firstName = $loggedUser['firstName'];
                        $lastName = $loggedUser['lastName'];
                        $fullName = $firstName . ' ' . $lastName;

                        echo $fullName;
                    }else{
                        echo 'No First Name';
                    }?></strong> </p>
            <p><?= lang("Text.ac1")?> <strong> <?php
                    if (isset($_COOKIE['LoggedUser'])){
                        //echo $_COOKIE['LoggedUser'];
                        $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
                        $firstName = $loggedUser['firstNameKid'];
                        $lastName = $loggedUser['lastNameKid'];
                        $fullName = $firstName . ' ' . $lastName;

                        echo $fullName;
                    }else{
                        echo 'No First Name';
                    }?></strong> <?= lang("Text.ac2")?> </p>
            <p><?= lang("Text.ac3")?> <strong> <?php
                    if (isset($_COOKIE['LoggedUser'])){
                        //echo $_COOKIE['LoggedUser'];
                        $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
                        $firstName = $loggedUser['firstNameKid'];
                        $lastName = $loggedUser['lastNameKid'];
                        $fullName = $firstName . ' ' . $lastName;

                        echo $fullName;
                    }else{
                        echo 'No First Name';
                    }?></strong> <?= lang("Text.ac4")?> <?= lang("Text.coc01")?><strong><?php
                    $currentDate = date('d-m-Y');
                    echo $currentDate;
                    ?></strong>  <?= lang("Text.ac5")?> <input type="date" name="endTerm">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'endTerm') ?></small>
                <?php endif ?>
            </p>
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