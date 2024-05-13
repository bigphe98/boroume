<?php
/**
 * @var $farmersMarkets string
 * @var $language string
 * @var $userID int
 * @var $dateOfActivity string
 * @var $farmersMarketId int
 * @var $spotsTaken string
 * @var $mySpots string
 * @var $selectedSpot string
 */
$mySpotsIds = array_map(function($spot) {
    return $spot->idFarmersMarket;
}, $mySpots);

// Define the function outside of the loop
function getNextWeekdayDate($weekday) {
    // Convert weekday name to numeric value
    $weekdayNumeric = date('N', strtotime($weekday));
    $currentDay = date('N');
    $daysUntilNextWeekday = ($weekdayNumeric - $currentDay + 7) % 7;
    $nextWeekday = strtotime("+$daysUntilNextWeekday days");
    return date('d/m/Y', $nextWeekday);
}
?>
<?php if (isset($requestData)): ?>
    <div>
        <h2>AJAX Request Data</h2>
        <pre><?php print_r($requestData); ?></pre>
    </div>
<?php endif; ?>
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
                        NAME AGORA AND MEETING POINT
                    </th>
                    <th>
                        NEXT DATE
                    </th>
                    <th>
                        TIME
                    </th>
                    <th>
                        SPOTS
                    </th>
                    <th>
                        PICK SPOT
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
                                <div class="row" id="farmersMarketName_<?=$market->idfarmersMarkets?>">
                                    <?php
                                    if ($language == 'gr') {
                                        echo $market->nameGreek;
                                    } else {
                                        echo $market->name;
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <a id="location_<?=$market->idfarmersMarkets?>" href="<?=$market->superMarketMapsLink?>" target="_blank"><?php
                                        if ($language == 'gr') {
                                            echo $market->superMarketLocationGreek;
                                        } else {
                                            echo $market->superMarketLocation;
                                        }
                                        ?></a>
                                </div>
                                <div class="row" id="charityName_<?=$market->idfarmersMarkets?>">
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
                        <td id="weekday_<?=$market->idfarmersMarkets?>">
                            <?= lang("Weekdays." . $market->actionDay) ?> <?=getNextWeekdayDate($market->actionDay)?>
                        </td>
                        <td id="time_<?=$market->idfarmersMarkets?>">
                            <?= lang("Text.fromText")?> <?= substr($market->timeStart, 0, 5) ?><?= lang("Text.untilText")?> <?= substr($market->timeEnd, 0, 5) ?>
                        </td>
                        <td>
                            <?=$market->spotsTaken?> / <?=$market->spotsTotal?>
                        </td>
                        <td>
                            <?php if (in_array($market->idfarmersMarkets, $mySpotsIds)): ?>
                                <button type="button" class="btn textbutton" onclick="cancelSpotAtMarket(<?=$userID?>,<?=$market->idfarmersMarkets?>, '<?=getNextWeekdayDate($market->actionDay)?>')">
                                    CANCEL SPOT
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn textbutton" onclick="pickSpotAtMarket(<?=$userID?>,<?=$market->idfarmersMarkets?>, '<?=getNextWeekdayDate($market->actionDay)?>' , <?=$market->spotsTaken?> , <?=$market->spotsTotal?>)">
                                    PICK SPOT
                                </button>
                            <?php endif; ?>
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



<div class="popup" id="popupCalendar">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container" id="defaultpopupthings1" style="width:fit-content">

            </div>
        </div>
    </div>
</div>