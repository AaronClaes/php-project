<?php
include_once("bootstrap.php");

try {
    $user = new User();
    $currentUserId = $_SESSION["userId"];
    $currentUser = $user->getUserInfo($currentUserId);
    $post = new Post();
    $inappropriatePost = $post->getflag();

    if($currentUser["admin"] != 1){
        header("Location: index.php");
    }
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
<link rel="stylesheet" href="css/index.css">
<title>Feed</title>
</head>

<body>
    <?php include_once("header.inc.php") ?>
    <?php



    ?>
    <div class="right">
        <div class="box-container">
            <div class="new_post-box">
                <h2 class="new_post-box-title">Results for inappropriate:</h2>
            </div>
                            
            <?php foreach ($inappropriatePost as $post):?>
                <ul>
                    <li> <img src="<?php echo $post["image"]?>" alt=""> </li>
                    <li><p class="post-description">Description: <?php echo $post["description"]?></p>  </li>
                </ul>
                <?php endforeach; ?>
        </div>
    </div>
    </div>
    <script src="scripts/post.js"></script>
</body>

</html>