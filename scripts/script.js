const upvoteButton = document.querySelectorAll(".upvote");
const downvoteButton = document.querySelectorAll(".downvote");
const postScores = document.querySelectorAll('.postScore');

for(let i =0; i < upvoteButton.length; i++) {
let score = parseInt(postScores[i].textContent);

upvoteButton[i].addEventListener('click', ()=> {
    if(!upvoteButton[i].classList.contains('active')) {
        upvoteButton[i].classList.add('active');
        downvoteButton[i].classList.remove('active');
        score++;
        postScores[i].textContent = score.toString();
    }
});

downvoteButton[i].addEventListener('click', () => {
    if(!downvoteButton[i].classList.contains('active')) {
        downvoteButton[i].classList.add('active');
        upvoteButton[i].classList.remove('active');
        score--;
        postScores[i].textContent = score.toString();
    }
});
}

// Add event listener to the like button
document.getElementsByClassName('upvote').addEventListener('click', function() {
    // Send AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/like');
    xhr.onload = function() {
      // Update like count display with the returned value
      document.getElementById('like-count').textContent = xhr.responseText;
    };
    xhr.send();
  });
  
  // Set timer to update like count display every 30 seconds
  setInterval(function() {
    // Send AJAX request to the server to get the latest like count
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/like-count');
    xhr.onload = function() {
      // Update like count display with the returned value
      document.getElementById('like-count').textContent = xhr.responseText;
    };
    xhr.send();
  }, 30000);