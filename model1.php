<?php
    include "language.php";
    include "octaveAPI/config.php";
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
    <script src="js/sketchModel1.js"></script>
    <script src="p5/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>

<body>
    <?php
    if(isset($_POST["button"])){
        $sqlP = "SELECT * FROM `visits` WHERE `model` = 'Inverted Pendulum';";

        if($result = mysqli_query($connSQLI, $sqlP)) {
            if(mysqli_num_rows($result) > 0) {
                $sqlP = "UPDATE `visits` SET `count_usage` = `count_usage` + 1 WHERE `model` ='Inverted Pendulum'";
                $connSQLI->query($sqlP);
            }
            else{
                $sqlP = "INSERT INTO `visits` (`model`,`count_usage`) VALUES ('Inverted Pendulum',1)";
                $connSQLI->query($sqlP);
            }
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href=<?php echo "index.php?lang=".$_GET['lang']?>><?php echo $lang["navMainSite"]?></a>
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
    <h2 class="center"><?php echo $lang["model1"];?></h2>
    <div class="alert alert-danger" id="ApiErrorMsg" style="display: none"><h5 id="errorMsgH4"><?php echo $lang["errorApiKey"];?></h5></div>

    <div id="descriptionModel1" class="container">
        <div class="row justify-content-center">
            <div class="col-7">
                <h6 style="color: darkblue"><?php echo $lang["model1Description"];?></h6>
            </div>
        </div>
    </div>
    <div id="descriptionModel1AfterSubmit" class="container">
        <div class="row justify-content-center">
            <div class="col-7">
                <h6 style="color: darkblue"><?php echo $lang["model1DescriptionAfterSubmit"];?></h6>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <form id="model">
                    <div id="initialInput">
                        <label for="input1_start"><?php echo $lang["start_input"]?> </label> <input id="input1_start" type="number" placeholder="Range: [-400, 400]">
                    </div>
                    <label for="input1"><?php echo $lang["input"]?> </label> <input id="input1" type="number" placeholder="Range: [-400, 400]"><br>
                    <button type="button" id="model1"><?php echo $lang["sending"]?></button>
                </form>
                <div style="display:flex; justify-content: space-between; width:35%; margin:20px auto;">
                    <div style="flex">
                        <label for="animation_model1"></label><input type="checkbox" id="animation_model1" name="animation" value="animation" checked>
                        <label for="animation"><?php echo $lang["animation"]?></label>
                    </div>
                    <div>
                        <label for="graph_model1"></label><input type="checkbox" id="graph_model1" name="graph" value="graph" checked>
                        <label for="graph"><?php echo $lang["graph"]?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="row justify-content-center">
            <div id="graphPlotly1" style="width:1000px;height:400px;"></div>
        </div>
    </div>
    <div class="margin-center">
        <div id="animation"></div>
    </div>
    <div class="footer bg-dark">
        <a href="model1.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="model1.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>

</body>

</html>
