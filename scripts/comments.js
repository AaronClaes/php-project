document.querySelectorAll(".addComment").forEach((comment) => {
  //let btn = document.querySelector(".addComment")
  comment.addEventListener("click", (e) => {
    const formData = new FormData();
    let postid = comment.dataset.postid;

    let text = comment.parentElement.querySelector(".commentText").value;

    formData.append("text", text);
    formData.append("postId", postid);

    let commentBox =
      comment.parentElement.parentElement.querySelector(".comments");

    fetch("ajax/saveComment.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())

      .then((result) => {
        let comment = document.createElement("tr");
        comment.innerHTML =
          "<div class='comments'><div class='comment'><img class='profile-picture' src='" +
          result["image"] +
          "' alt=''> <div class='comment-box'><div class='comment-box-info'> <h5 class='post-user'>" +
          result["username"] +
          "</h5><h5 class='post-dot'>•</h5><p class='post-date'>just now</p> </div><p class='comment-message' >" +
          text +
          "</p> </div> </div></div>";
        commentBox.appendChild(comment);
        console.log("Success:", result);
        let commentsAmount =
          comment.parentElement.parentElement.parentElement.querySelector(
            ".post-buttons .post-comments p"
          ).innerHTML;

        comment.parentElement.parentElement.parentElement.querySelector(
          ".post-buttons .post-comments p"
        ).innerHTML = parseInt(commentsAmount) + 1;
      })
      .catch((error) => {
        console.log("Error:", error);
      });
  });
});
