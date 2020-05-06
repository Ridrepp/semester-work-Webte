$(document).ready(function(){
    $("#model1").click(function() {
        // let data = $("#model").serialize();
        $.ajax(
            {
                type: "POST",
                url: "model1.php",
                data: {
                    button: "buttonSubmit1"
                },
                success: function() {
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
                success: function() {
                },
            }
        );
    });
});
