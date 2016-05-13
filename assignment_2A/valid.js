function ages()
{
    alert('he');
    var year_select=document.getElementById('year');
    var select=year_select.value;


    var x=(2016-select);
    if(x>26)
    {
        document.getElementById('age').value=x;
    }
    else
    {
        document.getElementById('age').value='';
        alert('Age is below 26YEar')
    }
}

function validateForm() {

    var first = document.forms["sub_form"]["firstname"].value;
    var last = document.forms["sub_form"]["lastname"].value;
    var ph = document.forms["sub_form"]["phone"].value;
    var no=ph.length;
    var patt=/[0-9]/;
    var of = document.forms["sub_form"]["office"].value;
    var ev = document.forms["sub_form"]["email"].value;
    var ps = document.forms["sub_form"]["password"].value;
    var str=ps.length;
    var cp = document.forms["sub_form"]["compass"].value;
    var mm = document.forms["sub_form"]["month"].value;
    var dd = document.forms["sub_form"]["day"].value;
    var yy = document.forms["sub_form"]["year"].value;
    var check1= document.getElementById("checkbox_sample18").checked;
    var check2= document.getElementById("checkbox_sample19").checked;
    var check3= document.getElementById("checkbox_sample20").checked;

    var ab = document.forms["sub_form"]["about"].value;
    if (first == null || first == "") {
        alert("Name must be filled out");
        return false;
    }
    else if (last == null || last == "") {
        alert("Lastname must be filled out");
        return false;
    }
    else if(ph=="")
    {
        alert("Plesea Enter Phone number");
        return false;

    }
    else if(isNaN(ph))
    {
        alert("Plesea Enter only NUMBER");
        return false;
    }
    else if(no!=10)
    {
        alert("please Enter 10 Digit Number");
        return false;
    }
    else if(isNaN(of))
    {
        alert("Plesea Enter only NUMBER");
        return false;
    }
    else if(ev=="")
    {
        alert("Plesea Enter Email");
        return false;

    }
    else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev))
    {
        alert("Plesea Enter Valid Email");
        return false;
    }
    else if(ps=="")
    {
        alert("Plesea Enter PASSWORD");
        return false;

    }
    else if(str < 6 || str > 8)
    {
        alert("Enter password length 6-8");
        return false;
    }
    else if((/[^a-zA-Z0-9\-\/]/.test(ps)))
    {

        alert("Used only Charaters");
        return false;
    }
    else if(cp=="")
    {
        alert("Plesea Enter PASSWORD");
        return false;

    }
    else if(cp!=ps)
    {
        alert("Passowrd not Match");
        return false;
    }
    else if(mm==0)
    {
        alert("Select Month");
        return false;
    }
    else if(dd==0)
    {
        alert("Select Day");
        return false;
    }
    else if(yy==0)
    {
        alert("Select Year");
        return false;
    }
    else if((check1== false) && (check2== false)&& (check3==false))
    {
        alert ( "Please choose Your interest" );
        return false;
    }
   else if(ab=="")
    {
        alert("Plesea Enter Aboutus");
        return false;
    }
    else
        return true;
}

