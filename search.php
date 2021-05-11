
<?php
include_once("bootstrap.php");
 
if (!empty($_GET['search'])) {
    try {
        $user = new User;
        $tag = new Post;
        $searchresult = $_GET['search'];
        $searchtags = $_GET['search'];
        $searchLocation = $_GET['search'];
       $users = $user->searchusers($searchresult);
       $location = $tag->searchLocation($searchLocation);
    $tags = $tag->searchtags($searchtags);
        
    }catch (\Throwable $th) {
        $error = $th->getMessage();
    }
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
<body>
<div class="container">
<label>Search</label>

<?php include_once("header.inc.php") ?>
</form>
<h2>Users</h2>



</table>
</div>
<?php

if( isset($users) ){
foreach($users as $searchresult):  ?>


   
   <a href="profile.php?id= <?php echo $searchresult['username']; ?>" ><?php echo $searchresult['username']; ?></a>
   
   
<?php  endforeach;} ?>
<?php
var_dump($location);
if( isset($tags) ){
foreach($tags as $searchtags):  ?>


   
    <a href="feed.php?search=tag&query=<?php echo $searchtags['tags']; ?>"><?php echo $searchtags['tags']; ?></a>
   
 
<?php  endforeach;} ?>
<?php

if( isset($location) ){
foreach($location as $searchLocation):  ?>


   
    <a href="feed.php?search=location&query=<?php echo $searchLocation['location']; ?>"><?php echo $searchLocation['location']; ?></a>
   
 
<?php  endforeach;} ?>

</body>
</html>