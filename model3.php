<?php
    include "language.php";
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title>Model 3</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/p5@1.0.0/lib/p5.js"></script>
    <script>
        function setup() {
            let cnv = createCanvas(400, 400);
            cnv.class(" p5Canvas");
            cnv.id("kyvadlo");
        }
        function draw() {
            background(100);
        }
    </script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><?php echo $lang["navMainSite"]?><span class="sr-only">(current)</span></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="model1.php">Model 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="model2.php">Model 2</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="model3.php">Model 3<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="documentation.php"><?php echo $lang["documentation"]?></a>
                </li>
            </ul>
        </div>
    </nav>

    <br>
    <div id="tester" style="width:600px;height:250px;"></div>

    <script>
        TESTER = document.getElementById('tester');
        Plotly.newPlot( TESTER, [{
            x: [1, 2, 3, 4, 5],
            y: [1, 2, 4, 8, 16] }], {
            margin: { t: 0 } } );
    </script>

    <div class="footer bg-dark">
        <a href="model1.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="model1.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>

</body>

</html>
