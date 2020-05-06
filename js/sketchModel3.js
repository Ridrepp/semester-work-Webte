let data1;
let data2;
var xCoord = [];
var y1Coord = [];
var y2Coord = [];
var graphData = [];

const layout = {
    title: 'Náklon lietadla / Tilt of the aircraft',
    xaxis: {
        title: 'čas / time',
    },
    yaxis: {
        title: 'Náklon (rad)/ Tilt (rads)',
    }

};

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
    
    let data = [];
    let graph = document.getElementById('graphPlotly1');
    let pattern = /^[-+]?[0-9]+[.]?[0-9]+$|^[-+]?[0-9]+$/;
    createGraph();
    //Plotly.newPlot(graph, data);
    $("#model3").click(function() {
        start_input = $('#input3_start').val();
        end_input = $('#input3').val();
        
        if(!start_input.match(pattern) || !end_input.match(pattern)){
            $.notify("Zlý vstup.","error");
            return;
        }
        $.ajax(
            {
                type: "GET",
                url: "octaveAPI/api.php",
                dataType: "json",
                data: {
                    action: "lietadlo",
                    start_input: start_input,
                    end_input: end_input
                },
                success: function(response) {
                    $('#initialInput').hide();
                    $('#input3_start').val(response.last_end_input);
                    console.log(response);
                    data1 = response.output1;
                    data2 = response.output2;
                    //updateGraph(graph, response.output1, response.output2);
                },
                error: function (response) {
                    let r = response.responseText;
                    if (r.includes("wrong apiKey")){
                        $('#ApiErrorMsg').css("display", "block");
                    }
                    console.log(response.responseText);
                }
            }
        );
    });
});

let angle = 0;
let planeImg;
let flapImg;
let cloudImg;

function preload() {
    planeImg = loadImage('planeImg/planeModel.png');
    flapImg = loadImage('planeImg/flapModel.png');
    cloudImg = loadImage('planeImg/cloud.png');
}

function setup() {
    let canvas;
    canvas = createCanvas(1000,700);
    canvas.parent("animation");
    background(color(153, 221, 255));
}

let watched = 0;
let timer = 0;

let pcTimer = 0;
function draw() {
    background(color(153, 221, 255));
    imageMode(CENTER);
    image(cloudImg,width-500,height-275,1180,492);
    if (data1 != null && data2 != null && watched === 0) {
        watched = 1;
        console .log(data1, data2);
    }
    if (data1 !=null){
        if (timer>data1.length){
            timer = 0;
            xCoord = [];
            y1Coord = [];
            y2Coord = [];
            createGraph();
        }
        noStroke();
        fill(color(0,200,0));
        rect(0,0,timer/data1.length*1000,20);
        console.log(timer/data1.length*1000);
        updateGraphSketch3(data1[timer], data2[timer], timer);
        translate(width / 2, height / 2);
        rotate(data1[timer]);
        imageMode(CENTER);
        image(planeImg, 0, 0);
        let x = Math.cos(PI / 180 * angle) + 250;
        let y = Math.sin(PI / 180 * angle) - 27;

        translate(x, y);
        rotate(-data2[timer]);
        image(flapImg, 0, 0);
        //console.log(data1[timer], data2[timer]);
        if (pcTimer === 0){
            timer +=1;
            pcTimer = 0;
        }
        else pcTimer++;
    }
}

function createGraph(){
    let pendulum = {
        x: xCoord,
        y: y1Coord,
        name: 'Vychýlenie lietadla v radiánoch/Deflection of plane in radians',
        line: {
            color: 'blue',
            width: 1
        }
    };
    let angleOfDeflection = {
        x: xCoord,
        y: y2Coord,
        name: 'Vychýlenie klapky v radiánoch/Deflection of flap in radians',
        line: {
            color: 'orange',
            width: 1
        }
    };

    let graphData = [pendulum, angleOfDeflection];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, graphData, layout);
}

function updateGraphSketch3(Y1, Y2, counter){
    xCoord.push(counter);
    y1Coord.push(Y1);
    y2Coord.push(Y2);

    Plotly.update('graphPlotly1', graphData, layout, 1);
}