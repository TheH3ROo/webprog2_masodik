<form action="<?= SITE_ROOT ?>beleptet" method="post">
<h2>Belépés</h2>
    <label for="login">Felhasználó:</label><input type="text" name="login" id="login" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br>
    <label for="password">Jelszó:</label><input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br>
    <input type="submit" value="Küldés">
</form>
<form action ="<?= SITE_ROOT ?>beleptet" method = "post">
    <h2>Regisztráció</h2>
    <label for="vezeteknev">Vezetéknév:</label><input type="text" name="vezeteknev" id="vezeteknev" required><br>
    <label for="utonev">Utónév:</label><input type="text" name="utonev" id="utonev" required><br>
    <label for="login">Felhasználó:</label><input type="text" name="login" id="login" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br>
    <label for="password">Jelszó:</label><input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br>
    <input type="submit" name="regisztracio" value="Regisztráció">
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>
