<?php
spl_autoload_register(function () {
    include_once("classes/Comment.php");
    include_once("classes/Db.php");
    include_once("classes/Post.php");
    include_once("classes/User.php");
});


if (isset($_SESSION["username"]) || preg_match('(signup.php|login.php)', $_SERVER['SCRIPT_NAME'])) {
} else {
    header("Location: signup.php");
}
