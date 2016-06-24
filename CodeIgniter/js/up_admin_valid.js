function admin_valid()
{
    var first = document.forms["form"]["admin_name"].value;
    var last = document.forms["form"]["admin_lastname"].value;
    var email = document.forms["form"]["admin_email"].value;
    var namef=/[^a-zA-Z\-\/]/;
    if((first == null || first == "")|| (last == null ||(namef.test(first))||(namef.test(last))|| last == "")||email==""||
        (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(email)))
    {
        document.getElementById('first').innerHTML="";
        document.getElementById('last').innerHTML="";
        document.getElementById('email').innerHTML="";

        if(first.trim() == null || first.trim() == "")            //firstname
        {
            document.getElementById('first').innerHTML="First Name Required";
        }
        if(namef.test(first))
        {
            document.getElementById("first").innerHTML="Use Only Letters";
        }
        if(last.trim() == null || last.trim() == "")              //lastname
        {
            document.getElementById('last').innerHTML="Last Name Required";
        }
        if(namef.test(last))
        {
            document.getElementById("last").innerHTML="Use Only Letters";
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
