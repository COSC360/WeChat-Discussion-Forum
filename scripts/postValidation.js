function validate(){

    var title = document.createPosts.title;
    var community = document.createPosts.community;

    if(title.value ==="") {
        title.classList.add("error");
        title.focus();
        return false;
    } else {
        title.classList.remove("error");
    }
    if(community.value ==="") {
        community.classList.add("error");
        community.focus();
        return false;
    } else {
        community.classList.remove("error");
        }
        return true;
    }

    
