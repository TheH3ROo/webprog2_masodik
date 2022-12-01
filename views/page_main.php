<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hatoslottó Zrt.</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    </head>
    <body>
        <header>
            <div id="user">Bejelentkezett: <em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname']?></em> (<em><?= $_SESSION['username']?></em>)</div>
            <h1 class="header">Hatoslottó Zrt.</h1>
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <aside>
                <p>A <i>hatoslottó</i> <b>1988</b> óta népszerű szerencsejáték hazánkban.</p>
                <p>A weboldalon a számhúzások és az azokhoz kapcsolódó nyeremények ismert adatai találhatók meg.</p>
        </aside>
        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>
        <footer>&copy; NJE - GAMF - Informatika Tanszék - Web-Programozás II <?= date("Y") ?></footer>
    </body>
</html>
