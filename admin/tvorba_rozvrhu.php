<?php
include_once "../include/db_connect.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$den = mysqli_real_escape_string($conn, $_POST['den']);
$od = mysqli_real_escape_string($conn, $_POST['od']);
$do = mysqli_real_escape_string($conn, $_POST['do']);
$rocnik = mysqli_real_escape_string($conn, $_POST['rocnik']);
$predmet = mysqli_real_escape_string($conn, $_POST['predmet']);
$ucitel = mysqli_real_escape_string($conn, $_POST['ucitel']);

$sql4 = "INSERT INTO hodina (ID_hodina, den, od, do, ID_trida, ID_predmet, ID_ucitel) VALUES ('NULL' ,'$den', '$od', '$do', '$rocnik', '$predmet', '$ucitel')";
mysqli_query($conn, $sql4);
header("Location: tvorba_rozvrhu.php?odeslano");
}
$sql = "SELECT ID_trida, rocnik, skolni_rok FROM trida";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT ID_predmet, nazev FROM predmet";
$result2 = mysqli_query($conn, $sql2);
$zaznamy2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

$sql3 = "SELECT ID_ucitel, ucitel.jmeno, ucitel.prijmeni from ucitel";
$result3 = mysqli_query($conn, $sql3);
$zaznamy3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);




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
  <h1>Tvorba rozvrhu.</h1>
<form method="POST">
  <div class="form-group">
    <label for="den">Den v týdnu</label>
    <select class="form-control" id="den" name="den"required>
    <option value="Pondělí">Pondělí</option>
    <option value="Úterý">Úterý</option>
    <option value="Středa">Středa</option>
    <option value="Čtvrtek">Čtvrtek</option>
    <option value="Pátek">Pátek</option>
  </select>
  </div>
  <div class="form-group">
    <label for="od">Od kdy</label>
    <select class="form-control" id="od" name="od"required>
    <option value="8:00">8:00</option>
    <option value="9:00">9:00</option>
    <option value="10:00">10:00</option>
    <option value="11:00">11:00</option>
    <option value="12:00">12:00</option>
    <option value="13:00">13:00</option>
    <option value="14:00">14:00</option>
    <option value="15:00">15:00</option>
  </select>
  </div>
  <div class="form-group">
    <label for="do">Do kdy</label>
    <select class="form-control" id="do" name="do"required>
    <option value="8:45">8:45</option>
    <option value="9:45">9:45</option>
    <option value="10:45">10:45</option>
    <option value="11:45">11:45</option>
    <option value="12:45">12:45</option>
    <option value="13:45">13:45</option>
    <option value="14:45">14:45</option>
    <option value="15:45">15:45</option>
  </select>
  </div>
  <div class="form-group">
  <label for="rocnik">Ročník</label>
    <select class="form-control" id="rocnik" name="rocnik"required>
      <?php
  foreach($zaznamy as $zaznam) {
    echo "<option value='" . $zaznam["ID_trida"] . "'>" . $zaznam["rocnik"] . " " .  $zaznam["skolni_rok"] . "</option>";
  }
  
?>
</select>
  </div>
  <div class="form-group">
  <label for="predmet">Předmět</label>
    <select class="form-control" id="predmet" name="predmet"required>
      <?php
  foreach($zaznamy2 as $zaznam) {
    echo "<option value='" . $zaznam["ID_predmet"] . "'>" . $zaznam["nazev"] . "</option>";
  }
  
?>
</select>
  </div>
  <div class="form-group">
  <label for="ucitel">Učitel</label>
    <select class="form-control" id="ucitel" name="ucitel"required>
      <?php
  foreach($zaznamy3 as $zaznam) {
    echo "<option value='" . $zaznam["ID_ucitel"] . "'>" . $zaznam["jmeno"] . " " .$zaznam["prijmeni"] . "</option>";
  }
  
?>
</select>
  </div>
 
  <button type="submit" class="btn btn-primary">Odeslat</button>
</form>
  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>