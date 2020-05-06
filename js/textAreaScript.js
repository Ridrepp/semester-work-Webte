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
                url: "octaveAPI/api.php",
                data: {
                    inputTextArea: textValue,
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