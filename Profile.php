<?php
include_once("bootstrap.php");
$conn = Db::getConnection();
try {
    $user = new User();
    $currentUserId = $_SESSION["userId"];
    $currentUser = $user->getLoggedUsername($currentUserId);

        // Update User INFO

    if (!empty($_POST)) {
        $user->setUsername($_POST['username']);
        if ($_POST['username'] !== $currentUser["username"]) {
            $user->checkUsername();
        }
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        if ($_POST['email'] !== $currentUser["email"]) {
            $user->checkEmail();
        }
        $user->setDescription($_POST['description']);

        
        // picture upload
        $profilePicture = $user->uploadProfilePicture($_FILES["profilePicture"]["name"]);
        $user->setPicture($profilePicture);

        // Password Verification  --HIER NIKS ONDER ZETTE!

        $user->setPassword($_POST["passwordConfirm"]);
        $user->verifyPassword($currentUser['id']);
        $user->setPassword($_POST["password"]);
        $newPassword = $user->hashPassword();

        // User updates
        $user->updateInfo($currentUser['id']);
        $user->updatePassword($currentUser['id']);
        
        $currentUser = $user->getLoggedUsername($currentUserId); //---Updated User Fetch---
    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
}

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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">

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

        <?php if (isset($error)) : ?>
            <div class="user-messages-area">
                <div class="alert alert-danger">

                    <ul>
                        <li><?php echo $error ?></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="content" class="content content-full-width">
                    <div class="profile">
                        <div class="profile-header">
                            <div class="profile-header-cover"></div>
                            <div class="profile-header-content">
                                <div class="profile-header-img">
                                    <img src= "<?php echo $currentUser["picture"];?>" alt="ProfilePicture">
                                </div>
                                <div class="profile-header-info">
                                    <h4 class="m-t-10 m-b-5"><?php echo $currentUser['username']; ?></h4>
                                    <p class="m-b-10"><?php echo $currentUser['email']; ?></p>
                                </div>
                            </div>   
                            <ul class="profile-header-tab nav nav-tabs">
                                <li class="nav-item"><a href="#profile-post" class="nav-link active show" data-toggle="tab">EDIT Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
        <div class="container">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-row form-spacing">
                    <div class="form-group col-md-6">
                        <label for="Username">Edit Username</label>
                        <input type="text" class="form-control" name="username" id="Username" placeholder="Username" value=<?php echo $currentUser['username']; ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Firstname">Edit Firstname</label>
                        <input type="text" class="form-control" name="firstname" id="Firstname" placeholder="Firstname" value=<?php echo $currentUser['firstname']; ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Email">Edit Email</label>
                        <input type="email" class="form-control" name="email" id="Email" placeholder="Email" value=<?php echo $currentUser['email']; ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Lastname">Edit Lastname</label>
                        <input type="text" class="form-control" id="Lastname" name="lastname" placeholder="Lastname" value=<?php echo $currentUser['lastname']; ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Description">Edit Description</label>
                        <textarea class="form-control" id="Description" name="description" placeholder="Description" rows="4" cols="50"></textarea>
                    </div>
                    <div class="col-md-6 align-items-start">
                        <label for="profilePicture" class="form-label">Upload or update your profilepicture</label>
                        <input type="file" class="form-control form-border" name="profilePicture" id="profilePicture" onchange="getpicture(this);">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Edit Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <small id="passwordHelpBlock" class="form-text text-muted">fill in your current password if you dont want to change it</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="passwordConfirm">Confirm Password</label>
                        <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" required>
                        <small id="passwordHelpBlock" class="form-text text-muted">please verify by entering your current password</small>
                    </div>
                    <button type="submit" class="btn btn-secondary">Edit</button>
            </form>
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