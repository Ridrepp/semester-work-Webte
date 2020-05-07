let counter;
let xCoord = [];
let y1Coord = [];
let y2Coord = [];
let graphData = [];
let actualData1;
let actualData2;
const maxValue = 400;

$(document).ready(function() {
    let lang;
    $('#descriptionModel1AfterSubmit').hide();
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
    console.log(searchParams.get('lang'));
    var startPos, endPos,interval;
    const arrayLength = 201;
    const intervalDuration = 50;
    let layoutTitle, layoutXTitle, layoutYTitle;
    if (lang === "sk") {
        layoutTitle = 'Prevrátené kyvadlo';
        layoutXTitle = 'časový úsek';
        layoutYTitle = 'pozícia kyvadla';
    } else {
        layoutTitle = "Inverted Pendulum";
        layoutXTitle = 'time period';
        layoutYTitle = 'pendulum position';
    }
    const inputErrorNotify = {
        className: "error",
        position:"right middle",
        autoHideDelay: 3000
    };
    let notifyAnimationProgress = {
        autoHideDelay: (intervalDuration*arrayLength),
        arrowShow: false,
        className: "warning",
    };
    let layout = {
        title: layoutTitle,
        xaxis: {
            title: layoutXTitle,
        },
        yaxis: {
            title: layoutYTitle,
        }

    };
    createGraph(layout,lang);
    let pattern = /^[-+]?[0-9]+[.]?[0-9]+$|^[-+]?[0-9]+$/;

    $("#model1").click(function () {
        start_input = $('#input1_start').val();
        end_input = $('#input1').val();
        if(!start_input.match(pattern) || !end_input.match(pattern)){
            $.notify("Zlý vstup.","error");
            return;
        }
        else if (checkRangeInput(start_input,0,inputErrorNotify,lang)===false )
            return;
        else if (checkRangeInput(end_input,1,inputErrorNotify,lang)===false )
            return;

        xCoord.length = 0;
        y1Coord.length = 0;
        y2Coord.length = 0;
        counter = 0;
        $.ajax(
            {
                type: "GET",
                url: "octaveAPI/api.php?apiKey=6acecbbb8b287799b906826d2391f5",
                dataType: "json",
                data: {
                    action: "kyvadlo",
                    start_input: start_input,
                    end_input: end_input
                },
                success: function (response) {
                    updateDatabaseCount();
                    $('#initialInput').hide();
                    $('#descriptionModel1').hide();
                    if(lang === 'sk'){
                        $.notify("Práve prebieha animácia...", notifyAnimationProgress);
                    }
                    else if(lang === 'en'){
                        $.notify("Animation is in progress...", notifyAnimationProgress);
                    }
                    interval = setInterval(function(){
                        $('#model1').prop('disabled', true);
                        if(counter === 0){
                            startPos = start_input;
                            endPos = response.output1[counter];
                        }
                        else{
                            startPos = response.output1[counter-1];
                            endPos = response.output1[counter];
                        }
                        actualData1 = response.output1[counter];
                        actualData2 = response.output2[counter];
                        updateGraphSketch1(response.output1[counter], response.output2[counter],counter,layout);
                        counter++;
                        redraw();
                        if(counter === arrayLength){
                            clearInterval(interval);
                            // $('#input1_start').val(response.output1[counter-1]);
                            $('#input1').val("0");
                            $('#descriptionModel1AfterSubmit').show();
                            xCoord.length =  y1Coord.length = y2Coord.length = 0;
                            $('#model1').prop('disabled', false);
                            if(lang === 'sk'){
                                $.notify("Animácia bola dokončená.", "success");
                            }
                            else if(lang === 'en'){
                                $.notify("Animation completed.", "success");
                            }
                        }
                    }, intervalDuration);
                },
                error: function (response) {
                    let r = response.responseJSON.message;
                    if (r.includes("incorrect")) {
                        $('#ApiErrorMsg').css("display", "block");
                    }
                    console.log(r);
                }
            }
        );
    });
});

function updateDatabaseCount() {
    $.ajax(
        {
            type: "POST",
            url: "model1.php",
            data: {
                button: "buttonSubmit1"
            },
            success: function() {
            },
        }
    );
}

function checkRangeInput(input,inputCnt,inputErrorNotify, language) {
    if(input > maxValue || input < -maxValue){
        if (language === 'sk'){
            if(inputCnt === 0){
                $('#input1_start').notify("Číslo nie je v povolenom rozsahu.", inputErrorNotify);
            }
            else if (inputCnt === 1){
                $('#input1').notify("Číslo nie je v povolenom rozsahu.", inputErrorNotify);
            }
        }
        else if (language==='en'){
            if(inputCnt === 0){
                $('#input1_start').notify("Number is out of range.", inputErrorNotify);
            }
            else if (inputCnt === 1){
                $('#input1').notify("Number is out of range.", inputErrorNotify);
            }
        }
        return false;
    }
    return true;

}


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

function createGraph(layout, language){
    let pendulumName;
    let angleOfDeflectionName;
    if (language === "sk"){
        pendulumName = "Pozícia kyvadla";
        angleOfDeflectionName = "Vychýlenie v rad";
    }
    else{
        pendulumName = "Position of Pendulum";
        angleOfDeflectionName = "Deflection in rad";
    }
    let pendulum = {
        x: xCoord,
        y: y1Coord,
        name: pendulumName,
        line: {
            color: 'blue',
            width: 1
        }
    };
    let angleOfDeflection = {
        x: xCoord,
        y: y2Coord,
        name: angleOfDeflectionName,
        line: {
            color: 'orange',
            width: 1
        }
    };

    let graphData = [pendulum, angleOfDeflection];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, graphData, layout);

}

function updateGraphSketch1(Y1, Y2, counter,layout){
    xCoord.push(counter);
    y1Coord.push(Y1);
    y2Coord.push(Y2);

    Plotly.update('graphPlotly1', graphData, layout, 1);
}
