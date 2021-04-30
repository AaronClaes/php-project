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
} else  ($buttonValue = "login.php");

if (!empty($_GET['search'])) {
    try {
        $user = new User;
        $searchresult = $_GET['search'];
       $users = $user->searchusers($searchresult);
        
        var_dump($searchresult);
        var_dump($user['firstname']);
    }catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
?>

<nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="logo" src="img/gg-logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <label>Search</label>
<form action="search.php" method="GET">
<input type="text" placeholder="Type the name here" name="search">&nbsp;
<input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">
</form>
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