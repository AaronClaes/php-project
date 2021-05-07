<?php
if (!empty($_GET['search'])) {
    try {
        $user = new User;
        $searchresult = $_GET['search'];
        $users = $user->searchusers($searchresult, $tags);
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
?>

<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top" aria-label="Second navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img class="logo" src="img/gg-logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <label>Search</label>
        <form action="search.php" method="GET">
            <input type="text" placeholder="Type the name here" name="search">&nbsp;
            <input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">
        </form>
        <div class="collapse navbar-collapse navbar-nav me-auto">
            <a href="logout.php" class="btn nav-btn"> Logout </a>
            <!-- <form data-np-checked="1">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search" data-np-checked="1">
            </form> -->
        </div>
    </div>
</nav>