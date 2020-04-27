<?php
    include "language.php";
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title>Model 1</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.4/gsap.min.js"></script>

    <script src="js/script.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/p5@1.0.0/lib/p5.js"></script>
    <!--    <script src="sketch.js"></script>-->
    <script>
        function setup() {
            let cnv = createCanvas(400, 400);
            cnv.class("kyvadlo p5Canvas");
            cnv.id("kyvadlo");
        }
        function draw() {
            background(100);
        }
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><?php echo $lang["navMainSite"]?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="model1.php"><?php echo $lang["model1"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="model2.php"><?php echo $lang["model2"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="model3.php"><?php echo $lang["model3"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="documentation.php"><?php echo $lang["documentation"]?></a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <h2 class="center"><?php echo $lang["model1"];?></h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <form>
                    <label for="input1"><?php echo $lang["input"]?> </label> <input id="input1" type="number">
                    <button type="button" id="model1"><?php echo $lang["sending"]?></button>
                </form>
            </div>
        </div>
    </div>

    <?php
        if (isset($_POST["arrData1"])){
            $pc = 0;
            $x = "";
            $y = "";
            foreach ($_POST["arrData1"] as $item){
                $x = $x . $pc . ", ";
                $pc++;
                $y = $y . $item . ", ";
                //echo $item . "<br>";
            }
            substr($x, -2);
            substr($y, -2);
        }
        if (isset($_POST["arrData2"])){
            $pc = 0;
            $x2 = "";
            $y2 = "";
            foreach ($_POST["arrData2"] as $item){
                $x2 = $x2 . $pc . ", ";
                $pc++;
                $y2 = $y2 . $item . ", ";
                //echo $item . "<br>";
            }
            substr($x2, -2);
            substr($y2, -2);
//            echo "<pre>".json_encode($_POST["arrData1"])."</pre>";
        }
    ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div id="tester" style="width:600px;height:250px;"></div>
            </div>

            <div class="col-6">
                <div id="tester2" style="width:600px;height:250px;"></div>
            </div>
        </div>
    </div>

    <script>
        TESTER = document.getElementById('tester');
        Plotly.newPlot( TESTER, [{
                x: [<?php echo $x?>],
                y: [<?php echo $y?>]}],
            {margin: { t: 0 } } );
        TESTER2 = document.getElementById('tester2');
        Plotly.newPlot( TESTER2, [{
            x: [<?php echo $x2?>],
            y: [<?php echo $y2?>] }], {
            margin: { t: 0 } } );
    </script>





    <div class="footer bg-dark">
        <a href="model1.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="model1.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>

</body>

</html>
