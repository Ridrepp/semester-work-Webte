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
        <span style='color: darkgreen; font-size: 20px;' ><b><i><u>API</u></i></b></span><br>
        API bolo vytvorené za pomoci voľne dostupného matematického softvéru <b>Octave</b>.<br>
        Keďže webová stránka pracuje využívaním <b>GET</b> metód z nášho vyvinutého API, tak po zadaní správnej URL adresy a správnych parametrov (vrátane API kľúča) je možné toto API využívať.
        Po odoslaní requestu sa vám zobrazí odpoveď z API s hodnotami v JSON formáte. Ak ste request odoslali správne, odpoveď bude obsahovať output1, output2, poslednú počiatočnú hodnotu a poslednú konečnú hodnotu (teda vami zadané hodnoty ako začiatočná a konečná hodnota). 
        Output1 obsahuje prvý zoznam hodnôt a output2 obsahuje druhý zoznam hodnôt, tak, ako sa píše v pôvodnom znení zadania pre každý model.<br><br>
        <span style='color: darkgreen;font-size: 20px;' ><b><i><u>Ako volať API</u></i></b></span><br>
        <b>Príkazový riadok</b><br>
        <i>147.175.121.210:8041/SemestralneZadanie/octaveAPI/api.php?apiKey={api kľúč}&action={nazov akcie}&inputTextArea={príkazy}</i><br>
        Ak sa pri parametri {príkazy} vyskytuje '+', musíte všetky jeho výskyty nahradiť znakmi '%2B', pretože znak '+' sa v URL preloží ako medzera.<br>
        Parameter {nazov akcie} musi mať hodnotu command pre toto volanie API.<br><br>
        <b>Prevrátené Kyvadlo, Gulička na Tyči, Náklon Lietadla</b><br>
        <i>147.175.121.210:8041/SemestralneZadanie/octaveAPI/api.php?apiKey={api kľúč}&action={nazov akcie}&start_input={počiatočná hodnota}&end_input={koncová hodnota}</i>
        <br>Parameter nazov akcie môže byť podľa toho, aký chcete model: {kyvadlo}, {gulicka}, {lietadlo}<br><br>  
        <span style='color: darkgreen;font-size: 20px;'><b><i><u>Proces API</u></i></b></span><br>   
        Na začiatku API volania porovnávame <b>API kľúč</b> zadaný v konfiguračnom súbore s API kľúčom, ktorý dostane vďaka GET metóde. <br>
        V prípade, že sa tieto kľúče nezhodujú, používateľ nedostane odpoveď pri odosielaní požiadaviek pri našich modeloch, a ani pri textovom poľi na hlavnej stránke.
        Ak sa kľúč zhoduje, načítavame vstupné hodnoty z podstránok a zisťujeme, z ktorej podstránky prišla požiadavka.
        <br><br>Ak prišla požiadavka z podstránok s modelmi, odvoláme sa na funkciu <b><i>sendData</i></b>, kde 
        vykonávame príkaz v príkazovom riadku cez ktorý spustíme príslušný Octave script. Scriptu cez príkazový riadok pošleme vstupné
        parametre, a ten sa odvolá na funkciu, kde sa vykoná výpočet daného modelu. Po dokončení výpočtov sa na konci scriptu výstupné hodnoty uložia do súborov, odkiaľ ich ďalej získavame a posielame 
        ako návratové hodnoty a v databáze sa vytvorí log o úspešnom alebo neúspešnom vykonaní činnosti.<br><br>
        Ak prišla požiadavka zo stránky s textovým poľom, tak prvotný postup je rovnaký, avšak sa neodvoláva na funkciu <i>sendData</i>, ale
        na funkciu <b><i>createQuery</i></b>, v ktorej na začiatok celého textu z text area zapúzdrime príkaz <b>pkg load control;</b>.
        Následne v celom texte 'vyescapujeme' potrebné znaky a pošleme do príkazu shellu, pomocou ktorého vytvoríme Octave script. Ďalej overíme,
        či pri vykonávaní scriptu nenastane chyba. V prípade chyby sa zobrazí presné znenie chyby. V prípade úspešného vykonania 
        príkazov bude výstup rovnaký, ako keby boli príkazy spustené v Octave. Limitáciou sú príkazy na vykreslovanie grafu (plot).
        <br>Do databázy zapisujeme informácie o úspešnom, prípadne neúspešnom vykonaní príkazu v logoch.
    
        
        ",
        "placeholder" => "Rozsah: ",

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
        "ballRangeDescription" => "Rozsah v ktorom je možné zadávať čísla je od -500 po 500 z dôvodu aby gulička pri animácii nevyšla mimo obrazovku. Môžete zadať desatinné alebo celé čísla.<br>*Vykreslovanie grafu a animáciu je možné spomaliť úpravou spomaľovacej konštanty v konfiguračnom súbore.<br>*Pri meneni veľkosti okna sa zachováva pôvodný číselný rozsah a proporcie animácie sa úmerne nakalibrujú.<br>*Zmenou počiatočnej hodnoty pred prvým odoslaním si viete v animácii pozrieť, kde sa momentálne gulička nachádza na tyči.<br>*Po prvom odoslaní počiatočnej a konečnej hodnoty, už môžete meniť iba konečnú hodnotu. Graf a animácia budú automaticky pokračovať tam, kde naposledy skončili.<br>*Ak sa v čísle pred desatinnou čiarkou na začiatku vyskytuje viac núl, tak budú odstránené<br>(napr. 0000.0005 bude 0.0005, 000500 bude 500)",
        "emailFormat" => "Formát emailu je: minimálne 3 znaky » @ » minimálne 1 alfanumerický znak » bodka » 2-4 písmená za bodkou",
        "model3info" => "Zadávané hodnoty sú v radiánoch (1 radián je približne 57 stupnov).<br>Odporúčanie neprekračovat 1,5 radiánu ako vstup.",
        "model1Description" => "Ako vstup sa zadávajú hodnoty pre pozíciu kyvadla. Na začiatku sa definuje prvotná pozícia v počiatočnej hodnote a v konečnej hodnote sa zadáva pozícia,kam sa má kyvadlo premiestniť. Následne sa zadávajú už len konečné hodnoty.
        Počas priebehu vykreslovania grafu a animácie nie je možné potvrdiť ďalšiu hodnotu, až kým nie je priebeh vykreslovania ukončený. <br>
        Rozsah bol určený, aby kyvadlo nepresahovalo mimo plátno pre animáciu.",
        "model1DescriptionAfterSubmit" => "Môžete zadať nasledujúcu pozíciu kyvadla:"

    );