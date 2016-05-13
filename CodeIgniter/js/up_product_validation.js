function product_valid()
{
    alert('asds');
    var name = document.forms["form"]["name"].value;
    var sku = document.forms["form"]["sku"].value;
    var short = document.forms["form"]["short_description"].value;
    var long = document.forms["form"]["long_description"].value;
    var price = document.forms["form"]["price"].value;
    var special = document.forms["form"]["special_price"].value;
    var date_from = document.forms["form"]["special_price_form"].value;
    var date_to = document.forms["form"]["special_price_to"].value;
    var qun = document.forms["form"]["quntity"].value;
    var title = document.forms["form"]["meta_title"].value;
    var meta_desc = document.forms["form"]["meta_description"].value;
    var meta_key = document.forms["form"]["meta_keywords"].value;

    alert('if');


    if(name == null || name == "" || sku == null || sku == "" || short == null || short == ""
        || long == null || long == ""||price == null || price == ""||(/^[0-9]+$/.test(price)) ||
        special == null || special == "" ||(/^[0-9]+$/.test(special)) || date_from == null ||
        date_from == "" || date_to == null || date_to == "" || qun == null || qun == ""||
        (/^[0-9]+$/.test(qun)) ||title == null || title == "" || meta_desc == null ||
        meta_desc == ""||meta_key == null || meta_key == "")
    {
        alert('if');
        document.getElementById('name').innerHTML="";
        document.getElementById('sku').innerHTML="";
        document.getElementById('short').innerHTML="";
        document.getElementById('long').innerHTML="";
        document.getElementById('price').innerHTML="";
        document.getElementById('special').innerHTML="";
        document.getElementById('date_from').innerHTML="";
        document.getElementById('date_to').innerHTML="";
        document.getElementById('qun').innerHTML="";
        document.getElementById('title').innerHTML="";
        document.getElementById('meta_desc').innerHTML="";
        document.getElementById('meta_key').innerHTML="";
       // document.getElementById('image').innerHTML="";

        if(name == null || name == "")                         //name
        {
            document.getElementById('name').innerHTML="Name Required";
        }
        if(sku == null || sku == "")                             //sku
        {
            document.getElementById('sku').innerHTML="SKU Required";
        }
        if(short == null || short == "")                       //short
        {
            document.getElementById('short').innerHTML="Short-Desc Required";
        }
        if(long == null || long == "")                            //long
        {
            document.getElementById('long').innerHTML="Long-Desc Required";
        }
        if(price == null || price == "")                        // price
        {
            document.getElementById('price').innerHTML="Price Required";
        }
        if(/^[0-9]+$/.test(price))                             //price
        {
            document.getElementById('price').innerHTML="Only Number";
        }
        if(special == null || special == "")                    //special
        {
            document.getElementById('special').innerHTML="Special_price Required";
        }
        if(/^[0-9]+$/.test(special))                             //special
        {
            document.getElementById('special').innerHTML="Only Number";
        }
        if(date_from == null || date_from == "")              //date_from
        {
            document.getElementById('date_from').innerHTML="Start Date Required";
        }
        if(date_to == null || date_to == "")                   //date_to
        {
            document.getElementById('date_to').innerHTML="End Date Required";
        }
        if(qun == null || qun == "")                          //qun
        {
            document.getElementById('qun').innerHTML="Quntity Required";
        }
        if(/^[0-9]+$/.test(qun))                             //qun
        {
            document.getElementById('qun').innerHTML="Only Number";
        }
        if(title == null || title == "")                       //title
        {
            document.getElementById('title').innerHTML="Title Required";
        }
        if(meta_desc == null || meta_desc == "")              //meta_desc
        {
            document.getElementById('meta_desc').innerHTML="Meta_Desc Required";
        }
        if(meta_key == null || meta_key == "")                //meta_key
        {
            document.getElementById('meta_key').innerHTML="Meta_key Required";
        }
        //if(image == null || image == "")                      //image
        //{
        //    document.getElementById('image').innerHTML="Image Required";
        //}
        return false;
    }
    else{
        return true;
    }

}

