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
        var no = ph.length;
        //var patt=/[0-9]/;
        var of = document.forms["sub_form"]["office"].value;
        var ev = document.forms["sub_form"]["email"].value;
        var ps = document.forms["sub_form"]["password"].value;
        var str = ps.length;
        var cp = document.forms["sub_form"]["confirm"].value;
        var mm = document.forms["sub_form"]["month"].value;
        var dd = document.forms["sub_form"]["day"].value;
        var yy = document.forms["sub_form"]["year"].value;
        var check1 = document.getElementById("checkbox_sample18").checked;
        var check2 = document.getElementById("checkbox_sample19").checked;
        var check3 = document.getElementById("checkbox_sample20").checked;
        var ab = document.forms["sub_form"]["about"].value;
        var country = document.getElementById('con').value;
        var input = document.getElementById('other').value;
        var q = document.getElementById('uploadFile').value;

    if ((first == null || first == "") || (last == null || last == "") || (ph == "")||(isNaN(ph))
    ||(no != 10)||(isNaN(of))||(ev == "")||(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev))||
        (ps == "")||(str < 6 || str > 8)||((/[^a-zA-Z0-9\-\/]/.test(ps)))||(cp == "")||
        (cp != ps)||(mm == 0)||(dd == 0) ||(yy == 0) ||((check1 == false) && (check2 == false) && (check3 == false))||
        (ab == "")||(country==0 || country==1 || input=="")||(q == "")) {

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
        if (first == null || first == "") {

            if (first == null || first == "") {

                document.getElementById('firstname').style.border = '1px solid #ff00ff';
                // return false;
            }
            else {
                document.getElementById("firstname").style.border = '1px solid gray';
            }
        }
        if (last == null || last == "") {
            if (last == null || last == "") {
                //document.getElementById("firstname").style.border = '1px solid gray';
                document.getElementById('lastname').style.border = '1px solid #ff00ff';
                //  return false;
            }
            else {
                document.getElementById("lastname").style.border = '1px solid gray';
            }
        }
        if (ph == "") {
            if (ph == "") {
                //document.getElementById("lastname").style.border = '1px solid gray';
                document.getElementById('phone').style.border = '1px solid #ff00ff';
                //return false;
            } else {
                document.getElementById("phone").style.border = '1px solid gray';
            }
        }

        if (isNaN(ph)) {
            if (isNaN(ph)) {
                document.getElementById('phone').style.border = '1px solid #ff00ff';
                // return false;
            }else {
                document.getElementById("phone").style.border = '1px solid gray';
            }
        }
        if (no != 10) {
            if (no != 10) {
                document.getElementById('phone').style.border = '1px solid #ff00ff';
                // return false;
            }else {
                document.getElementById("phone").style.border = '1px solid gray';
            }

        }
        if (isNaN(of)) {
            if (isNaN(of)) {
                document.getElementById('office').style.border = '1px solid #ff00ff';
                // return false;
            }else {
                document.getElementById("office").style.border = '1px solid gray';
            }
        }
        if (ev == "") {
            if (ev == "") {
                document.getElementById('email').style.border = '1px solid #ff00ff';
                // return false;
            }else{
                document.getElementById("email").style.border = '1px solid gray';
            }

        }
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev)) {
            if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev)) {
                document.getElementById('email').style.border = '1px solid #ff00ff';
                //return false;
            }else{
                document.getElementById("email").style.border = '1px solid gray';
            }
        }
        if (ps == "") {
            if (ps == "") {
            document.getElementById('password').style.border = '1px solid #ff00ff';
            //return false;
             }else{
            document.getElementById("password").style.border = '1px solid gray';
            }
        }
        if (str < 6 || str > 8) {
            if (str < 6 || str > 8) {
            document.getElementById('password').style.border = '1px solid #ff00ff';
            //return false;
            }else{
                document.getElementById("password").style.border = '1px solid gray';
            }
        }
        if ((/[^a-zA-Z0-9\-\/]/.test(ps))) {
            if ((/[^a-zA-Z0-9\-\/]/.test(ps))) {
            document.getElementById('password').style.border = '1px solid #ff00ff';
            //return false;
            }else{
                document.getElementById("password").style.border = '1px solid gray';
            }
        }
        if (cp == "") {
            if (cp == "") {
            document.getElementById('confirm').style.border = '1px solid #ff00ff';
            //return false;
            }else{
                document.getElementById("confirm").style.border = '1px solid gray';
            }
        }
        if (cp != ps) {
            if (cp != ps) {
            document.getElementById('confirm').style.border = '1px solid #0000ff';
            //return false;
            }else{
                document.getElementById("confirm").style.border = '1px solid gray';
            }
        }
        if (mm == 0) {
            if (mm == 0) {
            document.getElementById('month').parentElement.style.border = '1px solid #ff00ff';
            //return false;
            }else{
                document.getElementById("month").parentElement.style.border = '1px solid gray';
            }
        }
        if (dd == 0) {
            if (dd == 0) {
            document.getElementById('day').parentElement.style.border = '1px solid #ff00ff';
           // return false;
            }else{
                document.getElementById("day").parentElement.style.border = '1px solid gray';
            }
        }
        if (yy == 0) {
            if (yy == 0) {
            document.getElementById('year').parentElement.style.border = '1px solid #ff00ff';
            //return false;
            }else{
                document.getElementById("year").parentElement.style.border = '1px solid gray';
            }
        }
        if ((check1 == false) && (check2 == false) && (check3 == false)) {
            if ((check1 == false) && (check2 == false) && (check3 == false)){
            document.getElementById('checkbox_sample18').style.borderColor = "#ff00ff";
            document.getElementById('checkbox_sample19').style.borderColor = '#ff00ff';
            document.getElementById('checkbox_sample20').style.borderColor = '#ff00ff';
           // return false;
            }else{
                document.getElementById("checkbox_sample18").style.border = '1px solid gray';
                document.getElementById("checkbox_sample19").style.border = '1px solid gray';
                document.getElementById("checkbox_sample20").style.border = '1px solid gray';
            }
        }
        if (ab == "") {
            if (ab == "") {
            document.getElementById('about').style.border = '1px solid #ff00ff';
           // return false;
            }else{
                document.getElementById("about").style.border = '1px solid gray';
            }

        }
        if(country==0 || country==1 || input==""){
            if(country==0 || country==1 || input==""||input==null){
                document.getElementById('other').style.border = '1px solid #ff00ff';
            }else{
                document.getElementById("other").style.border = '1px solid gray';
            }
        }

        if (q == "") {
            if (q == "") {
            document.getElementById('uploadFile').style.border = '1px solid #ff00ff';
            //return false;
            }else{
                document.getElementById("uploadFile").style.border = '1px solid gray';
            }
        }
        return false;
    }
    else
    {

        return true;
    }
}

