function ages()
{
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
        document.getElementById('age').style.border='1px solid #ff00ff';
    }
}
function countrys()
{
    var country = document.getElementById('con').value;
    var input = document.getElementById('other').value;
    if ((country == 0 || country == -1 ))
    {
        document.getElementById('other').disabled=false;
        //alert('Select Contry');
    }
    else if(country==1 ||country==2||country==3)
    {
        document.getElementById('other').disabled=true;
        return true;
    }
    else if((country == 0 || country == -1) && !empty(input))
    {
        return true;
    }

}
function add()
{
    var input=document.createElement('input');
    input.type="file";
    document.getElementById('new').appendChild(input);
}



function validateForm() {

    var first = document.forms["sub_form"]["firstname"].value;
    var last = document.forms["sub_form"]["lastname"].value;
    var ph = document.forms["sub_form"]["phone"].value;
    var no=ph.length;
    //var patt=/[0-9]/;
    var of = document.forms["sub_form"]["office"].value;
    var ev = document.forms["sub_form"]["email"].value;
    var ps = document.forms["sub_form"]["password"].value;
    var str=ps.length;
    var cp = document.forms["sub_form"]["confirm"].value;
    var mm = document.forms["sub_form"]["month"].value;
    var dd = document.forms["sub_form"]["day"].value;
    var yy = document.forms["sub_form"]["year"].value;
    var check1= document.getElementById("checkbox_sample18").checked;
    var check2= document.getElementById("checkbox_sample19").checked;
    var check3= document.getElementById("checkbox_sample20").checked;
    var ab = document.forms["sub_form"]["about"].value;
    //var country = document.getElementById('con').value;
    //var input = document.getElementById('other').value;
    var q=document.getElementById('uploadFile').value;

    if (first == null || first == "") {

        document.getElementById('firstname').style.border='1px solid #ff00ff';
        return false;
    }
    else if (last == null || last == "") {
        document.getElementById("firstname").style.border='1px solid gray';
        document.getElementById('lastname').style.border='1px solid #ff00ff';
        return false;
    }
    else if(ph=="")
    {
        document.getElementById("lastname").style.border='1px solid gray';
        document.getElementById('phone').style.border='1px solid #ff00ff';
        return false;

    }
    else if(isNaN(ph))
    {
        document.getElementById('phone').style.border='1px solid #ff00ff';
        return false;
    }
    else if(no!=10)
    {
        document.getElementById('phone').style.border='1px solid #ff00ff';
        return false;
    }
    else if(isNaN(of))
    {
        document.getElementById('phone').style.border='1px solid #ff00ff';
        return false;
    }
    else if(ev=="")
    {
        document.getElementById("phone").style.border='1px solid gray';
        document.getElementById('email').style.border='1px solid #ff00ff';
        return false;

    }
    else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev))
    {
        document.getElementById('email').style.border='1px solid #ff00ff';
        return false;
    }
    else if(ps=="")
    {
        document.getElementById("email").style.border='1px solid gray';
        document.getElementById('password').style.border='1px solid #ff00ff';
        return false;

    }
    else if(str < 6 || str > 8)
    {alert('he');
        document.getElementById('password').style.border='1px solid #ff00ff';
        return false;
    }
    else if((/[^a-zA-Z0-9\-\/]/.test(ps)))
    {
        //alert('he');
        document.getElementById('password').style.border='1px solid #ff00ff';
        return false;
    }
    else if(cp=="")
    {
        document.getElementById("password").style.border='1px solid gray';
        document.getElementById('confirm').style.border='1px solid #ff00ff';
        return false;
    }
    else if(cp!=ps)
    {
        document.getElementById('confirm').style.border='1px solid #0000ff';
        return false;
    }
    else if(mm==0)
    {
        document.getElementById("confirm").style.border='1px solid gray';
        document.getElementById('month').parentElement.style.border='1px solid #ff00ff';
        return false;
    }
    else if(dd==0)
    {
        document.getElementById("month").parentElement.style.border='1px solid gray';
        document.getElementById('day').parentElement.style.border='1px solid #ff00ff';
        return false;
    }
    else if(yy==0)
    {
        document.getElementById("day").parentElement.style.border='1px solid gray';
        document.getElementById('year').parentElement.style.border='1px solid #ff00ff';
        return false;
    }
    else if((check1== false) && (check2== false)&& (check3==false))
    {
        document.getElementById("year").parentElement.style.border='1px solid gray';
        document.getElementById('checkbox_sample18').element.style.borderColor = "#ff00ff";
        document.getElementById('checkbox_sample19').style.borderColor='#ff00ff';
        document.getElementById('checkbox_sample20').style.borderColor='#ff00ff';
        return false;
    }
   else if(ab=="")
    {
        document.getElementById('about').style.border='1px solid #ff00ff';
        return false;
    }

    else if(q=="")
    {
        document.getElementById("about").parentElement.style.border='1px solid gray';
        document.getElementById('uploadFile').style.border='1px solid #ff00ff';
        return false;
    }

    else
    {

        return true;
    }
}

