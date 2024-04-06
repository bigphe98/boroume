<div class="container">
<h1><?= lang("Text.CodeOfConductTitle")?></h1>
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
            <input type="text" id="volunteerPlace" name="volunteerPlace" placeholder="<?= lang('Text.residencyPlaceholder')?>">
            <?php if(session()->has('validation')): ?>
                <small class="text-danger"><?= display_error(session('validation'), 'volunteerPlace') ?></small>
            <?php endif ?>
            <?= lang("Text.coc05")?>
            <?= lang("Text.coc04")?>
            <input type="text" id="volunteerAFM" name="volunteerAFM" placeholder="<?= lang('Text.afmPlaceholder')?>">
            <?php if(session()->has('validation')): ?>
                <small class="text-danger"><?= display_error(session('validation'), 'volunteerAFM') ?></small>
            <?php endif ?>
            <?= lang("Text.coc06")?>
            <input type="text" id="volunteerDOY" name="volunteerDOY" placeholder="<?= lang('Text.doyPlaceholder')?>">
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
                        <small class="text-danger"><?= display_error(session('validation'), 'serviceOne') ?></small>
                    <?php endif ?>
                    <li>
                        <input style="margin-bottom: 10px;" type="text" id="firstService" name="firstService" placeholder="<?= lang('Text.servOnePlaceholder')?>">
                    </li>
                    <li>
                        <input style="margin-bottom: 10px;" type="text" id="secondService" name="secondService" placeholder="<?= lang('Text.servPlaceholder')?>">
                    </li>
                    <li>
                        <input style="margin-bottom: 10px;" type="text" id="thirdService" name="thirdService" placeholder="<?= lang('Text.servPlaceholder')?>">
                    </li>
            <!--div style="display: flex">
                <label for="farmersMarket">
                    <input type="checkbox" id="farmersMarket" name="farmers_Market" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/boroume-at-the-farmers-market/">Boroume at the Farmers Market</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="saveNFoodOffering">
                    <input type="checkbox" id="saveNFoodOffering" name="save_food_offering" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/saving-offering-food/">Saving & Offering Food</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="everyMealMatters">
                    <input type="checkbox" id="everyMealMatters" name="every_meal_matters" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/awareness-program-stop-food-waste/">Awareness Program "Every meal matters"</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="boroumeAtSchool">
                    <input type="checkbox" id="boroumeAtSchool" name="boroume_at_school" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/boroume-at-school/">Boroume At School"</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="boroumeGleaning">
                    <input type="checkbox" id="boroumeGleaning" name="boroume_gleaning" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/boroume-gleaning/">Boroume Gleaning"</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="weAreFamily">
                    <input type="checkbox" id="weAreFamily" name="we_are_family" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/we-are-family/">We Are Family"</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="certificationSchemeNoFoodWaste">
                    <input type="checkbox" id="certificationSchemeNoFoodWaste" name="certification_scheme_no_food_waste" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/shima-pistopoiisis-no-food-waste/">Certification Scheme No Food Waste</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="euPrograms">
                    <input type="checkbox" id="euPrograms" name="eu_programs" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/european-programs/">European Programs</a>
                </label>
            </div>
            <div style="display: flex">
                <label for="allianceFoodWasteInGreece">
                    <input type="checkbox" id="allianceFoodWasteInGreece" name="alliance_food_waste_in_greece" value="1">
                    <a href="https://www.boroume.gr/en/programmata/programs-detail/alliance-for-the-reduction-of-food-waste-ingreece/">Alliance for the Reduction of Food Waste</a>
                </label>
            </div-->
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
            <?= lang("Text.coc32")?></p>
        <h3><?= lang("Text.coc4Title")?></h3>
        <p><?= lang("Text.coc41")?></p>
        <div id="code_of_conduct_div" style="margin: 15px;">
            <label for="code_of_conduct">
                <li id="code_of_conduct">
                    <a href="<?=base_url()?>AuthController/VolunteersGuideGeneral"><?= lang("Text.coc42")?></a></li>
            </label>
        </div>

        <div style="margin: 15px;">
            <label for="terms_of_service">
                <li id="terms_of_service">
                    <a href="<?=base_url()?>AuthController/VolunteersGuide"><?= lang("Text.coc43")?></a> </li>
            </label>
        </div>
        <p><?= lang("Text.coc44")?>
            <input type="text" id="volunteerHospitalisation" name="volunteerHospitalisation" placeholder="<?= lang("Text.hospitalisationPlaceholder")?>">
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