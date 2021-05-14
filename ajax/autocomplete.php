<?php

include_once(__DIR__ . "/../classes/User.php");

if (!empty($_POST)) {
    $users = User::searchUsers($_POST["value"]);

    $response = [
        'status' => 'success',
        'value' => $_POST["value"],
        'users' => $users,
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
