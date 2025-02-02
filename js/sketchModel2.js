var canvas, palicka, gulicka, groupPalickaGulicka, responseArrayLength, counter, slowConstant;
const radToDeg = 57.2957795;
var xList = [];
var y1List = [];
var y2List = [];
var graphData = [];
var first = true;

const maxAnimationWidth = 500;
const originalWidth = 1300;  
const originalHeight = 550;
var width, widthRatio, currAngleInDeg;
const startBallRadius = 30;
var ballRadius;

$(document).ready(function() {
    var lang, intervalDuration;
    let searchParams = new URLSearchParams(window.location.search);
    $('#input2_start').val(0);
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
    $('#input2_start').on('input', updateBallPosition);

    counter = 0;
    currAngleInDeg = 0;

    const pattern = /^[-+]?[0-9]+[.]?[0-9]+$|^[-+]?[0-9]+$/;
    var startPos = 0;
    var endPos = 0;
    var currAngleRad = 0;
    var animationInterval, layoutTitle, xTitle, yTitle;
    const responseArrayLength = 501;


    canvas = new fabric.Canvas('fabricAnim2');

    width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    widthRatio = originalWidth / width;
    console.log(widthRatio);

    canvas.width = (originalWidth-45) / widthRatio;
    canvas.height = originalHeight / widthRatio;
    canvas.setDimensions({width:canvas.width, height:canvas.height});

    var topPadding = $('#fabricAnim2').height()/2;
    var lineWidth = $('#fabricAnim2').width()+6;
    ballRadius = startBallRadius / widthRatio;
    gulicka = new fabric.Circle({ top: topPadding-ballRadius*2, left: ((lineWidth/2) + 0/widthRatio), radius: ballRadius, fill: 'green' ,selectable:false});    
    palicka = new fabric.Line([0, 0, lineWidth, 0], {top: topPadding, stroke: 'red',selectable:false });
    groupPalickaGulicka = new fabric.Group([palicka,gulicka],{angle: currAngleInDeg, selectable:false});
    canvas.add(groupPalickaGulicka);
    canvas.renderAll();

    console.log(canvas.width, canvas.height);
    

    $(window).on('resize', function(){
        width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        widthRatio = originalWidth / width;
        canvas.width = (originalWidth-45) / widthRatio;
        canvas.height = originalHeight / widthRatio;
        canvas.setDimensions({width:canvas.width, height:canvas.height});

        var spos = parseFloat(startPos);
        canvas.clear();
        var topPadding = $('#fabricAnim2').height()/2;
        var lineWidth = $('#fabricAnim2').width()+6;
        ballRadius = startBallRadius / widthRatio;
        
        if(first){
            gulicka = new fabric.Circle({ top: topPadding-ballRadius*2, left: ((lineWidth/2) + ($('#input2_start').val() / widthRatio) ), radius: ballRadius, fill: 'green' ,selectable:false});    
        }
        else{
            gulicka = new fabric.Circle({ top: topPadding-ballRadius*2, left: ((lineWidth/2) + spos/widthRatio), radius: ballRadius, fill: 'green' ,selectable:false});    
        }
        palicka = new fabric.Line([0, 0, lineWidth, 0], {top: topPadding, stroke: 'red',selectable:false });
        groupPalickaGulicka = new fabric.Group([palicka,gulicka],{angle: currAngleInDeg, selectable:false});
        canvas.add(groupPalickaGulicka);
        canvas.renderAll();
    });

    const notifyErrorInput = {
        className: "error",
        position:"right middle",
        autoHideDelay: 2000
    };

    if(lang == 'sk'){
        layoutTitle = 'Gulička na Tyči';
        xTitle = 'čas';
        yTitle = 'hodnoty';
    }
    else{
        layoutTitle = "Beam and Ball";
        xTitle = 'time period';
        yTitle = 'values';
    }

    const layout = {
        title: layoutTitle,
        xaxis: {
            title: xTitle,
        },
        yaxis: {
            title: yTitle,
        }
    };
    createGraph(layout, lang);
    display();
    $('#animation_model2').click(display);
    $('#graph_model2').click(display);



    $("#model2").click(function () {
        start_input = $('#input2_start').val();
        end_input = $('#input2').val();
        if(counter != 0 ){
            if (lang == 'sk'){
                $('#input2').notify("Stále prebieha posledná animácia. Počkajte na dokončenie.", notifyErrorInput);
            }
            else if (lang=='en'){
                $('#input2').notify("Last animation is still in progress. Please wait for it to finish.", notifyErrorInput);
            }
            
            return;
        }
        else if(!start_input.match(pattern) || !end_input.match(pattern)){
            if (lang == 'sk'){
                if(!start_input.match(pattern)){
                    $('#input2_start').notify("Zlý vstup.", notifyErrorInput);
                }
                else{
                    $('#input2').notify("Zlý vstup.", notifyErrorInput);
                }
            }
            else if (lang=='en'){
                if(!start_input.match(pattern)){
                    $('#input2_start').notify("Bad input.", notifyErrorInput);
                }
                else{
                    $('#input2').notify("Bad input.", notifyErrorInput);
                }
            }
            return;
        }
        else if(first && !checkInputRange(start_input, 1, notifyErrorInput, lang)){
            return;
        }
        else if(!checkInputRange(end_input, 2, notifyErrorInput, lang)){
            return;
        }
        
        xList.length =  y1List.length = y2List.length = 0;

        $.ajax(
            {
                type: "POST",
                url: "octaveAPI/config.php",
                dataType: "json",
                data: {
                    slow: "gulicka",
            },
            success: function (response) {
                slowConstant = response.value;
                if(slowConstant < 1){
                    slowConstant = 1;
                }
                intervalDuration = 100*slowConstant;
                console.log(intervalDuration);
                intervalDuration = parseInt(intervalDuration);
                var notifyAnimationInProgress = {
                    autoHideDelay: (intervalDuration*responseArrayLength)*3,
                    arrowShow: false,
                    className: "warning",
                };
                console.log(intervalDuration)

                $.ajax(
                    {
                        type: "GET",
                        url: "octaveAPI/api.php?apiKey=6acecbbb8b287799b906826d2391f5",
                        dataType: "json",
                        data: {
                            action: "gulicka",
                            start_input: start_input,
                            end_input: end_input
                        },
                        success: function (response) {
                            increaseVisitCount();
                            console.log(response)
                            $('#initialInput').hide();
                            
                            if(lang == 'sk'){
                                $.notify("Prebieha animácia...", notifyAnimationInProgress);
                            }
                            else if(lang == 'en'){
                                $.notify("Animation is in progress...", notifyAnimationInProgress);
                            }
                            animationInterval = setInterval(function(){
                                 
                                if(counter == 0){
                                    startPos = start_input;
                                    endPos = response.output1[counter];
                                }
                                else{
                                    startPos = response.output1[counter-1];
                                    endPos = response.output1[counter];
                                }
                                currAngleRad = response.output2[counter];
                                currAngleInDeg = currAngleRad*radToDeg;
                                beamAndBallAnimation(intervalDuration, startPos, endPos, counter);
                                updateGraph2(response.output1[counter], response.output2[counter], counter, layout);
                                counter++;
                                if(counter == responseArrayLength){
                                    clearInterval(animationInterval);
                                    animationInterval = null;
                                    $('#input2_start').val(response.output1[counter-1]);
                                    xList.length =  y1List.length = y2List.length = counter = 0;
                                    $('.notifyjs-wrapper').trigger('notify-hide');
                                    if(lang == 'sk'){
                                        $.notify("Animácia dokončená", "success");
                                    }
                                    else if(lang == 'en'){
                                        $.notify("Animation complete", "success");
                                    }
                                    
                                }
                             }, intervalDuration);
                             first = false;
                        },
                        error: function (response) {
                            let r = response.responseJSON.message;

                            if (r.includes("incorrect")) {
                                if (lang == 'sk'){
                                    $.notify("Nesprávny API kľúč.", "error");
                                }
                                else{
                                    $.notify("Wrong API key.", "error");
                                }
                                return;
                            }
                        }
                    }
                );
            },
            error: function (response) {
                
            }
        });


    });
});




