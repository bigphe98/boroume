<?php
/**
 * @var $farmersMarkets string
 * @var $language string
 * @var $userID int
 * @var $spotsSelected string
 * @var $actionClicked int
 * @var $volunteers string
 */

// Define the function outside the loop
function getNextWeekdayDate($weekday) {
    // Convert weekday name to numeric value
    $weekdayNumeric = date('N', strtotime($weekday));
    $currentDay = date('N');
    $daysUntilNextWeekday = ($weekdayNumeric - $currentDay + 7) % 7;
    $nextWeekday = strtotime("+$daysUntilNextWeekday days");
    return date('d/m', $nextWeekday);
}

function getNextWeekdayDateWithYear($weekday) {
    // Convert weekday name to numeric value
    $weekdayNumeric = date('N', strtotime($weekday));
    $currentDay = date('N');
    $daysUntilNextWeekday = ($weekdayNumeric - $currentDay + 7) % 7;
    $nextWeekday = strtotime("+$daysUntilNextWeekday days");
    return date('y/m/d', $nextWeekday);
}
?>

<div class="container-fluid">
    <table class="table" id="reservedSpots" style="display: none">
        <thead>
        <tr>
            <th>
                idPeople
            </th>
            <th>
                idFarmersMarket
            </th>
            <th>
                firstName and lastName
            </th>
            <th>
                email
            </th>
            <th>
                telephone
            </th>
            <th>
                date
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($spotsSelected as $spot): ?>
            <tr id="spotSelectedRow">
                <td id="peopleId_<?php $spot->peopleId ?>">
                    <?php echo $spot->peopleId; ?>

                </td>
                <td id="marketId_<?php $spot->peopleId ?>">
                    <?php echo $spot->farmersMarketId; ?>
                </td>
                <td id="name_<?php $spot->peopleId ?>">
                    <?php echo $spot->firstName; ?> <?php echo $spot->lastName; ?>
                </td>
                <td id="email_<?php $spot->peopleId ?>">
                    <?php echo $spot->email; ?>
                </td>
                <td id="telephone_<?php $spot->peopleId ?>">
                    <?php echo $spot->telephone; ?>
                </td>
                <td id="date_<?php $spot->peopleId ?>">
                    <?php echo $spot->actionDate; ?>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
    <div class="row">

        <?php $validation = \Config\Services::validation(); ?>

        <?= csrf_field(); ?>

        <?php if( !empty( session()->getFlashdata('fail') ) ) : ?>
            <div class="alert alert-danger" id="alertpopup"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if( !empty( session()->getFlashdata('success') ) ) : ?>
            <div class="alert alert-success" id="alertpopup"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <div class="col-md-12" id="tableCalendar">

            <table class="table">
                <thead>
                <tr>
                    <th>
                        Name Agora and Location
                    </th>
                    <th>
                        Next Date
                    </th>
                    <th>
                        Time
                    </th>
                    <th>
                        Places
                    </th>
                    <th>
                        Lock/Unlock
                    </th>
                    <th>
                        Update Market Info
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($farmersMarkets as $market):
                    ?>
                    <tr id="row_<?=$market->idfarmersMarkets?>">
                        <td>
                            <div style="margin-left: 15px">
                                <div class="row" id="farmersMarketName_<?=$market->idfarmersMarkets?>"
                                     data-name-greek="<?= $market->nameGreek; ?>"
                                     data-name-english="<?= $market->name; ?>">
                                    <?php
                                    if ($language == 'gr') {
                                        echo $market->nameGreek;
                                    } else {
                                        echo $market->name;
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <a id="location_<?=$market->idfarmersMarkets?>"
                                       data-location="<?= $market->meetingPoint; ?>"
                                       data-name-greek="<?= $market->superMarketLocationGreek; ?>"
                                       data-name-english="<?= $market->superMarketLocation; ?>"
                                       data-name-url="<?= $market->superMarketMapsLink; ?>"
                                       href="<?=$market->superMarketMapsLink?>" target="_blank"><?php
                                        if ($language == 'gr') {
                                            echo $market->superMarketLocationGreek;
                                        } else {
                                            echo $market->superMarketLocation;
                                        }
                                        ?></a>
                                </div>
                                <div class="row" id="charityName_<?=$market->idfarmersMarkets?>"
                                     data-name-greek="<?= $market->charityNameGreek; ?>"
                                     data-name-english="<?= $market->charityName; ?>">
                                    <?php
                                    if ($language == 'gr') {
                                        echo $market->charityNameGreek;
                                    } else {
                                        echo $market->charityName;
                                    }
                                    ?>
                                </div>
                            </div>


                        </td>
                        <td id="weekday_<?=$market->idfarmersMarkets?>" data-actionDay="<?= $market->actionDay; ?>">
                            <?= lang("Weekdays." . $market->actionDay) ?> <?=getNextWeekdayDate($market->actionDay)?>
                        </td>
                        <td id="time_<?=$market->idfarmersMarkets?>" data-time-start="<?= $market->timeStart ?>" data-time-end="<?= $market->timeEnd ?>">
                            <?= lang("Text.fromText")?> <?= substr($market->timeStart, 0, 5) ?><?= lang("Text.untilText")?> <?= substr($market->timeEnd, 0, 5) ?>
                        </td>
                        <td id="spots_<?=$market->idfarmersMarkets?>" data-spots-total="<?=$market->spotsTotal?>">
                            <a href="#" onclick="openVolunteerListForMarket(<?=$market->idfarmersMarkets?>, <?=$market->spotsTaken?>,<?=$market->spotsTotal?>, '<?=getNextWeekdayDateWithYear($market->actionDay)?>')"><?=$market->spotsTaken?> / <?=$market->spotsTotal?></a>
                        </td>
                        <td>
                            <?php if ($market->isLocked == '0'): ?>
                            <button type="button" class="btn textbutton" onclick="updateLockStatusMarket('lock', <?=$market->idfarmersMarkets?>)">
                                LOCK
                            </button>
                            <?php else: ?>
                                <button type="button" class="btn textbutton" onclick="updateLockStatusMarket('unlock', <?=$market->idfarmersMarkets?>)">
                                    UNLOCK
                                </button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn secondarytextbutton" onclick="displayPopUpUpdate(<?=$market->idfarmersMarkets?>)">
                                CHANGE INFO
                            </button>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top: 5vh">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success" onclick="displayPopUpCalendar(1)">
                        <?= lang("Text.addMarket")?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="popup" id="popupCalendar">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container" id="defaultpopupthings1" style="width:fit-content">

            </div>
        </div>
    </div>
</div>

<div class="popupSmall" id="popupVolunteers">
    <div class="row justify-content-center" style="height: 100px">
        <div class="col-md-12">
            <div class="container" id="defaultpopupthings1" style="width:fit-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-3"></div>
                        <div class="col-6 row justify-content-center">
                            <h5 style="margin-top: 5px" id="Type"> ADD VOLUNTEERS </h5>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-1">
                            <div class="smallroundbutton">
                <span class="material-symbols-outlined" onclick="closePopUp(4)" style="cursor: pointer">
                close
                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col justify-content-end input">
                        <input type="text" placeholder="Search People" id="mysearch" oninput="search()" autocomplete="off">
                    </div>
                </div>
                <div class="row justify-content-center scrollable-popup-container">
                    <table class="table" id="newPersonAtMarketPopUp">
                        <thead>

                        <tr>
                            <th style="display: none"> person ID </th>
                            <th>
                                First Name
                            </th>
                            <th>
                                Last Name
                            </th>
                            <th>
                                add person
                            </th>
                        </tr>
                        </thead>
                        <?php foreach($volunteers as $volunteer): ?>
                            <tbody id="popupVolunteerRow_<?= $volunteer->peopleId; ?>">
                            <td id="popupVolunteersID_<?= $volunteer->peopleId; ?>" style="display: none">
                                <?= $volunteer->peopleId; ?>
                            </td>
                            <td id="popupVolunteersFirstName_<?= $volunteer->peopleId; ?>">
                                <?= $volunteer->peopleFirstName; ?>
                            </td>
                            <td id="popupVolunteersLastName_<?= $volunteer->peopleId; ?>">
                                <?= $volunteer->peopleLastName; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" id="button-<?= $volunteer->peopleId; ?>" onclick="toggleVolunteer(<?= $volunteer->peopleId?>)">
                                    ADD
                                </button>
                            </td>
                            </tbody>
                        <?php
                        endforeach;
                        ?>

                    </table>

                </div>
                <div class="row" style="margin-top: 2vh">
                    <div class="col-6">
                        <button class="textbuttonsmall" onclick="confirmAddList()">
                            CONFIRM
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="textbuttonsmall" onclick="closePopUp(4)">
                            CANCEL
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="popup" id="popupSpotsSelected">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container" id="defaultpopupthings1" style="width:fit-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-3"></div>
                        <div class="col-6 row justify-content-center">
                            <h4 style="margin-top: 5px" id="Type"> RESERVED SPOTS </h4>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-1">
                            <div class="smallroundbutton">
                <span class="material-symbols-outlined" onclick="closePopUp(2)" style="cursor: pointer">
                close
                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table" id="reservedSpotsPopUp">
                    <thead>
                    <tr>
                        <th>
                            firstName and lastName
                        </th>
                        <th>
                            email
                        </th>
                        <th>
                            telephone
                        </th>
                        <th>
                            remove person
                        </th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>

                </table>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" onclick="displayPopUpCalendar(3)">
                                    ADD VOLUNTEERS
                                </button>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup" id="popupCalendarUpdate">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container" id="defaultpopupthings1" style="width:fit-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-3"></div>
                        <div class="col-6 row justify-content-center">
                            <h4 style="margin-top: 5px" id="Type"> Update Farmers Market </h4>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-1">
                            <div class="smallroundbutton">
                <span class="material-symbols-outlined" onclick="closePopUp(3)" style="cursor: pointer">
                close
                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container col-md-12 scrollable-container signUpForm" id="signUpForm">
                    <div class="row justify-content-center">

                        <div>

                            <?php $validation = \Config\Services::validation(); ?>

                            <?= csrf_field(); ?>

                            <div class="form-group" style="display: none">
                                <div style="display: flex; align-items: center;">


                                    <div id="idFarm" style="font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" class="form-control"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'name') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">

                                    <label for="nameGreekPopUp" style="width: 100px;"> Greek Name </label>
                                    <input id="nameGreekPopUp" style="font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="nameGreekPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 10px">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'surname') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="nameEnglishPopUp" style="width: 100px;"> English Name </label>
                                    <input id="nameEnglishPopUp" style= "font-family: 'Viga', sans-serif; width: 300px; margin-left: 10px;" type="text" name="nameEnglishPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="charityNameGreekPopUp" style="width: 100px;"> Charity Name Greek </label>
                                    <input id="charityNameGreekPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="charityNameGreekPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="charityNameEnglishPopUp" style="width: 100px;"> Charity Name English </label>
                                    <input id="charityNameEnglishPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="charityNameEnglishPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <div style="display: flex; align-items: center;">
                                    <label for="dayMarketPopUp" style="width: 100px">Day of the Week</label>
                                    <div style="width: 300px;margin-left: 10px;">
                                        <select id="dayMarketPopUp" style="font-family: 'Canada', sans-serif; width: 295px;" name="dayMarketPopUp">
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
                                    <label for="timeStartPopUp" style="width: 100px;"> Time Start </label>
                                    <input id="timeStartPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="time" name="timeStartPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="timeEndPopUp" style="width: 100px;"> Time End </label>
                                    <input id="timeEndPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="time" name="timeEndPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="locationPopUp" style="width: 100px;"> Meeting Point </label>
                                    <input id="locationPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="locationPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="meetingPointEnglishPopUp" style="width: 100px;"> Meeting Point Address </label>
                                    <input id="meetingPointEnglishPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="meetingPointEnglishPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="meetingPointGreekPopUp" style="width: 100px;"> Meeting Point Address (Greek) </label>
                                    <input id="meetingPointGreekPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="meetingPointGreekPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="meetingPointUrlPopUp" style="width: 100px;"> Address url </label>
                                    <input id="meetingPointUrlPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="text" name="meetingPointUrlPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <?php if(session()->has('validation')): ?>
                                    <small class="text-danger"><?= display_error(session('validation'), 'email') ?></small>
                                <?php endif ?>
                                <div style="display: flex; align-items: center;">
                                    <label for="spotsMarketPopUp" style="width: 100px;"> Total spots </label>
                                    <input id="spotsMarketPopUp" style="font-family: 'Canada', sans-serif; width: 300px; margin-left: 10px;" type="number" name="spotsMarketPopUp" class="form-control" placeholder="" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="row justify-content-center" id="create-account-div">
                                <div  class="row justify-content-center">
                                    <div style="display: flex; align-items: center; ">
                                        <input type="hidden" name="button1" value="button1">
                                        <button id="create_account_button" class="textbuttonsmall" onclick="updateLockStatusMarket('update', 0)">CONFIRM</button>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
