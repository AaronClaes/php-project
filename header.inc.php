<?php
if (!empty($_GET['search'])) {
    try {
        $user = new User;
        $currentUserId = $_SESSION["userId"];
        $currentUser = $user->getUserInfo($currentUserId);
        $searchresult = $_GET['search'];
        $users = $user->searchusers($searchresult, $tags);
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
?>

<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top" aria-label="Second navbar example">
    <div class="container-fluid nav-container">
        <a class="navbar-brand" href="index.php"><img class="logo" src="img/gg-logo.png" alt=""></a>
        <form autocomplete="off" class="searchbar" action="feed.php" method="GET">
            <div class="input-group" id="search">
                <select class="form-select form-border" id="search-select" aria-label="Floating label select example" name="search">
                    <option value="content" selected>Content</option>
                    <option value="tag">Tags</option>
                    <option value="location">Location</option>
                    <option value="user">Users</option>
                </select>
                <input type=" text" class="form-control form-border search-input" id="searchbar" placeholder="Type your query here" name="query">&nbsp;
                <ul class="autocomplete-box hidden">
                    <li>
                        <h6>test</h6>
                    </li>
                    <li>
                        <h6>test</h6>
                    </li>
                    <li>
                        <h6>test</h6>
                    </li>
                </ul>
                <button class="btn btn-search" type="submit">Search</button>
            </div>
        </form>
        <div class="navbar-nav">
            <a href="logout.php" class="btn nav-btn"> Logout </a>
            <?php if ($currentUser["admin"] != 0) : ?>
                <a href="adminControl.php" class="btn"> Control Panel </a>
            <?php endif ?>
        </div>
    </div>
</nav>
<script src="scripts/header.js"></script>