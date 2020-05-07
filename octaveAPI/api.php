<?php
include(dirname(__FILE__)."/config.php");
try {
    $conn = new PDO("mysql:host=localhost;dbname=semestralneZadanie;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br>";
}
$query = "SELECT * FROM `apiKey`";
$result = $conn->query($query)->fetch();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



//KYVADLO - x(:,1)   x(:,3)
//GULICKA - N*x(:,1) x(:,3)
//TLMIC -   x(:,1)   x(:,3)
//LIETADLO - x(:,3)  r*ones(size(t))*N-x*K'

$request_method = $_SERVER["REQUEST_METHOD"];


if($request_method == "GET"){
    if(isset($_GET['apiKey']) && isset($_GET['action'])){
        //var_dump(is_numeric($_GET['end_input']));
    
        if ($apiKey == $_GET["apiKey"]){

            if($_GET['action'] == 'kyvadlo' || $_GET['action'] == 'lietadlo' || $_GET['action'] == 'gulicka'){
                
                if (!isset($_GET['end_input']) || !isset($_GET['start_input']) || $_GET['start_input'] == '' || $_GET['end_input'] == ''){
                    echo json_encode(array("message"=>"Start and end input parameters must be provided and cannot be empty."));
                    http_response_code(400);
                    return;
                }
                else if(!is_numeric($_GET['start_input']) || !is_numeric($_GET['end_input'])){
                    echo json_encode(array("message"=>"Start and end input parameters must be represented numerically."));
                    http_response_code(400);
                    return;
                }
                else{
                    $end_input = $_GET['end_input'];
                    $end_input = doubleval($end_input);
                    $start_input = $_GET['start_input'];
                    $start_input = doubleval($start_input);
                }
            }
            else if($_GET['action'] == 'command'){
                if(!isset($_GET['inputTextArea'])){
                    echo json_encode(array("message"=>"Missing required parameter."));
                    http_response_code(400);
                    return;
                }
                else if($_GET['inputTextArea'] == ''){
                    echo json_encode(array("message"=>"inputTextArea parameter cannot be empty."));
                    http_response_code(400);
                    return;
                }
                else{
                    var_dump($_GET['inputTextArea']);
                    $command = $_GET['inputTextArea'];
                    
                }
            }
            else{
                echo json_encode(array("message"=>"Bad action parameter."));
                http_response_code(400);
            }

            ob_start();
            if(isset($_GET['action'])){
                $model = $_GET['action'];
                switch($model){
                    case "kyvadlo":
                        $model_name = 'Inverted Pendulum';
                        $filename = "kyvadlo.m";
                        $filename_output1 = "kyvadlo_output_1.mat";
                        $filename_output2 = "kyvadlo_output_2.mat";
                        sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input, $connSQLI, $model_name);
                        break;
                    case "gulicka":
                        $model_name = 'Ball and Beam';
                        $filename = "gulickaNaTyci.m";
                        $filename_output1 = "gulickaNaTyci_output_1.mat";
                        $filename_output2 = "gulickaNaTyci_output_2.mat";
                        sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input, $connSQLI, $model_name);
                        break;
                    case "lietadlo":
                        $model_name = 'Aircraft Pitch';
                        $filename = "lietadlo.m";
                        $filename_output1 = "lietadlo_output_1.mat";
                        $filename_output2 = "lietadlo_output_2.mat";
                        sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input, $connSQLI, $model_name);
                        break;
                    case "command":
                        $command = $_GET['inputTextArea'];
                        createQuery($command, $connSQLI);
                        break;
                }

            }
        }
        else{
            echo json_encode(array("message"=>"API key is incorrect."));
            http_response_code(400);
            return;
            throw new Exception("wrong apiKey");
        }
    }
    else{
        echo json_encode(array("message"=>"Required parameter is missing."));
        http_response_code(400);
        return;
    }
}
else{
    http_response_code(405);
    echo json_encode(array("message"=>"Error. This method is not allowed for this API endpoint."));
    return;
}


function sendData($filename, $filename_output1, $filename_output2, $end_input, $start_input, $connSQLI, $model_name){
    header('Content-Type: application/json');

    $date = date("Y-m-d H:i:s");
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
    $error = 0;
    $error_message = null;
    $sql = "INSERT INTO model_logs (model, start_value, end_value, error, error_message, time) values (?,?,?,?,?,?)";
    $stmt = $connSQLI->prepare($sql);
    $stmt->bind_param("sddiss", $model_name, $start_input, $end_input, $error, $error_message, $date);
    
    if($stmt->execute()){ 
    }
    else{
        //echo "Error: " . $sql . "<br>" . $connSQLI->error."<br>";
    }
 
    echo json_encode(array("output1" => $output1, "output2" => $output2, "start_input" => $start_input, "last_end_input" => $end_input));
}

function createQuery($command, $connSQLI){

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

        $sql = "INSERT INTO textArea_log (time,sent_command,error,error_message) values (?,?,?,?)";
        $stmt = $connSQLI->prepare($sql);
        $stmt->bind_param("ssis", $date, $sent_command, $error, $error_message);
        $stmt->execute();

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

        
        $sql = "INSERT INTO textArea_log (time,sent_command,error,error_message) values (?,?,?,?)";
        $stmt = $connSQLI->prepare($sql);
        $stmt->bind_param("ssis", $date, $sent_command, $error, $error_message);
        $error_message = str_replace("'\"\"'","'",$error_message);
        echo $error_message;
        }

    }


?>