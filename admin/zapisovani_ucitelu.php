<?php
include_once "../include/db_connect.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$jmeno = mysqli_real_escape_string($conn, $_POST['jmeno']);
$prijmeni = mysqli_real_escape_string($conn, $_POST['prijmeni']);
$datum_narozeni = mysqli_real_escape_string($conn, $_POST['datum_narozeni']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$heslo = mysqli_real_escape_string($conn, $_POST['heslo']);

$sql = "INSERT INTO ucitel (ID_ucitel, jmeno, prijmeni, datum_narozeni, email, heslo) VALUES ('NULL','$jmeno', '$prijmeni', '$datum_narozeni', '$email', '$heslo');";
mysqli_query($conn, $sql);
header("Location: zapisovani_ucitelu.php?odeslano");
}

$sql2 = "SELECT ID_ucitel, jmeno, prijmeni, datum_narozeni, email, heslo FROM ucitel";
$result = mysqli_query($conn, $sql2);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(isset($_GET['deleteID'])){
  $id=$_GET['deleteID'];
  $delete=mysqli_query($conn, "DELETE FROM `ucitel` WHERE `ID_ucitel` = '$id'");
  header("Location: zapisovani_ucitelu.php?smazano");
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
  <h1>Odeslání učitelských údajů do databáze.</h1>
<form method="POST">
  <div class="form-group">
    <label for="jmeno">Jméno učitele</label>
    <input type="text" class="form-control" name="jmeno" placeholder="Zadejte jméno učitele."required>
  </div>
  <div class="form-group">
    <label for="prijmeni">Příjmení učitele</label>
    <input type="text" class="form-control" name="prijmeni" placeholder="Zadejte příjmení učitele."required>
  </div>
  <div class="form-group">
    <label for="datum_narozeni">Datum narození učitele</label>
    <input type="date" class="form-control" name="datum_narozeni"required>
  </div>
  <div class="form-group">
    <label for="email">E-mailová adresa učitele</label>
    <input type="email" class="form-control" name="email" placeholder="Zadejte E-mail učitele."required>
  </div>
  <div class="form-group">
    <label for="heslo">Heslo učitele</label>
    <input type="text" class="form-control" name="heslo" placeholder="Zadejte heslo učitele."required>
  </div>
  <button type="submit" class="btn btn-primary">Odeslat</button>
</form>
</div>
<table class="table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Jméno</th>
      <th>Příjmení</th>
      <th>Datum narození</th>
      <th>E-mail</th>
      <th>Heslo</th>
      <th>Akce</th> 
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($zaznamy as $zaznam) {
        echo "<tr>";
        echo "<td>" . $zaznam["ID_ucitel"] . "</td>";
        echo "<td>" . $zaznam["jmeno"] . "</td>";
        echo "<td>" . $zaznam["prijmeni"] . "</td>";
        echo "<td>" . $zaznam["datum_narozeni"] . "</td>";
        echo "<td>" . $zaznam["email"] . "</td>";
        echo "<td>" . $zaznam["heslo"] . "</td>";
        echo "<td>";
        echo "<a type='button' onclick='confirmDelete(".$zaznam["ID_ucitel"].");'class='btn btn-danger'>Smazat</a>"; 
        echo "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
  </body>
  <script>
  function confirmDelete(id) {
    if (confirm('Opravdu chcete odstranit tento záznam?')) {
         window.location.href = '/THI0035_BP/admin/zapisovani_ucitelu.php?deleteID=' + id;
    }
}
</script>


  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>