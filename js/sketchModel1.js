let data1;
let data2;
$(document).ready(function() {
    let data = [];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, data);
    $("#model1").click(function () {
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
                    $('#input1_start').val(response.last_end_input);
                    console.log(response);
                    data1 =response.output1;
                    data2 =response.output2;
                    updateGraph(graph, response.output1, response.output2);
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
let watched = 0;
let timer = 0;
let pcTimer = 0;

function preload() {
    pendulum = loadImage('pendulum/Pendulum0.png');
}

function setup()  {
    let canvas = createCanvas(700,400);
    canvas.parent("animation1");
    canvas.id("pendulum");
    background(color(192, 192, 192));
}

function draw() {
    background(color(192, 192, 192));
    if (data1 != null && data2 != null && watched === 0) {
        watched = 1;
        console.log(data1, data2);
    }
    if (data1 != null){
        if (timer>400){
            timer = 0;
        }
        pendulum.resize(400,400);
        translate(width/2,height);
        rotate(data1[timer]);
        imageMode(CENTER);
        image(pendulum, 0, 0);
        console.log(data1[timer], data2[timer]);
        if (pcTimer === 3){
            timer +=1;
            pcTimer = 0;
        }
        else pcTimer++;
    }
}
