<?php
include_once("bootstrap.php");



if (!empty($_POST)) {
    try {
        $user = new User();

        $user->setUsername($_POST["username"], "login");
        $user->setPassword($_POST["password"], "login");
        $user->login();
        session_start();
        $_SESSION["username"] = $user->getUsername();
        var_dump($_SESSION["username"]);
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
    <link rel="stylesheet" href="https://use.typekit.net/zbb0stp.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark" style="box-shadow: 0px 0px 6px grey; background-color:#1d1d1b;">
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

<body style="background-color: #23272a;">
    <div class="form wrapper">
        <?php if (isset($error)) : ?>
            <div class="user-messages-area">
                <div class="alert alert-danger">

                    <ul>
                        <li><?php echo $error ?></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
 <div class="hero_bg">
        <form action="" method="POST">

            <h1 class="formTitleEmail">Username</h1>
            <input type="text" class="formEmail" name="username" placeholder="username">
            <h1 class="formTitleEmail">Password</h1>
            <input type="password" name="password" class="formPassword" placeholder="password">
            <div class="sign_up">
                <p id="MA-text">Nog geen account? <a href="signup.php">Maak er één aan</a></p>
            </div>
            <button type="submit" class="btn  btn-mobile">Log in</button>

    </div>
    </form>
   </div>

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