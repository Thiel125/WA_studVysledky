<?php
include_once "../include/db_connect.php";
$id_ucitel = $_SESSION['prihlaseni_ID_ucitel'];
$skolni_rok = aktualniSkolniRok();
$id = $_GET['id'];
$id2 = $id;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $popis = mysqli_real_escape_string($conn, $_POST['popis']);
  $stav = mysqli_real_escape_string($conn, $_POST['stav']);
  $hodina = mysqli_real_escape_string($conn, $_POST['hodina']);

  $studenti = isset($_POST['student']) ? $_POST['student'] : array();
  
  foreach ($studenti as $student) {
  $sql3 = "INSERT INTO absence (ID_absence, popis, stav, ID_hodina, ID_student) VALUES ('NULL','$popis', '$stav', '$hodina', '$student')";
  mysqli_query($conn, $sql3);
   }
  header("Location: ucitel_zapisAbsence.php?id=$id2");
  }

$sql = "SELECT student.ID_student, student.jmeno, student.prijmeni from student
JOIN trida_seznam_studentu ON student.ID_student = trida_seznam_studentu.ID_student
JOIN trida ON trida_seznam_studentu.ID_trida = trida.ID_trida
JOIN hodina ON trida.ID_trida = hodina.ID_trida
WHERE hodina.ID_hodina = '$id' AND trida.skolni_rok LIKE '$skolni_rok'";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT hodina.ID_hodina, hodina.den, hodina.od, hodina.do, predmet.nazev from hodina
JOIN predmet ON hodina.ID_predmet = predmet.ID_predmet
WHERE hodina.ID_hodina = '$id'";
$result2 = mysqli_query($conn, $sql2);
$zaznamy2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);




?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  </head>
  <body>

  <form method="POST">
    <h2>Zápis absence </h2>
  <table>
    <thead>
      <tr>
        <th></th>
        <th>Student</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($zaznamy as $zaznam) { ?>
        <tr>
          <td><input type="checkbox" name="student[]" value="<?php echo $zaznam["ID_student"]; ?>"></td>
          <td><?php echo $zaznam["jmeno"] . " " .  $zaznam["prijmeni"]; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class="form-group">
    <label for="popis">Popis absence</label>
    <input type="text" class="form-control" id="popis" name="popis" placeholder="Zadejte popis absence.">
  </div>
  <div class="form-group">
    <label for="stav">Stav absence</label>
    <select class="form-control" id="stav" name="stav"required>
    <option value="neomluveno">neomluveno</option>
    <option value="omluveno">omluveno</option>
</select>
</div>
<div class="form-group">
  <label for="hodina">Hodina</label>
    <select class="form-control" id="hodina" name="hodina">
      <?php
  foreach($zaznamy2 as $zaznam) {
    echo "<option value='" . $zaznam["ID_hodina"] . "'>" . $zaznam["den"] . " " . $zaznam["od"] . "-" . $zaznam["do"] . ", ". $zaznam["nazev"] . "</option>";
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