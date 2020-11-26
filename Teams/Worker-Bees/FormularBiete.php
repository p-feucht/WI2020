<?php session_start();
// User kommt nur auf Angebot erstellen-Seite nur, wenn er angemeldet ist, ansonsten auf Anmelden-Seite
if (!isset($_SESSION ["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Worker Bees</title>
    <link rel="icon" href="images/logoBiene.png" />
    <meta name="description" content="">
    
 <!--   <link href="CSS/headerDesign.css" rel="stylesheet">-->
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
    <script  src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/daterangepicker.css" />

</head>

<body>
    
    <?php 

    include ("./PHP/header.php"); ?>

    <div class="content">
        <!--Slider-->
        <section>
            <img class="mySlides" src="images/smith.jpg" alt="Schmied an der Arbeit" style="width:100%">
            <img class="mySlides" src="images/werkstatt.jpg" alt="Mann mit Staubmaske arbeitet in Werkstatt" style="width:100%">
            <img class="mySlides" src="images/tools.jpg"  alt="verschiedene Werkzeuge" style="width:100%">
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
                    Du möchtest deinen meist nicht benötigten Hochdruckreiniger verleihen, deine Werkstatt zwischendurch zur Verfügung stellen oder anderen bei etwas Handwerklichem unter die Arme greifen? Fülle das folgende Formular aus. Wir danken dir!
                </p>
                <br>
                <p class="Fehlermeldung" id="erforderlichErklärung">* erforderlich</p>
                <br>

                <form name="formularFuerAngebot" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return pruefeFormular();">

                    <div class=formblock>

                        <label>Wähle eine <b>Angebotskategorie</b></label><label class="Fehlermeldung" id="FehlermeldungAngebKat">*</label>
                        <br>
                        <input type="radio" id="wz" name="kategorie" value="Werkzeug"> Werkzeug verleihen

                        <input type="radio" id="ws" name="kategorie" value="Werkstatt"> Werkstatt vermieten

                        <input type="radio" id="dl" name="kategorie" value="Dienstleistung"> Dienstleistung anbieten

                    </div>


                    <div class=formblock>
                        <label>Gib deinem Angebot einen <b>Titel</b></label><label class="Fehlermeldung" id="FehlermeldungTitle">*</label>
                        <br>
                        <input id="title" type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" size="30" maxlength="30">
                        <label class="Fehlermeldung" id="FehlermeldungTitle"></label>
                        <div class=unterüberschrift>
                            <label>Tipp: Nutze Begriffe, die andere Heimwerker bei der Suche nach deinem Angebot verwenden würden.</label>
                        </div>

                    </div>

                    <div class="formblock">
                        <label>Wähle einen <b>Angebotszeitraum </b><label class="Fehlermeldung" id="FehlermeldungZeitraum">*</label>
                        <br>
                        <input type="text" name="datefilter" value="" placeholder="Wähle deinen Angebotszeitraum" size="27%" required />
                        <script type="text/javascript">
                            datePicker();
                        </script>
                    </div>

                    <div class="formblock">
                        <label>Füge eine <b>Beschreibung</b> hinzu</label>
                        <br>
                        <textarea id="beschreibung" name="beschreibung" rows="9" cols="1" value="<?php echo htmlspecialchars($beschreibung); ?>"></textarea>
                        <br>
                    </div>

                    <div class="formblock">
                        <input type="hidden" name="MAX_FILE_SIZE" value="90000"> <!--max. 90 KB großes Bild erlaubt -->
                        <label>Füge ein <b>Bild</b>, das dein Angebot zeigt oder beschreibt, hinzu</label>
                        <div class="unterüberschrift">
                            <label>Dateiformate *.jpg, *.png oder *.gif </label>
                        </div>
                        <input type="file" name="uploaddatei" accept="image/gif,image/jpeg,image/jpg,image/png">
                        </label><label class="Fehlermeldung" id="FehlermeldungBild"> <?php echo $BildFehler?> </label>
                        <div class="unterüberschrift">
                            <label>maximale Größe 90 KB</label>
                        </div>
                    </div>

                    <div class="formblock">
                        <label>Gib bitte deine <b>Anschrift</b> an</label> <label class="Fehlermeldung" id="FehlermeldungAnschrift"></label>
                        <div class="unterüberschrift">
                            <!--wenn Dienstleistung gewählt, in Javascript noch ergänzen:<textarea readonly disabled="disabled">Falls deine angebotene Dienstleistung an einem bestimmten Ort stattfindet, gib bitte dessen gesamte Adresse an. Fall du die Dienstleistung bei den Interessenten ausführen möchtest, gib bitte mindestens deinen Ort an, damit
                            klar ist, in welchem Gebiet die Dienstleistung stattfindet und da dein Angebot ansonsten nicht erscheint, wenn Interessenten nach einem Ort filtern.</textarea>-->
                        </div>
                        <label>Vorname 
                            <input type="text" id="Vorname" name="Vorname" value="<?php echo htmlspecialchars($vorname); ?>" size="20" maxlength="20">
                           
                        </label> <label class="Fehlermeldung" id="FehlermeldungVorname">*</label>
                        <br>
                        <label>Nachname
                            <input type="text" id="Nachname" name="Nachname" value="<?php echo htmlspecialchars($nachname); ?>" size="30" maxlength="30"> 
                        </label><label class="Fehlermeldung" id="FehlermeldungNachname">*</label>
                        <br>
                        <label>Straße
                            <input type="text" id="StrasseID" name="Strasse" value="<?php echo htmlspecialchars($strasse); ?>" size="30" maxlength="30">
                        </label><label class="Fehlermeldung" id="FehlermeldungStrasse">*</label>
                        <br>
                        <label>Hausnummer
                            <input type="text" id="HnrID" name="Hnr" value="<?php echo htmlspecialchars($hnr); ?>" size="4" maxlength="4"> 
                        </label><label class="Fehlermeldung" id="FehlermeldungHnr">*</label>
                        <br>
                        <label>Postleitzahl
                            <input type="number" id="plzinput" name="PLZ" value="<?php echo htmlspecialchars($plz); ?>" size="5" maxlength="5"> 
                         </label>
                         <label class="Fehlermeldung" id="FehlermeldungPLZ">*</label>
                        <br>
                        <label>Ort
                            <input type="text" name="Ort" id="OrtID" value="<?php echo htmlspecialchars($ort); ?>" size="30" maxlength="30">
                        </label>
                        <label class="Fehlermeldung" id="FehlermeldungOrt">*</label>
                    </div>


                    <div class="Werkzeug selectt">

                        <div class="formblock"> 
                            <label>Gib den <b>Preis</b> an, den das Ausleihen deines Gegenstands <b>pro Tag</b> kostet</label>
                            <br>
                            <input type="number" step="0.01" min="0" max="9999.99" name="PreisProTag1" value="<?php echo htmlspecialchars($preisProTag1);?>" size="4" maxlength="4">
                            <label>€/Tag</label>
                            <br>
                            <input type="checkbox" id="bierBez1" name="bierBez1" value="1" unchecked>
                            <label for="bierBez1">auch in Flaschen Bier bezahlbar (eine Flasche 0,5l entspricht in etwa 1€)</label>
                        </div>

                    </div>



                    <div class="Werkstatt selectt">
                        <div class="formblock">
                            <label>Gib den <b>Preis</b> an, den das Buchen deiner Werkstatt <b>pro Tag</b> kostet </label>
                            <br>
                            <input type="number" step="0.01" min="0" max="9999.99" name="PreisProTag2" value="<?php echo htmlspecialchars($preisProTag2);?>" size="4" maxlength="4"> <!--pattern="^(\d){1,4}([,.])?(\d){0,2}$"-->
                            <label>€/Tag</label>
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
                                <input type="checkbox" name="a4_Saege" value="1">
                                elektrische Standsäge
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
                        
                    </div>



                    <div class="Dienstleistung selectt">
                        <div class="formblock">
                            <label>Gib die <b>Art der Bezahlung</b> an</label>
                            <br>
                            <select name="Bezahlart">
                                <option>Preis/Stunde</option>
                                <option>Fixpreis</option>
                            </select>
                            <br>
                            <label>Betrag
                            </label>
                            <input type="number" step="0.01" min="0" max="9999.99" name="Preis" value="" size="4" maxlength="4"> 
                            <label>€</label>
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


                <script>
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

    </div>
</body>

</html>