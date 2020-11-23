<?php session_start(); ?>

<!doctype html>
<html class="no-js" lang="">
  
<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logoBiene.png" />
    <title>Worker Bees</title>
    <meta name="description" content="">
    <link href="CSS/aboutUsDesign.css" rel="stylesheet">

</head>

<body>
<?php include "PHP/header.php";?>
   
    <div class="content">
       <!--  first part that you'll see the page
        buttons redirect you to story or team -->
        <div class="background">
            <div class="aboutUs">
                <h2>Hier erfährst Du alles über die Geschichte von Worker Bees und kannst das fleißige Team kennenlernen.
                </h2>
                <a href="aboutUs.php#story"><button class="storyButton" ><h4>Unsere Story</h4></button></a>
                <a href="aboutUs.php#businessOwner"><button class="businessOwnerButton" ><h4>Unser Team</h4></button></a>
            </div>
        </div>

        <!-- information about our story -->
            <div id="story"> 
            <div class="row">
                <div class="columnStory">
                <div class="card2"> 
                 </br>
                 </br>
                 </br>
                    <h2>Du interessierst dich für unsere Erfolgsgeschichte? Dann bist Du hier genau richtig!
                    </h2>
                    </br>
                    </br>
                    <div class = "p">
                 <p>Worker Bees wurde im Jahr 2020 von drei dualen Studenten ins Leben gerufen. 
                   Das Ziel ist, dass jeder sein handwerkliches Hobby ausleben kann. 
                   Dies ist nämlich oft nicht der Fall, wenn man kein Geld für teure Werkzeuge oder keine Räumlichkeit zum Heimwerken hat...
                   Durch das Verleihen von Werkzeug und Vermieten von Werkstätten werden so neue Möglichkeiten geschaffen. 
                   Es soll eine ganz spezielle Community entstehen, die sich gegenseitig unterstützt und Wissen miteinander teilt.
                   Ebenfalls soll es belohnt werden, wenn man anderen unter die Arme greift. Deshalb vermitteln wir auf unserer Seite auch Dienstleistungen.
                   Außerdem wollen wir auch Nachhaltigkeit fördern. Durch Worker Bees kann nämlich Vieles wiederverwertet, repariert oder selbst erschaffen werden.
                   Dies macht einen Neukauf oftmals überflüssig. 
                 </p>
                 </br>
                 <p>Wir freuen uns, wenn auch Du mit dabei bist! :) 
                 </p>
                 </br>
                 </div>
                 <div id = "businessOwner">
                    <img src="images/logoSchriftzug.png"  style="width: 650px">
                    </div>
                    </div>
                    <div class="container"></div>
                  
              </div>
            </div>

                <!-- information about the team -->
                <div class="businessOwnerHeading"> 
                    </br>
                        <h2>Hier kannst Du unser Team näher kennenlernen
                        </h2>
                        </br>
                </div>


            <div class="row">
                <div class="column">
                  <div class="card">
                     
                    <img src="images/Sarah.jpg" alt="Sarah" style="width:100%">

                    <div class="container">
                      <h2>Sarah Engelmayer</h2>
                    </br> 
                    <!-- title: display text in grey -->
                    <p class="title">Gründer</p>
                    <p class="title">Verantwortlich für die Webseite</p>
                      </br> 
                    <p>"Kein Handwerk ohne Lehrzeit" (Jean de La Bruyère). Obwohl ich das immer wieder 
                      feststellen muss, spüre ich doch meist einen Funken Stolz, wenn ich an meiner selbst gebauten 
                      Kommode vorbeilaufe. Damit jeder die Möglichkeit hat, seine eigenen Unikate zu schaffen
                      und dabei seine Fähigkeiten auszubauen, gibt es die Workerbees.
                    </p>
                      </br> 
                      <!-- button that opens email with suitable address of the founders to contact them -->
                      <div role="button" class="buttonKontakt" onclick="location.href='mailto:engelmayer@workerbees.com';">Kontakt</div>

                    </div>
                  </div>
                </div>
              
                <div class="column">
                  <div class="card">

                    <img src="images/Kati.jpg" alt="Kati" style="width:100%">

                    <div class="container">
                      <h2>Katerina Matysova</h2>
                         </br> 
                      <p class="title">Gründer</p>
                      <p class="title">Verantwortlich für die Strategieplanung</p>
                        </br> 
                      <p>Ich wollte schon immer badass sein.</p>
                        </br> 
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        
                         <div role="button" class="buttonKontakt" onclick="location.href='mailto:matysova@workerbees.com';">Kontakt</div>
                    </div>
                  </div>
                </div>
              
                <div class="column">
                  <div class="card">

                    <img src="images/Dani_fitted.jpg" alt="Dani" style="width:100%">

                    <div class="container">
                      <h2>Daniel Birk</h2>
                        </br> 
                      <p class="title">Gründer</p>
                      <p class="title">Verantwortlich für das Marketing</p>
                        </br> 
                      <p>Als Student hat man einfach kein Geld, um sich neue Werkzeuge zu kaufen.
                        Trotzdem wollte ich am Wochenende mein Hobby ausleben und für meine WG neue Möbel bauen. 
                        Das ist jetzt durch Worker Bees möglich und das finde ich sehr cool. 
                      </p>
                        </br>
                        </br>
                        </br> 
                      
                         <div role="button" class="buttonKontakt" onclick="location.href='mailto:birk@workerbees.com';">Kontakt</div>
                    </div>
                  </div>
                </div>
              </div>

        </div>
      
    <?php include "PHP/footer.php";?>

</body>

</html>