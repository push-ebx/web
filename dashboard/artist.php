<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Личный кабинет</title>
  <link rel="stylesheet" href="../globals.css">
</head>
<style>
  main {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 150px 0;
  }

  .gallery {
    display: flex;
    justify-content: start;
    gap: 20px;
    flex-wrap: wrap;
    margin: 20px 0;
  }

  .gallery_item {
    padding: 20px;
    width: 19vw;
    border: 1px solid black;
    border-radius: 3px;
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .gallery_item img {
    width: 100%;
    height: auto;
  }

  .gallery_item p {
    word-wrap: break-word;
  }

  .contaiter {
    max-width: 60vw;
    display: flex;
    flex-direction: column;
  }
</style>

<body>
  <header>
    <h1><a href="/">Искусство и культура</a></h1>
    <div>
      <a href="/dashboard">Личный кабинет</a>
      <a href="/gallery.php">Галерея</a>
      <a href="/destroy-session.php">Выйти</a>
    </div>
  </header>
  <main>
    <div class="contaiter">
      <?php
      session_start();
      if (!isset($_SESSION["user_id"]) || !isset($_SESSION["username"])) {
        header("Location: http://lab4.local/login.php");
      }
      $user_id = $_SESSION["user_id"];
      ?>

      <?php
      require_once '../db_connection.php';

      global $conn;
      $sql = "SELECT * FROM `авторы` WHERE `ID автора`=$user_id";
      
      $result = $conn->query($sql);

      $fio = '';
      $email = '';

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fio = $row['ФИО автора'];
        $email = $row['email'];
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['save_fio'])) {
          $fio = $_POST['fio'];
          $sql = "UPDATE `авторы` SET `ФИО автора`=$fio WHERE `ID автора`=$user_id";
          $result = $conn->query($sql);
        }
      }

      if (isset($fio)) {
        echo "<h2>Здравствуйте, " . $fio . "!</h2><br/>";
        // echo "<h3>Ваш e-mail: <span style=\"font-weight: normal;\">$email</span></h3><br/>";
        echo '<a class="gallery_item" style="align-items: center; justify-content: center;" href="/dashboard/exhibitions.php">Перейти к списку выставок</a>';
      } else {
        echo
        '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">' .
          '<input type="text" name="fio">
          <input type="submit" name="save_fio" value="Сохранить ФИО">
        </form>
        ';
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['add_2ex'])) {
          $id_ex = $_POST['exs'];
          $art_id = $_POST['art_id'];
          $sql = "INSERT INTO `выставки_произведенияискусства` (`ID произведения`, `ID выставки`) VALUES ('$art_id', '$id_ex');";
          $result = $conn->query($sql);
        }
      }
      ?>
      

      <h2>Ваши произведения искусства:</h2>
      <div class="gallery">
        <?php
        $result = $conn->query("SELECT * FROM `произведения искусства` WHERE `ID автора`=$user_id");
        

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="gallery_item">';
            echo 
                '<img src="' . $row["image_url"] . '" alt="">
                <h3 class="title">' . $row["Название"] . '</h3>
                <p class="description">' . $row["Описание"] . '</p>
                <div class="cost">Оценочная стоимость: $' . $row["Оценочная стоимость"] . '</div>';
          ?>
          <form id="add_2ex" class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <select name="exs" id="exs" required>
              <option value="">Добавить в выставку</option>
              <?php 
                $result_ex = $conn->query("SELECT * FROM `Выставки` WHERE `ID автора`=$user_id");
                if ($result_ex->num_rows > 0) {
                  while ($row_ex = $result_ex->fetch_assoc()) {
                    $id = $row_ex["ID выставки"];
                    echo '<option value="'.$row_ex['ID выставки'].'">'.$row_ex['Название выставки'].'</option>';
                  }
                }
              ?>
            </select>
            <input type="text" name="art_id" value="<?php echo $row['ID произведения']?>" style="display: none">
            <input type="submit" name="add_2ex" value="Добавить">
          </form>  
          <?php
            echo '</div>';
          }
        } else {
          echo "Произведения не найдены<br/>";
        }
        ?>
        <a class="gallery_item" style="align-items: center; justify-content: center;" href="new-art.php">Добавить произведение искусства</a>
      </div>
    </div>
  </main>

  <footer>
    <a href="/dashboard">Личный кабинет</a>
    <a href="/gallery.php">Галерея</a>
  </footer>
</body>

</html>