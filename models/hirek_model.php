<?php
class Hirek_Model
{
	public function add_news($vars)
	{
		try {
			$dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
							array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			$dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
			
			$sqlInsert = "INSERT INTO hirek(cim, szoveg, nev) values(:cim, :szoveg, :nev)";
			$stmt = $dbh->prepare($sqlInsert);
			$succ = $stmt->execute(array(':cim' => $_POST['cim'], ':szoveg' => $_POST['szoveg'], ':nev' => $_SESSION['username']));
			$retData['eredmeny'] = "OK";
			$retData['uzenet'] = "A hír rögzítése sikeres.";
		}
		catch (PDOException $e) {
			$retData['eredmeny'] = "ERROR";
			$retData['uzenet'] = "Hiba: ".$e->getMessage();
			$ujra = true;
		}
		return $retData;
	}
}
?>