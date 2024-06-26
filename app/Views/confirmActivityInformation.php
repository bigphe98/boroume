<?php
/**
 * @var $actionDate string
 * @var $farmersMarket string
 * @var $peopleWentToMarket string
 * @var $foodInfo string
 */

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <p>Action Date: <?= htmlspecialchars($actionDate, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p>Farmers Market: <?= htmlspecialchars($farmersMarket, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                First name
                            </th>
                            <th>
                                Last name
                            </th>
                            <th>
                                Confirm
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($peopleWentToMarket as $people): ?>
                        <tr>
                            <td id="firstName">
                                <p id="firstNameP" style="display: block"><?= $people->firstName; ?></p>

                            </td>
                            <td id="lastName">

                                <p id="lastNameP" style="display: block"><?=$people->lastName; ?></p>

                            </td>
                            <td id="buttonCheck">
                                this person attended the activity: <input type="checkbox" id="buttonCheck">

                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

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
                                ADD MORE ATTENDEES
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-2">
                    <label for="foodName" style="width: 100px;"> Food name: </label>
                    <select id="foodName" name="foodName">
                        <option value="" disabled selected>Select food item</option>
                        <?php foreach ($foodInfo as $food): ?>
                            <option value="<?= $food->foodName; ?>">
                                <?= $food->foodName; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col-md-2">
                    <label for="boxWeight" style="width: 100px;"> amount of boxes : </label>
                    <input type="number" id="boxWeight" name="boxWeight" value="0">

                </div>
                <div class="col-md-2">
                    <label for="bagWeight" style="width: 100px;"> amount of bags : </label>
                    <input type="number" id="bagWeight" name="bagWeight" value="0">
                </div>
                <div class="col-md-2" style="margin-top: 2vh">
                    <button type="submit" class="btn btn-success btn-block" onclick="addFoodToList()">
                        ADD FOOD
                    </button>
                </div>
                <div class="col-md-2">
                </div>

    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                Food Name
                            </th>
                            <th>
                                Amount of Bags
                            </th>
                            <th>
                                Amount of Boxes
                            </th>
                            <th>
                                Manage
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<div class="row" style="margin-top: 5vh;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" onclick="displayPopUpCalendar(1)">
                    CONFIRM
                </button>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>