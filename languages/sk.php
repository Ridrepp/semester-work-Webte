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

        "descriptionDocumentation" => "
        <span style='color: darkgreen' ><b><i><u>Inštalácie a úpravy na serveri</u></i></b></span>
        <br>Na začiatku práce sme nainštalovali na server Octave pomocou príkazov:<br>
        <b><i>$ sudo apt-add-repository ppa:octave/stable</i></b><br>
        <b><i>$ sudo apt-get update</i></b><br>
        <b><i>$ sudo apt-get install octave</i></b><br>
        Potom sme inštalovali balíky nástrojov pomocou príkazu:<br>
        <b><i>$ sudo apt-get install -y liboctave-dev</i></b><br>
        Po inštalácii sme priamo v nainštalovanom Octave doinštalovali balík \"control\" pomocou:<br>
        <b><i>pkg install -forge control</i></b><br>
        Následne sme museli pridať práva pre adresár <b>var/www</b>, pretože Octave nemohol vytvárať súbory a zapisovať do nich dáta:<br>
        <b><i>$ sudo chmod 777 var/www</i></b><br>
        Pri riešení bodu 9 v požiadavkách na projekt sme kvôli možnosti posielania údajov na 
        email museli nainštalovať sendmail na server:<br>
        <b><i>$ sudo apt-get install sendmail</i></b><br>
        Aby sme zrýchlili odosielanie, tak sme otvorili súbor <b>etc/hosts</b> <br>
        <b><i>$ sudo vim etc/hosts</i></b> <br>
        Kde sme namiesto <b>127.0.0.1 localhost</b> zapísali <b>127.0.0.1 localhost.localdomain localhost os-webtech1-4</b><br>
        A taktiež sme  v súbore <b>etc/mail/sendmail.cf</b>, do ktorého sme sa dostali cez:<br>
        <b><i>$ sudo etc/mail/sendmail.cf</i></b><br>
        odkomentovali:<br>
        <b><i>#O HostsFile=/etc/hosts</i></b><br><br>
        <span style='color: darkgreen' ><b><i><u>API</u></i></b></span><br>
        API bolo vytvorené za pomoci voľne dostupného matematického softvéru <b>Octave</b>.<br>
        Keďže webová stránka je vytvorená s využitím <b>GET</b> metódy,tak po zadaní správnej URL adresy a správnych parametrov je možné získať výstupné hodnoty z matematického softvéru.<br>
        Na začiatku API porovnávame <b>API kľúč</b> zadaný v konfiguračnom súbore s API kľúčom, ktorý dostane vďaka GET metóde . <br>
        V prípade, že sa tieto kľúče nezhodujú, používateľ nemá možnosť zadávať vstupy pri modeloch a rovnako nemá prístup k zapisovaniu príkazov do textového poľa na hlavnej stránke.
        Potom načítavame vstupné hodnoty z podstránok a zisťujeme, z ktorej podstránky prišla požiadavka na výpočet.
        <br><br>Ak prišla požiadavka z podstránok s modelmi, odvoláme sa na funkciu <b><i>sendData</i></b>, kde 
        vykonávame príkaz v príkazovom riadku s parametom názvu súboru, kde sa volá funkcia pre výpočet daného modelu
        a so vstupnými parametrami. Po vykonaní príkazu sa výstupné hodnoty uložia do súborov, odkiaľ ich ďalej získavame a posielame 
        ako návratové hodnoty a v databáze sa vytvorí log o úspešnom alebo neúspešnom vykonaní činnosti.<br><br>
        Ak prišla požiadavka zo stránky s textovým poľom, tak prvotný postup je rovnaký, avšak sa neodvoláva na funkciu <i>sendData</i>, ale
        na funkciu <b><i>createQuery</i></b>, v ktorej na začiatku načítavame príkaz z textového poľa, pred ktorým načítame balík <b>control</b>.
        Následne tento príkaz uložíme do dočasného súboru, za pomoci ktorého sa vykoná načítajú a vykonajú zapísané príkazy v danom súbore.
        Do databázy zapisujeme informácie o úspešnom, prípadne neúspešnom vykonaní príkazu v logoch.
    
        
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
        "emailFormat" => "Formát emailu je: minimálne 3 znaky » @ » minimálne 1 alfanumerický znak » bodka » 2-4 písmená za bodkou",
        "model3info" => "Zadávané hodnoty sú v radiánoch (1 radián je približne 57 stupnov).<br>Odporúčanie neprekračovat 1,5 radiánu ako vstup.",
        "model1Description" => "Ako vstup sa zadávajú hodnoty pre pozíciu kyvadla. Na začiatku sa definuje prvotná pozícia v počiatočnej hodnote a v konečnej hodnote sa zadáva pozícia,kam sa má kyvadlo premiestniť. Následne sa zadávajú už len konečné hodnoty.
        Počas priebehu vykreslovania grafu a animácie nie je možné potvrdiť ďalšiu hodnotu až kým nie je priebeh vykreslovania ukončený."

    );