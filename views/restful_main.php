<?php
$url = "http://localhost/webprog2_masodik/rest/szerver.php";
$result = "";
if(isset($_POST['id']))
{
  // Felesleges szóközök eldobása
  $_POST['id'] = trim($_POST['id']);
  $_POST['nev'] = trim($_POST['nev']);
  $_POST['osztaly'] = trim($_POST['osztaly']);
  $_POST['nem'] = trim($_POST['nem']);
  
  // Ha nincs id és megadtak minden adatot (családi név, utónév, bejelentkezési név, jelszó), akkor beszúrás
  if($_POST['id'] == "" && $_POST['nev'] != "" && $_POST['osztaly'] != "" && $_POST['nem'] != "")
  {
      $data = Array("nev" => $_POST["nev"], "osztaly" => $_POST["osztaly"], "nem" => $_POST["nem"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha nincs id de nem adtak meg minden adatot
  elseif($_POST['id'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  // Ha van id, amely >= 1, és megadták legalább az egyik adatot (családi név, utónév, bejelentkezési név, jelszó), akkor módosítás
  elseif($_POST['id'] >= 1 && ($_POST['nev'] != "" || $_POST['osztaly'] != "" || $_POST['nem'] != ""))
  {
      $data = Array("id" => $_POST["id"], "nev" => $_POST["nev"], "osztaly" => $_POST["osztaly"], "nem" => $_POST["nem"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, amely >=1, de nem adtak meg legalább az egyik adatot
  elseif($_POST['id'] >= 1)
  {
      $data = Array("id" => $_POST["id"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, de rossz az id, akkor a hiba kiírása
  else
  {
    echo "Hiba: Rossz azonosító (Id): ".$_POST['id']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>REST GYAKORLAT</title>
</head>
<body>
    <?= $result ?>
    <h1>Diákok:</h1>
    <?= $tabla ?>
    <br>
    <h2>Módosítás / Beszúrás</h2>
    <form method="post">
    Id: <input type="text" name="id"><br><br>
    Név: <input type="text" name="nev" maxlength="45"> Osztály: <input type="text" name="osztaly" maxlength="45"><br><br>
    Nem: <input type="text" name="nem" maxlength="12"><br><br>
    <input type="submit" value = "Küldés">
    </form>
</body>
</html>
