<?php
session_start();
if (!isset($_SESSION["user_id"]) || !isset($_SESSION["username"])) {
  header("Location: http://lab4.local/login.php");
}
$user_id = $_SESSION["user_id"];
if ($_SESSION["role"] == 'critic') header("Location: /dashboard/critic.php");
else header("Location: /dashboard/artist.php");
