$(document).ready(function(){
    $("#sendEmail").click(function(event) {
        event.preventDefault();
        let email = $("#email").val();
        let emailObject =  document.getElementById("email");;
        console.log(email);
        let pattern = /^[a-zA-Z0-9'._]{3,}@[A-Z0-9-a-z]+.[a-z]{2,4}$/;

        if(!emailObject.value.match(pattern) && emailObject.value !== ''){
            $.notify("Error",{className: "error",position:"right middle"});
            emailObject.select();
            return;
        }
        else if (emailObject.value === ''){
            $.notify("Error",{className: "error",position:"right middle"});
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
                    $("#email").notify(response,{className: "success",position:"right middle"});
                },
                error: function (response) {
                    $.notify("Error","error");
                }
            }
        );
    });

});