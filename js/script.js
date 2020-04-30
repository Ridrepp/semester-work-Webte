$(document).ready(function(){
    let start_input;
    let data = [];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, data);

    display();
    $('#animation_model1').click(function(){
        display();
    });
    $('#graph_model1').click(function(){
        display();
    });

    $("#model1").click(function() {
        start_input = $('#input1_start').val();
        let end_input = $('#input1').val();
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {
                    action: "kyvadlo",
                    start_input: start_input,
                    end_input: end_input
                },
                success: function(response) {
                    $('#initialInput').hide();
                    start_input = response.last_end_input;
                    console.log(response);
                    updateGraph(graph, response.output1, response.output2);
                },
                error: function (response) {
                    console.log(response);

                }
            }
        );
    });
    $("#model2").click(function() {
        start_input = $('#input2_start').val();
        let end_input = $('#input2').val();
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {
                    action: "gulicka",
                    start_input: start_input,
                    end_input: end_input
                },
                success: function(response) {
                    $('#initialInput').hide();
                    start_input = response.last_end_input;
                    console.log(response);
                    updateGraph(graph, response.output1, response.output2);
                }
            }
        );
    });
    $("#model3").click(function() {
        start_input = $('#input3_start').val();
        let end_input = $('#input3').val();  
        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {
                    action: "lietadlo",
                    start_input: start_input,
                    end_input: end_input
                },
                success: function(response) {
                    $('#initialInput').hide();
                    start_input = response.last_end_input;
                    console.log(response);
                    updateGraph(graph, response.output1, response.output2);
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

function updateGraph(graphName, y1, y2){
    let xArr = Array();
    let max = y1;
    if(y1.length < y2.length){
        max = y2;
    }

    for(let x = 0; x < max.length; x++){
        xArr.push(x);
    }

    let graph1 = {
        x: xArr,
        y: y1,
        type: 'scatter',
        name: 'Prvý výstup',
        line: {
            color: 'blue',
            width: 1   
        }
    };
    let graph2 = {
        x: xArr,
        y: y2,
        type: 'scatter',
        name: 'Druhý výstup',
        line: {
            color: 'green',
            width: 1   
        }
    };

    let layout = {
        title: 'Graf Plotly',
        xaxis: {
        title: 'x',
        },
        yaxis: {
        title: 'y',
        }

    }
    let data = [graph1, graph2];

    Plotly.newPlot(graphName, data, layout);

    //Plotly.update(graphName, data, layout, 1);
}