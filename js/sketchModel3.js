let data1;
let data2;
$(document).ready(function() {
    let data = [];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, data);
    $("#model3").click(function() {
        start_input = $('#input3_start').val();
        end_input = $('#input3').val();
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
                    $('#input3_start').val(response.last_end_input);
                    console.log(response);
                    data1 = response.output1;
                    data2 = response.output2;
                    updateGraph(graph, response.output1, response.output2);
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

function preload() {
    planeImg = loadImage('planeImg/planeModel.png');
    flapImg = loadImage('planeImg/flapModel.png');
}

function setup() {
    let canvas;
    canvas = createCanvas(1000,650);
    canvas.parent("lul");
    background(color(153, 221, 255));
}

let way = "down";
let watched = 0;
let timer = 0;

let pcTimer = 0;
function draw() {
    background(color(153, 221, 255));
    if (data1 != null && data2 != null && watched === 0) {
        watched = 1;
        console .log(data1, data2);
    }
    if (data1 !=null){
        if (timer>400){
            timer = 0;
        }
        translate(width / 2, height / 2);
        rotate(data1[timer]);
        imageMode(CENTER);
        image(planeImg, 0, 0);
        let x = Math.cos(PI / 180 * angle) + 250;
        let y = Math.sin(PI / 180 * angle) - 27;

        translate(x, y);
        rotate(-data2[timer]);
        image(flapImg, 0, 0);
        console.log(data1[timer], data2[timer]);
        if (pcTimer === 3){
            timer +=1;
            pcTimer = 0;
        }
        else pcTimer++;
    }
    /*
    if (way === "down"){
        angle+=0.5;
    }
    if (way === "up"){
        angle-=0.5;
    }

    if (way === "down" && angle > 45){
        way = "up";
    }
    if (way === "up" && angle < 0){
        way = "down";
    }*/
}