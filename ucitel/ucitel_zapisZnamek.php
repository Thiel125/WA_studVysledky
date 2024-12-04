<?php
include_once "../include/db_connect.php";
$id_ucitel = $_SESSION['prihlaseni_ID_ucitel'];
$skolni_rok = aktualniSkolniRok();
$id = $_GET['id'];
$id2 = $id;




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $popis = mysqli_real_escape_string($conn, $_POST['popis']);
  $predmet = mysqli_real_escape_string($conn, $_POST['predmet']);
  $rocnik = mysqli_real_escape_string($conn, $_POST['rocnik']);
  $datum = mysqli_real_escape_string($conn, $_POST['datum']);

  $studenti = isset($_POST['student']) ? $_POST['student'] : array();
  $hodnoceni = isset($_POST['hodnoceni']) ? $_POST['hodnoceni'] : array();
  $poznamka = isset($_POST['poznamka']) ? $_POST['poznamka'] : array();

  foreach ($studenti as $index => $student_id) {
    $hodnoceni_student = mysqli_real_escape_string($conn, $hodnoceni[$index]);
    $poznamka_student = mysqli_real_escape_string($conn, $poznamka[$index]);
    $sql4 = "INSERT INTO znamka (hodnoceni, popis, poznamka, datum, ID_student, ID_predmet, ID_trida) VALUES ('$hodnoceni_student', '$popis', '$poznamka_student', '$datum', '$student_id', '$predmet', '$rocnik')";
    mysqli_query($conn, $sql4);
  }
  header("Location: ucitel_zapisZnamek.php?id=$id2");
}


$sql = "SELECT student.ID_student, student.jmeno, student.prijmeni from student
JOIN trida_seznam_studentu ON student.ID_student = trida_seznam_studentu.ID_student
JOIN trida ON trida_seznam_studentu.ID_trida = trida.ID_trida
JOIN hodina ON trida.ID_trida = hodina.ID_trida
WHERE hodina.ID_hodina = '$id' AND trida.skolni_rok LIKE '$skolni_rok'";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);


$sql2 = "SELECT predmet.ID_predmet, Predmet.nazev from predmet
JOIN hodina ON predmet.ID_predmet = hodina.ID_predmet
WHERE hodina.ID_hodina = '$id'";
$result2 = mysqli_query($conn, $sql2);
$zaznamy2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$IDpredmet=$zaznamy2[0]["ID_predmet"];
$_SESSION['ID_predmet'] = $IDpredmet;



$sql3 = "SELECT trida.ID_trida, trida.rocnik, trida.skolni_rok from trida
JOIN hodina ON trida.ID_trida = hodina.ID_trida
WHERE hodina.ID_hodina = '$id'";
$result3 = mysqli_query($conn, $sql3);
$zaznamy3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
$IDtrida=$zaznamy3[0]["ID_trida"];
$_SESSION['ID_trida'] = $IDtrida;

$sql5 = "SELECT znamka.ID_znamka, znamka.popis, znamka.datum from znamka
WHERE znamka.ID_predmet = '$IDpredmet' AND znamka.ID_trida = '$IDtrida'
GROUP BY znamka.popis";
$result5 = mysqli_query($conn, $sql5);
$zaznamy5 = mysqli_fetch_all($result5, MYSQLI_ASSOC);





?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ucitel.css">
  </head>
  <body>

  <form method="POST">
  <table>
    <thead>
      <tr>
        <th></th>
        <th>Student</th>
        <th>Hodnocení</th>
        <th>Poznámka</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($zaznamy as $zaznam) { ?>
        <tr>
          <td><input name="student[]" value="<?php echo $zaznam["ID_student"]; ?>"hidden></td>
          <td><?php echo $zaznam["jmeno"] . " " .  $zaznam["prijmeni"]; ?></td>
          <td>
            <select class="form-control" name="hodnoceni[]">
              <option value="1.0">1</option>
              <option value="1.5">1-</option>
              <option value="2.0">2</option>
              <option value="2.5">2-</option>
              <option value="3.0">3</option>
              <option value="3.5">3-</option>
              <option value="4.0">4</option>
              <option value="4.5">4-</option>
              <option value="5.0">5</option>
              <option value="NULL"selected>N</option>
            </select>
          </td>
          <td><input type="text" class="form-control" name="poznamka[]"></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div>
    <label for="popis">Popis Známky</label>
    <input class="form-control" type="text" id="popis" name="popis" placeholder="Zadejte popis Známky."required>
  </div>
  <div class="form-group">
    <label for="datum">Datum známky</label>
    <input type="date" class="form-control" name="datum"required>
  </div>
  <div class="form-group">
    <label for="predmet"></label>
    <select class="form-control" id="predmet" name="predmet">
      <?php foreach($zaznamy2 as $zaznam) {
        echo "<option value='" . $zaznam["ID_predmet"] . "'>" . $zaznam["nazev"] . "</option>";
      } ?>
    </select>
  </div>
  <div class="form-group">
    <label for="rocnik"></label>
    <select class="form-control" id="rocnik" name="rocnik"hidden>
      <?php foreach($zaznamy3 as $zaznam) {
        echo "<option value='" . $zaznam["ID_trida"] . "'>" . $zaznam["rocnik"] . " " .  $zaznam["skolni_rok"] . "</option>";
      } ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Oznámkovat</button>
</form>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Popis známek</th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($zaznamy5 as $zaznam) {
      echo "<tr>";
      echo "<td><a href='ucitel_znamkyZpredmetu.php?popis={$zaznam['popis']}'>" . $zaznam['popis'] . " " . date('d.m.Y', strtotime($zaznam['datum'])) . "</a></td>";
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