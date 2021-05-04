document.querySelector("#addComment").addEventListener("click", function(){
let postId = this.dataset.postId;
let text = document.querySelector("#commentText").value
console.log(postId)
console.log(text)

});