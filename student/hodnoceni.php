<?php
include_once "../include/db_connect.php";
$id_student = $_SESSION['prihlaseni_ID_student'];
//$skolni_rok = aktualniSkolniRok();


function znamkySkolniRok($conn, $skolni_rok) {
  $id_student = $_SESSION['prihlaseni_ID_student'];

  if(isset($_POST['submit'])){
    $skolni_rok = $_POST['skolni_rok'];
  }
$sql = "SELECT znamka.ID_znamka, student.ID_student, predmet.nazev, znamka.hodnoceni from student
 JOIN Znamka ON student.ID_student = znamka.ID_student 
 JOIN trida ON Znamka.ID_trida = Trida.ID_trida
 JOIN predmet ON znamka.ID_predmet = predmet.ID_predmet
WHERE student.ID_student LIKE '$id_student' AND trida.skolni_rok LIKE '$skolni_rok'";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

return $zaznamy;
 }

$skolni_rok = aktualniSkolniRok(); 
$zaznamy = znamkySkolniRok($conn, $skolni_rok);

$sql2 = "SELECT znamka.ID_student, predmet.nazev, ROUND(AVG(znamka.hodnoceni),2) AS `prumer` from znamka 
 JOIN trida ON Znamka.ID_trida = Trida.ID_trida
 JOIN predmet ON znamka.ID_predmet = predmet.ID_predmet
 WHERE znamka.ID_student = '$id_student' AND trida.skolni_rok LIKE '$skolni_rok' AND znamka.hodnoceni NOT LIKE '0.0'  
 GROUP BY predmet.ID_predmet";
$result2 = mysqli_query($conn, $sql2);
$zaznamy2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/hodnoceni.cs">
    <script src=../include/znamka_okno.js></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-white" href="hlstranka_student.php">Hlavní stránka</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
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
<form method="post">
  <label for="skolni_rok">Školní rok:</label>
  <select id="skolni_rok" name="skolni_rok">
  <option value="2020/2021">2020/2021</option>
  <option value="2021/2022">2021/2022</option>
  <option value="2022/2023">2022/2023</option>
  <option value="2023/2024">2023/2024</option>
  <option value="2024/2025">2024/2025</option>
</select>
  <button type="submit" name="submit">Aktualizovat</button>
</form>

<table class="table">
  <tr>
    <th>Předmět</th>
    <th>Známky</th>
    <th>Průměr</th>
  </tr>
  <?php
  $znamkyZpredmetu = array();

  foreach ($zaznamy as $zaznam) {
      if (!isset($znamkyZpredmetu[$zaznam["nazev"]])) {
          $znamkyZpredmetu[$zaznam["nazev"]] = array();
      }
      array_push($znamkyZpredmetu[$zaznam["nazev"]], array("hodnoceni" => $zaznam["hodnoceni"], "id_znamka" => $zaznam["ID_znamka"]));
  }

  foreach ($znamkyZpredmetu as $predmet => $znamky) {
      $oddelovac = "";
      foreach ($znamky as $znamka) {
          $oddelovac .= "<a onclick='oknoZnamka(".$znamka["id_znamka"].", \"".$predmet."\")'>"
          .(($znamka["hodnoceni"] == "0.0") ? "N" : ((intval($znamka["hodnoceni"]) == $znamka["hodnoceni"]) ? 
          (($znamka["hodnoceni"][-2] == ".") ? $znamka["hodnoceni"][0] : $znamka["hodnoceni"]) : 
          substr($znamka["hodnoceni"], 0, -2) . "-"))
          ."</a>, ";
      }

      $oddelovac = rtrim($oddelovac, ", ");
      $prumer = 0;
      foreach ($zaznamy2 as $zaznam) {
          if ($zaznam["nazev"] == $predmet) {
              $prumer = $zaznam["prumer"];
              break;
          }
      }

      if ($prumer == floor($prumer)) {
          echo "<tr><td>".$predmet."</td><td>".$oddelovac."</td><td>".intval($prumer)."</td></tr>";
      } else {
          echo "<tr><td>".$predmet."</td><td>".$oddelovac."</td><td>".$prumer."</td></tr>";
      }
  }
  ?>
</table>


  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>