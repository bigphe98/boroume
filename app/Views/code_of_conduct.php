<div class="row justify-content-center">
    <div class="col-3"></div>
    <div class="col-6 row justify-content-left">
        <h1><?= lang("Text.CodeOfConductTitle")?></h1>
    </div>
    <div class="col-3"></div>
</div>
<div class="row justify-content-center scrollable-container">
    <div class="col-3"></div>
    <div class="col-6 row justify-content-left">
    <form action="<?= base_url()?>AuthController/confirmCodeOfConduct" method="POST" autocomplete="off">

        <p><?= lang("Text.coc01")?><?php
            $currentDate = date('d-m-Y');
            echo $currentDate;
            ?>
            <?= lang("Text.coc021")?>
            <br>
            <?= lang("Text.coc022")?>
            <b>
                <?php
                if (isset($_COOKIE['LoggedUser'])){
                    //echo $_COOKIE['LoggedUser'];
                    $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
                    $expertName = $loggedUser['firstName'];
                    echo $expertName;
                }else{
                    echo 'No First Name';
                }?>
            </b>
            <?= lang("Text.coc03")?>
            <b>
                <?php
                if (isset($_COOKIE['LoggedUser'])){
                    //echo $_COOKIE['LoggedUser'];
                    $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
                    $expertName = $loggedUser['lastName'];
                    echo $expertName;
                }else{
                    echo 'No Last Name';
                }?>
            </b>
            <?= lang("Text.coc04")?>
            <input type="text" id="volunteerPlace" name="volunteerPlace" style="width: 37vh;" placeholder="<?= lang('Text.residencyPlaceholder')?>" value="<?= set_value('volunteerPlace') ?>">
            <?php if(session()->has('validation')): ?>
                <small class="text-danger"><?= display_error(session('validation'), 'volunteerPlace') ?></small>
            <?php endif ?>
            <?= lang("Text.coc05")?>
            <input type="text" id="volunteerAFM" name="volunteerAFM" style="width: 37vh;" placeholder="<?= lang('Text.afmPlaceholder')?>" value="<?= set_value('volunteerAFM') ?>">
            <?php if(session()->has('validation')): ?>
                <small class="text-danger"><?= display_error(session('validation'), 'volunteerAFM') ?></small>
            <?php endif ?>
            <?= lang("Text.coc06")?>
            <input type="text" id="volunteerDOY" name="volunteerDOY"  style="width: 37vh;" placeholder="<?= lang('Text.doyPlaceholder')?>" value="<?= set_value('volunteerDOY') ?>">
            <?php if(session()->has('validation')): ?>
                <small class="text-danger"><?= display_error(session('validation'), 'volunteerDOY') ?></small>
            <?php endif ?>
            <?= lang("Text.coc07")?>
        </p>
        <h3><?= lang("Text.coc1Title")?></h3>

            <p>
                <?= lang("Text.coc11")?>
                <div style="margin-left: 20px;">
                    <?php if(session()->has('validation')): ?>
                        <small class="text-danger"><?= display_error(session('validation'), 'programs') ?></small>
                    <?php endif ?>
            <div style="display: flex">
                <label for="farmersMarket">
                    <input type="checkbox" id="farmersMarket" name="programs[]" value="Boroume at the Farmers Market" <?= set_checkbox('programs', 'Boroume at the Farmers Market') ?>>
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/boroume-at-the-farmers-market/" target="_blank">Boroume at the Farmers Market</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="saveNFoodOffering">
                    <input type="checkbox" id="saveNFoodOffering" name="programs[]" value="Saving & Offering Food" <?= set_checkbox('programs', 'Saving & Offering Food') ?>>
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/saving-offering-food/" target="_blank">Saving & Offering Food</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="everyMealMatters">
                    <input type="checkbox" id="everyMealMatters" name="programs[]" value='Awareness Program "Every meal matters"' <?= set_checkbox('programs', 'Awareness Program "Every meal matters"') ?>>
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/awareness-program-stop-food-waste/" target="_blank">Awareness Program "Every meal matters"</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="boroumeAtSchool">
                    <input type="checkbox" id="boroumeAtSchool" name="programs[]" value="Boroume At School" <?= set_checkbox('programs', 'Boroume At School') ?>>
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/boroume-at-school/" target="_blank">Boroume At School</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="boroumeGleaning">
                    <input type="checkbox" id="boroumeGleaning" name="programs[]" value="Boroume Gleaning" <?= set_checkbox('programs', 'Boroume Gleaning') ?>>
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/boroume-gleaning/" target="_blank">Boroume Gleaning</a>
                </label>
            </div>

                    <!--button class="textbuttonsmall" style="background: white; color: blue" onclick="addService()">
                        Boroume At the Farmers Market <span>+</span>
                    </button>
            <button class="textbuttonsmall" style="background: white; " onclick="addService()">
                Saving & Offering Food  <span>+</span>
            </button>
            <button class="textbuttonsmall" style="background: white" onclick="addService()">
                Boroume at School <span>+</span>
            </button>
            <button class="textbuttonsmall" style="background: white" onclick="addService()">
                Awareness Program "Every meal matters"  <span>+</span>
            </button-->
                </div>
            </p>
            <p>
                <?= lang("Text.coc12")?>
            </p>
        <h3><?= lang("Text.coc2Title")?></h3>
        <p><?= lang("Text.coc21")?></p>
        <h3><?= lang("Text.coc3Title")?></h3>
        <p><?= lang("Text.coc31")?>
            <?php
            $currentDate = date('d-m-Y');
            echo $currentDate;
            ?>
            <?= lang("Text.coc32")?>
            <br>
            <input type="radio" id="indefinite" name="term_type" value="indefinite" onclick="toggleDateInput(false)" checked>
            <label for="indefinite"><?= lang("Text.coc32Indefinite")?></label>
            <br>
            <input type="radio" id="specific_date" name="term_type" value="specific_date" onclick="toggleDateInput(true)">
            <label for="specific_date"><?= lang("Text.coc32SpecificDate")?></label> <input type="date" id="end_date" name="end_date" disabled>
            <?php if(session()->has('validation')): ?>
                <small class="text-danger"><?= display_error(session('validation'), 'endTerm') ?></small>
            <?php endif ?>
            .<br>
            <?= lang("Text.coc33")?></p>
        <h3><?= lang("Text.coc4Title")?></h3>
        <p><?= lang("Text.coc41")?></p>
        <div id="code_of_conduct_div" style="margin: 15px;">
            <label for="code_of_conduct">
                <li id="code_of_conduct">
                    <a href="#" onclick="displayPopUpGeneralGuide(); return false;"><?= lang("Text.coc42")?></a>
                </li>
            </label>
        </div>

        <div style="margin: 15px;">
            <label for="terms_of_service">
                <li id="terms_of_service">
                    <a href="#" onclick="displayPopUpVolunteerGuide();  return false;"><?= lang("Text.coc43")?></a>
                </li>
            </label>
        </div>
        <p><?= lang("Text.coc44")?>
            <input type="text" id="volunteerHospitalisation" name="volunteerHosp" style="width: 37vh;" placeholder="<?= lang("Text.hospitalisationPlaceholder")?>" value="<?= set_value('volunteerHosp') ?>">
            <?php if(session()->has('validation')): ?>
                <small class="text-danger"><?= display_error(session('validation'), 'volunteerHosp') ?></small>
            <?php endif ?>
        </p>
        <h3><?= lang("Text.coc5Title")?></h3>
        <p><?= lang("Text.coc51")?>
        <div style="margin-left: 15px; margin-bottom: 10px;">
            <li><?= lang("Text.coc52")?></li>
            <li><?= lang("Text.coc53")?></li>
            <li><?= lang("Text.coc54")?></li>
        </div>
        <?= lang("Text.coc55")?>
        <br><br>
        <label for="videoConsent">
            <input type="checkbox" id="videoConsent" name="videoConsent" value="1"> <?= lang("Text.coc56")?>
        </label>
        </p>
        <h3><?= lang("Text.coc6Title")?></h3>
        <div><p><?= lang("Text.coc61")?></p>
            <p><?= lang("Text.coc62")?></p>
            </div>
        <br><br>
        <!-- Other fields go here -->
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

<div class="popup" id="popupGuide">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container" id="defaultpopupthings1" style="width:fit-content">

            </div>
        </div>
    </div>
</div>