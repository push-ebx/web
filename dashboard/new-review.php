<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добавление оценки</title>
  <link rel="stylesheet" href="../globals.css">
</head>
<style>
  #new_art_form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: start;
  }

  main {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    padding: 150px 0;
    gap: 10px;
  }

  input {
    width: 100%;
  }

  input[type="submit"] {
    outline: none;
    border: 1px solid black;
    padding: 5px;
    font-size: 14px;
    background-color: #fff;
    width: 100%;
    cursor: pointer;
  }

  .cost {
    display: flex;
    align-items: center;
    width: 100%;
  }

  textarea {
    outline: none;
    border: 1px solid black;
    font-size: 14px;
    padding: 5px;
  }

  form {
    padding: 25px;
    border: 1px solid black;
    border-radius: 3px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
</style>

<body>
  <header>
    <h1><a href="/">Искусство и культура</a></h1>
    <div>
      <a href="/dashboard">Личный кабинет</a>
      <a href="/gallery.php">Галерея</a>
    </div>
  </header>

  <?php
  session_start();
  if (!isset($_SESSION["user_id"]) || !isset($_SESSION["username"])) {
    header("Location: http://lab4.local/login.php");
  }
  $user_id = $_SESSION["user_id"];
  ?>

  <main>
    <a href="/gallery.php">Вернуться в Галерею</a>
    <form id="new_review_form" action="" method="post">
      <textarea name="text" id="text" cols="30" rows="10" placeholder="Текст рецензии"></textarea>
      <input type="submit" name="add" value="Добавить оценку">
    </form>
  </main>

  <?php
  require_once '../db_connection.php';
  global $conn;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
      
      $text = $_POST['text'];
      $art_id = $_GET['id'];
    
      $sql = "INSERT INTO `оценки критиков` (`Текст рецензии`, `ID произведения`, `ID критика`) VALUES ('$text', '$art_id', '$user_id')";
      $result = $conn->query($sql);
    //   $last_id = $conn->insert_id;

      header("Location: http://lab4.local/gallery.php");
    }
  }
  ?>

  <footer>
    <a href="/dashboard">Личный кабинет</a>
    <a href="/gallery.php">Галерея</a>
  </footer>
</body>

</html>