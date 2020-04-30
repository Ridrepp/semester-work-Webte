<?php
include(dirname(__FILE__)."/config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



//KYVADLO - x(:,1)   x(:,3)
//GULICKA - N*x(:,1) x(:,3)
//TLMIC -   x(:,1)   x(:,3)
//LIETADLO - x(:,3)  r*ones(size(t))*N-x*K'

$request_method = $_SERVER["REQUEST_METHOD"];


if($request_method == "POST"){
    
    
    if(isset($_POST['end_input'])){
        $end_input = $_POST['end_input'];   
        $end_input = doubleval($end_input); 
    }
    if(isset($_POST['start_input'])){
        $start_input = $_POST['start_input'];   
        $start_input = doubleval($start_input); 
    }
    
    ob_start();
    if(isset($_POST['action'])){
        $model = $_POST['action'];
        switch($model){
            case "kyvadlo":
                $filename = "kyvadlo.m";
                $filename_output1 = "kyvadlo_output_1.mat";
                $filename_output2 = "kyvadlo_output_2.mat";
                sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input);
            break;
            case "gulicka":
                $filename = "gulickaNaTyci.m";
                $filename_output1 = "gulickaNaTyci_output_1.mat";
                $filename_output2 = "gulickaNaTyci_output_2.mat";
                sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input);
            break;
            case "lietadlo":
                $filename = "lietadlo.m";
                $filename_output1 = "lietadlo_output_1.mat";
                $filename_output2 = "lietadlo_output_2.mat";
                sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input);
            break;
            case "command":
                $command = $_POST['end_inputTextArea'];
                createQuery($command, $conn);
            break;
        }

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

function sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input){
    header('Content-Type: application/json');

    $cmd = "octave-cli ".$filename." ".$start_input." ".$end_input." 2>&1 1> /dev/null";
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

    echo json_encode(array("output1" => $output1, "output2" => $output2, "last_end_input" => $end_input));
}

function createQuery($command, $conn){

    $sent_command = $command;
    $date = date("Y-m-d H:i:s");

    $command = "pkg load control; ".$command;
    $chars1 = array(";","\n",")","(","'");
    $chars2 = array("\;","","\)","\(","\'");
    $command = str_replace($chars1,$chars2,$command);

    $cmd = "echo ".$command." > superend_input.m";

    shell_exec($cmd);

    $error_string = 'error';
    $error_test = 'octave-cli -qf superend_input.m 2>&1 1> /dev/null';
    $shell_output = shell_exec($error_test);
    
    $pos = strpos($shell_output, $error_string);
    

    if ($pos === false) {
        $error = 0;
        $error_message = null;
        $sent_command = str_replace("'","'\"\"'",$sent_command);
        $sql = "INSERT INTO textArea_log (time,sent_command,error,error_message) values ('$date','$sent_command', $error, '$error_message')";
        $conn->query($sql);
        

        $cmd = "octave -qf superend_input.m";
        $output = exec ($cmd);
        ob_start();
        passthru($cmd, $output);  
        $var = ob_get_contents();

    } else {
        $error = 1;
        $error_message = $shell_output;

        $sent_command = str_replace("'","'\"\"'",$sent_command);
        $error_message = str_replace("'","'\"\"'",$error_message);
        $sql = "INSERT INTO textArea_log (time,sent_command,error,error_message) values ('$date','$sent_command',$error,'$error_message')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error."<br>";
            }
            echo $error_message;
        }

    }


?>