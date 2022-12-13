
/**
form.addEventListener('submit',(e) => {
    invalidFeedback();

})

function invalidFeedback(){
    t = 3;
    if(document.getElementById('time').value == "0"+T+":00"){
        document.getElementById('time').document.getElementsByClassName('invalid-feedback').style.display = "inline";
        e.preventDefault();

    }
}

**/

function headerCurrent(b){
    if (b == "index"){
        document.getElementById("navitem1").className = "nav-item nav-link active";
        document.getElementById("navitem2").className = "nav-item nav-link";
        document.getElementById("navitem3").className = "nav-item nav-link";
        document.getElementById("navitem4").className = "nav-item nav-link";
    }
    else if (b == "about"){
        document.getElementById("navitem1").className = "nav-item nav-link";
        document.getElementById("navitem2").className = "nav-item nav-link active";
        document.getElementById("navitem3").className = "nav-item nav-link";
        document.getElementById("navitem4").className = "nav-item nav-link";

    }
    else if (b == "contact"){
        document.getElementById("navitem1").className = "nav-item nav-link";
        document.getElementById("navitem2").className = "nav-item nav-link";
        document.getElementById("navitem3").className = "nav-item nav-link active";
        document.getElementById("navitem4").className = "nav-item nav-link";
    }
    else if (b == "account"){
        document.getElementById("navitem1").className = "nav-item nav-link";
        document.getElementById("navitem2").className = "nav-item nav-link";
        document.getElementById("navitem3").className = "nav-item nav-link";
        document.getElementById("navitem4").className = "nav-item nav-link active";
    }
}