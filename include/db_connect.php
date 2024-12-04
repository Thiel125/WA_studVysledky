<?php 
$conn = mysqli_connect('localhost', 'root', '', 'databaze_skola');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
session_start();
$error = "";
$success = "";
function aktualniSkolniRok() {
    $mesic = date('m'); // měsíc
    $rok = date('Y'); // rok
    $skolniRok = $mesic < 9 ? $rok - 1 : $rok;
    return $skolniRok . '/' . ($skolniRok + 1);
  }
  
?>