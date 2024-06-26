<?php
/**
 * @var $non_saved_past_activities string
 */

?>

<div class="container-fluid">
    <div class="row scrollable-container" style="margin-top: 15vh; height: 35vh">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        Action Date
                    </th>
                    <th>
                        Location
                    </th>
                    <th>
                        Add Information
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($non_saved_past_activities as $past_activity): ?>
                    <tr id="spotSelectedRow">
                        <td id="actionDate">
                            <p id="ActionDateP" style="display: block"><?= $past_activity->actionDate; ?></p>

                        </td>
                        <td id="farmersMarket">

                            <p id="farmersMarketP" style="display: block"><?=$past_activity->nameGreek; ?></p>

                        </td>
                        <td id="buttonAdd">
                            <button id="buttonAdd" style="display: block" onclick="addInfo('<?= $past_activity->actionDate ?>', '<?= $past_activity->nameGreek ?>')">
                                ADD INFORMATION
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

