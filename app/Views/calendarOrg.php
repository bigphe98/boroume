<?php
/**
 * @var $farmersMarkets string
 * @var $language string
 * @var $userID int
 */

// Define the function outside of the loop
function getNextWeekdayDate($weekday) {
    // Convert weekday name to numeric value
    $weekdayNumeric = date('N', strtotime($weekday));
    $currentDay = date('N');
    $daysUntilNextWeekday = ($weekdayNumeric - $currentDay + 7) % 7;
    $nextWeekday = strtotime("+$daysUntilNextWeekday days");
    return date('d/m', $nextWeekday);
}
?>

<div class="container-fluid">
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
                        Activate
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($farmersMarkets as $market):
                    ?>
                    <tr>
                        <td>
                            <div style="margin-left: 15px">
                                <div class="row">
                                    <?php
                                    if ($language == 'gr') {
                                        echo $market->nameGreek;
                                    } else {
                                        echo $market->name;
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <a href="<?=$market->superMarketMapsLink?>" target="_blank"><?php
                                        if ($language == 'gr') {
                                            echo $market->superMarketLocationGreek;
                                        } else {
                                            echo $market->superMarketLocation;
                                        }
                                        ?></a>
                                </div>
                            </div>


                        </td>
                        <td>
                            <?= lang("Weekdays." . $market->actionDay) ?> <?=getNextWeekdayDate($market->actionDay)?>
                        </td>
                        <td>
                            <?= lang("Text.fromText")?> <?= substr($market->timeStart, 0, 5) ?><?= lang("Text.untilText")?> <?= substr($market->timeEnd, 0, 5) ?>
                        </td>
                        <td>
                            <?=$market->spotsTaken?> / <?=$market->spotsTotal?>
                        </td>
                        <td>
                            <button type="button" class="btn textbutton">
                                LOCK
                            </button>

                            <button type="button" class="btn secondarytextbutton">
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
<div class="container-fluid">
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
                    <button type="button" class="btn btn-success" onclick="displayPopUpCalendar()">
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