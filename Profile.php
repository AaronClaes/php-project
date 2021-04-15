<?php
include_once("bootstrap.php");
$conn = Db::getConnection();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.typekit.net/zbb0stp.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Profile.css">

    <title>Profile</title>

</head>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <img class="logo" src="img/gg-logo.png" alt="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Feed</a>
                <a class="nav-link" href="logout.php">Logout</a>

            </div>
        </div>
    </div>
</nav>

<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div id="content" class="content content-full-width">
            <div class="profile">
               <div class="profile-header">
                  <div class="profile-header-cover"></div>
                  <div class="profile-header-content">
                     <div class="profile-header-img">
                        <img src="https://tinyurl.com/abzdvtrz" alt="">
                     </div>
                     <div class="profile-header-info">
                        <h4 class="m-t-10 m-b-5">Schankah</h4>
                        <p class="m-b-10">Rank 5 - Backseat Gamer</p>
                     </div>

                  </div>
                  <ul class="profile-header-tab nav nav-tabs">
                     <li class="nav-item"><a href="#profile-post" class="nav-link active show" data-toggle="tab">EDIT Profile</a></li>
                  </ul>
                  
               </div>

                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">User info</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">About me</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer class="footer  text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">Aaron, Tommy, Elias</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>
</html>