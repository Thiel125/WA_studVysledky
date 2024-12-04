<?php
include_once "../include/db_connect.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$rocnik = mysqli_real_escape_string($conn, $_POST['rocnik']);
$student = mysqli_real_escape_string($conn, $_POST['student']);

$sql = "INSERT INTO trida_seznam_studentu (ID, ID_trida, ID_student) VALUES ('NULL' ,'$rocnik', '$student')";
mysqli_query($conn, $sql);
header("Location: zapis_studentu_do_trid.php?odeslano");
}
$sql2 = "SELECT ID_student, student.jmeno, student.prijmeni from student";
$result = mysqli_query($conn, $sql2);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql3 = "SELECT ID_trida, rocnik, skolni_rok FROM trida";
$result2 = mysqli_query($conn, $sql3);
$zaznamy2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-white" href="hlstranka_admin.php">Hlavní stránka</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="tvorba_rozvrhu.php">Tvorba rozvrhu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="zapisovani_studentu.php">Zapisování studentů</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="zapisovani_ucitelu.php">Zapisování učitelů</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="zapis_trid.php">Zápisování tříd</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="zapis_studentu_do_trid.php">Zápisování studentů do tříd</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="../index.php">Odhlásit se</a>
      </li>
    </ul>
  </div>
</nav>
<div>
  <h1>Zapisování studentů do tříd.</h1>
<form method="POST">
  <label for="student">Student</label>
    <select class="form-control" id="student" name="student"required>
      <?php
  foreach($zaznamy as $zaznam) {
    echo "<option value='" . $zaznam["ID_student"] . "'>" . $zaznam["jmeno"] . " " .  $zaznam["prijmeni"] . "</option>";
  }
  
?>
</select>
<div class="form-group">
  <label for="rocnik">Ročník</label>
    <select class="form-control" id="rocnik" name="rocnik"required>
      <?php
  foreach($zaznamy2 as $zaznam) {
    echo "<option value='" . $zaznam["ID_trida"] . "'>" . $zaznam["rocnik"] . " " .  $zaznam["skolni_rok"] . "</option>";
  }
  
?>
</select>
  </div>

  <button type="submit" class="btn btn-primary">Odeslat</button>
</form>
</div>
  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>