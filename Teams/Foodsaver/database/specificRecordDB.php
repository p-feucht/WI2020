<?php
            session_start();
            require('connectDB.php');

            $record_id = (int)$_GET['id'];
            
            $db_resArray = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));
            
        
            $id = 1;

            $resultCheck = mysqli_num_rows($db_resArray);

            $recordEmail = "";
            if($resultCheck > 0){

                while($rowArray = mysqli_fetch_array($db_resArray))
            {  
                $artikel_id = (int)$rowArray["ID"];
            }




            $query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE ArtikelID = $artikel_id ") or die('Fehler: ' . mysqli_error());
            $ImageLink = array();

            while($ImageData = mysqli_fetch_array($query)){

                $ImageLink[] = $ImageData['imageLink'];

            }
            $db_res = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));

            while($row = mysqli_fetch_array($db_res))
            {   
                
                $recordEmail = $row['Email'];
                
                if($row['Visable'] !== '0'){
                    echo('<p>Artikel nicht mehr verfügbar!</p>');
                }
                else{
   
                echo('<div id="Record_specific"><h1>'.$row['Artikel'].'</h1>');

                echo('<table>');
              
                    echo('<tr id="td-head-' . $id . '" rowSpan="1"<a href="#" ">');
                    if(!empty($ImageLink)){
                        echo('<td id="tdBild"><div class="slideshow-container">');
                        foreach ($ImageLink as $key=>$value) {                        
                        echo('<div class="mySlides fade">');
                        echo('<a class="fancybox" rel="gallery1" href="'.$value.'"><img src="'.$value.'" id="record_image_specific"></a>');
                        echo('</div>');
                        }
                        echo('<div style="text-align:center">');
                        foreach($ImageLink as $key=>$value) {
                        echo('<span class="dot" onclick="currentSlide('.$key.')"></span> ');
                        }
                        echo('</div>');
                        if(count($ImageLink) > 1){
                        echo('<a class="prev" onclick="plusSlides(-1)">&#10094;</a>');
                        echo('<a class="next" onclick="plusSlides(1)">&#10095;</a>');
                        }
                        
                        echo('</div></td>');
                    
                        echo('<td><b>Artikel: </b>' . $row['Artikel'] . '</br></br></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                    }    
                    else{
                        echo('<td><b>Artikel: </b>' . $row['Artikel'] . '</td>');
                        echo('<td><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                    }   
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '1" >');   
                echo('<td><b>Menge: </b>' . $row['Menge'] . ' Stück/Portionen</td>');
                echo('<td><b>Preis: </b>' . $row['Preis'] . '€</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '2" >');   
                echo('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
                echo('<td><b>Datum: </b>' . $row['Erstellungsdatum'] . '</td>');   
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '3" >');   
                echo('<td><b>Username: </b><a href="../profile.php?userid='. $row['Username'] .'" >' . $row['Username'] . '</a></td>');
                echo('<td><b>Name: </b>' . $row['Nachname'] . " " . $row['Vorname'] . '</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '4" >');   
                echo('<td><b>Straße: </b>' . $row['Straße'] . '</td>');
                echo('<td><b>Hausnummer: </b>' . $row['Hausnummer'] . '</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '5" >');   
                echo('<td><b>PLZ: </b>' . $row['PLZ'] . '</td>');
                echo('<td><b>Ort: </b>' . $row['Ort'] . '</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '6" >');   
                echo('<td><b>E-mail: </b>' . $row['Email'] . '</td>');
                echo('<td><b>Telefonnummer: </b>' . $row['Telefonnummer'] . '</td>');               
                echo('</tr>');
                echo('</table>');
                $id++;
                
            }
        }
        
         }     
            
        
        else{

            echo('<tr><p>Keine Anzeigen gefunden!</p></tr>');
        }
        $_SESSION['RecordEmail'] = $recordEmail;


        if(isset($_SESSION['session_user'])){
        $query2 = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));

            while($row = mysqli_fetch_array($query2))
            {   
                $_SESSION['verkäuferLand'] = 'de';
                $_SESSION['verkäuferStadt'] = $row['Ort'];
                $_SESSION['verkäuferStraße'] = $row['Straße'];
                $_SESSION['verkäuferHausnummer'] = $row['Hausnummer'];
                $_SESSION['verkäuferplz'] = $row['PLZ'];
                $_SESSION['artikel_id'] = $record_id;
                
            }
        }

        ?>
        
        </div>
        <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    clearInterval(myTimer);
  showSlides(slideIndex += n);
}
function plusSlidesAuto(n) {
    clearInterval(myTimer);
  showSlides(slideIndex = n);
}

function currentSlide(n) {
    clearInterval(myTimer);
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1; n = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";

    myTimer = setInterval(function(){plusSlidesAuto(n + 1)}, 4000);
  
}
</script>
   

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/FancyBox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/FancyBox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/FancyBox/jquery.mousewheel.pack.js"></script>
<link rel="stylesheet" href="/FancyBox/jquery.fancybox-buttons.css" type="text/css" media="screen" />
<script type="text/javascript" src="/FancyBox/jquery.fancybox-buttons.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>


