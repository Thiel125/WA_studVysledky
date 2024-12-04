<?php
include_once "../include/db_connect.php";
$id_student = $_SESSION['prihlaseni_ID_student'];
 

function rozvrhSkolniRok($conn, $skolni_rok) {
  $id_student = $_SESSION['prihlaseni_ID_student'];

  if(isset($_POST['submit'])){
    $skolni_rok = $_POST['skolni_rok'];
  }

$sql = "SELECT CONCAT(LEFT(ucitel.jmeno, 1), LEFT(ucitel.prijmeni, 1)) AS `inicialy`, Hodina.ID_hodina, Hodina.den, Hodina.od, Hodina.do, Predmet.nazev from Hodina 
JOIN predmet ON Hodina.ID_predmet = Predmet.ID_predmet
JOIN trida ON Hodina.ID_trida = Trida.ID_trida
JOIN trida_seznam_studentu ON Trida.ID_trida = trida_seznam_studentu.ID_trida
JOIN student ON trida_seznam_studentu.ID_student = student.ID_student
JOIN ucitel ON Hodina.ID_ucitel = Ucitel.ID_ucitel
WHERE student.ID_student LIKE '$id_student' AND trida.skolni_rok LIKE '$skolni_rok' ORDER BY Hodina.od ";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

return $zaznamy;
}

$sql2 = "SELECT student.ID_student, student.jmeno, student.prijmeni from student 
WHERE student.ID_student LIKE '$id_student'";
$result2 = mysqli_query($conn, $sql2);
$student = mysqli_fetch_all($result2, MYSQLI_ASSOC);


$skolni_rok = aktualniSkolniRok();  
$zaznamy = rozvrhSkolniRok($conn, $skolni_rok);
$serazene = [
  'Pondělí' => [],
  'Úterý' => [],
  'Středa' =>[],
  'Čtvrtek' => [],
  'Pátek' => []
];
foreach($zaznamy as $zaznam){
    switch($zaznam['den']){
        case 'Úterý': 
            $serazene['Úterý'][] = $zaznam;
            break;
        case 'Středa':
            $serazene['Středa'][] = $zaznam;
            break;
        case 'Čtvrtek':
            $serazene['Čtvrtek'][] = $zaznam;
            break;
        case 'Pátek':
            $serazene['Pátek'][] = $zaznam;
            break;
        default:
            $serazene['Pondělí'][] = $zaznam;
            break;
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src=../include/rozvrh_okno.js></script>
    <link rel="stylesheet" href="../css/styly.css">
		
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
<h2>Rozvrh hodin pro studenta: <?php echo $student[0]['jmeno'] . " " . $student[0]['prijmeni'] ?></h2>
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
<table class=table-bordered>
<tr>
    <th></th>
    <th>8:00-8:45</th>
    <th>9:00-9:45</th>
    <th>10:00-10:45</th>
    <th>11:00-11:45</th>
    <th>12:00-12:45</th>
    <th>13:00-13:45</th>
    <th>14:00-14:45</th>
    <th>15:00-15:45</th>
</tr>
<?php
foreach($serazene as $den => $hodiny){
    echo '<tr>';
    echo '<td>'.$den.'</td>';

    $lastHour = 8;
    foreach($hodiny as $hodina){
        for($i = $lastHour+1; $i < explode(':', $hodina['od'])[0]; $i++)
            echo '<td></td>';

            echo '<td><button type="button" class="btn" onclick="oknoRozvrh('.$hodina['ID_hodina'].')"> '.$hodina['nazev'].'. <br>'.$hodina["inicialy"].'</br></td>';


        $lastHour = explode(':', $hodina['od'])[0];
    }
    for($i = $lastHour+1; $i < 16; $i++){
      echo '<td></td>';
    }

    echo '</tr>';
}
echo "</table>";

?>

  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>