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