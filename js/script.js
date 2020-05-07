$(document).ready(function(){
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

    };
    let data = [graph1, graph2];

    Plotly.newPlot(graphName, data, layout);

    // Plotly.update(graphName, data, layout, 1);
}