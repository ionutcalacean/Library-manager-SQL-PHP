<html>
<head>
<title>Afisare carti cu numar de pagini par</title>
</head>
<body style="background:url(library1.jpg);">
<h1 align="center">Afisare carti cu numar de pagini par</h1>
<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "biblioteca";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);

if(!$conn){
   die("eroare la conctare!");
}

$query="CALL `NrPaginiPar`()";

/*$query = "SELECT titlu,gen,nr_pagini
FROM Carte
WHERE MOD(nr_pagini,2)=0
ORDER BY nr_pagini,gen";*/
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
		echo '<p align=center><strong>'.($i).'. TITLUL: ';
        echo htmlspecialchars(stripslashes($row['titlu']));
        echo '</strong><br />GEN: ';
        echo stripslashes($row['gen']);
        echo '<br />NR. PAGINI:';
        echo stripslashes($row['nr_pagini']);
        echo '</p>';
    }
	echo '<p align=center>';
echo htmlspecialchars("Ordonarea a fost facuta dupa numarul de pagini si dupa gen.");
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
