function getImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      let image = document.createElement("IMG");
      document.querySelector(".previewImage").appendChild(image);
      document
        .querySelector(".previewImage img")
        .setAttribute("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
