//FLAG INAPPROPRIATE
document.querySelectorAll(".inappropriate").forEach((post) => {
  post.addEventListener("click", (e) => {
    const formData = new FormData();
    let postId = post.dataset.postid;
    formData.append("postId", postId);
    fetch("ajax/flagpost.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        console.log("Succes", result);
        let element = post.parentElement.parentElement.parentElement.parentNode;
        element.querySelector(".post-tags").classList.add("hidden");
        element.querySelector(".post-img").classList.add("hidden");
        element.querySelector(".post-buttons").classList.add("hidden");
        element.querySelector(".post-comments-box").classList.add("hidden");
        element.querySelector(".post-top").classList.add("hidden");
        let successElement = document.createElement("h4");
        let successMessage = document.createTextNode(
          "Successfully flagged this post."
        );
        successElement.appendChild(successMessage);

        element.appendChild(successElement);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
//DELETE POST
document.querySelectorAll(".delete").forEach((post) => {
  post.addEventListener("click", (e) => {
    const formData = new FormData();
    let postId = post.dataset.postid;
    formData.append("postId", postId);
    fetch("ajax/deletepost.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        console.log("Succes", result);
        let element = post.parentElement.parentElement.parentElement.parentNode;
        element.querySelector(".post-tags").classList.add("hidden");
        element.querySelector(".post-img").classList.add("hidden");
        element.querySelector(".post-buttons").classList.add("hidden");
        element.querySelector(".post-comments-box").classList.add("hidden");
        element.querySelector(".post-top").classList.add("hidden");
        let successElement = document.createElement("h4");
        let successMessage = document.createTextNode(
          "Successfully deleted this post"
        );
        successElement.appendChild(successMessage);

        element.appendChild(successElement);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
