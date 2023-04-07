 // Get the upvote and downvote buttons
 const upvoteButtons = document.querySelectorAll('.upvote');
 const downvoteButtons = document.querySelectorAll('.downvote');

 // Check if the user is logged in
 const xhrLogin = new XMLHttpRequest();
 xhrLogin.open('GET', 'checkLogin.php');
 xhrLogin.onload = function() {
 if (xhrLogin.status === 200) {
     const response = JSON.parse(xhrLogin.responseText);
     const loggedIn = response.loggedIn;
     if (loggedIn) {
         // User is logged in, so allow voting
         allowVoting();
     } else {
         // User is not logged in, so disable voting
         disableVoting();
     }
 } else {
     console.error('Error checking login status');
 }
};
xhrLogin.send();

 function allowVoting() {
// Add a click event listener to each upvote button
 upvoteButtons.forEach(button => {
 button.addEventListener('click', () => {
     const postId = button.dataset.post_id;
     const scoreElement = button.parentNode.querySelector('.postScore');

     // Check if the user has already upvoted this post
     if (button.classList.contains('active')) {
         console.log('Already upvoted');
         return;
     }

     // Make an AJAX call to update the post score
     const xhr = new XMLHttpRequest();
     xhr.open('POST', 'updateScore.php');
     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     xhr.onload = function() {
         if (xhr.status === 200) {
             // Update the score in the UI
             const newScore = JSON.parse(xhr.responseText).newScore;
             scoreElement.innerHTML = newScore; 
             button.classList.add('active');
             button.parentNode.querySelector('.downvote').classList.remove('active');
         } else {
             console.error('Error updating score');
         }
     };
     xhr.send(`post_id=${post_id}&vote=up`);
 });
});


 // Add a click event listener to each downvote button
 downvoteButtons.forEach(button => {
 button.addEventListener('click', () => {
     const postId = button.dataset.post_id;
     const scoreElement = button.parentNode.querySelector('.postScore');

     // Check if the user has already downvoted this post
     if (button.classList.contains('active')) {
         console.log('Already downvoted');
         return;
     }

     // Make an AJAX call to update the post score
     const xhr = new XMLHttpRequest();
     xhr.open('POST', 'updateScore.php');
     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     xhr.onload = function() {
         if (xhr.status === 200) {
             // Update the score in the UI
             const newScore = JSON.parse(xhr.responseText).newScore;
             scoreElement.innerHTML = newScore;
             button.classList.add('active');
             button.parentNode.querySelector('.upvote').classList.remove('active');
         } else {
             console.error('Error updating score');
         }
     };
     xhr.send(`post_id=${post_id}&vote=down`);
 });
});
 } function disableVoting() {
// Disable all upvote and downvote buttons
upvoteButtons.forEach(button => {
button.disabled = true;
});
downvoteButtons.forEach(button => {
button.disabled = true;
});
}
  
    // Refresh the post scores every few seconds
   /* setInterval(function() {
      // Loop through all the posts on the page
      const postContainers = document.querySelectorAll('.postContainer');
      postContainers.forEach(function(container) {
        const postId = container.querySelector('.upvote').getAttribute('data-postid');
        // Send an AJAX request to the server to get the updated post score
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getScore.php?post_id=' + postId);
        xhr.onload = function() {
          // If the request is successful, update the post score
          if (xhr.status === 200) {
            const scoreElement = container.querySelector('.postScore');
            const newScore = parseInt(xhr.responseText);
            scoreElement.textContent = newScore;
          }
        };
        xhr.send();
      });
    }, 5000); // Refresh every 5 seconds
  
  };
  */