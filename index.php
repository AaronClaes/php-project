<?php
include_once("bootstrap.php");

try {
   $user = new User();
   $currentUserId = $_SESSION["userId"];
   $currentUser = $user->getLoggedUsername($currentUserId);
} catch (\Throwable $th) {
   $error = $th->getMessage();
}

function time_elapsed_string($datetime, $full = false)
{
   $now = new DateTime;
   $ago = new DateTime($datetime);
   $diff = $now->diff($ago);

   $diff->w = floor($diff->d / 7);
   $diff->d -= $diff->w * 7;

   $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
   );
   foreach ($string as $k => &$v) {
      if ($diff->$k) {
         $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
         unset($string[$k]);
      }
   }

   if (!$full) $string = array_slice($string, 0, 1);
   return $string ? implode(', ', $string) . ' ago' : 'just now';
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
      <div class="feed-container left">
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
         <div class="feed-container">
            <div class="new_post-box">
               <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
               <h2 class="new_post-box-title">Share an epic gamer moment!</h2>
               <a href="new_post.php" class="btn nav-btn">New post</a>
            </div>
         </div>
         <?php
         $feed = Post::getFeedPosts();
         foreach ($feed as $post) :  ?>
            <?php $date = time_elapsed_string($post['created']); ?>
            <div class="post feed-container">
               <div class="post-top">
                  <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
                  <div class="post-data">
                     <div class="post-data-top">
                        <h4 class="post-user"><?php echo $post['username'] ?></h4>
                        <h4 class="post-dot">•</h4>
                        <p class="post-date"><?php echo $date ?></p>
                     </div>
                     <p class="post-description"><?php echo $post['description'] ?></p>
                  </div>
               </div>
               <img class="post-img" src="<?php echo $post['image'] ?>" alt="">
            </div>
         <?php endforeach; ?>
      </div>
   </div>
</body>

</html>