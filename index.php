<?php
include_once("bootstrap.php");

$conn = Db::getConnection();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.typekit.net/zbb0stp.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <img class="logo" src="img/gg-logo.png" alt="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Contact</a>
        <a class="nav-link" href="#">Login</a>
        <a class="nav-link" href="#">About </a>

      </div>
    </div>
  </div>
</nav>

<body>
  <div class="form wrapper">

    <label class="formTitleEmail">
      <h1>Login</h1>
    </label>
    <input type="email" class="formEmail" placeholder="name@example.com">
    <input type="password" class="formPassword" placeholder="password">
    <div class="sign_up">
      <p>Nog geen account? <a href="sign_up.php">Maak er één aan</a></p>
    </div>
    <button type="button" class="btn btn-primary">Log in</button>

  </div>
  <div class="hero_bg"></div>

  <footer class="footer  text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/">Aaron, Tommy, Elias</a>
    </div>
    <!-- Copyright -->
  </footer>
</body>

</html>