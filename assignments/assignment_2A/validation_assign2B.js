//
//function validation(){
//    //alert('hello');
//        var error={
//        firstname:{required:"Firstname required"},
//        lastname:{required:"Lastnaem required"}
//    }
//    var x;
//        document.getElementById("firstname").value;
//        document.getElementById("lastname").value;
//
//    var id={
//    }
//    alert(x);
//    //id.toString();
//    //document.getElementById("last").innerHTML = fruits;
//    checkvalidation(x);
//}
//
//function checkvalidation(x)
//{
//      //var check=document.getElementById("firstname").value;
//    //alert(check);
//
//  //  alert(error.firstname.required);
//        alert('hello');
//    if (x=="")
//    {
//        //data='firstname';
//        //validation(data);
//        alert(error.firstname.required);
//        alert('hello');
//        return false;
//
//    }
//    else
//        return false;
//}
//
//
//




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



    var error_messages = {
        firstname: {required: 'Firstname is compulsory'},
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
        compass:{required:'Plesea Enter Confirm PASSWORD',
                 match:'Passowrd not Match'},
        month:{required:'Select Month'},
        day:{required:'Select Day'},
        year:{required:'Select year'},
        about:{required:' Plesea Enter Aboutus'}

    }

function checkForm(form)
{

    var patt = /[a-z]/ig;
    var mail=!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var pass=/[^a-zA-Z0-9\-\/]/;
    var word=document.getElementsByName('password');
    var len=word.length;
    if (form.firstname.value == '')
    {
        alert(error_messages.firstname.required);
        return false;
    }
    if (form.lastname.value =='')
    {
        alert(error_messages.lastname.required);
        return false;
    }
    if(form.phone.value =='')
    {
        alert(error_messages.phone.required);
        return false;
    }
     if((form.password.value).length!=10)
    {
        alert(error_messages.phone.valid_no);
        return false;
    }
    if(isNaN(form.phone.value)){
        alert(error_messages.phone.digites);
        return false;
    }
    if(form.email.value =='')
    {
        alert(error_messages.email.required);
        return false;
    }
    //if(mail.test(form.email.value) )
    //{
    //    alert(error_messages.phone.valid);
    //    return false;
    //}
    if(form.password.value =='')
    {
        alert(error_messages.password.required);
        return false;
    }
    if(pass.test(form.password.value))
    {
        alert(error_messages.password.valid);
        return false;
    }
    if( (form.password.value).length < 5 || (form.password.value).length >8 )
    {
        alert(error_messages.password.length);
        return false;
    }
    if(form.compass.value =='')
    {
        alert(error_messages.compass.required);
        return false;
    }
    if(form.compass.value != form.password.value)
    {
        alert(error_messages.compass.match);
        return false;
    }
    if(form.month.value ==0)
    {
        alert(error_messages.month.required);
        return false;
    }
    if(form.day.value ==0)
    {
        alert(error_messages.day.required);
        return false;
    }
    if(form.year.value ==0)
    {
        alert(error_messages.year.required);
        return false;
    }
    if(form.about.value =='')
    {
        alert(error_messages.about.required);
        return false;
    }

    return true;

}