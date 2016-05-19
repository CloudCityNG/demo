function admin_valid()
{

    var first = document.forms["form"]["admin_name"].value;
    var last = document.forms["form"]["admin_lastname"].value;
    var email = document.forms["form"]["admin_email"].value;

    if((first == null || first == "")|| (last == null || last == "")||email==""||
        (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(email)))
    {

        document.getElementById('first').innerHTML="";
        document.getElementById('last').innerHTML="";
        document.getElementById('email').innerHTML="";

        if(first == null || first == "")            //firstname
        {
            document.getElementById('first').innerHTML="First Name Required";
        }
        if(last == null || last == "")              //lastname
        {
            document.getElementById('last').innerHTML="Last Name Required";
        }
        if(email == null || email == "")            //email
        {
            document.getElementById('email').innerHTML="E-mail Required";
        }
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(email))
        {
            document.getElementById('email').innerHTML="Invalid E-mail";
        }

        return false;
    }
    else{

        return true;
    }

}
