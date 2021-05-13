 document.querySelectorAll(".addComment").forEach((comment) => {
//let btn = document.querySelector(".addComment") 
console.log(comment);
  comment.addEventListener("click", (e) =>{
    window.location.reload(); 
  const formData = new FormData();
    let postid = comment.dataset.postid;
    
    let text = comment.parentElement.querySelector(".commentText").value
    console.log(postid);
    console.log(text);
  
    


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