/**
 * Created by webwerks1 on 25/3/16.
 */
/**
 * Created by webwerks1 on 25/3/16.
 */
/**
 * Created by webwerks1 on 22/3/16.
 */
//firstname


function firstName(fn)
{

    if(fn=="")
    {
       // alert("Plesea Enter Firstname");

          document.getElementById('firstname').focus();

          document.getElementById('firstname').style.border='1px solid #ff00ff';
    }
    else
    {
        document.getElementById("firstname").style.border='1px solid gray';
    }
}

//lastname
function lastName(ln)
{

    if(ln=="")
    {
       // alert("Plesea Enter Lastname");

           document.getElementById('lastname').focus();

          document.getElementById('lastname').style.border='1px solid #ff00ff';
    }
    else
    {
        document.getElementById("lastname").style.border='1px solid gray';
    }
}

//phone
function Phone(ph)
{
    var no=ph.length;
    var patt=/[0-9]/;
    if(ph=="")
    {
       // alert("Plesea Enter Phone number");

           document.getElementById('phone').focus();

          document.getElementById('phone').style.border='1px solid #ff00ff';
    }
    else if(isNaN(ph))
    {
       // alert("Plesea Enter only NUMBER");

        document.getElementById('phone').focus();

        document.getElementById('phone').style.border='1px solid #ff00ff';
    }
    else if(no!=10)
    {
       // alert("please Enter 10 Digit Number");

        document.getElementById('phone').focus();

        document.getElementById('phone').style.border='1px solid #ff00ff';
    }
    else
    {
        document.getElementById("phone").style.border='1px solid gray';
    }
}

//offnumber
function offNumber(of)
{
    if(isNaN(of))
    {
       // alert("Plesea Enter only NUMBER");

        document.getElementById('office').focus();

        document.getElementById('office').style.border='1px solid #ff00ff';
    }
    else
    {
        document.getElementById("office").style.border='1px solid gray';
    }
}

//email
function emailval(ev)
{
    if(ev=="")
    {
        //alert("Plesea Enter Email");

           document.getElementById('email').focus();

          document.getElementById('email').style.border='1px solid #ff00ff';
    }
    else if((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev))
    {


            document.getElementById("email").style.border='1px solid gray';

        return true;
    }
    else
    {
       // alert("Plesea Enter Valid Email");

        document.getElementById('email').focus();

        document.getElementById('email').style.border='1px solid #ff00ff';
    }
}

//password
function passWord(ps)
{
    var str=ps.length;


    if(ps=="")
    {
     //   alert("Plese Enter PASSWORD");

           document.getElementById('password').focus();

          document.getElementById('password').style.border='1px solid #ff00ff';
        return false;
    }
    else if(str < 6 || str > 8)
    {
       // alert("Enter password length 6-8");

        document.getElementById('password').focus();

        document.getElementById('password').style.border='1px solid #ff00ff';
        return false;
    }
    else if((/[^a-zA-Z0-9\-\/]/.test(ps)))
    {

        alert("Used only Charaters");
        document.getElementById('password').focus();

        document.getElementById('password').style.border='1px solid #ff00ff';
        return false;
    }
    else

        {
            document.getElementById("password").style.border='1px solid gray';
        }


}

//confirm
function comPass(cp)
{
    var pass=document.getElementById("password").value;

    if(cp=="")
    {
        //alert("Plesea Enter PASSWORD");

           document.getElementById('confirm').focus();

          document.getElementById('confirm').style.border='1px solid #ff00ff';
    }
    else if(cp!=pass)
    {
        alert("Passowrd not Match");

        document.getElementById('confirm').focus();

        document.getElementById('confirm').style.border='1px solid #ff00ff';
    }
    else

    {
        document.getElementById("confirm").style.border='1px solid gray';
    }

}

//month
function mnt()
{
    var month_select=document.getElementById('month');
    var select=month_select.value;

    if(select==0)
    {
        alert('month');
        month_select.parentElement.className="mandatory_select_fildes";
    }else{
        month_select.parentElement.className="";

    }

}

