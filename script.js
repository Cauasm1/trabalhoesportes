let likeCount = 0;
let dislikeCount = 0;

function likePost() {
    likeCount++;
    document.getElementById('like-count').innerText = likeCount;
}

function dislikePost() {
    dislikeCount++;
    document.getElementById('dislike-count').innerText = dislikeCount;
}
