
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-4">
            <div class="jumbotron">
                <h2>
                    Sign up for adults
                </h2>
                <p>
                    If you are an adult, please use this button to create an account.
                </p>
                <p>
                <form action="<?= base_url()?>AuthController/redirectAgeCheck" method="post">
                    <input type="hidden" name="isAdult" id="isAdultInput" value="0">
                    <button class="textbutton" id="adultButton" style="color:white; cursor: pointer; margin: 50px;"><span class="material-symbols-outlined">
keyboard_tab
</span></button>
                </form>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron">
                <h2>
                    Sign up for children
                </h2>
                <p>
                    If you are still a child, please use this button and create an account with the help of a parent/guardian.
                </p>
                <p>
                <form action="<?= base_url()?>AuthController/redirectAgeCheck" method="post">
                    <input type="hidden" name="isAdult" id="isAdultInput" value="0">
                    <button class="textbutton" id="childButton" style="color:white; cursor:pointer; margin: 50px;"><span class="material-symbols-outlined">
keyboard_tab
</span></button>
                </form>
                </p>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>