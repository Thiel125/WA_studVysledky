<?php
include_once "../include/db_connect.php";
$id_student = $_SESSION['prihlaseni_ID_student'];

$sql = "SELECT predmet.nazev, COUNT(ID_absence) AS `pocet` from absence
JOIN hodina ON absence.ID_hodina = hodina.ID_hodina
JOIN predmet ON hodina.ID_predmet = predmet.ID_predmet
WHERE absence.ID_student = '$id_student' AND absence.stav LIKE 'omluveno'
GROUP BY predmet.nazev";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT predmet.nazev, COUNT(ID_absence) AS `pocet` from absence
JOIN hodina ON absence.ID_hodina = hodina.ID_hodina
JOIN predmet ON hodina.ID_predmet = predmet.ID_predmet
WHERE absence.ID_student = '$id_student' AND absence.stav LIKE 'neomluveno'
GROUP BY predmet.nazev";
$result2 = mysqli_query($conn, $sql2);
$zaznamy2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/hodnoceni.cs">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-white" href="hlstranka_student.php">Hlavní stránka</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link text-white" href="hodnoceni.php">Hodnocení</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="rozvrh_student.php">Rozvrh hodin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="student_absence.php">Absence</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="../index.php">Odhlásit se</a>
      </li>
    </ul>
  </div>
</nav>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Předmět</th>
      <th>Počet zameškaných hodin</th>
      <th>Počet neomluvených hodin</th>
    </tr>
  </thead>
  <tbody>
  <?php
      foreach ($zaznamy as $index => $zaznam) {
          echo "<tr>";
          echo "<td>" . $zaznam["nazev"] . "</td>";
          echo "<td>" . $zaznam["pocet"] . "</td>";
          echo "<td>" . (isset($zaznamy2[$index]["pocet"]) ? $zaznamy2[$index]["pocet"] : 0) . "</td>";
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