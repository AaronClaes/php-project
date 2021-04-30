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
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 0px 6px grey;">
   <div class="container-fluid text-center ">
      <img class="logo" src="img/gg-logo.png" alt="logo">



      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="justify-content: center; margin-left:-4%;">
         <div class="navbar-nav">
            <a class="nav-link " aria-current="page" href="home.php">Home</a>

            <a class="nav-link active" aria-current="page" href="profile.php">profile</a>

            <a class="nav-link " href="about.php">About Us</a>
            <a class="nav-link" href="login.php">Login</a>
         </div>
      </div>
   </div>
</nav> -->

<body>
   <?php include_once("header.inc.php") ?>

   <!-- <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div id="content" class="content content-full-width">
               <div class="profile">
                  <div class="profile-header">
                     <div class="profile-header-cover"></div>
                     <div class="profile-header-content">
                        <div class="profile-header-img">
                           <img src="<?php echo $currentUser["picture"]; ?>" alt="ProfilePicture">
                        </div>

                        <div class="profile-header-info">
                           <h4 class="m-t-10 m-b-5"> <?php echo $_SESSION['username']; ?> </h4>
                           <p class="m-b-10">Rank 5 - Backseat Gamer</p>
                        </div>

                     </div>
                     <ul class="profile-header-tab nav nav-tabs">
                        <li class="nav-item"><a href="#" class="nav-link active show" data-toggle="tab">POSTS</a></li>
                        <li class="nav-item"><a href="#" class="nav-link" data-toggle="tab">FRIENDS</a></li>
                        <li class="nav-item"><a href="#" class="nav-link" data-toggle="tab">ABOUT</a></li>
                        <li class="nav-item"><a href="#" class="nav-link" data-toggle="tab">SCREENSHOTS</a></li>
                        <li class="nav-item"><a href="#" class="nav-link" data-toggle="tab">SCREENCAPTURES</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
   <?php

   $posts = new Post;
   $posts->setUserId($_SESSION["userId"]);
   $feed = $posts->getFeedPosts();


   foreach ($feed as $post) :  ?>
      <div class="post container-box">
         <div class="post-top">
            <img class="post-profile_picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
            <div class="post-data">
               <div class="post-data-top">
                  <h4 class="post-user"><?php echo $post['username'] ?></h4>
                  <h4 class="post-dot">•</h4>
                  <p class="post-date"><?php echo $post['created'] ?></p>
               </div>
               <p class="post-description"><?php echo $post['description'] ?></p>
            </div>
         </div>
         <img class="post-img" src="<?php echo $post['image'] ?>" alt="">
      </div>
   <?php endforeach; ?>
</body>

</html>