function submit_guestform()
{
alert('guest');
    var first = document.forms["form"]["user_name"].value;
    var last = document.forms["form"]["user_lastname"].value;
    var email = document.forms["form"]["user_email"].value;
    var add1 = document.forms["form"]["address_1"].value;
    var add2 = document.forms["form"]["address_2"].value;
    var zip = document.forms["form"]["zipcode"].value;

    var add3 = document.forms["form"]["address_3"].value;
    var add4 = document.forms["form"]["address_4"].value;
    var zip1 = document.forms["form"]["zipcode1"].value;
    var radio = document.forms["form"]["ship_address"].value;
    var str=zip.length;
    var str1=zip1.length;

    if((first == null || first == "")|| (last == null || last == "")||email==""||
        (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(email))||
        (add1 == null || add1 == "")||(add2 == null || add2 == "")||(zip == null || zip == "" )||
        (str < 6 || str > 8)||(radio == 'guest' && ((add3 == null || add3 == "")||(add4 == null || add4 == "")||(zip1 == null || zip1 =="")||(str1 < 6 || str1 > 6))))
    {
        document.getElementById('first').innerHTML="";
        document.getElementById('last').innerHTML="";
        document.getElementById('email').innerHTML="";
        document.getElementById('add1').innerHTML="";
        document.getElementById('add2').innerHTML="";
        document.getElementById('zipcode').innerHTML="";

        document.getElementById('add3').innerHTML="";
        document.getElementById('add4').innerHTML="";
        document.getElementById('zipcode1').innerHTML="";
        //document.getElementById('addressship').innerHTML="";

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
        if(add1 == null || add1 == "")            //firstname
        {
            document.getElementById('add1').innerHTML="Address Required";
        }
        if(add2 == null || add2 == "")              //lastname
        {
            document.getElementById('add2').innerHTML="Address Required";
        }
        if(zip == null || zip == "")              //password
        {
            document.getElementById('zipcode').innerHTML="Zipcode Required";
        }
        if((str < 6 || str > 6))
        {
            alert(str);
            document.getElementById('zipcode').innerHTML="6 Digit Zipcode Required";
        }
        if(radio == 'guest' && ((add3 == null || add3 == "")||(add4 == null || add4 == "")||(zip1 == null || zip1 =="")||(str1 < 6 || str1 > 6)))              //lastname
        {

            if(add3 == null || add3 == "")            //firstname
            {
                document.getElementById('add3').innerHTML="Address Required";
            }
            if(add4 == null || add4 == "")              //lastname
            {
                document.getElementById('add4').innerHTML="Address Required";
            }
            if(zip1 == null || zip1 == "")              //password
            {
                document.getElementById('zipcode1').innerHTML="Zipcode Required";
            }
            if((str1 < 6 || str1 > 6))
            {
                document.getElementById('zipcode1').innerHTML="6 Digit Zipcode Required";
            }
        }
        return false;
    }
    else{
        return true;
    }

}
