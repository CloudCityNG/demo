<aside>
    <form method="post" id="keepmeposted" action="/soon" >
        <fieldset>
            <legend class="hidden">keepmeposted</legend>
            <label for="firstname">First name</label>
            <input name="firstname" id="firstname" placeholder="First name" required>
            <label for="lastname">Last name</label>
            <input name="lastname" id="lastname" placeholder="Last name" required>
            <label for="emailaddress">email</label>
            <input id="emailaddress" type="email" name="emailaddress" placeholder="me@everythingyouliked.com" required>
            <button>Keep me posted!</button>
        </fieldset>
    </form>
    <p id="response">
        <img src="/images/yes.png" alt="yes">Yes, we will keep you updated when we will go live!<br>
        <img src="/images/no.png" alt="no">No, we won't spam or sell your email address.
    </p>
</aside>
<script>
$(document).ready(function() {
$('#keepmeposted').submit(function() {
$('#response').html('submitting your email....');
$.getJSON('ajax/soon/', {
'emailaddress':$('#emailaddress').val(),
'firstname':$('#firstname').val(),
'lastname':$('#lastname').val(),
}, function(data){
if (data.success == true){
$("input").val('');
}
$('#response').html(data.message);
});
return false;
});
});
</script>