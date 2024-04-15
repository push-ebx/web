<?php
require_once 'db_connection.php';
session_start();
function authenticateUser($username, $password) {
  global $conn;
  $sql = "SELECT * FROM `авторы` WHERE login='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();

    $_SESSION['user_id'] = $user_data['ID автора'];
    $_SESSION['username'] = $user_data['login'];
    $_SESSION['role'] = 'artist';
    header("Location: dashboard/artist.php");
    exit();
  }

  $sql = "SELECT * FROM `критики` WHERE login='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();

    $_SESSION['user_id'] = $user_data['ID критика'];
    $_SESSION['username'] = $user_data['login'];
    $_SESSION['role'] = 'critic';
    header("Location: dashboard/critic.php");
    exit();
  }

  echo '<script>alert("Ошибка входа!")</script>';
}