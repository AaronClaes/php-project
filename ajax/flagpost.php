<?php

include_once(__DIR__ . "/../classes/Post.php");

if (!empty($_POST)) {

    $post = new Post();
    $post->setPostId($_POST["postId"]);
    $post->flag();

    $response = [
        'status' => 'success',
        'message' => "post flagged"
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
