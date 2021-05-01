<?php
include_once("bootstrap.php");

try {
   $user = new User();
   $currentUserId = $_SESSION["userId"];
   $currentUser = $user->getLoggedUsername($currentUserId);
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
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://use.typekit.net/zbb0stp.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/index.css">
   <title>Feed</title>

</head>

<body>
   <?php include_once("header.inc.php") ?>
   <div class="index-feed">
      <div class="box-container left">
         <div class="left-link">
            <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="">
            <h3><a href="profile.php"><?php echo $currentUser["username"] ?></a></h3>
         </div>
         <div class="left-link left-link-middle">
            <img class="left-link-follow" src="img/follow.svg" alt="">
            <h3><a href="profile.php">Volgers</a></h3>
         </div>
         <div class="left-link">
            <img class="left-link-follow" src="img/follow.svg" alt="">
            <h3><a href="profile.php">Likes</a></h3>
         </div>
      </div>
      <div class="right">
         <div class="box-container">
            <div class="new_post-box">
               <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
               <h2 class="new_post-box-title">Share an epic gamer moment!</h2>
               <a href="new_post.php" class="btn nav-btn">New post</a>
            </div>
         </div>
         <?php
         $feed = Post::getFeedPosts();
         foreach ($feed as $post) :  ?>
            <?php include("post.inc.php") ?>
         <?php endforeach; ?>
      </div>
   </div>
</body>

</html>