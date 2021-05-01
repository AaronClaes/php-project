<?php
$tags = explode(",", $post['tags']);
$date = Post::time_elapsed_string($post['created']);
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
    <div class="post-comments-box">
        <hr class="line-small">
        <div class="comments">
            <div class="comment">
                <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt=""> <!-- Make picture of user that sent comment -->
                <div class="comment-box">
                    <div class="comment-box-info">
                        <h5 class="post-user"><?php echo $post['username'] ?></h5> <!-- Make username of user that sent comment -->
                        <h5 class="post-dot">•</h5>
                        <p class="post-date"><?php echo $date ?></p> <!-- Make date of comment ($date is the date the post was sent, dont use this) -->
                    </div>
                    <p class="comment-message">text</p>
                </div>
            </div>
        </div>
        <div class="post-comment">
            <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
            <input class="form-control form-border comment-input" name="comment" placeholder="Write a comment..."></input>
            <div><img class="comment-send" src="img/right-arrow.svg" alt=""></div>
        </div>
    </div>
</div>