// let arrayLength;
var counter;
var xCoord = [];
var y1Coord = [];
var y2Coord = [];
var graphData = [];
let actualData1;
let actualData2;

const layout = {
    title: 'Prevrátené kyvadlo / Inverted Pendulum',
    xaxis: {
        title: 'čas / time',
    },
    yaxis: {
        title: 'pozícia / position',
    }

};
$(document).ready(function() {
    var startPos, endPos,interval;
    const arrayLength = 201;
    const intervalDuration = 50;
    createGraph();

    $("#model1").click(function () {
        xCoord.length = 0;
        y1Coord.length = 0;
        y2Coord.length = 0;
        counter = 0;
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
                success: function (response) {
                    $('#initialInput').hide();
                    interval = setInterval(function(){
                        $('#model1').prop('disabled', true);
                        if(counter == 0){
                            startPos = start_input;
                            endPos = response.output1[counter];
                        }
                        else{
                            startPos = response.output1[counter-1];
                            endPos = response.output1[counter];
                        }
                        actualData1 = response.output1[counter];
                        actualData2 = response.output2[counter];
                        updateGraphSketch1(response.output1[counter], response.output2[counter],counter);
                        counter++;
                        redraw();
                        if(counter == arrayLength){
                            clearInterval(interval);
                            $('#input1_start').val(response.output1[counter-1]);
                            xCoord.length =  y1Coord.length = y2Coord.length = 0;
                            $('#model1').prop('disabled', false);
                            // noLoop();
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


let angle = 0;
let pendulum;
let liner;

function preload() {
    pendulum = loadImage('pendulum/Pendulum.png');
    liner = loadImage('pendulum/LineUnderPendulum.png')
}

function setup()  {
    let canvas = createCanvas(900,400);
    canvas.parent("animation");
    canvas.id("pendulum");
    background(color(192, 192, 192));
    noLoop();
}

function draw() {
    background(color(192, 192, 192));
    translate((width/2)+actualData1,height);
    rotate(actualData2);
    imageMode(CENTER);
    image(pendulum, 0, 0);
    let x = Math.cos(PI / 180 * angle);
    let y = Math.sin(PI / 180 * angle);
    translate(x,y);
    rotate(-actualData2);
    image(liner, 0, 0);
    console.log(actualData1, actualData2);
}

function createGraph(){
    let pendulum = {
        x: xCoord,
        y: y1Coord,
        name: 'Pozícia kyvadla/Position of Pendulum',
        line: {
            color: 'blue',
            width: 1
        }
    };
    let angleOfDeflection = {
        x: xCoord,
        y: y2Coord,
        name: 'Vychýlenie v rad/Deflection in rad',
        line: {
            color: 'orange',
            width: 1
        }
    };

    let graphData = [pendulum, angleOfDeflection];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, graphData, layout);

}

function updateGraphSketch1(Y1, Y2, counter){
    xCoord.push(counter);
    y1Coord.push(Y1);
    y2Coord.push(Y2);

    Plotly.update('graphPlotly1', graphData, layout, 1);
}
