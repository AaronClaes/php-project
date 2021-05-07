 document.querySelectorAll(".addComment").forEach((btn) => {
//let btn = document.querySelector(".addComment")
  btn.addEventListener("click", (e) =>{
  
    let postid = btn.dataset.postid;
    e.preventDefault();
    let text = btn.parentElement.querySelector(".commentText").value
    console.log(postid);
    console.log(text);
  
    let formData = new FormData();


    formData.append('text', text);
    formData.append('postId', postid);

    fetch('ajax/saveComment.php', {
    method: 'POST',
    body: formData
    })
    .then(response =>{
      console.log(response)
      return response.json()
     })
    .then(result => {
   
      console.log('Success:', result);
    })
    .catch(error => {
    console.log('Error:', error);
  
    });
  
 });
});