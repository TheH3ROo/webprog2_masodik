 <?php
class Regisztral_Model
{
	public function register_user($vars)
	{
		if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['vezeteknev']) && isset($_POST['utonev'])) {
			try {
				// Kapcsolódás
				$dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
								array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
				$dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
				
				// Létezik már a felhasználói név?
				$sqlSelect = "select id from felhasznalok where bejelentkezes = :login";
				$sth = $dbh->prepare($sqlSelect);
				$sth->execute(array(':login' => $_POST['login']));
				if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$ujra = "true";
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "A felhasználói név már foglalt!";
				}
				else {
					// Ha nem létezik, akkor regisztráljuk
					$sqlInsert = "insert into felhasznalok(csaladi_nev, utonev, bejelentkezes, jelszo)
								values(:csaladinev, :keresztnev, :felhasznalonev, :pass)";
					$stmt = $dbh->prepare($sqlInsert);
					$stmt->execute(array(':csaladinev' => $_POST['vezeteknev'], ':keresztnev' => $_POST['utonev'],
										':felhasznalonev' => $_POST['login'], ':pass' => sha1($_POST['password'])));
					if($count = $stmt->rowCount()) {
						$newid = $dbh->lastInsertId();  
						$retData['eredmeny'] = "OK";
						$retData['uzenet'] = "A regisztrációja sikeres.<br>Azonosítója: {$newid}";
						$ujra = false;
					}
					else {
						$retData['eredmeny'] = "ERROR";
						$retData['uzenet'] = "A regisztráció nem sikerült.";
						$ujra = true;
					}
				}
			}
			catch (PDOException $e) {
				$retData['eredmeny'] = "ERROR";
				$retData['uzenet'] = "Hiba: ".$e->getMessage();
				$ujra = true;
			}      
		}
		else {
			header("Location: .");
		}
		return $retData;
	}
}
?>