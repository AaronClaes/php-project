function getLocation() {
  console.log("getLocation Called");

  var api = "https://api.bigdatacloud.net/data/reverse-geocode-client";
  navigator.geolocation.getCurrentPosition(
    (position) => {
      api = `${api}?latitude=${position.coords.latitude}&longitude=${position.coords.longitude}&localityLanguage=en"`;
      getApi(api);
    },
    (err) => {},
    {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0,
    }
  );
}
function getApi(api) {
  fetch(api)
    .then((response) => response.json())
    .then((result) =>
      document.querySelector(".location").setAttribute("value", result.locality)
    )
    .catch((error) => {});
}

getLocation();

function getImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      let upload = e.target.result;
      let extension = upload.slice(11, 14);

      let image = document.createElement("IMG");
      document.querySelector(".previewImage").appendChild(image);
      document.querySelector(".previewImage img").setAttribute("src", upload);
      if (extension === "png") {
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
        document.querySelector(".postFilters").classList.remove("hidden");
        document.querySelector(".postFilters").classList.add("flex");
      } else {
        document.querySelector(".postFilters").classList.add("hidden");
        document.querySelector(".postFilters").classList.remove("flex");
      }
    };

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

function getFileExtension(filename) {
  return /[.]/.exec(filename) ? /[^.]+$/.exec(filename)[0] : undefined;
}
