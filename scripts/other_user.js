let follow = true;
const followButton = document.querySelector(".btn-profile-follow");
let followeduser = followButton.dataset.followeduser;
let followId = followButton.dataset.followid; // Waarom Kleine letters??

followButton.addEventListener("click", () => {

  var res;
  const check = new FormData();

  check.append("followeduser", followeduser);

fetch('ajax/checkFollow.php', {
  method: 'POST',
  body: check
})
.then(response => response.json())
.then(result => {
  console.log('Success:', result);
  if (result["result"][0]) {
    res = true;
  } else {
    res = false;
  }
  if(res === true){
    followid = result["result"][0]["id"];
    const remove = new FormData();

    remove.append("followid", followid);

    fetch('ajax/removeFollower.php', {
      method: 'POST',
      body: remove
    })
    .then(response => response.json())
    .then(result => {
      console.log('Success:', result);
      followButton.innerHTML = "Follow";
    })
    .catch(error => {
      console.error('Error:', error);
  
    /*follow = !follow;
    followPage(follow);*/
    })
 } else {
      const follow = new FormData();
  
      follow.append("followeduser", followeduser);
    
      fetch('ajax/addFollower.php', {
        method: 'POST',
        body: follow
      })
      .then(response => response.json())
      .then(result => {
        console.log('Success:', result);
        followButton.innerHTML = "Unfollow";
      })
      .catch(error => {
        console.error('Error:', error);
    
      /*follow = !follow;
      followPage(follow);*/
    })
    }
})

.catch(error => {
  console.error('Error:', error);
  })
})