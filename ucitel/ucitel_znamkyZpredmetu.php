<?php
include_once "../include/db_connect.php";
$id_ucitel = $_SESSION['prihlaseni_ID_ucitel'];
$popis = $_GET['popis'];

$IDpredmet = $_SESSION['ID_predmet'];
$IDtrida = $_SESSION['ID_trida'];

$sql = "SELECT znamka.ID_znamka, student.jmeno, student.prijmeni, znamka.hodnoceni, znamka.poznamka from student
JOIN znamka ON student.ID_student = znamka.ID_student
WHERE znamka.popis = '$popis' AND znamka.ID_trida = '$IDtrida' AND znamka.ID_predmet = '$IDpredmet'";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/hodnoceni.cs">
    <script src="../include/ucitel_absenceZnamky.js"></script>
  </head>
  <body>
  <table class="table table-hover">
  <thead>
    <tr>
      <th>Jméno</th>
      <th>Příjmení</th>
      <th>Poznámka</th>
      <th>Známka</th>
    </tr>
  </thead>
  <tbody>
  <?php
      foreach ($zaznamy as $znamka) {
        echo "<tr>";
        echo "<td>" . $znamka["jmeno"] . "</td>";
        echo "<td>" . $znamka["prijmeni"] . "</td>";
        echo "<td>" . $znamka["poznamka"] . "</td>";
        echo "<td>" .(($znamka["hodnoceni"] == "0.0") ? "N" : ((intval($znamka["hodnoceni"]) == $znamka["hodnoceni"]) ? 
        (($znamka["hodnoceni"][-2] == ".") ? $znamka["hodnoceni"][0] : $znamka["hodnoceni"]) : 
        substr($znamka["hodnoceni"], 0, -2) . "-")) . "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>