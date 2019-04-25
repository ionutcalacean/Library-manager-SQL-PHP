<html>
<head>
<title>Persoane cu carti nerestituite</title>
</head>
<body style="background:url(library1.jpg);">
<h1 align="center">Persoane cu carti nerestituite</h1>
<?php



$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "biblioteca";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);

if(!$conn){
   die("eroare la conctare!");
}

$query = "SELECT DISTINCT p.nume as nume,p.telefon as telefon FROM persoana p JOIN imprumut i ON (p.id_pers=i.id_imp) WHERE datar is NULL";
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
		echo '<p align=center><strong>'.($i).'. NUME: ';
        echo htmlspecialchars(stripslashes($row['nume']));
        echo '</strong><br />Telefon: ';
        echo stripslashes($row['telefon']);
        echo '</p>';
    }
	
} else {
    echo '<p  align=center>';
echo htmlspecialchars("NOT FOUND!");
echo '</p>';
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
