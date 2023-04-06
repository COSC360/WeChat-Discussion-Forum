

//Save post data to session storage when leaving the page
window.addEventListener("beforeunload", function(event) {
    event.preventDefault();
    event.returnValue = ""; // Required for Chrome
    alert("Are you sure you want to leave this page?");

    if (window.location.pathname == 'createCommunity.php' || window.location.pathname == 'viewPost.php') {
        
        var community_name = document.getElementById("community_name").value;
        var description = document.getElementById("description").value;
        var title = document.getElementById("title").value;

        sessionStorage.setItem("title", title);
        sessionStorage.setItem("description", description);
        sessionStorage.setItem("community_name", community_name);

    }
});

//Clear saved post data when returning to the page
window.addEventListener("load", function() {
    if (window.location.pathname == 'createCommunity.php' || window.location.pathname == 'viewPost.php') {
        var community_name = document.getElementById("community_name").value;
        var description = document.getElementById("description").value;
        var title = document.getElementById("title").value;

        if (title || description || community_name) {
            sessionStorage.clear();
            alert("Changes have been discarded.");
        }
    }
});