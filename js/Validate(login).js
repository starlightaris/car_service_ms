function doValidate(){
    var email=document.forms["myform"]["txtemail"].value;
    var regex=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var emailError = document.getElementById("emailError");
    
    if (!regex.test(email)) {
        emailError.style.display = "block";
        return false;
    } else {
        emailError.style.display = "none";
    }
    
    var pass=document.forms["myform"]["txtpass"].value;
    var regex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    var passwordError = document.getElementById("passwordError");

    if (!regex.test(pass)) {
        passwordError.style.display = "block";
        return false;
    } else {
        passwordError.style.display = "none";
    }
    return true;
};