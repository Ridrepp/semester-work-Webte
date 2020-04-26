$(document).ready(function(){
    $("#model1").click(function() {
        let value = $('#input1').val();
        $.ajax(
            {
                type: "POST",
                url: "model1.php",
                data: {input: value},
                success: function(response) {
                    $("body").html(response);
                }
            }
        );
    });
    $("#model2").click(function() {
        let value = $('#input2').val();
        $.ajax(
            {
                type: "POST",
                url: "model2.php",
                data: {input: value},
                success: function(response) {
                    $("body").html(response);
                }
            }
        );
    });
    $("#model3").click(function() {
        let value = $('#input3').val();
        $.ajax(
            {
                type: "POST",
                url: "model3.php",
                data: {input: value},
                success: function(response) {
                    $("body").html(response);
                }
            }
        );
    });
    $("#model3").click(function() {
        let value = $('#input3').val();
        $.ajax(
            {
                type: "POST",
                url: "model3.php",
                data: {input: value},
                success: function(response) {
                    $("body").html(response);
                }
            }
        );
    });

    $("#textAreaButton").click(function() {
        let value = $('#textArea').val();
        $.ajax(
            {
                type: "POST",
                dataType: "text",
                url: "index.php",
                data: {inputTextArea: value},
                success: function(response) {
                    $("body").html(response);
                }
            }
        );
    });
});