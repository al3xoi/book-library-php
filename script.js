

function checkForm() {
// Fetching values from all input fields and storing them in variables.
    var name = document.getElementById("name1").value;
    var email = document.getElementById("email1").value;
    var username = document.getElementById("username1").value;
    var password = document.getElementById("password1").value;
    var confpassword = document.getElementById("confpassword1").value;



//Check input Fields Should not be blanks.
    if (name == '' ||  email == '' || username == '' || password == '' || confpassword == '') {
        alert("Fill All Fields");
    } else {
//Notifying error fields
        var username1 = document.getElementById("name");
        var email1 = document.getElementById("email");
        var username1 = document.getElementById("username");
        var password1 = document.getElementById("password");
        var confpassword1 = document.getElementById("confpassword");

//Check All Values/Informations Filled by User are Valid Or Not.If All Fields Are invalid Then Generate alert.
        if (username1.innerHTML == 'Name must be 3+ letters' || password1.innerHTML == 'Password too short' || confpassword1.innerHTML == 'Passwords do not match!' || email1.innerHTML == 'Invalid email address' || username1.innerHTML == 'Username must be at least 4 letters') {
            alert("Fill Valid Information");
        } else {
//Submit Form When All values are valid.
            document.getElementById("regForm").submit();
        }
    }
}


// AJAX code to check input field values when onblur event triggerd.
function validate(field, query) {
    var xmlhttp;
    if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = "Validating..";
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = xmlhttp.responseText;
        } /*else {
            document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
        }*/
    }


    xmlhttp.open("GET", "validation.php?field=" + field + "&query=" + query, false);
    xmlhttp.send();
}