//date
function dt()
{
    var day_select=document.getElementById('day');
    var select=month_select.value;

    if(select==0)
    {
        alert('Select day');
        day.parentElement.className="mandatory_select_fildes";
    }else{
        day.parentElement.className="";

    }

}

//year
function years(yy)
{
    if(yy==0)
    {
         alert("Select Year");
        document.getElementById('year').focus();
        document.getElementById('year').style.boxShadow='#0000ff';
       // document.getElementById('year').style.textBlink='#00ff00';
    }
    else
    {
        act();
        return true;
    }
    function act()
    {
        var mv=document.getElementById("month").value;
        //var mv= m.value;
        // alert(mv);
        var yv=document.getElementById("year").value;
        //var yv= y.value;
        // alert(yv);

        if((yv<1990)||(yv==1990 && mv>5 ))
        {
            document.getElementById('age').disabled=false;
        }
        else
        {
            document.getElementById('age').disabled=true;
        }
    }
}

//age
function age(aa)
{
    if(aa=="")
    {
      //  alert('Enter age');

        document.getElementById('age').focus();

        document.getElementById('age').style.border='1px solid #ff00ff';
    }
    else

    {
        document.getElementById("age").style.border='1px solid gray';
    }

}
//box
function box(form)
{

    if ( ( form.check[0].checked == false ) && ( form.check[1].checked == false ) && ( form.check[2].checked == false )  )
    {
        alert ( "Please choose Your interest" );

        document.getElementById('checkbox_sample18').style.border='1px solid #ff00ff';
        return false;
    }




}
//about
function about(ab)
{

    if(ab=="")
    {
     //   alert("Plesea Enter Aboutus");

           document.getElementById('about').focus();

          document.getElementById('about').style.border='1px solid #ff00ff';
    }
    else

    {
        document.getElementById("about").style.border='1px solid gray';
    }
}

//country
function country()
{
    var x = document.getElementById('con').value;
  //  alert(x);
    if ((x == 0 || x == 1))
    {
        document.getElementById('other').disabled=false;
    }
    else
    {
        document.getElementById('other').disabled=true;
    }
}

//boxcountry
function x(c)
{
    if(c=="")
    {
       // alert("enter Country");

        document.getElementById('other').focus();

        document.getElementById('other').style.border='1px solid #ff00ff';
    }
    else

    {
        document.getElementById("other").style.border='1px solid gray';
    }
}

//upload
function load()
{
    var q=document.getElementById('uploadFile').value;

    if(!q.value)
    {
        alert(' File Uploading Done');

        document.getElementById('uploadFile').focus();

        document.getElementById('uploadFile').style.border='1px solid #00ff00';
    }
    else

    {
        document.getElementById("uploadFile").style.border='1px solid gray';
    }
}
//add
function add()
{
    var input=document.createElement('input');
    input.type="file";
    document.getElementById('new').appendChild(input);
}





















//var f = document.getElementById('fname');
//var l = document.getElementById('lname');
//var e = document.getElementById('email');
//var p = document.getElementById('phone');
//var ph = document.getElementById('photo');
//var fAlert = "Please enter your first name";
//var lAlert = "Please enter your last name";
//var eAlert = "Please enter a valid email address";
//var pAlert = "Please enter a contact number";
//var phAlert = "Please provide a recent photo";
//var em;
//if (!f.value)
//{
//    alert (fAlert);
//    return false;
//}
//if (!l.value)
//{
//    alert (lAlert);
//    return false;
//}
//if (!e.value)
//{
//    alert (eAlert);
//    return false;
//}
//em = e.value.match(/[@.]/g);
//if ((!em) || (em.length < 2))
//{
//    alert (eAlert);
//    return false;
//}
//if (!p.value)
//{
//    alert (pAlert);
//    return false;
//}
//if (!ph.value)
//{
//    alert (phAlert);
//    return false;
//}
//return true;
//}
//</script>