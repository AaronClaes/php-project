<?php
include_once("bootstrap.php");

if (!empty($_POST)) {
    try {
        $post = new Post();
        $post->setUserId("1234"); //TODO temp id until merge with branch Tommy for getloggeduser function
        $post->setDescription($_POST["description"]);
        $post->setTags($_POST["tags"]);
        $post->saveImage($_FILES["image"]["name"]);
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
    <link rel="stylesheet" href="css/new_post.css">
</head>

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
        <h1>Create a new post</h1>
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
            </div>
            <div class="previewImage">

            </div>
            <button type="submit" class="btn">Post</button>
        </form>
    </div>

    <script src="scripts/new_post.js"></script>
</body>

</html>