function increaseVisitCount(){

    $.ajax(
        {
            type: "POST",
            url: "model2.php",
            data: {
                button: "buttonSubmit2"
            },
            success: function() {
            },
        }
    );

}

function checkInputRange(input, inputNr, notifyErrorInput, lang){

    if(input > maxAnimationWidth || input < -maxAnimationWidth){
        if (lang == 'sk'){
            if(inputNr == 1){
                $('#input2_start').notify("Číslo je mimo prijateľný rozsah.", notifyErrorInput);
            }
            else if (inputNr == 2){
                $('#input2').notify("Číslo je mimo prijateľný rozsah.", notifyErrorInput);
            }
        }
        else if (lang=='en'){
            if(inputNr == 1){
                $('#input2_start').notify("Number is out of range.", notifyErrorInput);
            }
            else if (inputNr == 2){
                $('#input2').notify("Number is out of range.", notifyErrorInput);
            }
        }
        return false;
    }
    return true;
}

function updateBallPosition(){
    var newPos = $('#input2_start').val();
    if(newPos <= maxAnimationWidth && newPos >= -maxAnimationWidth){
        canvas.clear();
        var topPadding = $('#fabricAnim2').height()/2;
        var lineWidth = $('#fabricAnim2').width()+6;
        ballRadius = startBallRadius / widthRatio;
        gulicka = new fabric.Circle({ top: topPadding-ballRadius*2, left: ((lineWidth/2) + newPos/widthRatio), radius: ballRadius, fill: 'green' ,selectable:false});    
        palicka = new fabric.Line([0, 0, lineWidth, 0], {top: topPadding, stroke: 'red',selectable:false });
        groupPalickaGulicka = new fabric.Group([palicka,gulicka],{angle: currAngleInDeg, selectable:false});
        canvas.add(groupPalickaGulicka);
        canvas.renderAll();
    }

}

