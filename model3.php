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
            </ul>
        </div>
    </nav>


    <div class="footer bg-dark">
        <a href="model1.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="model1.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>



</body>

</html>
