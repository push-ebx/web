<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Галерея</title>
  <link rel="stylesheet" href="./globals.css">
</head>
<style>
  /* header {
    padding: 0 20vw;
  } */

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
    /* align-items: start; */
    max-width: 60vw;
  }

  .gallery_item {
    padding: 20px;
    width: 19vw;
    border: 1px solid black;
    border-radius: 3px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 20px;
  }

  .gallery_item__1 {
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

  textarea {
    width: 100%;
    font-family: 'Times New Roman', Times, serif;
    padding: 10px;

  }

  input[type="submit"] {
    width: 100%;
    padding: 10px;
    outline: none;
    border: 1px solid black;
    background-color: #fff;
    border-radius: 3px;
  }

  /* .search_form {
    padding: 10px;
    border: 1px solid black;
  } */
</style>

<body>
  <header>
    <h1><a href="/">Искусство и культура</a></h1>
    <div>
      <form class="search_form" action="" method="get">
        <input type="text" placeholder="Поиск по произведениям" name="title" value=<?php echo $_GET['title'] ?> >
        <!-- <input type="submit" placeholder="Найти" > -->
      </form>
      <a href="/dashboard">Личный кабинет</a>
      <a href="/gallery.php">Галерея</a>
    </div>
  </header>

  <main>
    <div class="gallery">
      <?php
      session_start();
      $user_id = $_SESSION["user_id"];

      require_once 'db_connection.php';

      global $conn;
      $title = $_GET['title'];
      $sql = "SELECT `произведения искусства`.`Название`, `произведения искусства`.`ID произведения`, `произведения искусства`.`Описание`, `произведения искусства`.`image_url`, `произведения искусства`.`Оценочная стоимость`, `произведения искусства`.`Статус реставрации`, `авторы`.`ФИО автора` FROM `произведения искусства` INNER JOIN `авторы` ON `произведения искусства`.`ID автора`=`авторы`.`ID автора` WHERE `произведения искусства`.`Название` LIKE '%$title%'";
      $result = $conn->query($sql);

      $add_review = '';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['add'])) {
          $text = $_POST['text'];
          $art_id = $_POST['art_id'];        
          $conn->query("INSERT INTO `оценки критиков` (`Текст рецензии`, `ID произведения`, `ID критика`) VALUES ('$text', '$art_id', '$user_id')");
        }
      }

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          if ($_SESSION["role"] == 'critic') $add_review = '<a href="/dashboard/new-review.php?id=' . $row["ID произведения"] . '">Оценить</a>';

          echo '
          <div class="gallery_item">
            <div class="gallery_item__1">
              <img src="' . $row["image_url"] . '" alt="">
              <h2 class="artist">' . $row["ФИО автора"] . '</h2>
              <h3 class="title">' . $row["Название"] . '</h3>
              <p class="description">' . $row["Описание"] . '</p>
            </div>
            <div class="cost">Оценочная стоимость: $' . $row["Оценочная стоимость"] . '</div>';
            if ($_SESSION["role"] == 'critic') { ?>
              <form id="new_review_form" action="" method="post">
                <input type="text" name="art_id" value="<?php echo $row['ID произведения']?>" style="display: none">
                <textarea name="text" id="text" cols="30" rows="10" placeholder="Текст рецензии"></textarea>
                <input type="submit" name="add" value="Оценить">
              </form>
            <?php
            }
            
            echo '</div>';
        }
      }
      ?>
    </div>  
  </main>
  <footer>
    <a href="/dashboard">Личный кабинет</a>
    <a href="/gallery.php">Галерея</a>
  </footer>
</body>

</html>