function beamAndBallAnimation(intervalDuration, startPos, endPos, counter){
    var spos = parseFloat(startPos);

    if(palicka == null || gulicka == null || groupPalickaGulicka == null){
        var topPadding = $('#fabricAnim2').height()/2;
        var lineWidth = $('#fabricAnim2').width()+6;
        ballRadius = ballRadius/widthRatio;
        palicka = new fabric.Line([0, 0, lineWidth, 0], {top: topPadding, stroke: 'red',selectable:false });
        gulicka = new fabric.Circle({ top: topPadding-ballRadius*2, left: (lineWidth/2) + spos, radius: ballRadius, fill: 'green' ,selectable:false});
        console.log((lineWidth/2) + spos, (lineWidth/2))
        groupPalickaGulicka = new fabric.Group([palicka,gulicka],{selectable:false});
        canvas.add(groupPalickaGulicka);
    }

    groupPalickaGulicka.animate('angle', currAngleInDeg, {
        onChange: canvas.renderAll.bind(canvas),
        duration: intervalDuration,
    });
      gulicka.animate('left', endPos / widthRatio, {
        onChange: canvas.renderAll.bind(canvas),
        duration: intervalDuration,
    });
    canvas.renderAll();
}

function createGraph(layout, lang){
    var n, n1;
    if(lang == 'sk'){
        n = 'Pozícia guličky';
        n1 = 'Uhol tyče';
    }
    else{
        n = "Ball position";
        n1 = 'Beam tilt';
    }

    let ballMovement = {
        x: xList,
        y: y1List,
        name: n,
        line: {
            color: 'green',
            width: 1
        }
    };
    let lineAngle = {
        x: xList,
        y: y2List,
        name: n1,
        line: {
            color: 'red',
            width: 1
        }
    };

    let graphData = [ballMovement, lineAngle];
    let graph = document.getElementById('graphPlotly2');
    Plotly.newPlot(graph, graphData, layout, {responsive: true});

}

function updateGraph2(newY1, newY2, counter, layout){
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
    let animation_checked = $("#animation_model2").is(':checked');
    let graph_checked = $("#graph_model2").is(':checked');
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