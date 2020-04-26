$(document).ready(function(){
    $("#model1").click(function() {
        let value = $('#input1').val();
        $.ajax(
            {
                type: "POST",
                url: "api.php",
                dataType: "json",
                data: {
                    action: "kyvadlo",
                    input: value
                },
                success: function(response) {
                    console.log(response);
                    return false;
                }
            }
        );
        return false;
    });
    $("#model2").click(function() {
        let value = $('#input2').val();
        $.ajax(
            {
                type: "POST",
                url: "api.php",
                dataType: "json",
                data: {
                    action: "gulicka",
                    input: value
                },
                success: function(response) {
                    console.log(response);
                    return false;
                }
            }
        );
        return false;
    });
    $("#model3").click(function() {
        let value = $('#input3').val();
        $.ajax(
            {
                type: "POST",
                url: "api.php",
                dataType: "json",
                data: {
                    action: "lietadlo",
                    input: value
                },
                success: function(response) {
                    console.log(response);
                    return false;
                }
            }
        );
        return false;
    });

    $("#textAreaButton").click(function() {
        let value = $('#textArea').val();
        $.ajax(
            {
                type: "POST",
                url: "api.php",
                dataType: "json",
                data: {inputTextArea: value},
                success: function(response) {
                    $("body").html(response);
                }
            }
        );
    });
});