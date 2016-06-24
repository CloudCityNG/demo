function user_address_valid()
{
    alert('asd');
    var add1 = document.forms["form"]["address_1"].value;
    //var add2 = document.forms["form"]["address_2"].value;
    var city = document.forms["form"]["city"].value;
    var state = document.forms["form"]["state"].value;
    var con = document.forms["form"]["country"].value;
    var zip = document.forms["form"]["zipcode"].value;
    var str=zip.length;

    if((add1 == null || add1 == "" ||city == null || city == "" || state == null || state == "" ||
        con == null || con == "" ||zip == null || zip == "" || (str < 6 || str > 8)))
    {

        document.getElementById('add1').innerHTML="";
        document.getElementById('city').innerHTML="";
        document.getElementById('state').innerHTML="";
        document.getElementById('country').innerHTML="";
        document.getElementById('zipcode').innerHTML="";

        if(add1 == null || add1 == "")            //firstname
        {
            document.getElementById('add1').innerHTML="Address Required";
        }
        //if(add2 == null || add2 == "")              //lastname
        //{
        //    document.getElementById('add2').innerHTML="Last Name Required";
        //}
        if(city == null || city == "")            //email
        {
            document.getElementById('city').innerHTML="City Required";
        }
        if(state == null || state == "")              //password
        {
            document.getElementById('state').innerHTML="State Required";
        }
        if(con == null || con == "")            //email
        {
            document.getElementById('country').innerHTML="Country Required";
        }
        if(zip == null || zip == "")              //password
        {
            document.getElementById('zipcode').innerHTML="Zipcode Required";
        }
        if((str < 6 || str > 6))
        {
            document.getElementById('zipcode').innerHTML="6 Digit Zipcode Required";
        }

        return false;
    }
    else{
        return true;
    }

}
