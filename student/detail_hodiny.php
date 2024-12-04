<?php
include_once "../include/db_connect.php";
$id_student = $_SESSION['prihlaseni_ID_student'];
$skolni_rok = aktualniSkolniRok();
$id = $_GET['id'];

$sql = "SELECT Predmet.nazev, Hodina.den, Hodina.od, hodina.do, ucitel.jmeno, ucitel.prijmeni from predmet
JOIN Hodina ON Predmet.ID_predmet = hodina.ID_predmet
JOIN Ucitel ON hodina.ID_ucitel = ucitel.ID_ucitel
WHERE hodina.ID_hodina = '$id'";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/hodnoceni.cs">
  </head>
  <body>

<?php
foreach ($zaznamy as $zaznam) {
echo "<br><b>" . "Název předmětu: " . "</b>" . $zaznam['nazev'] . "</br>";
echo "<br><b>" . "Den: " . "</b>" . $zaznam['den'] . "</br>";
echo "<br><b>" . "Od: " . "</b>" . $zaznam['od'] . "</br>";
echo "<br><b>" . "Do: " . "</b>" . $zaznam['do'] . "</br>";
echo "<br><b>" . "Vyučující: " . "</b>" . $zaznam['jmeno'] . " " .$zaznam['prijmeni'] . "</br>";
 }
?>
  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>