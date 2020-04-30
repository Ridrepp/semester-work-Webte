$(document).ready(function(){
    $("#model1").click(function() {
        $.ajax(
            {
                type: "POST",
                url: "model1.php",
                data: {
                    button: "buttonSubmit1"
                },
                success: function(response) {
                },
            }
        );
    });
    $("#model2").click(function() {
        $.ajax(
            {
                type: "POST",
                url: "model2.php",
                data: {
                    button: "buttonSubmit2"
                },
                success: function(response) {
                    $("body").html(response);
                },
            }
        );
    });
    $("#model3").click(function() {
        $.ajax(
            {
                type: "POST",
                url: "model3.php",
                data: {
                    button: "buttonSubmit3"
                },
                success: function(response) {
                },
            }
        );
    });
});
