let follow = true;
const followButton = document.querySelector(".btn-profile-follow");

followButton.addEventListener("click", () => {
  console.log("Clicked");
  follow = !follow;
  followPage(follow);
});

const followPage = (follow) => {
  if (follow === true) {
    followButton.innerHTML = "Follow";
  } else {
    followButton.innerHTML = "Unfollow";
  }
};
