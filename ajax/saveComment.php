<?php
include_once("../bootstrap.php");

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
   
];

    header('Content-Type: application/json');
    echo json_encode($response);

}


?>