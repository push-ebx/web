<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./globals.css">
</head>

<style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;

  }

  input[type="text"],
  input[type="password"],
  input[type="email"] {
    border: none;
    border-bottom: 1px solid black;
  }

  input {
    /* font-size: 16px; */
    outline: none;
    padding: 5px;
  }

  input[type="submit"] {
    margin-top: 20px;
    border: 1px solid black;
    cursor: pointer;
    background-color: white;
  }

  .container {
    padding: 30px;
    border: 1px solid black;
    border-radius: 3px;
    text-align: center;
  }

  .form-toggle input[type="radio"] {
    display: none;
  }

  .form-toggle label {
    display: inline-block;
    padding: 10px 20px;
    background-color: #eee;
    cursor: pointer;
    border-radius: 5px 5px 0 0;
  }

  .form-toggle input[type="radio"]:checked+label {
    background-color: #ccc;
  }

  #signup-form {
    display: none;
  }

  .forms {
    display: flex;
    flex-direction: column;
    align-items: end;
  }

  .form {
    display: flex;
    flex-direction: column;
    gap: 15px;
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
  <div class="forms">
    <div class="form-toggle">
      <input type="radio" id="login-toggle" name="toggle" value="login" checked>
      <label for="login-toggle">Войти</label>
      <input type="radio" id="signup-toggle" name="toggle" value="signup">
      <label for="signup-toggle">Регистрация</label>
    </div>
    <div class="container">
      <form id="login-form" class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="submit" name="login" value="Войти">
      </form>

      <form id="signup-form" class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="email" name="email" placeholder="Адрес электронной почты" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <select name="roles" id="role-select" required>
          <option value="">Выберите роль</option>
          <option value="artist">Автор</option>
          <option value="critic">Критик</option>
        </select>
        <input type="submit" name="register" value="Зарегистрироваться">
      </form>
    </div>
  </div>
  <footer>
    <a href="/dashboard">Личный кабинет</a>
    <a href="/gallery.php">Галерея</a>
  </footer>

  <?php
  session_start();
  if (isset($_SESSION["user_id"]) && isset($_SESSION["username"])) {
      
  }
  require_once 'auth.php';
  require_once 'register.php';

  if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['roles'];

    registerUser($username, $password, $email, $role);
  }

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    authenticateUser($username, $password);
  }
  ?>
</body>
<script>
  document.getElementById('login-toggle').addEventListener('click', () => {
    document.getElementById('login-form').style.display = 'flex';
    document.getElementById('signup-form').style.display = 'none';
  })

  document.getElementById('signup-toggle').addEventListener('click', () => {
    document.getElementById('signup-form').style.display = 'flex';
    document.getElementById('login-form').style.display = 'none';
  })
</script>

</html>