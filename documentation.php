<?php
    include "language.php";
    include "octaveAPI/config.php";
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title><?php echo $lang["documentation"]?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/mailScript.js"></script>
</head>

<body>
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
                <li class="nav-item active">
                    <a class="nav-link" href=<?php echo "documentation.php?lang=".$_GET['lang']?>><?php echo $lang["documentation"]?></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 20px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h1><?php echo $lang["documentation"]?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <p><?php echo $lang["descriptionDocumentation"]?></p>
            </div>
        </div>
    </div>


    <div class="container" style="margin-top: 50px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h2><?php echo $lang["taskDivision"]?></h2>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7">
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
                            <td><?php echo $lang["model3"]?></td>
                            <td><?php echo $lang["model1"]?></td>
                            <td><?php echo $lang["model2"]?></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["helpApi"]?></td>
                            <td><?php echo $lang["helpApi"]?></td>
                            <td><?php echo $lang["apiProgramming"]?></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["apiKey"]?></td>
                            <td><?php echo $lang["graphics"]?></td>
                            <td><?php echo $lang["apiTextArea"]?></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["completionMail"]?></td>
                            <td><?php echo $lang["preparationMail"]?></td>
                            <td><?php echo $lang["dbMail"]?></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["graphs"]?></td>
                            <td><?php echo $lang["language_version"]?></td>
                            <td><?php echo $lang["checkboxFun"]?></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["casLogs"]?></td>
                            <td><?php echo $lang["casLogs"]?></td>
                            <td><?php echo $lang["casLogs"]?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container" style="margin: 30px auto;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h2><?php echo $lang["statistics"]?></h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <thead>
                    <tr class="table-dark" style="border: 1px solid black!important;">
                        <th scope="col"><?php echo $lang["model1"]?></th>
                        <th scope="col"><?php echo $lang["model2"]?></th>
                        <th scope="col"><?php echo $lang["model3"]?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <?php
                            $sqlP = "SELECT count_usage FROM `visits` WHERE `model` = 'Inverted Pendulum';";
                            if($result = mysqli_query($connSQLI, $sqlP)) {
                                if(mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    echo $row["count_usage"];
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $sqlP = "SELECT count_usage FROM `visits` WHERE `model` = 'Ball & Beam';";
                            if($result = mysqli_query($connSQLI, $sqlP)) {
                                if(mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    echo $row["count_usage"];
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $sqlP = "SELECT count_usage FROM `visits` WHERE `model` = 'Aircraft Pitch';";
                            if($result = mysqli_query($connSQLI, $sqlP)) {
                                if(mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    echo $row["count_usage"];
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container" >
        <div class="row justify-content-center" style="margin: 0 0 80px 0;">
            <div class="col-md-6 col-md-offset-3">
                <h5><?php echo $lang["statistics_email"]?></h5>
                <h6 style="color:red; font-style: italic; font-size:10px;">*<?php echo $lang["emailFormat"]?></h6>
                <form>
                    E-mail:
                    <label>
                        <input id="email" name="email" type="text" size="32" />
                    </label>
                    <button type="button" id="sendEmail"><?php echo $lang["sending"]?></button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="footer bg-dark">
        <a href="documentation.php?lang=sk"><?php echo $lang["lang_sk"]?></a>
        | <a href="documentation.php?lang=en"><?php echo $lang["lang_en"]?></a>
    </div>
</body>

</html>