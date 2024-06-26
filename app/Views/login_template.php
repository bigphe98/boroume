

<!DOCTYPE html>
<html>
<head>
    <title><?= $title?></title>
    <meta charset="UTF-8" />
    <meta name="keywords" content="boroume demo site" />
    <meta name="description"
          content="This a demo site for Boroume" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>/public/css/boroume.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/layoutit/src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>/public/favicon.ico"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="<?= base_url()?>/public/js/codeOfConduct.js"></script>
    <script src="<?= base_url()?>/public/js/general.js"></script>
    <script src="<?= base_url()?>/public/js/signUpPage.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/jquery.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/scripts.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<header>
    <div class="container-fluid">
        <div class="row" id="navbar" >
            <div class="col-md-1" id="logo-div" >
                <img id="logo-icon" src="<?=base_url()?>/public/icons/png-boroume_logo_gr.png" alt="website logo">
            </div>

            <div class="col-md-9"></div>
            <div class="col-md-2" id="langs_login" >
                <div class="langs">
                    <a class="dropdown-item<?= session('lang') === 'en' ? ' active' : '' ?>" id="en" href="<?= site_url('AuthController/login/lang/en'); ?>">English</a>
                    <a class="dropdown-item<?= session('lang') === 'gr' ? ' active' : '' ?>" id="gr" href="<?= site_url('AuthController/login/lang/gr'); ?>">Ελληνικά</a>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="col-md-12 " id="templateMain" style="margin-top: 15px" >
        <?=$content?>
    </div>
</main>
<footer>
    <p>Copyright &copy; 2024 Thesis. KUL&nbsp;All Rights Reserved.&nbsp;&nbsp;
        <a href="#"><?= lang("Text.PrivacyPolicyText")?></a> | <a href="#"><?= lang("Text.TermsOfUseText")?></a> | <?= lang("Text.OfficialWebsiteText")?> <a href="https://www.boroume.gr/"><?= lang("Text.BoroumeText")?> </a>
    </p>
</footer>

<script>
    let alertPopup = document.getElementById("alertpopup");
    if (alertPopup) {
        setTimeout(function(){ alertPopup.style.display = "none"; }, 10000);
    }

    let alertPopup2 = document.getElementById("alertpopup3");
    if (alertPopup2) {
        setTimeout(function(){ alertPopup2.style.display = "none"; }, 10000);
    }
</script>


</body>
</html>
