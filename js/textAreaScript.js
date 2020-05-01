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
                    $('#output').html(response);
                },
                error: function (response) {
                    console.log("ERROR");
                    console.log(response.responseText);
                }
            }
        );
    });
});