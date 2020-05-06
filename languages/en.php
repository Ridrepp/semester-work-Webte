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
        <span style='color: darkgreen' ><b><i><u>API</u></i></b></span><br>
        The API was created using freely available mathematical software <b>Octave</b>.<br>
        Because the website is created using <b>GET</b> methods, so after entering the correct URL address and the correct parameters, it is possible to obtain output values from the mathematical software.<br>
        At the beginning, in the API we compare <b>API key</b> specified in the configuration file with the API key that it gets thanks to the GET method. <br>
        If these keys do not match, the user does not have the ability to enter input for models, nor does he has access to enter commands in the text box on the main page.
        Then we read the input values from the subpages and find out from which subpage the request for calculation came from.
        <br><br>If the request came from the subpages with models, we refer to the function <b><i>sendData</i></b>, where
        we execute a command in the command line with the file name parameter, where the function for calculating the given model is called
        and with input parameters. After executing the command, the output values are stored in files, from where we further obtain and send them
        as return values and a log is created in the database on the successful or unsuccessful execution of the activity.<br><br>
        If the request came from a text box page, the initial procedure is the same, but does not refer to the function <i>sendData</i>, but
        to function <b><i>createQuery</i></b>, in which we initially load a command from the text box before which we load the package <b>control</b>.
        Subsequently, we save this command in a temporary file, with the help of which the written commands written in the given file are loaded and executed.
        We enter information about successful or unsuccessful execution of the command in the logs into the database.",

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
        "ballRangeDescription" => "Accepted number range is between -600 and 600 in order to prevent the ball going off screen during animation. You can input fractional or whole numbers.<br>You can slow down the plotting of the graph and animation drawing by changing the slow constant in configuration file.",
        "emailFormat" => "Email format: at least 3 characters » @ » at least 1 alphanumeric character » period » 2-5 letters after period",
        "model3info" => "Entered values are in radians (1 radian is approximately 57 degrees).<br>It is recommended not to exceed 1.5 radians as input.",
        "model1Description" => "The values for the pendulum position are entered as input. At the beginning, the initial value means initial position of inverted pendulum and the final value is the position where the pendulum wiil be moved. Subsequently, only the final values are entered.
         It is not possible to confirm another value during the graph and animation rendering process until the rendering process is completed."
    );