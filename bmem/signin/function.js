$('#Signin').click(function(){
    $('#signin_spinner').show();
    $('#signin_spinner_text').show();
    $('#signin_text').hide();
    $('#toastMsgTxt').html('');
    

    setTimeout(function(){
        //$('.toast-5s').toast('show')
        $username = $('#Email').val();
        $password = $('#Password').val();

        $.ajax({
            method: "POST",
            url: "signin/function.php",
            data: { fn: "doLogin", username: $username, password: $password }
        })
        .done(function( res ) {
            console.log(res);
            $res1 = JSON.parse(res);
            $('#signin_spinner').hide();
            $('#signin_spinner_text').hide();
            $('#signin_text').show();

            if($res1.status == true){
                window.location.href = '?p=dashboard';
            }else{
                $('#toastMsgTxt').html($res1.message);
                $('.toast-5s').toast('show');
                //alert($res1.message);
                //$('#error_text').html('Wrong username or password');
            }
        });//end ajax

        //window.location = '?p=dashboard';
    }, 500)
    
})

//Loading screen
$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading"); },
    ajaxStop: function() { $body.removeClass("loading"); }    
});