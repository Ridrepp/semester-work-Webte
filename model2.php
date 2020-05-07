<?php
    include "language.php";
    include "octaveAPI/config.php";
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title>Model 2</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.4/gsap.min.js"></script>

    <script src="js/sketchModel2.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.3/fabric.min.js"></script>
</head>

<body>
    <?php
    if(isset($_POST["button"])){
        $sqlP = "SELECT * FROM `visits` WHERE `model` = 'Ball & Beam';";

        if($result = mysqli_query($connSQLI, $sqlP)) {
            if(mysqli_num_rows($result) > 0) {
                $sqlP = "UPDATE `visits` SET `count_usage` = `count_usage` + 1 WHERE `model` ='Ball & Beam'";
                $connSQLI->query($sqlP);
            }
            else{
                $sqlP = "INSERT INTO `visits` (`model`,`count_usage`) VALUES ('Ball & Beam',1)";
                $connSQLI->query($sqlP);
            }
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href=<?php echo "index.php?lang=".$_GET['lang']?>><?php echo $lang["navMainSite"]?><span class="sr-only">(current)</span></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href=<?php echo "model1.php?lang=".$_GET['lang']?>><?php echo $lang["model1"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=<?php echo "model2.php?lang=".$_GET['lang']?>><?php echo $lang["model2"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=<?php echo "model3.php?lang=".$_GET['lang']?>><?php echo $lang["model3"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=<?php echo "documentation.php?lang=".$_GET['lang']?>><?php echo $lang["documentation"]?></a>
                </li>
            </ul>
        </div>
    </nav>

    <br>
    <h2 class="center"><?php echo $lang["model2"];?></h2>
    <div class="alert alert-danger" id="ApiErrorMsg" style="display: none"><h5 id="errorMsgH4"><?php echo $lang["errorApiKey"];?></h5></div>
    <div class="container">
    <h6 style="color:red; font-style: italic; font-size:13px;">*<?php echo $lang["ballRangeDescription"]?></h6>
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <form>
                    <div id="initialInput">
                        <label for="input2_start"><?php echo $lang["start_input"]?> </label> <input id="input2_start" placeholder = "[-500, +500]" type="number">
                    </div>
                    <label for="input2"><?php echo $lang["input"]?> </label> <input id="input2" placeholder = "[-500, +500]" type="number"><br>
                    <button type="button" id="model2"><?php echo $lang["sending"]?></button>
                </form>
                <div style="display:flex; justify-content: space-between; width:35%; margin:20px auto;">
                    <div style="flex">
                        <label for="animation_model2"></label><input type="checkbox" id="animation_model2" name="animation" value="animation" checked>
                        <label for="animation"><?php echo $lang["animation"]?></label>
                    </div>
                    <div>
                        <label for="graph_model2"></label><input type="checkbox" id="graph_model2" name="graph" value="graph" checked>
                        <label for="graph"><?php echo $lang["graph"]?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div id="graphPlotly2" style="width:1000px;height:350px;"></div>
    </div>

    <div class="row justify-content-center" id="animation" style="margin: 80px 0;">
        <canvas id="fabricAnim2" width="1450" height="550" style="border: solid black 3px"></canvas>
    </div>

    <div class="footer bg-dark">
        <a href="model2.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="model2.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>

</body>

</html>
