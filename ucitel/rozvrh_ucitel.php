<?php
include_once "../include/db_connect.php";
$id_ucitel = $_SESSION['prihlaseni_ID_ucitel'];



function rozvrhSkolniRok($conn, $skolni_rok)
{
  $id_ucitel = $_SESSION['prihlaseni_ID_ucitel'];

  if (isset($_POST['submit'])) {
    $skolni_rok = $_POST['skolni_rok'];
  }

  $sql = "SELECT hodina.ID_hodina, Hodina.den, Hodina.od, Hodina.do, Predmet.nazev from hodina  
  JOIN predmet ON Hodina.ID_predmet = Predmet.ID_predmet
  JOIN trida ON hodina.ID_trida = trida.ID_trida
  JOIN ucitel ON hodina.ID_ucitel = ucitel.ID_ucitel
  WHERE trida.skolni_rok LIKE '$skolni_rok' AND ucitel.ID_ucitel = '$id_ucitel'
  ORDER BY Hodina.od ";
  $result = mysqli_query($conn, $sql);
  $zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

  return $zaznamy;
}

$sql2 = "SELECT Ucitel.ID_ucitel, Ucitel.jmeno, Ucitel.prijmeni from ucitel 
WHERE ucitel.ID_ucitel LIKE '$id_ucitel'";
$result2 = mysqli_query($conn, $sql2);
$ucitel = mysqli_fetch_all($result2, MYSQLI_ASSOC);


$skolni_rok = aktualniSkolniRok();
$zaznamy = rozvrhSkolniRok($conn, $skolni_rok);
$serazene = [
  'Pondělí' => [],
  'Úterý' => [],
  'Středa' => [],
  'Čtvrtek' => [],
  'Pátek' => []
];
foreach ($zaznamy as $zaznam) {
  switch ($zaznam['den']) {
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
  <script src=../include/ucitel_absenceZnamky.js></script>
  <link rel="stylesheet" href="../css/styly.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-white" href="hlstranka_ucitel.php">Hlavní stránka</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="rozvrh_ucitel.php">Rozvrh hodin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="seznam_studentu.php">Seznam studentů</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="ucitel_omluvaAbsence.php">Omlouvání absence</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../index.php">Odhlásit se</a>
        </li>
      </ul>
    </div>
  </nav>
  <h2>Rozvrh hodin pro učitele: <?php echo $ucitel[0]['jmeno'] . " " . $ucitel[0]['prijmeni'] ?></h2>
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


  <table class="table-bordered">
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
    foreach ($serazene as $den => $hodiny) {
      echo '<tr>';
      echo '<td>' . $den . '</td>';

      $lastHour = 8;
      foreach ($hodiny as $hodina) {
        for ($i = $lastHour + 1; $i < explode(':', $hodina['od'])[0]; $i++)
          echo '<td></td>';
        echo '<td class="doprava"><button type="button" class="btn" onclick="oknoZnamky(' . $hodina['ID_hodina'] . ')"> ' . $hodina['nazev'] . '</button><a href="#" onclick="oknoAbsence(' . $hodina['ID_hodina'] . ')"><img src="../img/absence_icon.png"></a></td>';
        $lastHour = explode(':', $hodina['od'])[0];
      }
      for ($i = $lastHour + 1; $i < 16; $i++) {
        echo '<td></td>';
      }

      echo '</tr>';
    }
    ?>
  </table>



</body>
<footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>

</html>