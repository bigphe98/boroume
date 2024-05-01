<!DOCTYPE html>
<html>
<head>
    <title><?= $title?></title>
    <meta charset="UTF-8" />
    <meta name="keywords" content="boroume demo site" />
    <meta name="description"
          content="This a demo site for Boroume" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>/public/css/boroume.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>/public/layoutit/src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>/public/favicon.ico"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/jquery.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/public/layoutit/src/js/scripts.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="<?= base_url()?>/public/js/peopleManagement.js"></script>
    <script src="<?= base_url()?>/public/js/general.js"></script>
    <?php if (isset($scripts_to_load)) foreach ($scripts_to_load as $script): ?>
    <script src="<?= base_url()?>/public/js/<?=$script?>" defer></script>
    <?php endforeach; ?>
</head>

<body>
    <header>
        <div class="container-fluid">
            <div id="navbar" class="row">
                <div id="logo-div" class="col-md-1">
                    <div id="logo">
                        <img id="logo-icon" src="<?=base_url()?>/public/icons/png-boroume_logo_gr.png" alt="website logo">
                    </div>
                </div>
                <div class="col-md-9">
                    <nav id="navigations">
                        <?php if (isset($menu_items)) : ?>
                            <ul style="font-size: 16pt; margin: 0;">
                                <?php foreach ($menu_items as $menu): ?>
                                    <li style="width: 300px; margin-right: 15px;"><a href="<?=$menu['link']?>" title="<?=$menu['title']?>" class = "<?=$menu['classname']?>"><?=$menu['name']?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </nav>
                </div>
                <div class="col-md-2 subMenuIcon">
                    <div onclick="openSideMenu()">
                        <span class="material-symbols-outlined">account_circle</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="subMenuWrap" id="subMenuWrap" style="">
            <div class="sub-menu">
                <div class="user-info">
                    <h2><?php
                        if (isset($_COOKIE['LoggedUser'])){
                            //echo $_COOKIE['LoggedUser'];
                            $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
                            $expertID = $loggedUser['user']['peopleId'];
                            //echo $expertID;
                            $expertName = $loggedUser['user']['peopleFirstName'];
                            echo $expertName;
                            echo"\n";
                            $expertLastName = $loggedUser['user']['peopleLastName'];
                            echo $expertLastName;
                            //echo"\n";
                            $email = $loggedUser['user']['peopleEmailAddress'];
                            //echo $email;
                            //echo"\n";
                        }
                        ?></h2>
                </div>
                <hr>

                <div class="langs">
                    <a class="dropdown-item<?= session('lang') === 'en' ? ' active' : '' ?>" href="<?= site_url('BoroumeController/home/lang/en'); ?>">English</a>
                    <a class="dropdown-item<?= session('lang') === 'gr' ? ' active' : '' ?>" href="<?= site_url('BoroumeController/home/lang/gr'); ?>">Ελληνικά</a>
                </div>
                <a href="#" class="sub-menu-link" onclick="location.href = '<?=base_url()?>BoroumeController/edit_profile';">

                    <p id="editlink" style="font-family: 'Viga', sans-serif">EDIT PROFILE</p>
                </a>
                <a href="#" class="sub-menu-link" onclick="location.href = '<?=base_url()?>AuthController/logout';">
                    <p id="logoutlink" style="font-family: 'Viga', sans-serif">LOG OUT</p>
                </a>
            </div>
    </header>
<main>
    <section>
        <h2><?= $content_title_1?></h2>
        <h3><?= $content_title_2?></h3>
        <p>
            <?= $content?>

        </p>

    </section>
</main>
<footer>
    <p>Copyright &copy; 2024 Thesis. KUL&nbsp;All Rights Reserved.&nbsp;&nbsp;
        <a href="#"><?= lang("Text.PrivacyPolicyText")?></a> | <a href="#"><?= lang("Text.TermsOfUseText")?></a> | <?= lang("Text.OfficialWebsiteText")?> <a href="https://www.boroume.gr/"><?= lang("Text.BoroumeText")?> </a>
    </p>
</footer>
</body>
</html>

