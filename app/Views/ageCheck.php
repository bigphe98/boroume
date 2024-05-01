<div class="container">
    <div class="row justify-content-center" id="WelcomeMessage">
        <h3><?= lang("Text.ageCheck")?></h3>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="btn-group">
            <form action="<?= base_url()?>AuthController/redirectAgeCheck" method="post">
                <input type="hidden" name="isAdult" id="isAdultInput" value="0">
                <button class="textbutton" id="adultButton" style="color:white; cursor: pointer; margin: 50px;"><?= lang("Text.ageCheckYes")?></button>
                <button class="textbutton" id="childButton" style="color:white; cursor:pointer; margin: 50px;"><?= lang("Text.ageCheckNo")?></button>
            </form>
        </div>
    </div>
</div>