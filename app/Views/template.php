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
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>/public/favicon.ico"/>


    <?php if (isset($scripts_to_load)) foreach ($scripts_to_load as $script): ?>
    <script src="<?= base_url()?>/public/js/<?=$script?>" defer></script>
    <?php endforeach; ?>
</head>

<body>
<header>
    <div id="logo">
        <h1>Boroume</h1>
        <h2>demo site</h2>
    </div>
    <nav>
        <?php if (isset($menu_items)) : ?>
        <ul>
        <?php foreach ($menu_items as $menu): ?>
        <li><a href="<?=$menu['link']?>" title="<?=$menu['title']?>" class = "<?=$menu['classname']?>"><?=$menu['name']?></a></li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </nav>
</header>
<main>
    <section>
        <h2><?= $content_title_1?></h2>
        <h3><?= $content_title_2?></h3>
        <p>
            <?= $content?>

        </p>

    </section>
    <aside>
        <article>
            <p>Official Website <a href="https://www.boroume.gr/">Boroume</a>
        </article>
    </aside>
</main>
<footer>
    <p>Copyright &copy; 2024 Thesis. KUL&nbsp;All Rights Reserved.&nbsp;&nbsp;
        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </p>
</footer>
</body>
</html>

