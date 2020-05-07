<?php
    $lang = array(
        "title" => "Semester Assignment",
        "navMainSite" => "Main site",
        "pageDescription" => "Page description",
        "description" =>    "<br>There is a command line on the main page where you can enter simple math
                            statements. The statements will be sent to Octave and you will receive the exact Octave output.
                            In case there was an error in some of the statements, the exact error will be displayed instead.<br><br>
                            On the other subpages, you can test model calculations using input parameters. After sending, the calculations 
                            are plotted in a graph and an animation is drawn. It is possible to deactivate graphically displayed outputs 
                            using appropriate checkboxes.<br><br>
                            On the last subpage, the technical documentation, there is a distribution of tasks 
                            between the project developers, statistics about the usage of different models and you also the possibility 
                            of sending the statistics to your email address. Lastly, it is also possible to switch between Slovak and 
                            English language on all of the subpages and main page (at the bottom).",
        "documentation" => "Technical documentation",
        "lang_sk" => "Slovak",
        "lang_en" => "English",

        "descriptionDocumentation" => "<span style='color: darkgreen' ><b><i><u>Installations and modifications on the server</u></i></b></span>
        <br>At the beginning of the work, we installed the Octave on the server using the commands:<br>
        <b><i>$ sudo apt-add-repository ppa:octave/stable</i></b><br>
        <b><i>$ sudo apt-get update</i></b><br>
        <b><i>$ sudo apt-get install octave</i></b><br>
        Then we installed the toolkits using the command:<br>
        <b><i>$ sudo apt-get install -y liboctave-dev</i></b><br>
        After installation, we installed the \"control\" package directly in the installed Octave using:<br>
        <b><i>pkg install -forge control</i></b><br>
        Subsequently, we had to add permissions for the <b>var/www</b> directory, because Octave could not create files and write data to them.:<br>
        <b><i>$ sudo chmod 777 var/www</i></b><br>
        When dealing with point 9 in the project requirements, we had to install sendmail on the server due to the possibility of sending data to:<br>
        <b><i>$ sudo apt-get install sendmail</i></b><br>
        To speed up uploading, we've opened the file <b>etc/hosts</b> <br>
        <b><i>$ sudo vim etc/hosts</i></b> <br>
        Where we are instead <b>127.0.0.1 localhost</b> wrote <b>127.0.0.1 localhost.localdomain localhost os-webtech1-4</b><br>
        And we are also in the file <b>etc/mail/sendmail.cf</b>, which we got through:<br>
        <b><i>$ sudo etc/mail/sendmail.cf</i></b><br>
        uncommented:<br>
        <b><i>#O HostsFile=/etc/hosts</i></b><br><br>
        <span style='color: darkgreen;font-size: 20px;' ><b><i><u>API</u></i></b></span><br>
        The API was created using freely available mathematical software <b>Octave</b>.<br>
        Since the website is created using <b>GET</b> methods from our developed API, it is possible to access this API submitting proper URL address with correct parameters, including API key. 
        After submission, you will receive a response with values in JSON format. Should the API request be correct, the response contains output1, output2, last start value and last end value. 
        Output1 refers to the first array of values and output2 refers to the second array of output values, as stated in the original assignment description for every model.<br><br>
        
        <span style='color: darkgreen;font-size: 20px;' ><b><i><u>API call</u></i></b></span><br>
        <b>Octave command line</b><br>
        <i>147.175.121.210:8041/SemestralneZadanie/octaveAPI/api.php?apiKey={api key}&action={action name}&inputTextArea={commands}</i><br>
        If your {commands} parameter includes any '+' character, you will have to replace them with '%2B' character, 
        because '+' is represented as a space in a URL.<br>
        Parameter {action name} is required to be <b>command</b> for this call.<br><br>
        <b>Inverted Pendulum, Ball and Beam, Aircraft Pitch</b><br>
        <i>147.175.121.210:8041/SemestralneZadanie/octaveAPI/api.php?apiKey={api key}&action={action name}&start_input={start input value}&end_input={end input value}</i>
        <br>Parameter action call will be one of these: {kyvadlo}, {gulicka}, {lietadlo}, depending on which model you want to use.<br><br>  

        <span style='color: darkgreen;font-size: 20px;' ><b><i><u>API process</u></i></b></span><br>
        At the beginning of the API call we compare <b>API key</b> specified in the configuration file with the API key that it gets as the GET method parameter.<br>
        If these keys do not match, the user will not get a response when sending requests to our API using our models or the 'octave command line' on the main page.
        If the keys match, we read the input values from the subpages and find out which subpage sent the request.
        <br><br>If the request came from the subpages with models, we refer to the function <b><i>sendData</i></b>, where
        we execute a command in the command line which runs the appropriate Octave script. We also pass the parameters to this script using the command line.
        The script calls a function, were the calculations are executed. After the calculations are finished, the script stores the output values in files, from where 
        we further obtain and send them as return values and a log is created in the database on the successful or unsuccessful execution of the activity.<br><br>
        If the request came from the 'octave command line' page, the initial procedure is the same, but the API does not refer to the function <i>sendData</i>, but
        to the function <b><i>createQuery</i></b> instead, in which we initially encapsulate the command <b>pkg load control;</b>.
        After that, we escape all the required characters in the text, because we want to send this text to the command line as a parameter to create a file.
        Octave script will be created. Next we will check if any error occurs when we run the script. In case of an error the exact error message
        will be displayed. If the script finished successfully, the output will be exactly as if you were to run these statements in Octave.
        The only limitation is the function to plot graphs (plot). 
        <br>Finally, we create a new log in our database with either a successful or unsuccessful execution of the commands.",

        "taskDivision" => "Task distribution",
        "sending" => "Send",
        "input" => "End value:",
        "commands" => "Enter statements to send to Octave: ",
        "model1" => "Inverted Pendulum",
        "model2" => "Ball and Beam",
        "model3" => "Aircraft Pitch",
        "statistics" => "Model usage statistics",
        "graph" => "Graph",
        "animation" => "Animation",
        "start_input" => "Initial value",
        "statistics_email" => "Send statistics to email",
        "errorApiKey" => "API key is wrong!",
        "helpApi" => "API development assistance",
        "apiProgramming" => "API development",
        "apiKey" => "API key functionality",
        "graphics" => "Graphics, site design and code editing",
        "apiTextArea" => "API for text area/custom statements",
        "dbMail" => "Database and mail communication",
        "preparationMail" => "Mail task preparation works",
        "completionMail" => "Mail completion",
        "graphs" => "Make basic graphs",
        "language_version" => "Language version (EN,SK)",
        "checkboxFun" => "Checkbox functionality",
        "casLogs" => "CAS logs (collaboration)",
        "ballRangeDescription" => "Accepted number range is between -500 and 500 in order to prevent the ball going off screen during the animation. You can input fractional or whole numbers.<br>*You can slow down the plotting of the graph and animation drawing by changing the slow constant in configuration file.<br>*When resizing the page, the original number range is maintained and scaled appropriately.<br>*Changing the initial value before submitting first values will show you where the new ball initial position is on the beam.<br>*After the first submission of the initial and the end value, you can only enter the next end value. Graph and animation will automatically resume from where they left off last time.<br>*Multiple zeroes before the decimal point are cut off from the start<br>(i.e: 0000.0005 will be 0.0005, 000500 will be 500)",
        "emailFormat" => "Email format: at least 3 characters » @ » at least 1 alphanumeric character » period » 2-5 letters after period",
        "model3info" => "Entered values are in radians (1 radian is approximately 57 degrees).<br>It is recommended not to exceed 1.5 radians as input.",
        "model1Description" => "The values for the pendulum position are entered as input. At the beginning, the initial value means initial position of inverted pendulum and the final value is the position where the pendulum wiil be moved. Subsequently, only the final values are entered.
        It is not possible to confirm another value during the graph and animation rendering process until the rendering process is completed.<br>
        The range was determined so that the pendulum did not exceed out of the animation screen.",
        "model1DescriptionAfterSubmit" => "You can enter the following Pendulum position:"

    );