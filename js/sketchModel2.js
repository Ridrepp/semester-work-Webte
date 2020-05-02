$(document).ready(function() {
    let data = [];
    let graph = document.getElementById('graphPlotly1');
    Plotly.newPlot(graph, data);
    $("#model2").click(function () {
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
                    $('#input2_start').val(response.last_end_input);
                    console.log(response);
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