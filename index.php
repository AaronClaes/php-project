<?php
include_once(__DIR__ . "/classes/Db.php");

$conn = Db::getConnection();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Contact</a>
        <a class="nav-link" href="#">Login</a>
        <a class="nav-link" href="#">About Us</a>
       
      </div>
    </div>
  </div>
</nav>
<body>
   <img class="hero-bg" src="https://i.pinimg.com/originals/4e/3d/c2/4e3dc23cab082329b06c4a793ce462a1.jpg" alt="">
   <div class="form">
<div>
  <label  class="formTitleEmail">Email address</label>
  <input type="email" class="formEmail"  placeholder="name@example.com">
</div>
<div>
  <label  class="formTitleUsername">Username</label>
  <input type="name" class="formusername"  placeholder="Username">
</div><div>
  <label  class="formTitlePassword">Password</label>
  <input type="password" class="formPassword"  placeholder="password">
</div>
</div>

</body>

</html>