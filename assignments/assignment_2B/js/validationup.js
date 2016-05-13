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
        alert("Plesea Enter Firstname");

           document.getElementById('firstname').focus();

        //  document.getElementById('firstname').style.border='1px solid #ff00ff';
    }
}

//lastname
function lastName(ln)
{

    if(ln=="")
    {
        alert("Plesea Enter Lastname");

           document.getElementById('lastname').focus();

        //  document.getElementById('lastname').style.border='1px solid #ff00ff';
    }
}

//phone
function Phone(ph)
{
    var no=ph.length;
    var patt=/[0-9]/;
    if(ph=="")
    {
        alert("Plesea Enter Phone number");

           document.getElementById('phone').focus();

        //  document.getElementById('firstname').style.border='1px solid #ff00ff';
    }
    else if(isNaN(ph))
    {
        alert("Plesea Enter only NUMBER");
        document.getElementById('phone').focus();
    }
    else if(no!=10)
    {
        alert("please Enter 10 Digit Number")
        document.getElementById('phone').focus();
    }
}

//offnumber
function offNumber(of)
{
    if(isNaN(of))
    {
        alert("Plesea Enter only NUMBER");
        document.getElementById('office').focus();
    }
}

//email
function emailval(ev)
{
    if(ev=="")
    {
        alert("Plesea Enter Email");

           document.getElementById('email').focus();

        //  document.getElementById('lastname').style.border='1px solid #ff00ff';
    }
    else if((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev))
    {
        return true;
    }
    else
    {
        alert("Plesea Enter Valid Email");
        document.getElementById('email').focus();
    }
}

//password
function passWord(ps)
{
    var str=ps.length;


    if(ps=="")
    {
        alert("Plesea Enter PASSWORD");
        document.getElementById('password').focus();
        return false;


        //  document.getElementById('lastname').style.border='1px solid #ff00ff';
    }
    else if(str < 6 || str > 8)
    {
        alert("Enter password length 6-8");
        document.getElementById('password').focus();
        return false;
    }
    else if((/[^a-zA-Z0-9\-\/]/.test(ps)))
    {

        alert("Used only Charaters");
        document.getElementById('password').focus();
        return false;
    }

}

//confirm
function comPass(cp)
{
    var pass=document.getElementById("password").value;

    if(cp=="")
    {
        alert("Plesea Enter PASSWORD");

           document.getElementById('compass').focus();


    }
    else if(cp!=pass)
    {
        alert("Passowrd not Match");
        document.getElementById('compass').focus();
    }
}

//month
function mnt(mm)
{

    if(mm==0)
    {
        alert("Select Month");
        document.getElementById('month').focus();
    }

}

//date
function dt(dd)
{


    if(dd==0)
    {
        alert("Select Day");
        document.getElementById('day').focus();
    }

}

//year
function years(yy)
{
    if(yy==0)
    {
        alert("Select Year");
        document.getElementById('year').focus();
    }
    else
    {
        act();
        return true;
    }
    function act()
    {
        var year_select=document.getElementById('year');
        var select=year_select.value;

        var x=(2016-select);
        if(x>26)
        {

            document.getElementById('age').value=x;
           // document.getElementById("age").style.border='1px solid gray';
        }
        else
        {
            alert('Age is below 26YEar')
            document.getElementById('age').value='';
            document.getElementById('age').focus();

          //  document.getElementById('age').style.border='1px solid #ff00ff';
          //  document.getElementById('age').disabled=true;
        }
    }
}

//age
function age(aa)
{
    if(aa=="")
    {
        alert('Enter age');
        document.getElementById('age').focus();
    }
}


//box
function box(form)
{


    if ( ( form.check[0].checked == false ) && ( form.check[1].checked == false ) && ( form.check[2].checked == false )  )
    {
        alert ( "Please choose Your interest" );

      //  document.getElementById('checkbox_sample18').style.border='1px solid #ff00ff';
        return false;
    }

}

//about
function about(ab)
{

    if(ab=="")
    {
        alert("Plesea Enter Aboutus");

           document.getElementById('about').focus();

        //  document.getElementById('lastname').style.border='1px solid #ff00ff';
    }
}

//country
function country()
{
    var x = document.getElementById('con').value;
    if ((x == 0 || x == 1))
    {
        document.getElementById('other').disabled=false;
    }
}
//boxcountry
function x(c)
{
    if(c=="")
    {
        alert("enter Country");
        document.getElementById('other').focus();
    }
}

//upload
function load()
{
    var q=document.getElementById('uploadFile').value;
  //  alert(q);
    if(q=="")
    {
        alert('load file');
    }
}