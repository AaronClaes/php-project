<?php
$tags = explode(",", $post['tags']);
?>

<div class="post box-container">
    <div class="post-top">
        <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
        <div class="post-data">
            <div class="post-data-top">
                <h4 class="post-user"><?php echo $post['username'] ?></h4>
                <h4 class="post-dot">•</h4>
                <p class="post-date"><?php echo $date ?></p>
            </div>
            <p class="post-description"><?php echo $post['description'] ?></p>
        </div>
    </div>
    <?php if (!empty($tags)) : ?>
        <div class="post-tags">
            <?php foreach ($tags as $tag) : ?>
                <a href="">
                    <p class="post-tag"><?php echo $tag ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif;  ?>
    <img class="post-img" src="<?php echo $post['image'] ?>" alt="">
</div>