<?php
include_once("bootstrap.php");

try {
    $user = new User();
    $currentUserId = $_SESSION["userId"];
    $currentUser = $user->getUserInfo($currentUserId);
} catch (\Throwable $th) {
    $error = $th->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/zbb0stp.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="css/styles.css">
<title>Feed</title>
</head>

<body>
    <?php include_once("header.inc.php") ?>
    <div class="right">
        <div class="box-container">
            <div class="new_post-box">
                <?php if ((empty($_GET["query"])) || (empty($_GET["search"]))) : ?>
                    <h2 class="new_post-box-title">No search term or type specified</h2>
                <?php else : ?>
                    <h2 class="new_post-box-title">Results for: <?php echo htmlspecialchars($_GET["query"]) ?> </h2>
                <?php endif; ?>
            </div>
        </div>
        <?php
        if ((!empty($_GET["query"])) || (!empty($_GET["search"]))) :
            switch ($_GET["search"]) {
                case 'tag':
                    $feed = Post::getPostsByTag($_GET["query"]);
                    break;
                case 'content':
                    $feed = Post::getPostsByContent($_GET["query"]);
                    break;
                case 'location':
                    $feed = Post::getPostsByLocation($_GET["query"]);
                    break;
                case 'user':
                    $users = User::searchUsers($_GET["query"]);
                    break;
                default:
                    # code...
                    break;
            };
            if (isset($feed)) {
                $i = 0;
                foreach ($feed as $i => $post) :
                    if ($i == 2) {
                        break;
                    }
                    include("post.inc.php");
                    $i++;
                endforeach;
            }
            if (isset($users)) :
                foreach ($users as $user) : ?>
                    <div class="box-container">
                        <div class="new_post-box">
                            <?php if (!empty($user["picture"])) : ?>
                                <img class="profile-picture" src="<?php echo $user["picture"] ?>" alt="profile picture">
                            <?php endif; ?>
                            <h2 class="new_post-box-title"><a href="other_user.php?id=<?php echo $user["id"] ?>"> <?php echo htmlspecialchars($user["username"]) ?> </a></h2>
                            <a href="other_user.php?id=<?php echo $user["id"] ?>" class="btn nav-btn">Checkout user</a>
                        </div>
                    </div>
                <?php endforeach; ?>
        <?php endif;
        endif; ?>
    </div>
    </div>
    <script src="scripts/post.js"></script>
    <script src="scripts/comments.js"></script>
</body>

</html>