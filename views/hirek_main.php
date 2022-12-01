<form action ="<?= SITE_ROOT ?>hirek" method = "post">
<head>
    <style>
        .tabla {
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color: #588c7e;
            color: white;
        }
    tr:nth-child(even) {background-color: #f2f2f2}
    </style>
</head>
<table class="tabla">
    <tr>
        <th>ID</th>
        <th>Cím</th>
        <th>Szöveg</th>
        <th>Felhasználó</th>
        <th>Dátum</th>
    </tr>
    <?php
    $connection = Database::getConnection();
    $sql = "select id, cim, szoveg, nev, datum from hirek order by datum desc";
    $result = $connection->query($sql);

    if($result -> rowCount() > 0){
        while($row = $result -> fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>". $row["id"] ."</td><td>". $row["cim"] ."</td><td>". $row["szoveg"] ."</td><td>". $row["nev"] ."</td><td>". $row["datum"] ."</td></tr>";
        }
        echo "</table>";
    }
    ?>
</table>

<h2>Hír hozzáadása</h2>
<table>
    <tr>
        <td>Cím</td>
        <td><input name="cim" type="text" id="cim" required></td>
    </tr>
    <tr>
        <td>Szöveg</td>
        <td><textarea name="szoveg" id="szoveg" required></textarea></td>
    </tr>
    <tr>
    <tr>
        <td colspan="2">
            <div align="center">
                <input name="hiddenField" type="hidden" value="add_n">
                <input type="submit" value="Küldés">
            </div>
        </td>
</table>
</form>