

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row card-footer">
                    <div class="col-md-2">
            <span class="material-symbols-outlined" style="width: 150px">
                food_bank
                </span>
                    </div>
                    <div class="col-md-8">
                        <p>
                            Add information about past activities.
                        </p>

                    </div>
                    <div class="col-md-2">

                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="window.location.href='<?= base_url()?>BoroumeController/addActivityData'">
                            Go
                        </button>
                    </div>
                </div>
                <div class="row card-footer">
                    <div class="col-md-2">
            <span class="material-symbols-outlined">
                perm_data_setting
                </span>
                    </div>
                    <div class="col-md-8">
                        <p>
                            Change measurement sizes of the specific food items or add new food types.
                        </p>
                    </div>
                    <div class="col-md-2">

                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="window.location.href='<?= base_url()?>BoroumeController/changeMeasuringInfo'">
                            Go
                        </button>

                    </div>
                </div>
                <div class="row card-footer">
                    <div class="col-md-2">
            <span class="material-symbols-outlined">
                manage_history
            </span>
                    </div>
                    <div class="col-md-8">
                        <p>
                            Check and manage history of previous activities.
                        </p>
                    </div>
                    <div class="col-md-2">

                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">
                            Go
                        </button>
                    </div>
                </div>

        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>