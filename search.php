
<?php
include_once("bootstrap.php");
if (!empty($_GET['search'])) {
    try {
        $user = new User;
        $searchresult = $_GET['search'];
        $searchtags = $_GET['search'];
       $users = $user->searchusers($searchresult);
    $tags = $user->searchtags($searchtags);
        
    }catch (\Throwable $th) {
        $error = $th->getMessage();
    }
} 

?>
<!DOCTYPE html>
<html>
<head>
<title>Basic Search form using mysqli</title>
<link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<label>Search</label>
<form action="search.php" method="GET">
<input type="text" placeholder="Type the name here" name="search">&nbsp;
<input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">
</form>
<h2>List of students</h2>



</table>
</div>
<?php

if( isset($users) ){
foreach($users as $searchresult):  ?>


   
   <a href="profile.php?id= <?php echo $searchresult['username']; ?>" ><?php echo $searchresult['username']; ?></a>
   
   
<?php  endforeach;} ?>
<?php
var_dump($searchresult);
var_dump($searchtags);
if( isset($tags) ){
foreach($tags as $searchtags):  ?>


   
   <a href="profile.php?id= <?php echo $searchtags['tags']; ?>" ><?php echo $searchtags['tags']; ?></a>
   
   
<?php  endforeach;} ?>
</body>
</html>