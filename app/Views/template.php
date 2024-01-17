<!DOCTYPE html>
<html>
<head>
    <title><?= $title?></title>
    <meta charset="UTF-8" />
    <meta name="keywords" content="UXWD course demo" />
    <meta name="description"
          content="This a demo for the UXWD course. But still... the question is... who will cook tonight?" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/main.css" rel="stylesheet" type="text/css"/>


    <?php if (isset($scripts_to_load)) foreach ($scripts_to_load as $script): ?>
    <script src="<?= base_url()?>/public/js/<?=$script?>" defer></script>
    <?php endforeach; ?>
</head>

<body>
<header>
    <div id="logo">
        <h1>PotLuck</h1>
        <h2>UXWD demo site</h2>
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
            <h3>Latest PotLuck...</h3>
            <ul>

        </article>
        <article>
            <h3>Feedback</h3>
            <p>This concept is awesome! Also the site looks nice and stylish <em>(Jeroen)</em></p>
            <p>Is there also a mobile app for this site? <em>(Patrick)</em></p>
            <p>Student cooking with <a href="https://dagelijksekost.een.be/">Dagelijkse Kost</a>
        </article>
    </aside>
</main>
<footer>
    <p>Copyright &copy; 2020 UXWD. KUL&nbsp;All Rights Reserved.&nbsp;&nbsp;
        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </p>
</footer>
</body>
</html>

