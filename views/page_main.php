<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Napló Bt.</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    </head>
    <body>
        <header>
            <div id="user">Bejelentkezett: <em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname']?></em> (<em><?= $_SESSION['username']?></em>)</div>
            <h1 class="header">Napló Bt.</h1>
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <aside>
                <p>A <i>Napló Bt.</i> <b>2000</b> óta népszerű online naplót biztosít iskolák számára.</p>
                <p>A weboldalon a napló megoldásaink minta adatbázisaival tudnak interakcióba lépni</p>
        </aside>
        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>
        <footer>&copy; NJE - GAMF - Informatika Tanszék - Web-Programozás II <?= date("Y") ?></footer>
    </body>
</html>
