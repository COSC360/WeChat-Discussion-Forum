

var formEdited = false;

window.addEventListener("beforeunload", function (event) {
  if (formEdited) {
    event.preventDefault();
    event.returnValue = '';
    return "Are you sure you want to leave? Your changes will not be saved.";
  }
});

var createCommunityForm = document.querySelector("form[name='createPosts']");
createCommunityForm.addEventListener("input", function () {
  formEdited = true;
});

createCommunityForm.addEventListener("submit", function () {
  formEdited = false;
});

var loginForm = document.querySelector("form[name='loginForm']");
loginForm.addEventListener("input", function () {
  formEdited = true;
});

loginForm.addEventListener("submit", function () {
  formEdited = false;
});

var signupForm = document.querySelector("form[name='signupForm']");
signupForm.addEventListener("input", function () {
  formEdited = true;
});

signupForm.addEventListener("submit", function () {
  formEdited = false;
});
