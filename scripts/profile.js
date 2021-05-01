let edit = true;
const editButton = document.querySelector(".btn-profile-edit");
const editContainer = document.querySelector(".edit-container");
const feedContainer = document.querySelectorAll(".post");

editButton.addEventListener("click", () => {
  edit = !edit;
  showPage(edit);
});

const showPage = (edit) => {
  if (edit === true) {
    editButton.innerHTML = "Edit";
    editContainer.classList.add("hidden");
    feedContainer.forEach((element) => {
      element.classList.remove("hidden");
    });
  } else {
    editButton.innerHTML = "Cancel";
    editContainer.classList.remove("hidden");
    feedContainer.forEach((element) => {
      element.classList.add("hidden");
    });
  }
};
