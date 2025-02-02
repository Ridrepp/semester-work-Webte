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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="js/textAreaScript.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand active" href=<?php echo "index.php?lang=".$_GET['lang']?>><?php echo $lang["navMainSite"]?></a>
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

    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h1><?php echo $lang["navMainSite"]?></h1>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-8">
                <h4 style="color: darkblue"><?php echo $lang["pageDescription"]?></h4>
                <h6 style="color: darkgreen"><?php echo $lang["description"]?></h6>
            </div>
        </div>
    </div>

    <br>

    <div class="alert alert-danger" id="ApiErrorMsg" style="display: none"><h5 id="errorMsgH4"><?php echo $lang["errorApiKey"];?></h5></div>
    <?php
        if (isset($_POST["inputTextArea"])){
            echo "<p class='center'>".$_POST["inputTextArea"]."</p>";
        }
    ?>
    <div class="container" style="margin-top: 15px">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                <form>
                    <div>
                        <label style="font-size:20px;" for="textArea"><b><?php echo $lang["commands"]?></b></label>
                        <div>
                            <textarea id="textArea" style="width: 700px; height: 150px"></textarea>
                        </div>
                    </div>
                    <button type="button" id="textAreaButton"><?php echo $lang["sending"]?></button>
                </form>
                <div id="output">
                </div>
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