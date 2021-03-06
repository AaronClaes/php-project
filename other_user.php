<?php
include_once("bootstrap.php");
$conn = Db::getConnection();
try {

    $user = new User();
    $otherUserid = $_GET["id"];
    $otherUser = $user->getUserInfo($otherUserid);
    $currentUserid = $_SESSION["userId"];
    $currentUser = $user->getUserInfo($currentUserid);
    $feed = Post::getUserPosts($otherUser["id"]);
    $allFollowing = Follower::getAllFollowing($otherUserid);
    $allFollowers = Follower::getAllFollowers($otherUserid);

    $follower = new Follower();
    $follower->setUser_Id($currentUserid);
    $follower->setFollower_id($otherUserid);
    $check = $follower->checkFollowed();

    if (!empty($check)) {
        $followedId = $check[0]["id"];
    } else {
        $followedId = " ";
    }

    //var_dump($follower->checkFollowed());

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
                    <?php if (!empty($otherUser["picture"])) : ?>
                        <img class="profile-picture-big" src="<?php echo $otherUser["picture"] ?>" alt="profile picture">
                    <?php endif; ?>

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
                    <h4><span><?php echo count($feed) ?></span> Posts</h4>
                    <h4><span><?php echo count($allFollowers) ?></span> Followers</h4>
                    <h4><span><?php echo count($allFollowing) ?></span> Following</h4>
                </div>
            </div>
            <div class="box-container-small">
                <div class="btn btn-profile-follow" data-followid="<?php echo $followedId ?>" data-followedUser="<?php echo $otherUser['id'] ?>"><?php echo $followedId !== " "  ? "Unfollow" : "Follow" ?></div>
            </div>
        </div>
        </div>
        <?php

        foreach ($feed as $post) :  ?>
            <?php include("post.inc.php") ?>
        <?php endforeach; ?>
        <script src="scripts/other_user.js"></script>
        <script src="scripts/post.js"></script>
        <script src="scripts/comments.js"></script>
</body>

</html>