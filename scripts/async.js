// Wait for the page to load before executing the script
window.onload = function() {

    // Get the upvote and downvote buttons
    const upvoteButtons = document.querySelectorAll('.upvote');
    const downvoteButtons = document.querySelectorAll('.downvote');
  
    // Loop through all the upvote buttons
    upvoteButtons.forEach(function(button) {
      // Attach an event listener to each upvote button
      button.addEventListener('click', function() {
        // Get the post ID from the button's data-postid attribute
        const postId = button.getAttribute('data-postid');
        
        // Send an AJAX request to the server to upvote the post
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateScore.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          // If the request is successful, update the post score
          if (xhr.status === 200 && xhr.responseText === 'upvoted') {
            const scoreElement = button.parentNode.querySelector('.postScore');
            const currentScore = parseInt(scoreElement.textContent);
            scoreElement.textContent = currentScore + 1;
          }
        };
        xhr.send('post_id=' + postId + '&vote=up');
      });
    });
  
    // Loop through all the downvote buttons
    downvoteButtons.forEach(function(button) {
      // Attach an event listener to each downvote button
      button.addEventListener('click', function() {
        // Get the post ID from the button's data-postid attribute
        const postId = button.getAttribute('data-postid');
        
        // Send an AJAX request to the server to downvote the post
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateScore.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          // If the request is successful, update the post score
          if (xhr.status === 200 && xhr.responseText === 'downvoted') {
            const scoreElement = button.parentNode.querySelector('.postScore');
            const currentScore = parseInt(scoreElement.textContent);
            scoreElement.textContent = currentScore - 1;
          }
        };
        xhr.send('post_id=' + postId + '&vote=down');
      });
    });
  
    // Refresh the post scores every few seconds
    setInterval(function() {
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
  