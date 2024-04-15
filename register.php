<?php
require_once 'db_connection.php';
function registerUser($username, $password, $email, $role) {
  global $conn;
  
  $sql = '';

  if ($role == 'critic') $sql = "INSERT INTO `критики` (`login`, `password`, `email`) VALUES ('$username', '$password', '$email');";
  else $sql = "INSERT INTO `авторы` (`login`, `password`, `email`) VALUES ('$username', '$password', '$email');";

  $result = $conn->query($sql);

  if ($result) {
    echo '<script>alert("Пользователь зарегистрирован!")</script>';
  }
}