function getLocation() {
  console.log("getLocation Called");
  var Api = "https://api.bigdatacloud.net/data/reverse-geocode-client";
  navigator.geolocation.getCurrentPosition(
    (position) => {
      Api = `${Api}?latitude=${position.coords.latitude}&longitude=${position.coords.longitude}&localityLanguage=en"`;
      getApi(Api);
    },
    (err) => {
      getApi(Api);
    },
    {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0,
    }
  );
}
function getApi(Api) {
  fetch(Api)
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
