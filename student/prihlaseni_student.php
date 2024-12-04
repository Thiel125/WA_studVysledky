<?php
include_once "../include/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT ID_student FROM student WHERE email = '$email' and heslo = '$password'";
  $result = mysqli_query($conn, $sql);
  $pocet = mysqli_num_rows($result);

  if ($pocet == 1) {
    $zaznam = mysqli_fetch_assoc($result);
    $_SESSION['prihlaseni_ID_student'] = $zaznam['ID_student'];
    header("location: hlstranka_student.php?id=".$zaznam['ID_student']);
  } else {
      $error = "Zadali jste chybný email nebo heslo. Zkuste to znovu.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VysledkyOnline</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/prihlaseni.css">
</head>
<body>
<div class="container">
<form method="POST">
    <h2>Přihlášení pro studenta</h2>
    <input class="input" type="text" name="email" placeholder="E-mail">
    <input class="input" type="password" name="password" placeholder="Heslo">
    <input class="button submit" type="submit" value="Přihlásit se">
</form>
  <div>
  </div>
    </div>
    <h2 class="chyba"><?php echo $error; ?></h2>
    
    
</body>
</html>