<?php
    $lang = array(
        "title" => "Semestrálne zadanie",
        "navMainSite" => "Hlavná stránka",
        "pageDescription" => "Popis stránky",
        "description" => "<br>Na hlavnej stránke je príkazový riadok, do ktorého je možné zadávať jednoduché matematické 
                          operácie. Príkazy budú poslané do Octave a zobrazí sa presný výstup z Octave. V prípade, že bola v niektorom z príkazov
                          chyba, zobrazí sa presná chyba, ktorá nastala.<br><br>Na ďalších podstránkach je možné vyskúšať výpočty 
                          pre modely pomocou zadávaných parametrov. Výpočty sa následne vykreslia v grafe a v animácii. 
                          Pomocou checkboxov je možné deaktivovať graficky znázorňované výstupy.<br><br>Na poslednej podstránke,
                          technická dokumentácia, sa nachádza rozdelenie úloh medzi projektovými vývojármi, štatistika využívania modelov, 
                          a možnosť odoslania štatistík na Vašu emailovú adresu. Na každej stránke (v spodnej časti) je rovnako 
                          umožnené meniť si jazyk týchto stránok medzi anglickým a slovenským jazykom.",
        "documentation" => "Technická dokumentácia",
        "lang_sk" => "Slovenčina",
        "lang_en" => "Angličtina",

        "descriptionDocumentation" => "Na začiatku práce sme nainštalovali na server Octave pomocou príkazov:<br>
        <i>$ sudo apt-add-repository ppa:octave/stable</i><br>
        <i>$ sudo apt-get update</i><br>
        <i>$ sudo apt-get install octave</i><br>
        Potom sme inštalovali balíky nástrojov pomocou príkazu:<br>
        <i>$ sudo apt-get install -y liboctave-dev</i><br>
        Po inštalácii sme priamo v nainštalovanom Octave doinštalovali balík \"control\" pomocou:<br>
        <i>pkg install -forge control</i><br>
        Následne sme museli pridať práva pre adresár var/www, pretože Octave nemohol vytvárať súbory a zapisovať do nich dáta:<br>
        <i>$ sudo chmod 777 var/www</i><br>
        Pri riešení bodu 9 v požiadavkách na projekt sme kvôli možnosti posielania údajov na 
        email museli nainštalovať sendmail na server:<br>
        <i>$ sudo apt-get install sendmail</i><br>
        Aby sme zrýchlili odosielanie, tak sme otvorili súbor <b>etc/hosts</b> <br>
        <i>$ sudo vim etc/hosts</i> <br>
        Kde sme namiesto \"127.0.0.1 localhost\" zapísali \"127.0.0.1 localhost.localdomain localhost os-webtech1-4\"<br>
        A taktiež sme  v súbore <b>etc/mail/sendmail.cf</b>, do ktorého sme sa dostali cez:<br>
        <i>$ sudo etc/mail/sendmail.cf</i><br>
        odkomentovali #O HostsFile=/etc/hosts<br><br>
        
        
        ",

        "taskDivision" => "Rozdelenie úloh",
        "sending" => "Odoslať",
        "input" => "Konečná hodnota:",
        "commands" => "Zadaj príkazy na odoslanie do Octave: ",
        "model1" => "Prevrátené kyvadlo",
        "model2" => "Gulička na tyči",
        "model3" => "Náklon lietadla",
        "statistics" => "Štatistika použitia",
        "graph" => "Graf",
        "animation" => "Animácia",
        "start_input" => "Počiatočná hodnota",
        "statistics_email" => "Odoslanie štatistík na email",
        "errorApiKey" => "API kľúč nie je správny!",
        "helpApi" => "Pomoc pri vývoji API",
        "apiProgramming" => "Vývoji API",
        "apiKey" => "Funkcionalita API kľúča",
        "graphics" => "Grafika, dizajn stránky a úpravy kódov",
        "apiTextArea" => "Vytvorenie API pre text area/vlastné príkazy",
        "dbMail" => "Komunikácia medzi DB a mailom",
        "preparationMail" => "Predpríprava pred sfunkčnením mailu",
        "completionMail" => "Dokončenie mailu",
        "graphs" => "Vytvorenie základných grafov",
        "language_version" => "Jazykové verzie (EN,SK)",
        "checkboxFun" => "Funkcionalita checkboxov",
        "casLogs" => "CAS logy (spolupráca)",
        "ballRangeDescription" => "Rozsah v ktorom je možné zadávať čísla je od -600 po 600 z dôvodu aby gulička pri animácii nevyšla mimo obrazovku. Môžete zadať desatinné alebo celé čísla.<br>Vykreslovanie grafu a animáciu je možné spomaliť úpravou spomaľovacej konštanty v konfiguračnom súbore.",
        "emailFormat" => "Formát emailu je: minimálne 3 znaky » @ » minimálne 1 alfanumerický znak » bodka » 2-4 písmená za bodkou"


    );