
function cms_valid()
{

    var title = document.forms["form"]["title"].value;
    var content = document.forms["form"]["content"].value;
    var meta_desc = document.forms["form"]["meta_description"].value;
    var meta_key = document.forms["form"]["meta_keyword"].value;
    //var image = document.forms["form"]["meta_keyword"].value;

    if(title == null || title == "" ||content == null || content == "" ||  meta_desc == null ||
        meta_desc == ""||meta_key == null || meta_key == "")
    {

        document.getElementById('title').innerHTML="";
        document.getElementById('content').innerHTML="";
        document.getElementById('meta_desc').innerHTML="";
        document.getElementById('meta_key').innerHTML="";

        if(title == null || title == "")                       //title
        {
            document.getElementById('title').innerHTML="Title Required";
        }
        if(content == null || content == "")                       //content
        {
            document.getElementById('content').innerHTML="Content Required";
        }
        if(meta_desc == null || meta_desc == "")              //meta_desc
        {
            document.getElementById('meta_desc').innerHTML="Meta_Desc Required";
        }
        if(meta_key == null || meta_key == "")                //meta_key
        {
            document.getElementById('meta_key').innerHTML="Meta_key Required";
        }
        var fup = document.getElementById('image').value;
        if(fup == "")                //meta_key
        {
            document.getElementById('banner_name').innerHTML="Image Required";
        }
        return false;
    }
    else{
        return true;
    }
}