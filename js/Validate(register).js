function doValidate(){
    //email validation
    var email=document.forms["myform"]["txtemail"].value;
    var regex=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var emailError = document.getElementById("emailError");
    
    if (!regex.test(email)) {
        emailError.style.display = "block";
        return false;
    } else {
        emailError.style.display = "none";
    }


    //pasword validation 
    var pw=document.forms["myform"]["txtpw"].value;
    var regex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    var passwordError1 = document.getElementById("passwordError1");
    var passwordError2 = document.getElementById("passwordError2");
    
    if (!regex.test(pw)) {
        passwordError1.style.display = "block";
        return false;
    } else {
        passwordError1.style.display = "none";
    }

    var conpw=document.forms["myform"]["txtconpw"].value;
    if(pw!=conpw){
        passwordError2.style.display = "block";
        return false;
    } else {
        passwordError2.style.display = "none";
    }

    //phone numberr validation
    var tel=document.forms["myform"]["txttel"].value;
    var regex= /^[0-9]{10}$/;
    var telError=document.getElementById("telError");

    if(!regex.test(tel)){
        telError.style.display = "block";
        return false;
    }
    else{
        telError.style.display = "none";
        }
    }