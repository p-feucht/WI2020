<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Worker Bees</title>
    <link rel="icon" href="images/logoBiene.png" />
    <meta name="description" content="">
    
    <link href="CSS/headerDesign.css" rel="stylesheet">
    <link href="CSS/formularBiete.css" rel="stylesheet">
    <link href="CSS/datepicker.css" rel="stylesheet">

    <link href="JavaScript/formular.js">
    <!--
    <script src="https://code.jquery.com/jquery-3.4.1.min.js">
    </script>
    -->

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- date picker links (https://www.daterangepicker.com/)-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/daterangepicker.css" />

</head>

<body>
    <!--<div class="header">
        <a href="index.html"> <img src="images/logoKomplett.png" class="logo">
        </a>
        <div class="header-content-middle">
            <a class="biete" href="FormularBiete.html">Ich biete</a>
            <a href="#tips">Tipps & Tricks</a>
            <a class="aboutus" href="aboutUs.html">Über uns</a>
            <a href="FormularBiete.html#contact">Impressum</a>
        </div>

        <div class="header-content-right">
            <a href="#Anmeldung" class="headerButton">Anmelden</a>
            <a href="categories.html#Werkstatt-Ang" class="headerButton" id="headerSearch"><i class="fa fa-search"></i></a>
        </div>
    </div>-->
    <?php 
    $site_name = "HTML5-Seite mit Grundstruktur";
    include ("./PHP/header.php"); ?>

    <div class="content">
        <!--Slider-->
        <section>
            <img class="mySlides" src="images/smith.jpg" style="width:100%">
            <img class="mySlides" src="images/werkstatt.jpg" style="width:100%">
            <img class="mySlides" src="images/tools.jpg" style="width:100%">
        </section>
        <script src="JavaScript/formular.js"></script>
        <!--End of Slider-->


        <div class="yellow-container">


            <div class="explanation_and_form">


            <?php include ("./PHP/formularBieteAbschicken.php"); ?>



                <!-- Text über Formular -->
                <h2>Schreibe ein Angebot</h2>
                <p>
                <br>
                    Du möchtest eine Werkstatt zur Verfügung stellen, eine Bohrmaschine verkaufen oder überflüssige Schrauben verschenken? Fülle hierzu das folgende Formular aus. Wir danken dir!
                </p>
                <br>

                <form name="formularFuerAngebot" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return pruefeFormular();">

                    <div class=formblock>

                        <label>Wähle eine <b>Angebotskategorie</b></label>
                        <br>
                        <input type="radio" name="kategorie" value="Werkzeug"> Werkzeug verleihen

                        <input type="radio" name="kategorie" value="Werkstatt"> Werkstatt vermieten

                        <input type="radio" name="kategorie" value="Dienstleistung"> Dienstleistung anbieten

                    </div>


                    <div class=formblock>
                        <label>Gib deinem Angebot einen <b>Titel</b></label>
                        <br>
                        <input id="title" type="text" name="title" value="<?php echo htmlspecialchars($title);?>" size="30" maxlength="30">
                        <label class="Fehlermeldung" id="FehlermeldungTitle">
                            </label>
                        <label class="error"><?php echo $titleErr;?></span>
                        <div class=unterüberschrift>
                            <label>Tipp: Nutze Begriffe, die andere Heimwerker bei der Suche nach deinem Angebot verwenden würden.</label>
                        </div>

                    </div>

                    <div class="formblock">
                        <label>Wähle einen <b>Angebotszeitraum </b>
                        <br>
                        <input type="text" name="datefilter" value="<?php echo htmlspecialchars($zeitraum);?>" placeholder="Wähle deinen Angebotszeitraum" size="27%" required />
                        <span class="error"><?php echo $zeitraumErr;?></span>
                        <script type="text/javascript">
                            datePicker();
                        </script>
                    </div>
<!--
                    <div class="formblock">
                        <label for="begDat">
                  Beginndatum </label><br>
                        <input type="date" id="begDat" required><br>
                        <label for="endeDat">
                  Endedatum </label><br>
                        <input type="date" id="endeDat" required><br>
                    </div>
                    -->

                    <div class="formblock">
                        <label>Füge eine <b>Beschreibung</b> hinzu</label><label class="Fehlermeldung" id="FehlermeldungBeschr">
                            </label> 
                        <!--<div id="FehlerBeiValidierung">-->
                        <!-- </div>-->
                        <br>
                        <textarea id="beschreibung" name="beschreibung" value="<?php echo htmlspecialchars($beschreib);?>" rows="9" cols="1">
                        </textarea>
                        
                        <br>
                        <span class="error"><?php echo $beschreibErr;?></span>
                    </div>

                    <div class="formblock">
                        <label>Füge ein <b>Bild</b>, das dein Angebot zeigt oder beschreibt, hinzu</label>
                        <br>
                        <button type="button">Bild Upload</button>
                        <div class=unterüberschrift>
                            <label>noch ist kein Bild ausgewählt</label>
                        </div>
                    </div>

                    <div class="formblock">
                        <label>Gib bitte deine <b>Anschrift</b> an</label>
                        <div class="unterüberschrift">
                            <!--wenn Dienstleistung gewählt, in Javascript noch ergänzen:<textarea readonly disabled="disabled">Falls deine angebotene Dienstleistung an einem bestimmten Ort stattfindet, gib bitte dessen gesamte Adresse an. Fall du die Dienstleistung bei den Interessenten ausführen möchtest, gib bitte mindestens deinen Ort an, damit
                            klar ist, in welchem Gebiet die Dienstleistung stattfindet und da dein Angebot ansonsten nicht erscheint, wenn Interessenten nach einem Ort filtern.</textarea>-->
                        </div>
                        <label>Vorname
                            <input type="text" name="Vorname" value="<?php echo htmlspecialchars($vorname);?>" size="20" maxlength="20">
                            <span class="error"><?php echo $vornameErr;?></span>
                            </label>
                        <br>
                        <label>Nachname
                            <input type="text" name="Nachname" value="<?php echo htmlspecialchars($nachname);?>" size="30" maxlength="30">
                            <span class="error"><?php echo $nachnameErr;?></span>    
                        </label>
                        <br>
                        <label>Straße
                            <input type="text" name="Strasse" value="<?php echo htmlspecialchars($strasse);?>" size="30" maxlength="30">
                            <span class="error"><?php echo $strasseErr;?></span>
                        </label>
                        <br>
                        <label>Hausnummer
                            <input type="text" name="Hnr" value="<?php echo htmlspecialchars($hnr);?>" size="4" maxlength="4"> 
                            <span class="error"><?php echo $hnrErr;?></span>
                        </label>
                        <br>
                        <label>Postleitzahl
                            <input type="number" name="PLZ" value="<?php echo htmlspecialchars($plz);?>" size="5" maxlength="5"> 
                            <span class="error"><?php echo $plzErr;?></span>
                         </label>
                        <br>
                        <label>Ort
                            <input type="text" name="Ort" value="<?php echo htmlspecialchars($ort);?>" size="30" maxlength="30">
                            <span class="error"><?php echo $ortErr;?></span> 
                        </label>
                    </div>


                    <div class="Werkzeug selectt">

                        <div class="formblock">
                            <label>Gib den <b>Preis</b> an, den das Ausleihen deines Gegenstands <b>pro Tag</b> kostet</label>
                            <br>
                            <input type="number" step="0.01" min="0" max="9999.99" name="PreisProTag1" value="<?php echo htmlspecialchars($preisProTag1);?>" size="4" maxlength="4">
                            <label>€/Tag</label> <span class="error"><?php echo $preisProTagErr;?></span>
                            <br>
                            <input type="checkbox" id="bierBez1" name="bierBez1" value="1" unchecked>
                            <label for="bierBez1">auch in Flaschen Bier bezahlbar (eine Flasche 0,5l entspricht in etwa 1€)</label>
                        </div>

                        <!--<div class="formblock">
                            <label>Damit Interessenten wissen, wo deinen Angebotsgegenstand abholen können, gib deine <b>Anschrift</b> an</label>
                            <br>
                            <label>Straße
                            <input type="text" name="Straße" value=" " size="30" maxlength="30">
                            </label>
                            <br>

                            <label>Hausnummer
                            <input type="number" name="Hnr" value=" " size="4" maxlength="4"> 
                        </label>
                            <br>

                            <label>Postleitzahl
                            <input type="number" name="PLZ" value=" " size="5" maxlength="5"> 
                        </label>
                            <br>
                            <label>Ort
                            <input type="text" name="Ort" value=" " size="30" maxlength="30"> 
                        </label>
                    </div>-->

                    </div>



                    <div class="Werkstatt selectt">
                        <div class="formblock">
                            <label>Gib den <b>Preis</b> an, den das Buchen deiner Werkstatt <b>pro Tag</b> kostet </label>
                            <br>
                            <input type="number" step="0.01" min="0" max="9999.99" name="PreisProTag2" value="<?php echo htmlspecialchars($preisProTag2);?>" size="4" maxlength="4"> <!--pattern="^(\d){1,4}([,.])?(\d){0,2}$"-->
                            <label>€/Tag</label>
                            <span class="error"><?php echo $preisProTagErr;?></span>
                            <br>
                            <input type="checkbox" id="bierBez2" name="bierBez2" value="1" unchecked>
                            <label for="bierBez2">auch in Flaschen Bier bezahlbar (eine Flasche 0,5l entspricht in etwa 1€)</label>
                        </div>

                        <div class="formblock">
                            <label>Gib an, ob deine Werkstatt besondere <b>Ausstattungsmerkmale</b> besitzt </label>
                            <fieldset>
                                <ul>
                                    <li>
                                        <label>
                                  <input type="checkbox" name="a1_Bohr" value="1">
                                  Standbohrmaschine
                                </label>
                                    </li>
                                    <li>
                                        <label>
                                   <input type="checkbox" name="a2_Drechsel" value="1">
                                   Drechselbank/Drehbank

                                </label>
                                    </li>
                                    <li>
                                        <label>
                                  <input type="checkbox" name="a3_Schleif" value="1">
                                  Schleifmaschine
                                </label>
                                    </li>
                                    <li>
                                        <label>
                                <input type="checkbox" name="a4_Säge" value="1">
                                elektrische Standsägen
                              </label>
                                    </li>
                                    <li>
                                        <label>
                              <input type="checkbox" name="a5_Kleinteil" value="1">
                              Grundausstattung Kleinteile (Schrauben, Dübel, Nägel etc.) vorhanden und verwendbar
                            </label>
                                    </li>
                                </ul>
                            </fieldset>
                        </div>
                        <!--
                        <div class="formblock">
                            <label>Gib die <b>Anschrift</b> der angebotenen Werkstatt an</label>
                            <br>
                            <label>Straße
                            <input type="text" name="Straße" value=" " size="30" maxlength="30">
                            </label>
                            <br>
                            <label>Hausnummer
                            <input type="number" name="Hnr" value=" " size="4" maxlength="4"> 
                        </label>
                            <br>
                            <label>Postleitzahl
                            <input type="number" name="PLZ" value=" " size="5" maxlength="5"> 
                        </label>
                            <br>
                            <label>Ort
                            <input type="text" name="Ort" value=" " size="30" maxlength="30"> 
                        </label>
                        </div>-->
                    </div>



                    <div class="Dienstleistung selectt">
                        <div class="formblock">
                            <label>Gib die <b>Art der Bezahlung</b> an </label>
                            <br>
                            <select name="Bezahlart">
                                <option>Preis/Stunde</option>
                                <option>Fixpreis</option>
                            </select>
                            <br>
                            <label>Betrag
                            </label>
                            <input type="number" step="0.01" min="0" max="9999.99" name="Preis" value="<?php echo htmlspecialchars($preisBetragErr);?>" size="4" maxlength="4">
                            <label>€</label>
                            <span class="error"><?php echo $preisBetragErr;?></span>
                            <br>
                            <input type="checkbox" id="bierBez3" name="bierBez3" value="1" unchecked>
                            <label for="bierBez3">auch in Flaschen Bier bezahlbar (eine Flasche 0,5l entspricht in etwa 1€)</label>
                        </div>
                    </div>



                    <br>
                    <p>Nach Erstellung des Angebots können Interessenten dein Angebot sehen und dich kontaktieren.</p>
                    <br>
                    <div class=unterüberschrift>
                        <p>Nur bei
                            <t>workerbees</t> registrierte Personen können dein Angebot sehen. Die angegebenen Daten werden gemäß Datenschutzrichtlinie xy nicht an Dritte weitergegeben und nach Löschung des Angebots eliminiert. Auch ist ein Versand von Reklame
                            an angegebene Anschriften ausgeschlossen.</p>
                    </div>
                    <input type="submit" name="Angebot erstellen" value="Angebot erstellen">
                    <br>
                </form>


                <script type="text/javascript">
                    $(document).ready(function() {
                        $('input[type="radio"]').click(function() {
                            var inputValue = $(this).attr("value");
                            var targetBox = $("." + inputValue);
                            $(".selectt").not(targetBox).hide();
                            $(targetBox).show();
                        });
                    });
                </script>
                

            </div>


        </div>


        <!--Notiz: <progress value="40" max="100"></progress> für Fortschrittsanzeige (wenn Formular über mehrere Seiten geht)-->

        
        <?php include ("./PHP/footer.php"); ?>

        <!--<div class="footer">
            <div class="footer_info">
                <img src="images/logoKomplett.png " class="logo " alt="Worker Bees Logo" width="207" height="60">
                <br>
                <br>
                <br>

                <div class="footer_slogan">
                    <p>Come to craft.</p>
                </div>
                <div id="contact">
                    <p>WorkerBees e.V.
                        <br> Musterstraße 25
                        <br> 86712 Musterstadt
                    </p>
                    <a href="mailto:support@workerbees.com ">support@workerbees.com</a>
                    <br> +49 172 906 212
                </div>
            </div>
            <div class="footer_end">
                <p>Copyright 2020 | WorkerBees e.V.</p>
            </div>

        </div>-->

    </div>
</body>

</html>