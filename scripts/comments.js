document.querySelector(".addComment").addEventListener("click", function(){
let postId = "100";
let text = document.getElementById("commentText").value;

console.log(postId);
console.log(text);

const formData = new FormData();


formData.append('text', text);
formData.append('postId', postId);

fetch('./ajax/saveComment.php', {
  method: 'POST',
  body: formData
})
.then(response => response.json())
.then(result => {
    l
  console.log('Success:', result);
})
.catch(error => {
  console.error('Error:', error);
});
});