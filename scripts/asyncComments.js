window.onload = function() {

    // Get the upvote and downvote buttons
    const upvoteButtons = document.querySelectorAll('.upvote');
    const downvoteButtons = document.querySelectorAll('.downvote');
  
    // Loop through all the upvote buttons
    upvoteButtons.forEach(function(button) {
      // Attach an event listener to each upvote button
      button.addEventListener('click', function() {
        // Get the post ID from the button's data-postid attribute
        const comment_id = button.getAttribute('comment_id');
        
        // Send an AJAX request to the server to upvote the post
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateCommentScore.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          // If the request is successful, update the post score
          if (xhr.status === 200 && xhr.responseText === 'upvoted') {
            const scoreElement = button.parentNode.querySelector('.postScore');
            const currentScore = parseInt(scoreElement.textContent);
            scoreElement.textContent = currentScore + 1;
          }
        };
        xhr.send('comment_id=' + comment_id + '&vote=up');
      });
    });
  
    // Loop through all the downvote buttons
    downvoteButtons.forEach(function(button) {
      // Attach an event listener to each downvote button
      button.addEventListener('click', function() {
        // Get the post ID from the button's data-postid attribute
        const commentId = button.getAttribute('comment_id');
        
        // Send an AJAX request to the server to downvote the post
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateCommentScore.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          // If the request is successful, update the post score
          if (xhr.status === 200 && xhr.responseText === 'downvoted') {
            const scoreElement = button.parentNode.querySelector('.postScore');
            const currentScore = parseInt(scoreElement.textContent);
            scoreElement.textContent = currentScore - 1;
          }
        };
        xhr.send('comment_id=' + commentId + '&vote=down');
      });
    });
  
    // Refresh the post scores every few seconds
    setInterval(function() {
      // Loop through all the posts on the page
      const postContainers = document.querySelectorAll('.postContainer');
      postContainers.forEach(function(container) {
        const commentId = container.querySelector('.upvote').getAttribute('comment_id');
        // Send an AJAX request to the server to get the updated post score
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getScore.php?comment_id=' + commentId);
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