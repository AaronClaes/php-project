document.querySelectorAll(".inappropriate").forEach((post) => {
  post.addEventListener("click", (e) => {
    const formData = new FormData();
    let postId = post.dataset.postid;
    formData.append("postId", postId);
    console.log(postId);
    fetch("ajax/flagpost.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        console.log("Succes", result);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
