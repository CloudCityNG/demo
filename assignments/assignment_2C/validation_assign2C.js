function ages()
{
    //alert('he');
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


var error_messages = {
    firstname: {required: style="border = 'Firstname is complusory'"},
    lastname: {required: 'Lastname is complusory'},
    phone: {required: 'Phone no is complusory',
        valid_no: 'Phone no should not contain character',
        digites:'Plesea Enter only NUMBER'},
    office:{valid_no:'Plesea Enter only NUMBER'},
    email:{required:'Plesea Enter Email',
        valid:'Plesea Enter Valid Email'},
    password:{required:'Plesea Enter PASSWORD',
        length:'Enter password length 6-8',
        valid:'Used only Charaters'},
    confirm:{required:'Plesea Enter Confirm PASSWORD',
        match:'Passowrd not Match'},
    month:{required:'Select Month'},
    day:{required:'Select Day'},
    year:{required:'Select year'},
    about:{required:' Plesea Enter Aboutus'},
    uploadfile:{required:' Plesea uploadfile'}
}

function checkForm(form)
{

    document.getElementById('firstname').style.border = '1px solid gray';
    document.getElementById("lastname").style.border = '1px solid gray';
    document.getElementById("phone").style.border = '1px solid gray';
    document.getElementById("office").style.border = '1px solid gray';
    document.getElementById("email").style.border = '1px solid gray';
    document.getElementById("password").style.border = '1px solid gray';
    document.getElementById("confirm").style.border = '1px solid gray';
    document.getElementById("month").parentElement.style.border = '1px solid gray';
    document.getElementById("day").parentElement.style.border = '1px solid gray';
    document.getElementById("year").parentElement.style.border = '1px solid gray';
    document.getElementById("about").style.border = '1px solid gray';
    document.getElementById("other").style.border = '1px solid gray';
    document.getElementById("uploadFile").style.border = '1px solid gray';






    var patt = /[a-z]/ig;
    var mail=!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var pass=/[^a-zA-Z0-9\-\/]/;
    var word=document.getElementsByName('password');
    var len=word.length;
    if (form.firstname.value == '')
    {
        document.getElementById('firstname').style.border = '1px solid #ff00ff';
        //alert(error_messages.firstname.required);
        return false;
    }
    if (form.lastname.value =='')
    {
        document.getElementById('lastname').style.border = '1px solid #ff00ff';
       // alert(error_messages.lastname.required);
        return false;
    }
    if(form.phone.value =='')
    {
        document.getElementById('phone').style.border = '1px solid #ff00ff';
       // alert(error_messages.phone.required);
        return false;
    }
    if((form.phone.value).length!=10)
    {
        document.getElementById('phone').style.border = '1px solid #ff00ff';
        //alert(error_messages.phone.valid_no);
        return false;
    }
    if(isNaN(form.phone.value)){
        document.getElementById('phone').style.border = '1px solid #ff00ff';
        //alert(error_messages.phone.digites);
        return false;
    }
    if(form.email.value =='')
    {
        document.getElementById('email').style.border = '1px solid #ff00ff';
       // alert(error_messages.email.required);
        return false;
    }
    //if(mail.test(form.email.value) )
    //{
    //    alert(error_messages.phone.valid);
    //    return false;
    //}
    if(form.password.value =='')
    {
        document.getElementById('password').style.border = '1px solid #ff00ff';
        //alert(error_messages.password.required);
        return false;
    }
    if(pass.test(form.password.value))
    {
        document.getElementById('password').style.border = '1px solid #ff00ff';
        //alert(error_messages.password.valid);
        return false;
    }
    if((form.password.value).length < 5 ||  (form.password.value).length > 8)
    {
        document.getElementById('password').style.border = '1px solid #ff00ff';
        //alert(error_messages.password.length);
        return false;
    }
    if(form.confirm.value =='')
    {
        document.getElementById('confirm').style.border = '1px solid #ff00ff';
        alert(error_messages.confirm.required);
        return false;
    }
    if(form.confirm.value != form.password.value)
    {
        document.getElementById('confirm').style.border = '1px solid #ff00ff';
       // alert(error_messages.confirm.match);
        return false;
    }
    if(form.month.value ==0)
    {
        document.getElementById('month').style.border = '1px solid #ff00ff';
       // alert(error_messages.month.required);
        return false;
    }
    if(form.day.value ==0)
    {
        document.getElementById('day').style.border = '1px solid #ff00ff';
        //alert(error_messages.day.required);
        return false;
    }
    if(form.year.value ==0)
    {
        document.getElementById('year').style.border = '1px solid #ff00ff';
        //alert(error_messages.year.required);
        return false;
    }
    if(form.about.value =='')
    {
        document.getElementById('about').style.border = '1px solid #ff00ff';
       // alert(error_messages.about.required);
        return false;
    }
    if(form.uploadFile.value =="")
    {
        document.getElementById('uploadFile').style.border = '1px solid #ff00ff';
       // alert(error_messages.uploadFile.required);
        return false;
    }

    return true;

}