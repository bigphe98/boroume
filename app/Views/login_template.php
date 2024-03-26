

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/jquery.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/scripts.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <?php if (isset($scripts_to_load)) foreach ($scripts_to_load as $script): ?>
        <script src="<?= base_url()?>/public/js/<?=$script?>" defer></script>
    <?php endforeach; ?>
</head>
<body>
<header>
    <div class="container-fluid">
        <div id="navbar" class="row">
            <div id="logo-div" class="col-md-1">
                <div id="logo-top">
                    <div id="logo-wrapper">
                        <img id="logo-icon" style="margin-top: 20px;" src="<?=base_url()?>/public/icons/png-boroume_logo_gr.png" alt="website logo">
                    </div>
                </div>

            </div>

            <div class="col-md-9"></div>
            <div id="langs_login" class="col-md-2">
                <div class="langs">
                    <a class="dropdown-item<?= session('lang') === 'en' ? ' active' : '' ?>" href="<?= site_url('AuthController/login/lang/en'); ?>">English</a>
                    <a class="dropdown-item<?= session('lang') === 'gr' ? ' active' : '' ?>" href="<?= site_url('AuthController/login/lang/gr'); ?>">Ελληνικά</a>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="col-md-12 " id="templateMain" style="margin-top: 30px" >
        <?=$content?>
    </div>
</main>

<script>
    let alertPopup = document.getElementById("alertpopup");
    if (alertPopup) {
        setTimeout(function(){ alertPopup.style.display = "none"; }, 3000);
    }

    let alertPopup2 = document.getElementById("alertpopup2");
    if (alertPopup2) {
        setTimeout(function(){ alertPopup2.style.display = "none"; }, 3000);
    }
</script>


</body>
</html>
