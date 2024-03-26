<div class="container">
    <div class="row justify-content-center">
        <h1><?= lang("Text.welcome_message")?></h1>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="btn-group">
            <form action="<?= base_url()?>AuthController/redirect" method="post">
                <input type="submit" class="textbutton" id="loginStudentButton" name="destination" value="<?= lang("Text.SignIn")?>" style="color:white; cursor: pointer;">
                <input type="submit" class="textbutton" id="loginExpertButton" name="destination" value="<?= lang("Text.SignUp")?>" style="color:white; cursor:pointer;">
            </form>
        </div>
    </div>
</div>