<?php
include_once("bootstrap.php");

if (!empty($_POST)) {
    try {
        $post = new Post();
        $post->setUserId($_SESSION["userId"]);
        $post->setDescription($_POST["description"]);
        $tags = $post->cleanupTags($_POST["tags"]);
        $post->setTags($tags);
        $type = $_POST["selectedFilter"];
        $image = $post->saveImage($_FILES["image"]["name"], $type);
        $post->setImage($image);
        if (!empty($_POST["location"])) {
            $post->setLocation($_POST["location"]);
        }
        $post->save();
        header("Location: profile.php");
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/new_post.css">
</head>

<body>
    <?php include_once("header.inc.php"); ?>
    <?php if (isset($error)) : ?>
        <div class="user-messages-area">
            <div class="alert alert-danger">

                <ul>
                    <li><?php echo $error ?></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <div class="box-container">
        <h1 class="form-title">Create a new post</h1>
        <form enctype="multipart/form-data" method="POST">
            <div class="mb-3">
                <label for="postDescription" class="form-label">Description</label>
                <textarea class="form-control form-border" id="postDescription" name="description" placeholder="Give your post a description" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="postTags" class="form-label">Tags</label>
                <input type="text" class="form-control form-border" id="postTags" name="tags" placeholder='Separate tags with a comma' />
            </div>
            <div class="mb-3">
                <label for="postImage" class="form-label">Image</label>
                <input type="file" class="form-control form-border" name="image" id="postImage" onchange="getImage(this);" />
                <small>Upload a .png if you want to apply filters</small>
            </div>
            <div class="postFilters hidden">
                <div class="filter">
                    <img src="" alt="normal">
                    <h6>normal</h6>
                </div>
                <div class="filter">
                    <img src="" alt="negate" data-type="IMG_FILTER_NEGATE">
                    <h6>negate</h6>
                </div>
                <div class="filter">
                    <img src="" alt="gray scale" data-type="IMG_FILTER_GRAYSCALE">
                    <h6>gray scale</h6>
                </div>
                <div class="filter">
                    <img src="" alt="warm" data-type="IMG_FILTER_COLORIZE">
                    <h6>warm</h6>
                </div>
                <div class="filter">
                    <img src="" alt="emboss" data-type="IMG_FILTER_EMBOSS">
                    <h6>emboss</h6>
                </div>

            </div>
            <div class="hidden">
                <input type="text" name="selectedFilter" class="selectedFilter">
                <input type="text" name="location" class="location">
            </div>
            <div class="previewImage"></div>

            <button type="submit" class="w-100 btn btn-lg submit">Post</button>
        </form>
    </div>

    <script src="scripts/new_post.js"></script>
</body>

</html>