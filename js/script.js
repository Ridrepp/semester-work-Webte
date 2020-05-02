$(document).ready(function(){
    let data = [];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, data);

    // var canvas = new fabric.Canvas('fabricAnim');
    // var pendulumImgSrc = 'inv_pendulum_edited.png';
    // fabric.Image.fromURL(pendulumImgSrc, function(img){
    //     /*img.width = 550;
    //     img.height = 400;*/
    //     img.left = 200;
    //     img.selectable = false;
    //     canvas.add(img);
    //
    //     img.animate({left: 500, top: 50},{
    //         onChange: canvas.renderAll.bind(canvas),
    //         duration: 2000
    //     })
    // });

    (function() {
        var canvas = new fabric.Canvas('fabricAnim');
        var tyc_kyvadlo_gula=new fabric.Line([370, 40, 370, 195], {left: 375,top: 40,stroke: 'red',selectable:false });
        var polgula_zakladneho_kyvadla = new fabric.Circle({ top: 190, left: 365, radius: 10, fill: 'blue' ,selectable:false});
        var zaklad_kyvadla = new fabric.Rect({ top: 200, left: 325, width: 100, height: 50, fill: '#f55' ,selectable:false});
        var lave_koleso = new fabric.Circle({ top: 240, left: 330, radius: 15, fill: 'green' ,selectable:false});
        var prave_koleso = new fabric.Circle({ top: 240, left: 390, radius: 15, fill: 'green',selectable:false });
        var vrchna_gula = new fabric.Circle({ top: 20, left: 360, radius: 15, fill: 'blue' ,selectable:false});
        var group_zaklad = new fabric.Group([ polgula_zakladneho_kyvadla, zaklad_kyvadla,lave_koleso,prave_koleso ], {
            selectable:false,
            // left: 150,
            // top: 100,
            // angle: -10
        });
        var group_vrch = new fabric.Group([ tyc_kyvadlo_gula,vrchna_gula], {selectable:false,
            // left: 150,
            // top: 100,
            // angle: -10
        });
        // canvas.add(group_vrch,group_zaklad);

        // alert(canvas.getObjects().indexOf(group_zaklad));
        // alert(canvas.getObjects().indexOf(group_vrch));
        // group_vrch.animate({left: 440, angle: 30}, {duration: 5000,onChange: canvas.renderAll.bind(canvas) });
        // group_zaklad.animate({left: 440}, {duration: 5000, onChange: canvas.renderAll.bind(canvas) });
        var groupAll = new fabric.Group([group_vrch,group_zaklad],{selectable:false});
        canvas.add(groupAll);
        group_vrch.animate("angle","-=10", {duration: 5000,onChange: canvas.renderAll.bind(canvas) });

        groupAll.animate("left","+=335", {duration: 5000, onChange: canvas.renderAll.bind(canvas) });
        // group_vrch.animate('angle', '-=50', {duration: 5000,onChange: canvas.renderAll.bind(canvas) });
        // group_zaklad.animate({ angle: -360 }, {
        //     easing: fabric.util.ease.easeOutCubic,
        //     duration: 500,
        //     onChange: canvas.renderAll.bind(canvas),
        //     onComplete: function onComplete() {
        //         console.log(Math.round(group_zaklad.angle)),
        //             group_vrch.animate({
        //                 angle: Math.round(group_vrch.angle) === 360 ? -360 : 360
        //             }, {
        //                 duration: 500,
        //                 onComplete: onComplete
        //             });
        //     }
        // });
        // fabric.Image.fromURL('../lib/pug.jpg', function(img) {
        //     canvas.add(img.set({ left: 400, top: 350, angle: 30 }).scale(0.25));
        // });

        // function animate() {
            // canvas.item(0).animate('top', canvas.item(0).get('top') === 500 ? '100' : '500', {
            //     duration: 1000,
            //     onChange: canvas.renderAll.bind(canvas),
            //     onComplete: animate
            // });
        // }
        // animate();
    })();
    

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
                    console.log(response);

                    updateGraph(graph, response.output1, response.output2);


                    // fabric.Image.fromURL(pendulumImgSrc, function (img) {
                        /*img.scale(0.5).set({
                            left: 100,
                            top: 100
                        });
                        canvas.add(img).setActiveObject(img);
                        img.moveTo(0);*/
                        //console.log(img.angle);
                        //console.log("animating");

                        // img.animate({left: 100, top: 0},{
                        //     onChange: canvas.renderAll.bind(canvas),
                        //     duration: 2000
                        // })
                    // });
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
    $("#model2").click(function() {
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
                success: function(response) {
                    $('#initialInput').hide();
                    $('#input2_start').val(response.last_end_input);
                    console.log(response);
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

    };
    let data = [graph1, graph2];

    Plotly.newPlot(graphName, data, layout);

    // Plotly.update(graphName, data, layout, 1);
}