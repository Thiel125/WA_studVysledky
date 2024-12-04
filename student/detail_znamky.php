<?php
include_once "../include/db_connect.php";
$id_student = $_SESSION['prihlaseni_ID_student'];
$skolni_rok = aktualniSkolniRok();
$id = $_GET['id'];

$sql = "SELECT znamka.ID_znamka, znamka.hodnoceni, znamka.popis, znamka.poznamka, predmet.nazev from znamka
JOIN predmet ON znamka.ID_predmet = predmet.ID_predmet
WHERE znamka.ID_znamka = '$id'";
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
foreach ($zaznamy as $znamka) {
echo "<br><b>" . "Hodnocení: " . "</b>" .(($znamka["hodnoceni"] == "0.0") ? "N" : ((intval($znamka["hodnoceni"]) == $znamka["hodnoceni"]) ? 
(($znamka["hodnoceni"][-2] == ".") ? $znamka["hodnoceni"][0] : $znamka["hodnoceni"]) : 
substr($znamka["hodnoceni"], 0, -2) . "-"))
. "</br>";
echo "<br><b>" . "Popis: " . "</b>" . $znamka['popis'] . "</br>";
echo "<br><b>" . "Poznámka učitele: " . "</b>" . $znamka['poznamka'] . "</br>";
echo "<br><b>" . "Předmět: " . "</b>" . $znamka['nazev'] . "</br>";

 }
?>
  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>