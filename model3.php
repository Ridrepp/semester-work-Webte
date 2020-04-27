<?php
    include "language.php";
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title>Model 3</title>
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
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="model1.php"><?php echo $lang["model1"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="model2.php"><?php echo $lang["model2"]?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="model3.php"><?php echo $lang["model3"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="documentation.php"><?php echo $lang["documentation"]?></a>
                </li>
            </ul>
        </div>
    </nav>

    <br>
    <div class="container" style="margin-top: 20px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <form>
                    <label for="input3"><?php echo $lang["input"]?> </label> <input id="input3" type="number">
                    <button type="button" id="model3"><?php echo $lang["sending"]?></button>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["input"])){
        echo $_POST["input"];
    }
    ?>
    <div id="tester" style="width:600px;height:250px;"></div>

    <script>
        TESTER = document.getElementById('tester');
        Plotly.newPlot( TESTER, [{
            x: [1, 2, 3, 4, 5],
            y: [1, 2, 4, 8, 16] }], {
            margin: { t: 0 } } );
    </script>

    <div class="footer bg-dark">
        <a href="model3.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="model3.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>

</body>

</html>
