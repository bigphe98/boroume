<div class="container">
    <div class="row justify-content-center">
        <div class="col-3"></div>
        <div class="col-6 row justify-content-center">
            <h4 style="margin-top: 5px" id="Type"> Add New Farmers Market </h4>
        </div>
        <div class="col-2"></div>
        <div class="col-1">
            <div class="smallroundbutton">
                <span class="material-symbols-outlined" onclick="closePopUp()" style="cursor: pointer">
                close
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container col-md-12 scrollable-container signUpForm" id="signUpForm">
    <div class="row justify-content-center">

        <form id="SignUp-form" style="margin-top: 10px" action="<?= base_url()?>BoroumeController/addFarmersMarket" method="POST" autocomplete="off" >

            <?php $validation = \Config\Services::validation(); ?>

            <?= csrf_field(); ?>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'name') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">

                    <label for="nameGreek" style="width: 100px;"> Greek Name </label>
                    <input id="nameGreek" style="font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="nameGreek" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group" style="margin-top: 10px">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'surname') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="nameEnglish" style="width: 100px;"> English Name </label>
                    <input id="nameEnglish" style= "font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="nameEnglish" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="charityNameGreek" style="width: 100px;"> Charity Name Greek </label>
                    <input id="charityNameGreek" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="charityNameGreek" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="charityNameEnglish" style="width: 100px;"> Charity Name English </label>
                    <input id="charityNameEnglish" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="charityNameEnglish" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <div style="display: flex; align-items: center;">
                    <label for="dayMarket" style="width: 100px">Day of the Week</label>
                    <div style="width: 300px;margin-left: 10px;">
                        <select id="dayMarket" style="font-family: 'Canada', sans-serif; width: 295px;" name="dayMarket">
                            <option value="Monday"><?= lang("Weekdays.Monday")?></option>
                            <option value="Tuesday"><?= lang("Weekdays.Tuesday")?></option>
                            <option value="Wednesday"><?= lang("Weekdays.Wednesday")?></option>
                            <option value="Thursday"><?= lang("Weekdays.Thursday")?></option>
                            <option value="Friday"><?= lang("Weekdays.Friday")?></option>
                            <option value="Saturday"><?= lang("Weekdays.Saturday")?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="timeStart" style="width: 100px;"> Time Start </label>
                    <input id="timeStart" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="time" name="timeStart" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="timeEnd" style="width: 100px;"> Time End </label>
                    <input id="timeEnd" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="time" name="timeEnd" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="supermarket" style="width: 100px;"> Supermarket </label>
                    <input id="supermarket" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="supermarket" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="meetingPointEnglish" style="width: 100px;"> Meeting Point Address </label>
                    <input id="meetingPointEnglish" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="meetingPointEnglish" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="meetingPointGreek" style="width: 100px;"> Meeting Point Address (Greek) </label>
                    <input id="meetingPointGreek" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="meetingPointGreek" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="meetingPointUrl" style="width: 100px;"> Address url </label>
                    <input id="meetingPointUrl" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="meetingPointUrl" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php if(session()->has('validation')): ?>
                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                <?php endif ?>
                <div style="display: flex; align-items: center;">
                    <label for="spotsMarket" style="width: 100px;"> Total spots </label>
                    <input id="spotsMarket" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="number" name="spotsMarket" class="form-control" placeholder="" value="" autocomplete="off">
                </div>
            </div>

            <div class="row justify-content-center" id="create-account-div">
                <div  class="row justify-content-center">
                    <div style="display: flex; align-items: center; ">
                        <input type="hidden" name="button1" value="button1">
                        <button id="create_account_button" class="textbuttonsmall">CONFIRM</button>
                    </div>
                </div>
            </div>
        </form>





    </div>
</div>


