function getImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      let upload = e.target.result;
      let image = document.createElement("IMG");
      document.querySelector(".previewImage").appendChild(image);
      document.querySelector(".previewImage img").setAttribute("src", upload);

      document.querySelectorAll(".filter img").forEach((filter) => {
        const formData = new FormData();
        let type = filter.dataset.type;
        formData.append("image", upload);
        formData.append("type", `${type}`);

        fetch("ajax/getpreviewimage.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.blob())
          .then((blob) => {
            filter.src = URL.createObjectURL(blob);
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
    };

    document.querySelector(".postFilters").classList.remove("hidden");
    document.querySelector(".postFilters").classList.add("flex");

    reader.readAsDataURL(input.files[0]);
  }
}

document.querySelectorAll(".filter img").forEach((filter) => {
  filter.addEventListener("click", (e) => {
    let src = e.target.src;
    document.querySelector(".previewImage img").setAttribute("src", src);
    document
      .querySelector(".selectedFilter")
      .setAttribute("value", filter.dataset.type);
  });
});
