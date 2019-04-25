<html>
<head>
<title>Gasire autor dupa titlu</title>
</head>
<body style="background:url(library1.jpg);">
<h1 align="center">Gasire autor dupa titlu</h1>
<?php

$titlu=$_POST['titlu'];


if (!$titlu)
{
echo 'Nu ati introdus criteriul de cautare corect. Va rog sa incercati din nou.';
exit;
}

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "biblioteca";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);

if(!$conn){
   die("eroare la conctare!");
}

$query = "SELECT nume
FROM persoana
WHERE id_pers IN
(SELECT id_aut
FROM carte INNER JOIN autor ON carte.id_carte=autor.id_carte
WHERE titlu='$titlu')
; ";
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
		echo '<p align=center><strong>'.($i).' Nume: ';
        echo htmlspecialchars(stripslashes($row['nume']));
        
        
        echo '</p>';
    }
	echo '<p align=center>';
    echo htmlspecialchars("Acesta este autorul cartii cautate de dumneavoastra!");
    echo '</p>';
} else {
    echo '<p  align=center>';
echo htmlspecialchars("NOT FOUND!");
echo '</p>';
}

echo '<form action="EX5A.html" method=post>';
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
