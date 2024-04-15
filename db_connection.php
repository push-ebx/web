<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "movedb";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    print("Connection failed!");
  }