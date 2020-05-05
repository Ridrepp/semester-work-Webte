<?php
    $lang = array(
        "title" => "Semestrálne zadanie",
        "navMainSite" => "Hlavná stránka",
        "pageDescription" => "Popis stránky",
        "description" => "Na hlavnej stránke je príkazový riadok, do ktorého je možné zadávať jednoduché matematické 
                          operácie, ktoré vrátia ich výsledok. Na ďalších podstránkach si je možné odskúšať výpočty 
                          pre modely pomocou zadávaných parametrov. Výpočty sa následne vykreslia v grafe a v animácii. 
                          Pomocou checkboxov je možné deaktivovať graficky znázorňované výstupy. Na poslednej podstránke 
                          (technická dokumentácia) sa nachádza rozdelenie úloh, štatistika využívania modelov a 
                          možnosť odoslania štatistík na Vašu emailovú adresu. Na každej stránke je rovnako 
                          umožnené si meniť jazyk týchto stránok (v spodnej časti stránok).",
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
        "commands" => "Zadaj príkazy: ",
        "model1" => "Prevrátené kyvadlo",
        "model2" => "Gulička na tyči",
        "model3" => "Náklon lietadla",
        "statistics" => "Štatistika použitia",
        "graph" => "Graf",
        "animation" => "Animácia",
        "start_input" => "Počiatočná hodnota",
        "statistics_email" => "Odoslanie štatistík na email",
        "errorApiKey" => "API kľúč nie je správny!",
        "helpApi" => "Pomoc pri programovaní API",
        "apiProgramming" => "Programovanie API",
        "apiKey" => "Vytvorenie funkcionality API kľúča",
        "graphics" => "Grafika, dizajn stránky a úpravy kódov",
        "apiTextArea" => "Vytvorenie API pre textAreu",
        "dbMail" => "Komunikácia medzi DB a mailom",
        "preparationMail" => "Predpríprava pred sfunkčnením mailu",
        "completionMail" => "Dokončenie mailu",
        "graphs" => "Vytvorenie základných grafov",
        "language_version" => "Jazykové verzie (EN,SK)",
        "checkboxFun" => "Funkcionalita checkboxov",
        "casLogs" => "CAS logy (spolupráca)"




    );