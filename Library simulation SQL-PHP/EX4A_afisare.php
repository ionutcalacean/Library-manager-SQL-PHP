<html>
<head>
<title>Perechi de carti dupa gen</title>
</head>
<body style="background:url(library1.jpg);">
<h1 align="center">Perechi de carti dupa gen</h1>
<?php

$gen=$_POST['gen'];


if (!$gen)
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

$query = "SELECT CONCAT(c.titlu,',',d.titlu ) as titluri
FROM autor a JOIN autor b ON a.id_aut=b.id_aut JOIN 
carte c ON b.id_carte=c.id_carte JOIN 
carte d ON a.id_carte=d.id_carte 
WHERE a.id_carte!=b.id_carte AND c.id_carte<d.id_carte AND c.gen='$gen' AND d.gen='$gen' ";
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
		echo '<p align=center><strong>'.($i).' Pereche gasita: ';
        echo htmlspecialchars(stripslashes($row['titluri']));
        
        
        echo '</p>';
    }
	echo '<p align=center>';
    echo htmlspecialchars("O pereche este unica in rezultat!");
    echo '</p>';
} else {
    echo '<p  align=center>';
echo htmlspecialchars("NOT FOUND!");
echo '</p>';
}

echo '<form action="EX4A.html" method=post>';
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
