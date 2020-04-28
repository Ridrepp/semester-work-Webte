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
    
    
    if(isset($_POST['input'])){
        $input = $_POST['input'];   
        $input = doubleval($input); 
    }
    
    ob_start();
    if(isset($_POST['action'])){
        $model = $_POST['action'];
        switch($model){
            case "kyvadlo":
                $filename = "kyvadlo.m";
                $filename_output1 = "kyvadlo_output_1.mat";
                $filename_output2 = "kyvadlo_output_2.mat";
                sendData($filename, $filename_output1, $filename_output2, $input, $conn);
            break;
            case "gulicka":
                $filename = "gulickaNaTyci.m";
                $filename_output1 = "gulickaNaTyci_output_1.mat";
                $filename_output2 = "gulickaNaTyci_output_2.mat";
                sendData($filename, $filename_output1, $filename_output2, $input, $conn);
            break;
            case "lietadlo":
                $filename = "lietadlo.m";
                $filename_output1 = "lietadlo_output_1.mat";
                $filename_output2 = "lietadlo_output_2.mat";
                sendData($filename, $filename_output1, $filename_output2, $input, $conn);
            break;
            case "command":
                $command = $_POST['inputTextArea'];
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

function sendData($filename, $filename_output1, $filename_output2, $input, $conn){
    header('Content-Type: application/json');

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

function createQuery($command, $conn){

    $sent_command = $command;
    $date = date("Y-m-d H:i:s");

    $command = "pkg load control; ".$command;
    $command = str_replace(';',"\;",$command);
    $command = str_replace("\n","",$command);
    $command = str_replace(")","\)",$command);
    $command = str_replace("(","\(",$command);
    $command = str_replace("'","\'",$command);



    $cmd = "echo ".$command." > superInput.m";

    shell_exec($cmd);

    $error_string = 'error';
    $error_test = 'octave-cli -qf superInput.m 2>&1 1> /dev/null';
    $shell_output = shell_exec($error_test);
    
    $pos = strpos($shell_output, $error_string);
    

    if ($pos === false) {
        $error = 0;
        $error_message = null;
        $sql = "INSERT INTO textArea_log (time,sent_command,error,error_message) values ('$date',\'".$sent_command."\', $error, '$error_message')";
        echo $sql;
        $conn->query($sql);
        

        $cmd = "octave -qf superInput.m";
        $output = exec ($cmd);
        ob_start();
        passthru($cmd, $output);  
        $var = ob_get_contents();

    } else {
        $error = 1;
        $error_message = $shell_output;
        
        try{
            $sent_command = mysqli_real_escape_string($sent_command);
            $sql = "INSERT INTO textArea_log (time,sent_command,error,error_message) values ('$date',$sent_command, $error, '$error_message')";
            echo $sql;
            $conn->query($sql);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        echo $error_message;
        /*
        if($result = mysqli_query($conn, $sql)) {
            if(!mysqli_num_rows($result) > 0){
                $sql = "INSERT INTO)  VALUES ('$ip', 1);";
                $conn->query($sql);
            }
        }
*/
        

    }

    
    //
/*
    

    //var_dump($shell_output);
    

    

    
*/



}

?>