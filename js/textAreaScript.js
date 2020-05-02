$(document).ready(function() {
    $("#textAreaButton").click(function () {
        let value = $('#textArea').val();
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                data: {
                    inputTextArea: value,
                    action: "command"
                },
                success: function (response) {
                    console.log(response);
                    if (response.includes("wrong apiKey")){
                        $('#ApiErrorMsg').css("display", "block");
                    }
                    else $('#output').html(response);
                },
                error: function (response) {
                    console.log(response.responseText);
                }
            }
        );
    });
});