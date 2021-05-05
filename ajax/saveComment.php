<?php
include_once(__DIR__. "../classes/Comment.php");

if(!empty($_POST)){
$c = new Comment();
$c->setPostId($_POST['postId']);
$c->setText($_POST['text']);
$c->setUserId($_SESSION["userId"]);

    $c->saveComment();
$response = [
    'status' => 'succes',
    'message' => 'Comment Saved',
    'body' => htmlspecialchars($c->getText()),
    
];

    header('Conten-Type; application/json');
    echo json_encode($response);

}


?>