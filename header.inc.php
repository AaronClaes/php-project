<?php
if (isset($_SESSION["userId"])) {
    $loggedIn = true;
    $buttonText = "Logout";
    $buttonValue = "";
}
if (preg_match('(signup.php)', $_SERVER['SCRIPT_NAME'])) {
    $buttonText = "Login";
    $buttonValue = "login.php";
} else if ((preg_match('(login.php)', $_SERVER['SCRIPT_NAME']))) {
    $buttonText = "Sign up";
    $buttonValue = "signup.php";
} else ($buttonValue = "login.php")

?>

<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top" aria-label="Second navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img class="logo" src="img/gg-logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-nav me-auto">
            <?php if ($loggedIn) :  ?>
                <a href=<?php echo $buttonValue ?> class="btn nav-btn"> <?php echo $buttonText ?></a>
            <?php endif; ?>
            <?php if (!$loggedIn) :  ?>
                <a href=<?php echo $buttonValue ?> class="btn nav-btn"><?php echo $buttonText ?></a>
            <?php endif; ?>
            <!-- <form data-np-checked="1">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search" data-np-checked="1">
            </form> -->
        </div>
    </div>
</nav>