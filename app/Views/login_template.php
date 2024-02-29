

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>/public/favicon.ico"/>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="<?=base_url()?>/public/layoutit/src/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/public/css/boroume.css" rel="stylesheet" type="text/css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,300;8..144,400;8..144,600;8..144,700;8..144,800&family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/jquery.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/scripts.js"></script>
    <script src="<?=base_url()?>/public/js/general.js"></script>

</head>
<body>
<header>
    <div class="container-fluid">
        <div id="navbar" class="row">
            <div id="logo-div" class="col-md-1">
                <div id="logo-top">
                    <div id="keyboard-wrapper">

                    </div>
                    <div id="logo-text-top-wrapper">
                        <h5 id="logo-text-top">BOROUME</h5>
                    </div>

                </div>

            </div>

            <div class="offset-8"></div>
            <div id = "langs_login" class="col-md-3">
                <div class="langs">
                    <a href="#" class="language" lang="en" style="font-family: 'Nokora', sans-serif">English</a>
                    <a href="#" class="language active" lang="nl" style="font-family: 'Nokora', sans-serif">Ελληνικά</a>
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
