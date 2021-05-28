<?php
include_once(__DIR__ . "/../bootstrap.php");

if (!empty($_POST)) {

    $like = new Like();
    $like->setPost_id($_POST["postId"]);
    $like->setUser_id($_SESSION["userId"]);

    $result = $like->checkLiked();

    if (empty($result)) {
        $like->saveLike();
        $action = "saved";
    } else {
        $like->setId($result[0]["id"]);
        $like->removeLike();
        $action = "removed";
    }

    $response = [
        'status' => 'like',
        'action' => $action
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
