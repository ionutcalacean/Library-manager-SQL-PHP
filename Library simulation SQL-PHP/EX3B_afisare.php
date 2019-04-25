<html>
<head>
<title>Aflare carti restituite intarziat</title>
</head>
<body style="background:url(library2.jpg); " >
<h1 align="center">Carti restituite intarziat</h1>
<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "biblioteca";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);

if(!$conn){
   die("eroare la conctare!");
}

$query= "CALL `RestituireIntarziata`()";

/*$query = "SELECT id_carte,id_imp, DATEDIFF(datar,datai)-nr_zile as 'Numar zile intarziere'
FROM imprumut
WHERE (datar-datai)>nr_zile 
ORDER BY 'Numar zile intarziere' DESC";*/
$result = $conn->query($query);
// verifică dacă rezultatul este în regulă
if(!$result)
{
	die("eroare la query! nu returneaza nimic!");
}

// se obţine numărul tuplelor returnate
$num_results = mysqli_num_rows($result);


if ($result->num_rows > 0) {
    // output data of each row
	$i=0;
    while($row = $result->fetch_assoc()) {
	$i++;;
		echo '<p align=center><strong>'.($i).'. ID_CARTE: ';
        echo htmlspecialchars(stripslashes($row['id_carte']));
        echo '</strong><br />ID_IMPRUMUTANT: ';
        echo stripslashes($row['id_imp']);
        echo '<br />NR. ZILE INTARZIERE: ';
        echo stripslashes($row['Numar zile intarziere']);
        echo '</p>';
    }
	echo '<p align=center>';
echo htmlspecialchars("Ordonarea a fost facuta dupa numarul de zile intarziere, descrescator.");
echo '</p>';
} else {
    echo "0 results";
}

echo '<form action="biblioteca.html" method=post>';
echo '<div style=" width:25%; margin: auto" align="center">';
echo '<table border=1>
<tr align="center">
<td colspan="2" align="center"><input type=submit value="Inapoi"></td>
</tr>
</table>
</div>
</form>';
// deconectarea de la BD
$conn->close();
?>
</body>
