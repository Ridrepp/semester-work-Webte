<?php
    include "language.php";
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title><?php echo $lang["title"]?></title>
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
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand active" href="index.php"><?php echo $lang["navMainSite"]?></a>
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
                <li class="nav-item">
                    <a class="nav-link" href="model3.php"><?php echo $lang["model3"]?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="documentation.php"><?php echo $lang["documentation"]?></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h1><?php echo $lang["heading"]?></h1>
                <p><?php echo $lang["description"]?></p>
            </div>

        </div>
    </div>
    <br>
    <?php
        if (isset($_POST["inputTextArea"])){
            echo "<p class='center'>".$_POST["inputTextArea"]."</p>";
        }
    ?>
    <div class="container" style="margin-top: 50px">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                <form>
                    <div>
                        <label for="textArea"><?php echo $lang["commands"]?></label>
                        <div>
                            <textarea id="textArea" style="width: 700px; height: 600px">
                            </textarea>
                        </div>
                    </div>
                    <button type="button" id="textAreaButton"><?php echo $lang["sending"]?></button>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>
    <div class="footer bg-dark">
    <a href="index.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
    | <a href="index.php?lang=en"><?php echo $lang["lang_en"]?></a>
</div>
</body>

</html>