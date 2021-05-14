let select = document.querySelector(".form-select");
if (localStorage.getItem("selectedSearch") !== null) {
  select.value = localStorage.getItem("selectedSearch");
} else {
  select.value = "content";
}

select.addEventListener("change", (e) => {
  localStorage.setItem("selectedSearch", select.value);
});

const searchbar = document.querySelector(".search-input");
const autocomplete = document.querySelector(".autocomplete-box");
searchbar.addEventListener("keyup", (e) => {
  if (searchbar.value !== "" && select.value === "user") {
    autocomplete.classList.remove("hidden");
    while (autocomplete.firstChild) {
      autocomplete.removeChild(autocomplete.lastChild);
    }
    const formData = new FormData();
    let value = searchbar.value;
    formData.append("value", value);
    fetch("ajax/autocomplete.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        result["users"].forEach((user) => {
          let li = document.createElement("li");
          autocomplete.appendChild(li);
          li.innerHTML = `<a href="other_user.php?id=${user["id"]}">${user["username"]} - ${user["firstname"]} ${user["lastname"]}</a>`;
        });
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  } else {
    document.querySelector(".autocomplete-box").classList.add("hidden");
  }

  document.body.addEventListener("click", (e) => {
    if (!e.target.classList.contains("search-input")) {
      document.querySelector(".autocomplete-box").classList.add("hidden");
    }
  });
});
