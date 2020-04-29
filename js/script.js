$(document).ready(function(){
    display();
    $('#animation_model1').click(function(){
        display();
    });
    $('#graph_model1').click(function(){
        display();
    });

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
        //value = value.replace(/</g, '&lt;').replace(/>/g, '&gt;');
        //console.log(value);
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                data: {
                    inputTextArea: value,
                    action: "command"
                },
                success: function(response) {
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

function display(){
    let animation_checked = $("#animation_model1").is(':checked');
    let graph_checked = $("#graph_model1").is(':checked');
    if(animation_checked && graph_checked){
        enableAnimation();
        enableGraph();
    }
    else if(animation_checked && !graph_checked){
        enableAnimation();
        disableGraph();
    }
    else if(!animation_checked && graph_checked){
        disableAnimation();
        enableGraph();
    }
    else{
        disableAnimation();
        disableGraph();
    }
    
}
function enableGraph(){
    $('#graphPlotly1').show();
    $('#graphPlotly2').show();
}
function disableGraph(){
    console.log("disabled");
    $('#graphPlotly1').hide();
    $('#graphPlotly2').hide();
}
function enableAnimation(){
    $('#animationP5').show();
}
function disableAnimation(){
    $('#animationP5').hide();
}