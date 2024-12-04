<?php
include_once "../include/db_connect.php";
$id_ucitel = $_SESSION['prihlaseni_ID_ucitel'];
$skolni_rok = aktualniSkolniRok();

$sql= "SELECT student.ID_student, student.jmeno, student.prijmeni, COUNT(absence.ID_absence) from student 
JOIN absence ON student.ID_student = absence.ID_student
JOIN hodina ON absence.ID_hodina = hodina.ID_hodina
JOIN trida ON hodina.ID_trida = trida.ID_trida
WHERE absence.stav LIKE '%neomluveno%' AND trida.ID_tridni_ucitel = '$id_ucitel' AND trida.skolni_rok LIKE '$skolni_rok' 
GROUP BY student.ID_student";
$result = mysqli_query($conn, $sql);
$zaznamy = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_student= $_POST['ID_student'];

  $sql2 = "UPDATE absence SET stav = 'omluveno' WHERE ID_student = '$id_student' AND stav LIKE 'neomluveno'";
  $result2 = mysqli_query($conn, $sql2);

}


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Školní hodnocení</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/hodnoceni.cs">
    <script src=../include/ucitel_absenceZnamky.js></script>
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
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

<table class="table table-hover">
  <thead>
    <tr>
      <th>Jméno</th>
      <th>Příjmení</th>
      <th>Neomluvený počet hodin</th>
      <th>Omluvit</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($zaznamy as $zaznam) { ?>
      <tr>
        <td><?php echo $zaznam["jmeno"]; ?></td>
        <td><?php echo $zaznam["prijmeni"]; ?></td>
        <td><?php echo $zaznam["COUNT(absence.ID_absence)"]; ?></td>
        <td>
        <button type="button" class="btn btn-primary" onclick="omluvit(<?php echo $zaznam['ID_student']; ?>)">Omluvit</button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



  </body>
  <footer>
  <p style="padding: 0; margin: 0; text-align: center">&copy Adam Thiel 2023</p>
</footer>
</html>