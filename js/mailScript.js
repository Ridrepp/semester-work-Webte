$(document).ready(function(){
    var lang;
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('lang')){
        if(searchParams.get('lang') == 'en'){
            lang = 'en'
        }
        else if(searchParams.get('lang') == 'sk'){
            lang = 'sk';
        }
        else{
            location.href = ("http://"+window.location.host + window.location.pathname + "?lang=sk");
        }
    }
    else{
        location.href = ("http://"+window.location.host + window.location.pathname + "?lang=sk");
    }

    $("#sendEmail").click(function(event) {

        console.log();
        event.preventDefault();
        let email = $("#email").val();
        let emailObject =  document.getElementById("email");;
        console.log(email);
        let pattern = /^[a-zA-Z0-9'._]{3,}@[A-Z0-9-a-z]+.[a-z]{2,4}$/;

        if(!emailObject.value.match(pattern) && emailObject.value !== ''){
            if(lang == 'sk'){
                $('#email').notify("Zadajte email v správnom formáte.",{className: "error",position:"bottom center"});
            }
            else{
                $('#email').notify("Enter email in proper format.",{className: "error",position:"bottom center"});
            }
            emailObject.select();
            return;
        }
        else if (emailObject.value === ''){
            if(lang == 'sk'){
                $('#email').notify("Toto pole nemôže byť prázdne.",{className: "error",position:"bottom center"});
            }
            else{
                $('#email').notify("Email field cannot be empty.",{className: "error",position:"bottom center"});
            }
            return;
        }
        $.ajax(
            {
                type: "POST",
                url: "mail.php",
                data: {
                    email: email,
                },
                success: function(response) {
                    console.log(response);
                    if(lang == 'sk'){
                        $("#email").notify("Štatistika bola úspešne odoslaná.",{className: "success", position:"bottom center"});
                    }
                    else{
                        $("#email").notify("The statistic has been sent succesfully.",{className: "success", position:"bottom center"});
                    }
                    return;
                },
                error: function (response) {
                    console.log(response);
                    $.notify("Server side error.","error");
                    return;
                }
            }
        );
        return;
    });

});