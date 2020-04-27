$(document).ready(function(){
    $("#model1").click(function() {
        let value = $('#input1').val();
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {
                    action: "kyvadlo",
                    input: value
                },
                success: function(response) {
                    console.log(response);
                    let arrData1 = response.output1;
                    console.log(arrData1);
                    let arrData2 = response.output2;
                    console.log(arrData2);
                    $.ajax({
                        type: "POST",
                        url: "model1.php",
                        data: {
                            arrData1: arrData1,
                            arrData2: arrData2,
                        },

                        success:function(data){
                            $("body").html(data);
                        }
                    });
                },
                error: function (response) {
                    console.log(response);

                }
            }
        );
    });
    $("#model2").click(function() {
        let value = $('#input2').val();
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {
                    action: "gulicka",
                    input: value
                },
                success: function(response) {
                    console.log(response);
                    let arrData1 = response.output1;
                    console.log(arrData1);
                    let arrData2 = response.output2;
                    console.log(arrData2);
                    $.ajax({
                        type: "POST",
                        url: "model2.php",
                        data: {
                            arrData1: arrData1,
                            arrData2: arrData2,
                        },

                        success:function(data){
                            $("body").html(data);
                        }
                    });
                }
            }
        );
    });
    $("#model3").click(function() {
        let value = $('#input3').val();
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {
                    action: "lietadlo",
                    input: value
                },
                success: function(response) {
                    console.log(response);
                    let arrData1 = response.output1;
                    console.log(arrData1);
                    let arrData2 = response.output2;
                    console.log(arrData2);
                    $.ajax({
                        type: "POST",
                        url: "model3.php",
                        data: {
                            arrData1: arrData1,
                            arrData2: arrData2,
                        },

                        success: function (data) {
                            $("body").html(data);
                        }
                    });
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
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {inputTextArea: value},
                success: function(response) {
                    $("body").html(response);
                }
            }
        );
    });
});