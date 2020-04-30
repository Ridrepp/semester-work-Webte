<?php
    include "language.php";
    include "config.php";

    if(isset($_POST["buttonSubmit3"])){
        $sqlP = "SELECT * FROM `visits` WHERE `model` = 'Aircraft Pitch';";
        if($result = mysqli_query($conn, $sqlP)) {
            if(mysqli_num_rows($result) > 0) {
                $sqlP = "UPDATE `visits` SET `count_usage` = `count_usage` + 1 WHERE `model` ='Aircraft Pitch'";
                $conn->query($sqlP);
            }
            else{
                $sqlP = "INSERT INTO `visits` (`model`,`count_usage`) VALUES ('Aircraft Pitch',1)";
                $conn->query($sqlP);
            }
        }
    }

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
    <script src="js/buttonScript.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/p5@1.0.0/lib/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.3/fabric.min.js"></script>
    <script>
        function setup() {
            let cnv = createCanvas(400, 400);
            cnv.class("animationP5 p5Canvas");
            cnv.id("animationP5");
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
    <h2 class="center"><?php echo $lang["model3"];?></h2>
    <div class="container" style="margin-top: 20px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <form>
                    <div id="initialInput">
                        <label for="input3_start"><?php echo $lang["start_input"]?> </label> <input id="input3_start" type="number">
                    </div>
                    <label for="input3"><?php echo $lang["input"]?> </label> <input id="input3" type="number"><br>
                    <button type="button" id="model3"><?php echo $lang["sending"]?></button>
                </form>
                <div style="display:flex; justify-content: space-between; width:35%; margin:20px auto;">
                    <div style="flex">
                        <input type="checkbox" id="animation_model1" name="animation" value="animation" checked="true">
                        <label for="animation"><?php echo $lang["animation"]?></label>
                    </div>
                    <div>
                        <input type="checkbox" id="graph_model1" name="graph" value="graph" checked="true">
                        <label for="graph"><?php echo $lang["graph"]?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div id="graphPlotly1" style="width:1500px;height:450px;"></div>
        </div>
    </div>

    <div class="footer bg-dark">
        <a href="model3.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="model3.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>

</body>

</html>
