<?php
include_once("bootstrap.php");
$tags = explode(",", $post['tags']);
$date = Post::time_elapsed_string($post['created']);
$allComments = Comment::getAllComments($post["postId"]);
$allLikes = Like::getAllLikesOnPost($post["postId"]);

$like = new Like();
$like->setPost_id($post["postId"]);
$like->setUser_id($_SESSION["userId"]);
$result = $like->checkLiked();
?>

<div class="post box-container">
    <!-- USER & DESCRIPTION -->
    <div class="post-top">
        <?php if (empty(!$post["picture"])) : ?>
            <img class="profile-picture" src="<?php echo htmlspecialchars($post["picture"]) ?>" alt="profile picture">
        <?php endif; ?>
        <div class="post-data">
            <div class="post-data-top">

                <h4 class="post-user"><a href="other_user.php?id=<?php echo $post["id"] ?>"> <?php echo htmlspecialchars($post['username']) ?></a></h4>
                <h4 class="post-dot">•</h4>
                <p class="post-date"><?php echo $date ?></p>
            </div>
            <p class="post-description"><?php echo htmlspecialchars($post['description'])  ?></p>
        </div>
        <div class="btn-group dropend post-dropdown-button">
            <div class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <h1>&#8942;</h1>
            </div>
            <div class="dropdown-menu">
                <?php if ($post["user_id"] !== $currentUser["id"]) : ?>
                    <li data-postid="<?php echo htmlspecialchars($post['postId']) ?>" class="dropdown-item inappropriate" href="#">Flag inappropriate</li>
                <?php endif; ?>

                <?php if ($post["user_id"] === $currentUser["id"]) : ?>
                    <li data-postid="<?php echo htmlspecialchars($post['postId']) ?>" class="dropdown-item delete" href="#">Delete post</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- TAGS -->
    <?php if (!empty($tags)) : ?>
        <div class="post-tags">
            <?php foreach ($tags as $tag) : ?>
                <a href="feed.php?search=tag&query=<?php echo $tag ?>">
                    <p class="post-tag"><?php echo htmlspecialchars($tag) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif;  ?>

    <!-- IMAGE -->
    <img class="post-img" src="<?php echo $post['image'] ?>" alt="">
    <div class="post-buttons">
        <div data-postid="<?php echo htmlspecialchars($post['postId']) ?>" class=" post-like post-button">
            <svg style="fill:<?php echo !empty($result) ? "#fd3939" : "#7a7f84" ?>" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 572.87 571.59">
                <path class="cls-1" d="M248.66,388.33A74.58,74.58,0,0,1,234,402.17a76.86,76.86,0,0,1-18.39,9.74,52.87,52.87,0,0,1-18.16,3.67H63.28a42.41,42.41,0,0,1-17.09-3.67,55.27,55.27,0,0,1-15.14-9.74,43.43,43.43,0,0,1-10.38-13.84,26.87,26.87,0,0,1-2.38-16l27.25-173a34.14,34.14,0,0,1,7.57-16,74.87,74.87,0,0,1,14.71-13.84A78.74,78.74,0,0,1,86,159.69,52.07,52.07,0,0,1,104.38,156h186l-8.65,54.07H126.44a19.89,19.89,0,0,0-11.25,3.47q-5.19,3.47-6.91,13L89.67,345.07q-1.74,9.51,2.6,13a16,16,0,0,0,10.38,3.47h74.41a19.86,19.86,0,0,0,10.17-4.11q5-3.67,6.27-12.33l2.59-17.31q1.72-9.51-2.59-13a16.16,16.16,0,0,0-10.38-3.46h-39.8L152,257.24h70.52a43.08,43.08,0,0,1,16.87,3.68,54.79,54.79,0,0,1,15.36,9.73A43.84,43.84,0,0,1,265.1,284.5a26.87,26.87,0,0,1,2.38,16l-11.25,71.81A34,34,0,0,1,248.66,388.33Z" />
                <path class="cls-1" d="M513.43,388.33a74.3,74.3,0,0,1-14.71,13.84,76.68,76.68,0,0,1-18.39,9.74,52.87,52.87,0,0,1-18.16,3.67H328.05A42.45,42.45,0,0,1,311,411.91a55.27,55.27,0,0,1-15.14-9.74,43.58,43.58,0,0,1-10.38-13.84,26.87,26.87,0,0,1-2.38-16l27.25-173a34.14,34.14,0,0,1,7.57-16,74.87,74.87,0,0,1,14.71-13.84,78.74,78.74,0,0,1,18.18-9.73A52.11,52.11,0,0,1,369.15,156h186l-8.65,54.07H391.21A19.89,19.89,0,0,0,380,213.55q-5.19,3.47-6.91,13L354.44,345.07q-1.74,9.51,2.6,13a16,16,0,0,0,10.38,3.47h74.41A19.86,19.86,0,0,0,452,357.4q5-3.67,6.27-12.33l2.59-17.31q1.72-9.51-2.59-13a16.16,16.16,0,0,0-10.38-3.46h-39.8l8.65-54.08h70.52a43.08,43.08,0,0,1,16.87,3.68,54.79,54.79,0,0,1,15.36,9.73,43.84,43.84,0,0,1,10.38,13.85,26.87,26.87,0,0,1,2.38,16L521,372.32A34,34,0,0,1,513.43,388.33Z" />
            </svg>
            <p><?php echo count($allLikes) ?></p>
        </div>
        <div class="post-comments post-button">
            <svg height="682pt" viewBox="-21 -47 682.66669 682" width="682pt" xmlns="http://www.w3.org/2000/svg">
                <path d="m552.011719-1.332031h-464.023438c-48.515625 0-87.988281 39.472656-87.988281 87.988281v283.972656c0 48.421875 39.300781 87.824219 87.675781 87.988282v128.871093l185.183594-128.859375h279.152344c48.515625 0 87.988281-39.472656 87.988281-88v-283.972656c0-48.515625-39.472656-87.988281-87.988281-87.988281zm-83.308594 330.011719h-297.40625v-37.5h297.40625zm0-80h-297.40625v-37.5h297.40625zm0-80h-297.40625v-37.5h297.40625zm0 0" />
            </svg>
            <p><?php echo count($allComments) ?></p>
        </div>
    </div>
    <div class="post-comments-box post hidden">
        <hr class="line-small">
        <!-- COMMENTS -->

        <div class="comments">
            <?php foreach ($allComments as $c) : ?>
                <?php $dateComment = Comment::time_elapsed_string($c['created']); ?>
                <div class="comment">
                    <?php if (!empty($c["picture"])) : ?>
                        <img class="profile-picture" src="<?php echo $c["picture"] ?>" alt=""> <!-- Make picture of user that sent comment -->
                    <?php endif; ?>
                    <div class="comment-box">
                        <div class="comment-box-info">
                            <h5 class="post-user"><?php echo htmlspecialchars($c['username']) ?></h5> <!-- Make username of user that sent comment -->
                            <h5 class="post-dot">•</h5>
                            <p class="post-date"><?php echo $dateComment ?></p> <!-- Make date of comment ($date is the date the post was sent, dont use this) -->
                        </div>
                        <p class="comment-message"><?php echo  htmlspecialchars($c['text']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- COMMENTS INPUT FIELD -->
        <div class="post-comment">
            <?php if (!empty($currentUser["picture"])) : ?>
                <img class="profile-picture" src="<?php echo $currentUser["picture"] ?>" alt="profile picture">
            <?php endif; ?>

            <input class="form-control form-border comment-input commentText" name="comment" placeholder="Write a comment..."></input>
            <div class="addComment" data-postid="<?php echo $post["postId"];  ?>"><img class="comment-send" src="img/right-arrow.svg" alt=""></div>
        </div>
    </div>

</div>