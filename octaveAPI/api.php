<?php
//include(dirname(__FILE__)."/config.php");
include "config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

//KYVADLO - x(:,1)   x(:,3)
//GULICKA - N*x(:,1) x(:,3)
//TLMIC -   x(:,1)   x(:,3)
//LIETADLO - x(:,3)  r*ones(size(t))*N-x*K'

$request_method = $_SERVER["REQUEST_METHOD"];


if($request_method == "POST"){
    
    if(isset($_POST['input'])){
        $input = $_POST['input'];    
    }
    ob_start();
    $input = doubleval($input);
    if(isset($_POST['action'])){
        $model = $_POST['action'];
        switch($model){
            case "kyvadlo":
                $filename = "kyvadlo.m";
                $filename_output1 = "kyvadlo_output_1.mat";
                $filename_output2 = "kyvadlo_output_2.mat";
            break;
            case "gulicka":
                $filename = "gulickaNaTyci.m";
                $filename_output1 = "gulickaNaTyci_output_1.mat";
                $filename_output2 = "gulickaNaTyci_output_2.mat";
            break;
            case "lietadlo":
                $filename = "lietadlo.m";
                $filename_output1 = "lietadlo_output_1.mat";
                $filename_output2 = "lietadlo_output_2.mat";
            break;
        }
        sendData($filename, $filename_output1, $filename_output2, $input);
    }
    
    /*if (is_null($output))
    {   
        var_dump(ob_get_contents());
    }
    else
    {  

    }
    ob_end_clean();  
    */
}
else{

}

function sendData($filename, $filename_output1, $filename_output2, $input){
    $cmd = "octave-cli ".$filename." ".$input." 2>&1 1> /dev/null";
    shell_exec($cmd);
    $output1 = file_get_contents($filename_output1, true);
    $output1 = explode(" ", $output1);
    $output1 = array_slice($output1, 20);

    $output2 = file_get_contents($filename_output2, true);
    $output2 = explode(" ", $output2);
    $output2 = array_slice($output2, 20);

    foreach ($output2 as $key => $value) {
        $output2[$key] = floatval($value);
    }
    foreach ($output1 as $key => $value) {
        $output1[$key] = floatval($value);
    }

    echo json_encode(array("output1" => $output1, "output2" => $output2));
}

?>