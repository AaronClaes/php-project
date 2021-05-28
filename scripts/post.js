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
        let element = emptyPost(post);
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
        let element = emptyPost(post);
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

const emptyPost = (post) => {
  let element = post.parentElement.parentElement.parentElement.parentNode;
  element.querySelector(".post-tags").classList.add("hidden");
  element.querySelector(".post-img").classList.add("hidden");
  element.querySelector(".post-buttons").classList.add("hidden");
  element.querySelector(".post-comments-box").classList.add("hidden");
  element.querySelector(".post-top").classList.add("hidden");
  return element;
};

document.querySelectorAll(".post-comments").forEach((button) => {
  let state = false;
  button.addEventListener("click", (e) => {
    state = !state;
    if (state === true) {
      button.parentElement.parentElement
        .querySelector(".post-comments-box")
        .classList.remove("hidden");
    } else {
      button.parentElement.parentElement
        .querySelector(".post-comments-box")
        .classList.add("hidden");
    }
  });
});

document.querySelectorAll(".post-like").forEach((like) => {
  like.addEventListener("click", (e) => {
    const formData = new FormData();
    let postId = like.dataset.postid;
    formData.append("postId", postId);
    fetch("ajax/likepost.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        return response.json();
      })
      .then((result) => {
        console.log("Succes like", result);
        let likeField =
          like.parentElement.parentElement.parentElement.querySelector(
            ".post-buttons .post-like p"
          );
        let likeAmount = likeField.innerHTML;
        if (result["action"] === "saved") {
          likeField.innerHTML = parseInt(likeAmount) + 1;
          like.querySelector("svg").style.fill = "#fd3939";
        } else {
          likeField.innerHTML = parseInt(likeAmount) - 1;
          like.querySelector("svg").style.fill = "#7a7f84";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
