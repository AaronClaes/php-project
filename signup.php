<?php

include_once("bootstrap.php");

if (!empty($_POST)) {
  try {
    $user = new User();
    $user->setEmail($_POST["email"]);
    $user->setFirstname($_POST["firstName"]);
    $user->setLastname($_POST["lastName"]);
    $user->setUsername($_POST["username"], "signup");
    $user->setPassword($_POST["password"], "signup");
    $user->save();
    session_start();
    $_SESSION["username"] = $user->getUsername();
    header("Location: index.php");
  } catch (\Throwable $th) {
    $error = $th->getMessage();
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 0px 6px grey;">
    <div class="container-fluid text-center ">
    <img class="logo" src="img/gg-logo.png" alt="logo">



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="justify-content: center; margin-left:-4%;">
            <div class="navbar-nav">
            <a class="nav-link " aria-current="page" href="home.php">Home</a>
            
                <a class="nav-link " aria-current="page" href="contact.php">Contact</a>
                
                <a class="nav-link " href="about.php">About Us</a>
                <a class="nav-link active" href="login.php">Login</a>
            </div>
        </div>
    </div>
</nav>

<body>
  <?php if (isset($error)) : ?>
    <div class="error">
      <h3><?php echo $error ?></h3>
    </div>
  <?php endif; ?>
  <form action="" method="POST">
    <div class="form-contact wrapper">

      
        <h2 class="formTitleEmail">Email:</h2>
      
      <input type="email" class="formEmail" name="email" placeholder="name@example.com">

    
        <h2 class="formTitleEmail">First Name:</h2>
      
      <input type="text" class="formFirstName" name="firstName" placeholder="First Name">

      <label class="formTitleLastName">
        <h2 class="formTitleEmail">Last Name:</h2>
      </label>
      <input type="text" class="formLastName" name="lastName" placeholder="Last Name">


      <label class="formTitleUsername">
        <h2 class="formTitleEmail">Username:</h2>
      </label>
      <input type="name" class="formUsername" name="username" placeholder="Username">

      <label class="formTitlePassword">
        <h2 class="formTitleEmail">Password:</h2>
      </label>
      <input type="password" class="formPassword" name="password" placeholder="password">

      <button type="submit" class="btn btn-mobile">Sign up</button>

    </div>
  </form>
  <div class="hero_bg2"></div>

  <footer class="footer bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
</body>

</html>