$(document).ready(function(){

    let data = [];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, data);

    var canvas = new fabric.Canvas('fabricAnim');
    var pendulumImgSrc = 'inv_pendulum_edited.png';
    fabric.Image.fromURL(pendulumImgSrc, function(img){
        /*img.width = 550;
        img.height = 400;*/
        img.left = 200;
        img.selectable = false;
        canvas.add(img);

        img.animate({left: 500, top: 50},{
            onChange: canvas.renderAll.bind(canvas),
            duration: 2000
        })
    })

    

    display();
    $('#animation_model1').click(function(){
        display();
    });
    $('#graph_model1').click(function(){
        display();
    });

    $("#model1").click(function() {
        start_input = $('#input1_start').val();
        end_input = $('#input1').val();
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
                    $('#input1_start').val(response.last_end_input);

                    $.ajax(
                        {
                            type: "POST",
                            url: "octaveAPI/model1.php",
                            data: {
                                button: "buttonSubmit1"
                            },
                            success: function(response) {
                            },
                        }
                    )
                    console.log(response);
                    updateGraph(graph, response.output1, response.output2);
                    fabric.Image.fromURL(pendulumImgSrc, function (img) {
                        /*img.scale(0.5).set({
                            left: 100,
                            top: 100
                        });
                        canvas.add(img).setActiveObject(img);
                        img.moveTo(0);*/
                        //console.log(img.angle);
                        //console.log("animating");

                        img.animate({left: 100, top: 0},{
                            onChange: canvas.renderAll.bind(canvas),
                            duration: 2000
                        })
                    });
                },
                error: function (response) {
                    console.log(response.responseText);

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
    $("#sendEmail").click(function() {
        let email = $('#email').val();
        $.ajax(
            {
                type: "POST",
                url: "mail.php",
                data: {
                    email: email,
                },
                success: function(response) {
                    $.notify(response,"success");
                },
                error: function (response) {
                    $.notify("Error","error");
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
}
function disableGraph(){
    $('#graphPlotly1').hide();
}
function enableAnimation(){
    $('#animation').show();
}
function disableAnimation(){
    $('#animation').hide();
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