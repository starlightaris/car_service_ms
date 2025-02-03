function doValidate(){
    //email validation
    var email=document.forms["myform"]["email"].value;
    var regex=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var emailError = document.getElementById("emailError");
    
    if (!regex.test(email)) {
        emailError.style.display = "block";
        return false;
    } else {
        emailError.style.display = "none";
    }


  //phone numberr validation
  var tel=document.forms["myform"]["phoneNumber"].value;
  var regex= /^[0-9]{10}$/;
  var telError=document.getElementById("telError");

  if(!regex.test(tel)){
      telError.style.display = "block";
      return false;
  }
  else{
      telError.style.display = "none";
      }
return true;


  }