<html>
<head>
<title>Id-ul cartiloc cu mai multi autori</title>
</head>
<body style="background:url(library1.jpg);">
<h1 align="center">Id-ul cartilor cu mai multi autori</h1>
<?php



$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "biblioteca";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);

if(!$conn){
   die("eroare la conctare!");
}

$query = "SELECT DISTINCT id_carte
FROM autor a
WHERE EXISTS
(SELECT *
FROM autor b
WHERE a.id_aut!=b.id_aut AND a.id_carte=b.id_carte)";
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
		echo '<p align=center><strong>'.($i).'. Id Carte: ';
        echo htmlspecialchars(stripslashes($row['id_carte']));
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
