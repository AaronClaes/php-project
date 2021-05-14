<?php
include_once("../bootstrap.php");
try {
    $user = new User();
    $currentUserId = $_SESSION["userId"];
    $currentUser = $user->getUserInfo($currentUserId);
 } catch (\Throwable $th) {
    $error = $th->getMessage();
 };
if(!empty($_POST)){
$c = new Comment();
$c->setPostId($_POST['postId']);
$c->setText($_POST['text']);
$c->setUserId($_SESSION["userId"]);






    $c->saveComment();
$response = [
    'status' => 'succes',
    'message' => 'Comment Saved',
    'text' => htmlspecialchars($c->getText()),
    'postId' => $_POST['postId'],
    'userId' => $_SESSION['userId'],
    'username' => $currentUser['username'],
    'image' => $currentUser['picture'],
    
    
   
];

    header('Content-Type: application/json');
    echo json_encode($response);

}


?>