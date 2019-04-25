<html>
<head>
<title>Numarul de pagini mediu pentru fiecare gen</title>
</head>
<body style="background:url(library2.jpg);">
<h1 align="center">Numarul de pagini mediu pentru fiecare gen</h1>
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
SELECT gen,SUM(nr_pagini)/COUNT(gen) as NumarPagini
FROM carte
GROUP BY gen ";
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
		echo '<p align=center><strong>'.($i).'. GEN: ';
        echo htmlspecialchars(stripslashes($row['gen']));
		 echo '</strong><br />Numar Pagini Mediu: ';
        echo stripslashes($row['NumarPagini']);
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
