function getImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      let image = document.createElement("IMG");
      document.querySelector(".previewImage").appendChild(image);
      document
        .querySelector(".previewImage img")
        .setAttribute("src", e.target.result);

      document.querySelectorAll(".filter img").forEach((filter) => {
        filter.src = e.target.result;
      });

      document.querySelector(".postFilters").classList.remove("hidden");
      document.querySelector(".postFilters").classList.add("flex");
    };

    reader.readAsDataURL(input.files[0]);
  }
}
