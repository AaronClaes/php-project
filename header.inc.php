<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top" aria-label="Second navbar example">
    <div class="container-fluid nav-container">
        <a class="navbar-brand" href="index.php"><img class="logo" src="img/gg-logo.png" alt=""></a>
        <form class="searchbar" action="feed.php" method="GET">
            <div class="input-group" id="search">
                <select class="form-select form-border" id="search-select" aria-label="Floating label select example" name="search">
                    <option value="content" selected>Content</option>
                    <option value="tag">Tags</option>
                    <option value="location">Location</option>
                    <option value="user">Users</option>
                </select>
                <input type=" text" class="form-control form-border" id="searchbar" placeholder="Type the name here" name="query">&nbsp;
                <button class="btn btn-search" type="submit">Search</button>
            </div>
        </form>
        <div class="navbar-nav">
            <a href="logout.php" class="btn btn-nav"> Logout </a>
            <!-- <form data-np-checked="1">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search" data-np-checked="1">
            </form> -->
        </div>
    </div>
</nav>