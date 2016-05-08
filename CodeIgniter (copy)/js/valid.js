function regi()
{
    alert('helo');

    var name=document.getElementsByName('admin_name');
    alert(name);
    if(name == "" || name == null)
    {alert('First Name requried');
        document.getElementById('admin_name').innerHTML='FirstName Required'
    }
    //else
    //{
    //    document.getElementById('admin_name').innerHTML='FirstName Required'
    //}
}
