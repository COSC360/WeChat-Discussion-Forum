const userClick = document.getElementById("new-password");
const lowLetter = document.getElementById("lowLetter");
const upperCapital = document.getElementById("upperCapital");
const number = document.getElementById("number");
const maxLength = document.getElementById("maxLength");

//on user click on password textbox, display the password required rules
userClick.onfocus = function(){
    document.getElementById("passwordRules").style.display = "block";
}
//on user click anywhere else, hide it
userClick.onblur = function(){
    document.getElementById("passwordRules").style.display = "none";
}

//now begin validation
//every time the user types anything validate the characters/update and put "X" or "checkmark" beside each requirement

//uppercase req
userClick.onkeyup = function(){
const capitalLetters = /[A-Z]/g; //any character between A-Z and global '/g' to run multiple times for string
if(userClick.value.match(capitalLetters)){
    upperCapital.classList.remove("invalid");
    upperCapital.classList.add("valid");
}else{
    upperCapital.classList.remove("valid");
    upperCapital.classList.add("invalid");
}
//lower req
const lowerLetters = /[a-z]/g;
if(userClick.value.match(lowerLetters)){
    lowLetter.classList.remove("invalid");
    lowLetter.classList.add("valid");
}else{
    lowLetter.classList.remove("valid");
    lowLetter.classList.add("invalid");
}
//numbers req (must have number in password 0-9)
const nums = /[0-9]/g;
if(userClick.value.match(nums)){
    number.classList.remove("invalid");
    number.classList.add("valid");
}else{
    number.classList.remove("valid");
    number.classList.add("invalid");
}

//min length of password
if(userClick.value.length >= 8){
    maxLength.classList.remove("invalid");
    maxLength.classList.add("valid");
}else{
    maxLength.classList.remove("valid");
    maxLength.classList.add("invalid");
}
}

const form = document.querySelector("form");
const password = document.getElementById("new-password");
const confirmPassword = document.getElementById("confirm-password");

form.addEventListener("submit", function(event) {
  event.preventDefault();
//checking if the passwords match
  if (password.value !== confirmPassword.value) {
    return false;
  }
    
});
