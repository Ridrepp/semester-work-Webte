var canvas;
var palicka, gulicka, groupPalickaGulicka, responseArrayLength, counter;
const radToDeg = 57.2957795;
var xList = [];
var y1List = [];
var y2List = [];
var graphData = [];

const layout = {
    title: 'Gulička na tyči',
    xaxis: {
    title: 'čas',
    },
    yaxis: {
    title: 'poloha',
    }

};

$(document).ready(function() {
    var startPos, endPos, angle, animationInterval;
    const intervalDuration = 100;
    const responseArrayLength = 501;
    createGraph();
    display();
    $('#animation_model1').click(function(){
        display();
    });
    $('#graph_model1').click(function(){
        display();
    });

    canvas = new fabric.Canvas('fabricAnim2', {backgroundColor: "lightblue"});

    $("#model2").click(function () {

        //TODO: prevent click if animation in progress...
        //TODO2: prevent click if value > canvas width && value < -canvas width

        xList.length =  y1List.length = y2List.length = counter = 0;
        start_input = $('#input2_start').val();
        end_input = $('#input2').val();
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
                success: function (response) {
                    $('#initialInput').hide();
                    animationInterval = setInterval(function(){ 
                        if(counter == 0){
                            startPos = start_input;
                            endPos = response.output1[counter];
                        }
                        else{
                            startPos = response.output1[counter-1];
                            endPos = response.output1[counter];
                        }
                        angle = response.output2[counter];
                        beamAndBallAnimation(intervalDuration, startPos, endPos, angle, counter);
                        updateGraph2(response.output1[counter], response.output2[counter], counter);
                        counter++;
                        if(counter == responseArrayLength){
                            clearInterval(animationInterval);
                            $('#input2_start').val(response.output1[counter-1]);
                            xList.length =  y1List.length = y2List.length = 0;
                        }
                     }, intervalDuration);
                },
                error: function (response) {
                    let r = response.responseText;
                    if (r.includes("wrong apiKey")) {
                        $('#ApiErrorMsg').css("display", "block");
                    }
                    console.log(response.responseText);
                }
            }
        );
    });
});



function beamAndBallAnimation(intervalDuration, startPos, endPos, angle, counter){
    var spos = parseFloat(startPos);
    var epos = parseFloat(endPos);
    var degAngle = parseFloat(angle*radToDeg);
    //console.log("startPos:"+spos.toFixed(2)+" endPos:"+epos.toFixed(2)+ " angle in deg:"+degAngle.toFixed(2)+" counter:"+counter);

    if(palicka == null || gulicka == null || groupPalickaGulicka == null){
        const topPadding = $('#fabricAnim2').height()/2;
        const lineWidth = $('#fabricAnim2').width();
        const ballRadius = 15;
        palicka = new fabric.Line([0, 0, lineWidth, 0], {top: topPadding, stroke: 'red',selectable:false });
        gulicka = new fabric.Circle({ top: topPadding-ballRadius*2, left: lineWidth/2, radius: ballRadius, fill: 'green' ,selectable:false});
        groupPalickaGulicka = new fabric.Group([palicka,gulicka],{selectable:false});
        canvas.add(groupPalickaGulicka);
    }

    groupPalickaGulicka.animate('angle', degAngle, {
        onChange: canvas.renderAll.bind(canvas),
        duration: intervalDuration,
    });
      gulicka.animate('left', endPos, {
        onChange: canvas.renderAll.bind(canvas),
        duration: intervalDuration,
    });

    canvas.renderAll();
}

function createGraph(){
    let ballMovement = {
        x: xList,
        y: y1List,
        //type: 'scatter',
        name: 'Pozícia guličky',
        line: {
            color: 'blue',
            width: 1
        }
    };
    let lineAngle = {
        x: xList,
        y: y2List,
        //type: 'scatter',
        name: 'Uhol tyče',
        line: {
            color: 'green',
            width: 1
        }
    };

    let graphData = [ballMovement, lineAngle];

    let graph = document.getElementById('graphPlotly2');
    Plotly.newPlot(graph, graphData, layout);

}

function updateGraph2(newY1, newY2, counter){
    xList.push(counter);
    y1List.push(newY1);
    y2List.push(newY2);
                
    Plotly.update('graphPlotly2', graphData, layout, 1);  
    /*
    Plotly.animate('graphPlotly2', {
        data: [{y: [Math.random(), Math.random(), Math.random()]}],
        traces: [0],
        layout: {}
      }, {
        transition: {
          duration: 500,
          easing: 'cubic-in-out'
        },
          frame: {
              duration: 500
          }
      })*/
}

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
    $('#graphPlotly2').show();
}
function disableGraph(){
    $('#graphPlotly2').hide();
}
function enableAnimation(){
    $('#animation').show();
}
function disableAnimation(){
    $('#animation').hide();
}