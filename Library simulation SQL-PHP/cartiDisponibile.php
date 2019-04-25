<html>
<head>
<title>Carti</title>
</head>
<body style="background:url(library2.jpg);">
<h1 align="center">Carti disponibile in biblioteca</h1>
<?php



$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "biblioteca";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);

if(!$conn){
   die("eroare la conctare!");
}

$query = "
CALL `gasesteCarti`() ";
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
		echo '<p align=center><strong>'.($i).'. TITLU: ';
        echo htmlspecialchars(stripslashes($row['titlu']));
		echo '</strong><br />ID CARTE: ';
        echo stripslashes($row['id_carte']);
		echo '</strong><br />NR. PAGINI: ';
        echo stripslashes($row['nr_pagini']);
		echo '</strong><br />NR. EXEMPLARE: ';
        echo stripslashes($row['nr_exemplare']);
		echo '</strong><br />GEN: ';
        echo stripslashes($row['gen']);
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
