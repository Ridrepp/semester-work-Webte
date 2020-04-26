<?php
    include "language.php";
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title><?php echo $lang["documentation"]?></title>
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
                <li class="nav-item">
                    <a class="nav-link" href="model3.php">Model 3</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="documentation.php"><?php echo $lang["documentation"]?></a>
                </li>
            </ul>
        </div>
    </nav>





    <div class="container" style="margin-top: 50px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h1><?php echo $lang["documentation"]?></h1>
                <p><?php echo $lang["descriptionDocumentation"]?></p>
            </div>

        </div>
    </div>


    <div class="container" style="margin-top: 50px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h1><?php echo $lang["taskDivision"]?></h1>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <thead>
                    <tr class="table-dark" style="border: 1px solid black!important;">
                        <th scope="col">Martin Michale</th>
                        <th scope="col">Patrik Majtán</th>
                        <th scope="col">Martin Domorák</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <div class="footer bg-dark">
        <a href="documentation.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="documentation.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>
</body>

</html>