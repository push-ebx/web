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
      if ($_SESSION["role"] != 'artist') header("Location: /dashboard");
      ?>
      <?php
        require_once '../db_connection.php';
  
        global $conn;
        $ex_id = $_GET["id"];
        $sql = "SELECT * FROM `Выставки` WHERE `ID выставки`=$ex_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          echo '<h1>'.$row["Название выставки"].'</h1>';
          // echo '<div class="gallery_item">
          //     <a style="cursor: pointer" href="/$" class="title">' . $row["Название выставки"] . '</a>
          //   </div>';
        } else {
          echo "Выставка не найдена!<br/>";
        }
        ?>

      <div class="gallery">
        <?php
          $sql = "
          SELECT `название`, `image_url` FROM `выставки`
          INNER JOIN `выставки_произведенияискусства`
          ON `выставки`.`ID выставки` = `выставки_произведенияискусства`.`ID выставки`
          INNER JOIN `произведения искусства`
          ON `произведения искусства`.`ID произведения` = `выставки_произведенияискусства`.`ID произведения`
          WHERE `выставки`.`ID выставки` = $ex_id
          ";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<div class="gallery_item">
                  <img src="' . $row["image_url"] . '" alt="">
                  <h3 class="title">' . $row["название"] . '</h3>
                  <p>' . $row["текст рецензии"] . '</p>
                </div>';
            }
          } else {
            echo "Произведения не найдены<br/>";
          }
        ?>
        <!-- <br/> -->
        <!-- <a class="gallery_item" style="align-items: center; justify-content: center;" href="new-exhibition.php">Добавить картину в выставку</a> -->
      </div>
    </div>
  </main>

  <footer>
    <a href="/dashboard">Личный кабинет</a>
    <a href="/gallery.php">Галерея</a>
  </footer>
</body>

</html>