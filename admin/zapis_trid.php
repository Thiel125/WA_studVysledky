<?php
include_once "../include/db_connect.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$rocnik = mysqli_real_escape_string($conn, $_POST['rocnik']);
$skolni_rok = mysqli_real_escape_string($conn, $_POST['skolni_rok']);
$oznaceni_ucebny = mysqli_real_escape_string($conn, $_POST['oznaceni_ucebny']);
$tridni_ucitel = mysqli_real_escape_string($conn, $_POST['tridni_ucitel']);

$sql = "INSERT INTO trida (ID_trida, rocnik, skolni_rok, oznaceni_ucebny, ID_tridni_ucitel ) VALUES ('NULL','$rocnik', '$skolni_rok', '$oznaceni_ucebny', '$tridni_ucitel')";
mysqli_query($conn, $sql);
header("Location: zapis_trid.php?odeslano");
}
$sql2 = "SELECT ID_ucitel, ucitel.jmeno, ucitel.prijmeni from ucitel";
$result = mysqli_query($conn, $sql2);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql3 = "SELECT ID_trida, rocnik, skolni_rok, oznaceni_ucebny, ucitel.jmeno, ucitel.prijmeni FROM trida
JOIN ucitel ON trida.ID_tridni_ucitel = ucitel.ID_ucitel";
$result2 = mysqli_query($conn, $sql3);
$zaznamy2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

if(isset($_GET['deleteID'])){
  $id=$_GET['deleteID'];
  $delete=mysqli_query($conn, "DELETE FROM `trida` WHERE `ID_trida` = '$id'");
  header("Location: zapis_trid.php?smazano");
}

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
  <h1>Zapisování tříd do databáze.</h1>
<form method="POST">
  <div class="form-group">
    <label for="rocnik">Ročník</label>
    <select class="form-control" id="rocnik" name="rocnik"required>
    <option value="první">první</option>
    <option value="druhý">druhý</option>
    <option value="třetí">třetí</option>
    <option value="čtvrtý">čtvrtý</option>
    <option value="pátý">pátý</option>
    <option value="šestý">šestý</option>
    <option value="sedmý">sedmý</option>
    <option value="osmý">osmý</option>
    <option value="devátý">devátý</option>
  </select>
  </div>
  <div class="form-group">
    <label for="skolni_rok">Školní rok</label>
    <input type="text" class="form-control" name="skolni_rok" placeholder="Zadejte školní rok."required>
  </div>
  <div class="form-group">
    <label for="oznaceni_ucebny">Označení učebny</label>
    <input type="text" class="form-control" name="oznaceni_ucebny" placeholder="Zadejte označení učebny."required>
  </div>
  <div class="form-group">
  <label for="tridni_ucitel">Třídní učitel</label>
    <select class="form-control" id="tridni_ucitel" name="tridni_ucitel"required>
      <?php
  foreach($zaznamy as $zaznam) {
    echo "<option value='" . $zaznam["ID_ucitel"] . "'>" . $zaznam["jmeno"] . " " .  $zaznam["prijmeni"] . "</option>";
  }
  
?>
</select>
  </div>
 
  <button type="submit" class="btn btn-primary">Odeslat</button>
</form>
</div>
<table class="table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Ročník</th>
      <th>Školní rok</th>
      <th>Označení učebny</th>
      <th>Třídní učitel</th>
      <th>Akce</th> 
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($zaznamy2 as $zaznam) {
        echo "<tr>";
        echo "<td>" . $zaznam["ID_trida"] . "</td>";
        echo "<td>" . $zaznam["rocnik"] . "</td>";
        echo "<td>" . $zaznam["skolni_rok"] . "</td>";
        echo "<td>" . $zaznam["oznaceni_ucebny"] . "</td>";
        echo "<td>" . $zaznam["jmeno"] . " " . $zaznam["prijmeni"] . "</td>";
        echo "<td>";
        echo "<a type='button' onclick='confirmDelete(".$zaznam["ID_trida"].");'class='btn btn-danger'>Smazat</a>"; 
        echo "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
<script>
  function confirmDelete(id) {
    if (confirm('Opravdu chcete odstranit tento záznam?')) {
         window.location.href = '/THI0035_BP/admin/zapis_trid.php?deleteID=' + id;
    }
}
</script>
  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>