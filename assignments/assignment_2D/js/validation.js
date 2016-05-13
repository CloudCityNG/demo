

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
   // var con = document.forms["sub_form"]["con"].value;
   // var state = document.forms["sub_form"]["state"].value;
   // var city = document.forms["sub_form"]["city"].value;



    if ((first == null || first == "") || (last == null || last == "") || (ph == "")||(isNaN(ph))
        ||(no != 10)||(isNaN(of))||(ev == "")||(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(ev))||
        (ps == "")||(str < 6 || str > 8)||((/[^a-zA-Z0-9\-\/]/.test(ps)))||(cp == "")||
        (cp != ps)||(mm == 0)||(dd == 0) ||(yy == 0) ||((check1 == false) && (check2 == false) && (check3 == false))||
        (ab == "")) {

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
       // document.getElementById("other").style.border = '1px solid gray';
       // document.getElementById("uploadFile").style.border = '1px solid gray';


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
        //else if (con == -1) {
        //    document.getElementById("about").parentElement.style.border = '1px solid gray';
        //    document.getElementById('con').parentElement.style.border = '1px solid #ff00ff';
        //    return false;
        //}
        //else if (state == -1) {
        //    document.getElementById("con").parentElement.style.border = '1px solid gray';
        //    document.getElementById('state').parentElement.style.border = '1px solid #ff00ff';
        //    return false;
        //}
        //else if (city == -1) {
        //    document.getElementById("state").parentElement.style.border = '1px solid gray';
        //    document.getElementById('city').parentElement.style.border = '1px solid #ff00ff';
        //    return false;
        //}
        return false;
    }
    else
    {
        return true;
    }
}

var myJson = {
    "country": [
        {
            "name": "United States",
            "id": "usa",
            "states": [
                {
                    "name": "State 1 USA",
                    "id": "usaState1",
                    "cities": [
                        {
                            "name": "City 1",
                            "id": "usaState1City1",
                            "area": "12345 sqkm"
                        },
                        {
                            "name": "City 2",
                            "id": "usaState1City2",
                            "area": "12345 sqkm"
                        }
                    ]
                },
                {
                    "name": "State 2 USA",
                    "id": "usaState2",
                    "cities": [
                        {
                            "name": "City 3",
                            "id": "usaState2City3",
                            "area": "12345 sqkm"
                        },
                        {
                            "name": "City 4",
                            "id": "usaState2City4",
                            "area": "12345 sqkm"
                        }
                    ]
                }
            ]
        },
        {
            "name": "Australia",
            "id": "aus",
            "states": [
                {
                    "name": "State 1 Australia",
                    "id": "ausState1",
                    "cities": [
                        {
                            "name": "City 5",
                            "id": "ausState1City5",
                            "area": "12345 sqkm"
                        },
                        {
                            "name": "City 6",
                            "id": "ausState1City6",
                            "area": "12345 sqkm"
                        }
                    ]
                },
                {
                    "name": "State 2 Australia",
                    "id": "ausState2",
                    "cities": [
                        {
                            "name": "City 7",
                            "id": "ausState2City7",
                            "area": "12345 sqkm"
                        },
                        {
                            "name": "City 8",
                            "id": "ausState2City8",
                            "area": "12345 sqkm"
                        }
                    ]
                }
            ]
        }
    ]
} ;


$(function(){
    if(i==-1)
    {
        document.getElementById('con').parentElement.style.border='1px solid #ff00ff';
        return false;
    }
    for(var i=0;i<myJson.country.length;i++)
    {
        $("#country").append('<option value="'+i+'">'+myJson.country[i].name+'</option>');
    }
    $("#country").on('change',function() {

        var country_selected = $(this).val();


        $('#state').html('<option value="-1">-Select State-</option>');
        for (var j = 0; j < myJson.country[country_selected].states.length; j++) {
            $("#state").append('<option value="' + j + '">' + myJson.country[country_selected].states[j].name + '</option>');

        }


    });


    $('#state').on("change",function(){
        var country_selected = $("#country").val();
        var state_selected=$(this).val();
        $('#city').html('<option value="-1">-Select city -</option>');
        for (var j = 0; j < myJson.country[country_selected].states[state_selected].cities.length; j++) {
            $("#city").append('<option value="' + j + '">' + myJson.country[country_selected].states[state_selected].cities[j].name + '</option>');
        }

    }) ;

});










