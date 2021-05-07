<?php
include_once("bootstrap.php");
$conn = Db::getConnection();
try {
    $user = new User();
    $otherUserid = $_GET["id"];
    $otherUser = $user->getUserInfo($otherUserid); 
} catch (\Throwable $th) {
    $error = $th->getMessage();
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>

<body>
    <?php include_once("header.inc.php") ?>
    <?php if (isset($error)) : ?>
        <div class="user-messages-area">
            <div class="alert alert-danger">
                <ul>
                    <li><?php echo $error ?></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <main>
        <div class="box-container">
            <div class="profile-box">
                <div class="profile-box-info">
                    <img class="profile-picture-big" src="<?php $otherUser["picture"] ?>" alt="profile picture">
                    <div class="profile-box-names">
                        <h1><?php echo htmlspecialchars($otherUser["username"]) ?></h1>
                        <h5><?php echo htmlspecialchars($otherUser["firstname"]) . " " .  htmlspecialchars($otherUser["lastname"]) ?></h5>
                    </div>
                </div>
                <p class="profile-box-description"><?php echo htmlspecialchars($otherUser["bio"]) ?></p>
            </div>
        </div>
        </div>
        <div class="profile-stats-container">
            <div class="box-container-medium ">
                <div class="profile-stats-box">
                    <h4><span>420</span> Posts</h4>
                    <h4><a href=""><span>420</span> Followers</a></h4>
                    <h4><a href=""><span>420</span> Following</a></h4>
                </div>
            </div>
            <div class="box-container-small">
                <div class="btn btn-profile-follow">Follow</div>
            </div>
        </div>
        </div>
    <div class="post box-container">
        <div class="new_post-box">
            <img class="profile-picture" src="<?php echo $otherUser["picture"] ?>" alt="profile picture">
            <h2 class="new_post-box-title">Share an epic gamer moment!</h2>
            <a href="new_post.php" class="btn nav-btn">New post</a>
        </div>
    </div>
    <?php
    $feed = Post::getUserPosts($otherUser["id"]);
    foreach ($feed as $post) :  ?>
        <?php include("post.inc.php") ?>
    <?php endforeach; ?>
    <script src="scripts/other_user.js"></script>
    <script src="scripts/post.js"></script>
</body>

</html>