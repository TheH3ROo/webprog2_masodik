<?php
$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=masodik', 'root', '',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM diak";
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>Név</th><th>Osztály</th><th>Nem</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;
		case "POST":
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "insert into diak values (0, :nev, :osztaly, :nem)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":nev"=>$data["nev"], ":osztaly"=>$data["osztaly"], ":nem"=>$data["nem"]));				
				$newid = $dbh->lastInsertId();
				$eredmeny .= $count." beszúrt sor: ".$newid;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['nev'] != "") {$modositando .= ", nev = :nev"; $params[":nev"] = $data["nev"];}
				if($data['osztaly'] != "") {$modositando .= ", osztaly = :osztaly"; $params[":osztaly"] = $data["osztaly"];}
				if($data['nem'] != "") {$modositando .= ", fiu = :nem"; $params[":nem"] = $data["nem"];}
				$sql = "update diak set ".$modositando." where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from diak where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;
?>