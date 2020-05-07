$(document).ready(function() {
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
    

    $("#textAreaButton").click(function () {
        let textValue = $('#textArea').val();
        if (textValue == ''){
            if(lang == 'sk'){
                $('#textArea').notify("Príkazové pole nemôže byť prázdne.",{className: "error",position:"right center"});
            }
            else{
                $('#textArea').notify("Please enter some statement.",{className: "error",position:"right center"});
            }
            return;
        }
        $.ajax(
            {
                type: "GET",
                url: "octaveAPI/api.php?apiKey=6acecbbb8b287799b906826d2391f5",
                data: {
                    inputTextArea: textValue,
                    action: "command"
                },
                success: function (response) {
                    $('#output').html(response);
                },
                error: function (response) {
                    let r = response.responseJSON.message;
                    if ( r.includes("incorrect")){
                        $('#ApiErrorMsg').css("display", "block");
                    }
                }
            }
        );
    });
});