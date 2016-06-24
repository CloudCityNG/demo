function registration_user()
{

    var first = document.forms["form"]["user_name"].value;
    var last = document.forms["form"]["user_lastname"].value;
    var email = document.forms["form"]["user_email"].value;
    var pass = document.forms["form"]["user_password"].value;
    var radio = document.forms["form"]["user_status"].value;
    var str=pass.length;
    var namef=/[^a-zA-Z\-\/]/;

    if((first == null || first == "")||(namef.test(first))||(namef.test(last))||(last == null || last == "")||email==""||
        (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(email))||pass == null ||
        pass == "" ||(str < 6 || str > 8)||((/[^a-zA-Z0-9\-\/]/.test(pass)))||(radio == 0))
    {
        document.getElementById('first').innerHTML="";
        document.getElementById('last').innerHTML="";
        document.getElementById('pass').innerHTML="";
        document.getElementById('email').innerHTML="";
        document.getElementById('gender').innerHTML="";

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
        if(pass == null || pass == "")              //password
        {
            document.getElementById('pass').innerHTML="Password Required";
        }
        if(str < 6 || str > 8)                      //password length
        {
            document.getElementById('pass').innerHTML="Length Between 6-8";
        }
        if((/[^a-zA-Z0-9\-\/]/.test(pass)))         //check charater
        {
            document.getElementById('pass').innerHTML="Invalid Password";
        }
        if(radio == 0)
        {
            document.getElementById("gender").innerHTML="Select Gender ";
        }
        //if(com == null || com == "")                // confirm password
        //{
        //    document.getElementById('com').innerHTML="Confirm Password Required";
        //}
        //if(com != pass)                             //match password
        //{
        //    document.getElementById('com').innerHTML="Confirm Password Not match";
        //}

        return false;
    }
    else{
        return true;
    }

}
