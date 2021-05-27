<?php
include_once("bootstrap.php");
$conn = Db::getConnection();
try {
    $user = new User();
    $currentUserId = $_SESSION["userId"];
    $currentUser = $user->getUserInfo($currentUserId);

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
        if (!empty($_FILES["profilePicture"]["name"])) {
            $profilePicture = $user->uploadProfilePicture($_FILES["profilePicture"]["name"]);
            $user->setPicture($profilePicture);
        } else {
            $user->setPicture($currentUser["picture"]);
        }

        // Password Verification  --HIER NIKS ONDER ZETTE!
        $user->setPassword($_POST["passwordConfirm"]);
        $user->verifyPassword($currentUser['id']);

        if (!empty($_POST["password"])) {
            $user->setPassword($_POST["password"]);
            $newPassword = $user->hashPassword();
            $user->updatePassword($currentUser['id']);
        }
        // User updates
        $user->updateInfo($currentUser['id']);

        $currentUser = $user->getUserInfo($currentUserId); //---Updated User Fetch---
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
    <link rel="stylesheet" href="css/styles.css">
    <title>Profile</title>
</head>

<body>
    <?php include_once("header.inc.php") ?>
    <?php if (isset($error)) : ?>
        <div class="user-messages-area">
            <div class="alert alert-danger">
                <ul>
                    <li><?php echo $error ?></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <main>
        <div class="box-container">
            <div class="profile-box">
                <div class="profile-box-info">
                    <?php if (!empty($currentUser["picture"])) : ?>
                        <img class="profile-picture-big" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
                    <?php endif; ?>
                    <div class="profile-box-names">
                        <h1><?php echo htmlspecialchars($currentUser["username"]) ?></h1>
                        <h5><?php echo htmlspecialchars($currentUser["firstname"]) . " " .  htmlspecialchars($currentUser["lastname"]) ?></h5>
                    </div>
                </div>
                <p class="profile-box-description"><?php echo htmlspecialchars($currentUser["bio"]) ?></p>
            </div>
        </div>
    </div>
        <div class="profile-stats-container">
            <div class="box-container-medium ">
                <div class="profile-stats-box">
                    <h4><span>420</span> Posts</h4>
                    <h4><a href=""><span>420</span> Followers</a></h4>
                    <h4><a href=""><span>420</span> Following</a></h4>
                </div>
            </div>
            <div class="box-container-small">
                <div class="btn btn-profile-edit">Edit</div>
            </div>
        </div>
        </div>
        <div class="box-container edit-container hidden">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-row form-spacing">
                    <div class="mb-3">
                        <label class="form-label" for=" profilePicture">Edit Profilepicture</label>
                        <input type="file" class="form-control form-border" name="profilePicture" id="profilePicture">
                        <small class="form-text text-muted" for="removeProfilePicture">Do you want to remove your current profile picture?</small>
                        <input type="checkbox" name="removeProfilePicture" id="removeProfilePicture">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="Username">Edit Username</label>
                        <input type="text" class="form-control form-border" name="username" id="Username" placeholder="Username" value=<?php echo htmlspecialchars($currentUser['username']); ?>>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="Firstname">Edit Firstname</label>
                        <input type="text" class="form-control form-border" name="firstname" id="Firstname" placeholder="Firstname" value=<?php echo htmlspecialchars($currentUser['firstname']); ?>>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="Email">Edit Email</label>
                        <input type="email" class="form-control form-border" name="email" id="Email" placeholder="Email" value=<?php echo htmlspecialchars($currentUser['email']); ?>>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="Lastname">Edit Lastname</label>
                        <input type="text" class="form-control form-border" id="Lastname" name="lastname" placeholder="Lastname" value=<?php echo htmlspecialchars($currentUser['lastname']); ?>>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="Description">Edit Description</label>
                        <textarea class="form-control form-border" id="Description" name="description" placeholder="Description" rows="3" cols="50"><?php echo htmlspecialchars($currentUser['bio']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Edit Password</label>
                        <input type="password" class="form-control form-border" name="password" id="password">
                    </div>
                    <hr class="line">
                    <div class="mb-3">
                        <label class="form-label" for="passwordConfirm">Confirm Password</label>
                        <input type="password" class="form-control form-border" id="passwordConfirm" name="passwordConfirm" required>
                        <small id="passwordHelpBlock" class="form-text text-muted">please verify by entering your current password</small>
                    </div>
                    <button type="submit" class="w-100 btn btn-lg">Update</button>
            </form>
        </div>
    </main>
    <div class="post box-container">
        <div class="new_post-box">
            <?php if (!empty($currentUser["picture"])) : ?>
                <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
            <?php endif; ?>
            <h2 class="new_post-box-title">Share an epic gamer moment!</h2>
            <a href="new_post.php" class="btn nav-btn">New post</a>
        </div>
    </div>
    <?php if (isset($_POST["RemoveProfilePicture"])){
        Echo "Profilepicture delete";
    } ?>

    <?php
    $feed = Post::getUserPosts($_SESSION["userId"]);
    foreach ($feed as $post) :  ?>
        <?php include("post.inc.php") ?>
    <?php endforeach; ?>
    <script src="scripts/profile.js"></script>
    <script src="scripts/post.js"></script>
    <script src="scripts/comments.js"></script>
</body>

</html>