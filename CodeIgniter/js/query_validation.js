function query_valid()
{
alert('sadas');
    var first = document.forms["form"]["replay"].value;
    if((first == null || first == ""))
    {alert('dfd');
        document.getElementById('first').innerHTML="";
        if(first == null || first == "")            //firstname
        {alert('dov');
            document.getElementById('first').innerHTML="Replay Required";
        }
        return false;
    }
    else{
        return true;
    }

}
