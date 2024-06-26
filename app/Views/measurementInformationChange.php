<?php
/**
 * @var $food_data string
 */
?>

<div class="container-fluid">
    <form action="<?= base_url()?>BoroumeController/changeMeasuringInfo" method="POST" autocomplete="off">

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label for="foodName" style="width: 100px;"> Food name : </label>
            <input type="text" id="foodName" name="foodName" placeholder="enter food name in capitals">
        </div>
        <div class="col-md-2">
            <label for="boxWeight" style="width: 100px;"> kilos per box : </label>
            <input type="text" id="boxWeight" name="boxWeight" placeholder="enter kilos per box">

        </div>
        <div class="col-md-2">
            <label for="bagWeight" style="width: 100px;"> kilos per bag : </label>
            <input type="text" id="bagWeight" name="bagWeight" placeholder="enter kilos per bag">
        </div>
        <div class="col-md-2" style="margin-top: 2vh">
            <button type="submit" class="btn btn-success btn-block">
                ADD FOOD
            </button>
        </div>
            <div class="col-md-2">
            </div>
    </div>

    </form>
    <div class="row scrollable-container" style="margin-top: 15vh; height: 35vh">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        Food Name
                    </th>
                    <th>
                        kilos per box
                    </th>
                    <th>
                        kilos per bag
                    </th>
                    <th>
                        change info
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($food_data as $data): ?>
                    <tr id="spotSelectedRow">
                        <td id="foodName_<?= $data->idFoodMeasurements ?>">
                            <p id="pFoodName_<?= $data->idFoodMeasurements ?>" style="display: block"><?= $data->foodName; ?></p>

                            <input id="inputFoodName_<?= $data->idFoodMeasurements ?>" style="display: none" value="<?= $data->foodName ?>">
                        </td>
                        <td id="kgBox_<?= $data->idFoodMeasurements ?>">

                            <p id="pkgBox_<?= $data->idFoodMeasurements ?>" style="display: block"><?=$data->kgPerKafasi; ?></p>

                            <input id="inputkgBox_<?= $data->idFoodMeasurements ?>" style="display: none" value="<?=$data->kgPerKafasi; ?>">
                        </td>
                        <td id="kgBag_<?= $data->idFoodMeasurements ?>">
                            <p id="pkgBag_<?= $data->idFoodMeasurements ?>" style="display: block"><?=$data->kgPerSakoula; ?></p>

                            <input id="inputkgBag_<?= $data->idFoodMeasurements ?>" style="display: none" value="<?=$data->kgPerSakoula; ?>">

                        </td>
                        <td id="foodButton_<?= $data->idFoodMeasurements ?>">
                            <button id="changeButton_<?= $data->idFoodMeasurements ?>" style="display: block" onclick="changeInfo('change', <?= $data->idFoodMeasurements ?>)">
                                Change
                            </button>
                            <button id="cancelButton_<?= $data->idFoodMeasurements ?>" style="display: none" onclick="changeInfo('cancel', <?= $data->idFoodMeasurements ?>)">
                                Cancel
                            </button>
                            <button id="confirmButton_<?= $data->idFoodMeasurements ?>" style="display: none" onclick="changeInfo('confirm', <?= $data->idFoodMeasurements ?>)">
                                Confirm
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
