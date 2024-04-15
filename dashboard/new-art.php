<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добавление произведения искусства</title>
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
    <a href="/dashboard">Вернуться в Личный кабинет</a>
    <form id="new_art_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="text" name="title" placeholder="Название" />
      <textarea name="description" id="description" cols="30" rows="10" placeholder="Описание"></textarea>
      <div class="cost"><input type="number" name="cost" placeholder="Оценочная стоимость" />$</div>
      <input type="url" name="image_url" placeholder="URL фото" />
      <input type="submit" name="add" value="Добавить">
    </form>
  </main>

  <?php
  require_once '../db_connection.php';
  global $conn;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $cost = $_POST['cost'];
      $image_url = $_POST['image_url'];

      $sql = "INSERT INTO `произведения искусства` (`Название`, `Описание`, `Оценочная стоимость`, `image_url`, `ID автора`) VALUES ('$title', '$description', '$cost', '$image_url', '$user_id');";
      $result = $conn->query($sql);

      header("Location: http://lab4.local/dashboard");
    }
  }
  ?>

  <footer>
    <a href="/dashboard">Личный кабинет</a>
    <a href="/gallery.php">Галерея</a>
  </footer>
</body>

</html>