<?php
include_once "../include/db_connect.php";
$id_ucitel = $_SESSION['prihlaseni_ID_ucitel'];
$skolni_rok = aktualniSkolniRok();

$sql = "SELECT student.jmeno, student.prijmeni, student.datum_narozeni, student.email, trida.rocnik from student
JOIN trida_seznam_studentu ON Student.ID_student = trida_seznam_studentu.ID_student
JOIN trida ON trida_seznam_studentu.ID_trida = trida.ID_trida
WHERE Trida.ID_tridni_ucitel LIKE '$id_ucitel' AND trida.skolni_rok LIKE '$skolni_rok'";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT trida.ID_trida, trida.rocnik, trida.skolni_rok from trida
JOIN Ucitel ON trida.ID_tridni_ucitel = ucitel.ID_ucitel
WHERE ucitel.ID_ucitel LIKE '$id_ucitel' AND trida.skolni_rok LIKE '$skolni_rok' ";
$result2 = mysqli_query($conn, $sql2);
$rocnik = mysqli_fetch_all($result2, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-white" href="hlstranka_ucitel.php">Hlavní stránka</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
<?php if (isset($rocnik[0])){
  echo "<h2>Seznam studentů:" . $rocnik[0]['rocnik'] . " ročník.</h2>";
  echo "<h3>Školní rok:" . $rocnik[0]['skolni_rok'] . " školní rok.</h3>";
}  else {
  echo "<h2>Nejste třídní učitel</h2>";
}?>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Jméno</th>
      <th>Příjmení</th>
      <th>Datum narození</th>
      <th>E-mail</th>
    </tr>
  </thead>
  <tbody>
  <?php
      foreach ($zaznamy as $zaznam) {
        echo "<tr>";
        echo "<td>" . $zaznam["jmeno"] . "</td>";
        echo "<td>" . $zaznam["prijmeni"] . "</td>";
        echo "<td>" . $zaznam["datum_narozeni"] . "</td>";
        echo "<td>" . $zaznam["email"] . "</td>";
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