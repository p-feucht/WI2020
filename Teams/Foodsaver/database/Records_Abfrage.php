     <?php
        //Zeigt Records auf Startseite an
        session_start();
        require('connectDB.php');
        //speichert Filterinformationen
        $Kategorie = "";
        $Kueche = "";
        $PreisU = 0;
        $PreisO = 100000;
        if (isset($_GET['Kategorie'])) {
            $Kategorie = $_GET['Kategorie'];
            $Kueche = $_GET['Kueche'];
            $Preis = $_GET['Preis'];
            if ($Preis == "under5euros") {
                $PreisO = 5.01;
            } else if ($Preis == "until10euros") {
                $PreisO = 10.01;
            } else if ($Preis == "until20euros") {
                $PreisO = 20.01;
            }
        }


        //Im Index werden alle Records in verschiedene Arrays eingeteilt je nach Entfernung vom User zum Verkäufer
        //Je nach gesetztem Entfernungs-Filter wird das entsprechende Array ausgewählt und durchlaufen
        //Für jeden Record in dem Array wird die prozentuale Übereinstimmung mit allen anderen Records berechnet 
        //Der Record mit der höchsten übereinstimmung wird angezeigt
        //Dies wird für jeden Record in dem Entfernungs-Array durchgeführt
        if (isset($_GET['Entfernung']) && $_GET['Entfernung'] != "") {

            if ($_GET['Entfernung'] == "until5km") {
                $id_array = array();

                for ($i = 0; $i < count($_SESSION['distance_less5']); $i++) {

                    $street = $_SESSION['distance_less5'][$i][3][0];
                    $Hausnummer = $_SESSION['distance_less5'][$i][3][1];
                    $plz = $_SESSION['distance_less5'][$i][3][2];
                    $Ort = $_SESSION['distance_less5'][$i][3][3];

                    $street_percentages = array();
                    $sql_straße = mysqli_query($db_link, "SELECT * FROM tbl_records") or die('Fehler: ' . mysqli_error($db_link));
                    while ($res_straße = mysqli_fetch_array($sql_straße)) {
                        similar_text($street, $res_straße['Straße'], $percent);
                        $perc_temp = array();
                        array_push($perc_temp, $street, $res_straße['Straße'], $percent);
                        array_push($street_percentages, $perc_temp);
                    }
                    $b = 0;
                    for ($a = 0; $a < count($street_percentages); $a++) {
                        if ($street_percentages[$a][2] > $b) {
                            $b = $street_percentages[$a][2];
                            $street_end = $street_percentages[$a][1];
                        }
                    }

                    $db_dist = mysqli_query($db_link, "SELECT ID FROM tbl_records WHERE Straße = '$street_end' and Hausnummer = '$Hausnummer'
                            and PLZ = '$plz'") or die('Fehler: ' . mysqli_error($db_link));

                    while ($result = mysqli_fetch_array($db_dist)) {
                        if (in_array($result['ID'], $id_array)) {
                        } else {
                            array_push($id_array, $result['ID']);
                        }
                    }
                }
            } elseif ($_GET['Entfernung'] == "until15km") {
                $id_array = array();
                for ($i = 0; $i < count($_SESSION['distance_less15']); $i++) {

                    $street = $_SESSION['distance_less15'][$i][3][0];
                    $Hausnummer = $_SESSION['distance_less15'][$i][3][1];
                    $plz = $_SESSION['distance_less15'][$i][3][2];
                    $Ort = $_SESSION['distance_less15'][$i][3][3];

                    $street_percentages = array();
                    $sql_straße = mysqli_query($db_link, "SELECT * FROM tbl_records") or die('Fehler: ' . mysqli_error($db_link));
                    while ($res_straße = mysqli_fetch_array($sql_straße)) {
                        similar_text($street, $res_straße['Straße'], $percent);
                        $perc_temp = array();
                        array_push($perc_temp, $street, $res_straße['Straße'], $percent);
                        array_push($street_percentages, $perc_temp);
                    }
                    $b = 0;
                    for ($a = 0; $a < count($street_percentages); $a++) {
                        if ($street_percentages[$a][2] > $b) {
                            $b = $street_percentages[$a][2];
                            $street_end = $street_percentages[$a][1];
                        }
                    }

                    $db_dist = mysqli_query($db_link, "SELECT ID FROM tbl_records WHERE Straße = '$street_end' and Hausnummer = '$Hausnummer'
                            and PLZ = '$plz'") or die('Fehler: ' . mysqli_error($db_link));

                    while ($result = mysqli_fetch_array($db_dist)) {
                        if (in_array($result['ID'], $id_array)) {
                        } else {
                            array_push($id_array, $result['ID']);
                        }
                    }
                }
            } elseif ($_GET['Entfernung'] == "until30km") {
                $id_array = array();
                for ($i = 0; $i < count($_SESSION['distance_less30']); $i++) {

                    $street = $_SESSION['distance_less30'][$i][3][0];
                    $Hausnummer = $_SESSION['distance_less30'][$i][3][1];
                    $plz = $_SESSION['distance_less30'][$i][3][2];
                    $Ort = $_SESSION['distance_less30'][$i][3][3];

                    $street_percentages = array();
                    $sql_straße = mysqli_query($db_link, "SELECT * FROM tbl_records") or die('Fehler: ' . mysqli_error($db_link));
                    while ($res_straße = mysqli_fetch_array($sql_straße)) {
                        similar_text($street, $res_straße['Straße'], $percent);
                        $perc_temp = array();
                        array_push($perc_temp, $street, $res_straße['Straße'], $percent);
                        array_push($street_percentages, $perc_temp);
                    }

                    $b = 0;
                    for ($a = 0; $a < count($street_percentages); $a++) {
                        if ($street_percentages[$a][2] > $b) {
                            $b = $street_percentages[$a][2];
                            $street_end = $street_percentages[$a][1];
                        }
                    }

                    $db_dist = mysqli_query($db_link, "SELECT ID FROM tbl_records WHERE Straße = '$street_end' and Hausnummer = '$Hausnummer'
                            and PLZ = '$plz'") or die('Fehler: ' . mysqli_error($db_link));

                    while ($result = mysqli_fetch_array($db_dist)) {
                        if (in_array($result['ID'], $id_array)) {
                        } else {
                            array_push($id_array, $result['ID']);
                        }
                    }
                }
            } else {
                $id_string = '*';
            }
            if (empty($id_array)) {
                $id_string = '-1';
            } else {
                $id_string = implode(', ', $id_array);
            }
        } else {
            $id_string = '*';
        }


        if ((isset($_POST["myInput"]) and !empty($_POST["myInput"])) or (isset($_POST["searchButton"]) and !empty($_POST["myInput"]))) {
            $search = $_POST["myInput"];
        } else {
            $search = '*';
        }
        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
        } else {
            $limit = 10;
        }
        if ($search == '*') {
            if ($id_string == '*') {
                $db_res = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE Visable = '0' AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
                $countselect = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE Visable = '0' AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
                $all_records = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE Visable = '0' AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
            } else {
                $db_res = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE Visable = '0' AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' AND ID IN ($id_string) ORDER BY Erstellungsdatum DESC Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
                $countselect = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE Visable = '0' AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' AND ID IN ($id_string) ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
                $all_records = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE Visable = '0' AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
            }
        } else {
            if ($id_string == '*') {
                $db_res = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE (Visable = '0') AND (Artikel LIKE '%$search%' or Beschreibung LIKE '%$search%' or Menge LIKE '%$search%' 
                        or Preis LIKE '%$search%' or Firma LIKE '%$search%' or Nachname LIKE '%$search%' or PLZ LIKE '%$search%' or Ort LIKE '%$search%') AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
                $countselect = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE (Visable = '0') AND (Artikel LIKE '%$search%' or Beschreibung LIKE '%$search%' or Menge LIKE '%$search%' 
                        or Preis LIKE '%$search%' or Firma LIKE '%$search%' or Nachname LIKE '%$search%' or PLZ LIKE '%$search%' or Ort LIKE '%$search%') AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
                $all_records = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE (Visable = '0') AND (Artikel LIKE '%$search%' or Beschreibung LIKE '%$search%' or Menge LIKE '%$search%' 
                        or Preis LIKE '%$search%' or Firma LIKE '%$search%' or Nachname LIKE '%$search%' or PLZ LIKE '%$search%' or Ort LIKE '%$search%') AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
            } else {
                $db_res = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE (Visable = '0') AND (Artikel LIKE '%$search%' or Beschreibung LIKE '%$search%' or Menge LIKE '%$search%' 
                        or Preis LIKE '%$search%' or Firma LIKE '%$search%' or Nachname LIKE '%$search%' or PLZ LIKE '%$search%' or Ort LIKE '%$search%') AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' AND ID IN ($id_string)) ORDER BY Erstellungsdatum DESC Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
                $countselect = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE (Visable = '0') AND (Artikel LIKE '%$search%' or Beschreibung LIKE '%$search%' or Menge LIKE '%$search%' 
                        or Preis LIKE '%$search%' or Firma LIKE '%$search%' or Nachname LIKE '%$search%' or PLZ LIKE '%$search%' or Ort LIKE '%$search%') AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' AND ID IN ($id_string)) ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
                $all_records = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE (Visable = '0') AND (Artikel LIKE '%$search%' or Beschreibung LIKE '%$search%' or Menge LIKE '%$search%' 
                        or Preis LIKE '%$search%' or Firma LIKE '%$search%' or Nachname LIKE '%$search%' or PLZ LIKE '%$search%' or Ort LIKE '%$search%') AND Kategorie LIKE '$Kategorie%' AND LänderKüche LIKE '$Kueche%' AND Preis>='$PreisU' AND Preis<'$PreisO' ORDER BY Erstellungsdatum DESC") or die('Fehler: ' . mysqli_error($db_link));
            }
        }


        $id = 1;

        $resultCheck = mysqli_num_rows($db_res);
        $sumResults = mysqli_num_rows($countselect);

        if ((isset($_POST["myInput"]) and !empty($_POST["myInput"])) or (isset($_POST["searchButton"]) and !empty($_POST["myInput"]))) {
            if ($resultCheck > 0) {
                echo ("<div id='Record'>
                <h1>Aktuelle Angebote für '" . $search . "'</h1>
                <p>Anzahl an Angeboten: $resultCheck von $sumResults</p>");
            } else {
                echo ("<div id='Record'>
                <h1>Es gibt leider keine Angebote für '" . $search . "'</h1>");
            }
        } else {
            echo ("<div id='Record'>
                <h1>Aktuelle Angebote</h1>
                <p>Anzahl an Angeboten: $resultCheck von $sumResults</p>");
        }

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_array($db_res)) {

                $artikel_id = (int)$row["ID"];

                //Anzeige des Records mit Thumbnail und Originalbild und allen Informationen 

                $query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE (ArtikelID = $artikel_id) and (Thumbnail = 0)") or die('Fehler: ' . mysqli_error($db_link));
                $query_tbn = mysqli_query($db_link, "SELECT * FROM `Images` WHERE (ArtikelID = $artikel_id) and (Thumbnail = 1)") or die('Fehler: ' . mysqli_error($db_link));

                $ImageData = mysqli_fetch_array($query);
                $ImageData_tbn = mysqli_fetch_array($query_tbn);

                $ImageLink = $ImageData['imageLink'];
                $ImageLink_tbn = $ImageData_tbn['imageLink'];

                echo ('<table>');
                echo ('<col style="width:50%" span="2" />');
                echo ('<tr class="first_row" id="td-head-' . $id . '" rowSpan="1"<a href="#td-head-' . $id . '" onclick="toggle(6, ' . $id . '); changeText(' . $id . ');">');
                if ($ImageLink_tbn != Null) {
                    echo ('<td><b><a class="fancybox" rel="gallery" href="' . $ImageLink . '"><img src="' . $ImageLink_tbn . '" id="record_image"></a></td>');
                } elseif ($ImageLink_tbn == Null and $ImageLink != Null) {
                    echo ('<td><b><a class="fancybox" rel="gallery" href="' . $ImageLink . '"><img src="' . $ImageLink . '" id="record_image"></a></td>');
                } else {
                    echo ('<td><a class="fancybox" rel="gallery" href="../uploads/Kein_Bild_Standard.jpg"><img src="../uploads/Kein_Bild_Standard.jpg" id="record_image"></a></td>');
                }
                if ($_SESSION['session_user'] == $row['Email']) {
                    echo ('<td><i><b id="deine_anzeige">Deine Anzeige</b></i></br><b>Artikel: </b><a id="article" href="../order_food.php?id=' . $artikel_id . '">' . $row['Artikel'] . '</a></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                } else {
                    echo ('<td><b>Artikel: </b><a id="article" href="../order_food.php?id=' . $artikel_id . '">' . $row['Artikel'] . '</a></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                }
                $datum = $row['Erstellungsdatum'];
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $datum)->format('d.m.Y - H:i');
                $date = $date . ' Uhr';
                echo ('</tr>');
                echo ('<tr id="td-data-' . $id . '1" style="display:none">');
                echo ('<td><b>Menge: </b>' . $row['Menge'] . ' Stück/Portionen</td>');
                echo ('<td><b>Preis: </b>' . $row['Preis'] . '€</td>');
                echo ('</tr>');
                echo ('<tr id="td-data-' . $id . '2" style="display:none">');
                echo ('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
                echo ('<td><b>Datum: </b>' . $date . '</td>');
                echo ('</tr>');
                echo ('<tr id="td-data-' . $id . '3" style="display:none">');
                echo ('<td><b>Username: </b><a id="username" href="../profile.php?userid=' . $row['Username'] . '" >' . $row['Username'] . '</a></td>');
                echo ('<td><b>Name: </b>' . $row['Nachname'] . " " . $row['Vorname'] . '</td>');
                echo ('</tr>');
                echo ('<tr id="td-data-' . $id . '4" style="display:none">');
                echo ('<td><b>Straße: </b>' . $row['Straße'] . '</td>');
                echo ('<td><b>Hausnummer: </b>' . $row['Hausnummer'] . '</td>');
                echo ('</tr>');
                echo ('<tr id="td-data-' . $id . '5" style="display:none">');
                echo ('<td><b>PLZ: </b>' . $row['PLZ'] . '</td>');
                echo ('<td><b>Ort: </b>' . $row['Ort'] . '</td>');
                echo ('</tr>');
                echo ('<tr id="td-data-' . $id . '6" style="display:none">');
                echo ('<td><b>E-mail: </b>' . $row['Email'] . '</td>');
                echo ('<td><b>Telefonnummer: </b>' . $row['Telefonnummer'] . '</td>');
                echo ('</tr>');
                echo ('</table>');
                echo ('<button class="mehr_details" id="details' . $id . '" onclick="toggle(6, ' . $id . '); changeText(' . $id . ');">Mehr Details</button>');
                echo ('<a class="zur_bestellung" href="../order_food.php?id=' . $artikel_id . '">Zur Bestellung</a>');

                $id++;
            }
            //Anzahl an angezeigten Records wird ein Limit gesetzt, standart 10, d.h. 10 Records werden angezeigt
            // wenn mehr Records verfügbar sind, wird Button angezeigt, der 10 weitere Records lädt
            if (mysqli_num_rows($countselect) > $limit) {
                $limit2 = $limit + 10;
                echo ('<a class="mehr_artikel" href="../index.php?limit=' . $limit2 . '#td-head-' . ($limit - 1) . '">Weitere Artikel Anzeigen</a>');
            }
            //Array mit allen gespeicherten Records erstellt und gespeichert, für Distanzberechnung von User zu allen Records
            if (isset($_SESSION['session_user'])) {
                $arrayDist = array();
                while ($row2 = mysqli_fetch_array($all_records)) {

                    $data_array = array("id" => $row2['ID'], "Artikel" => $row2['Artikel'], "Straße" => $row2['Straße'], "Hausnummer" => $row2['Hausnummer'], "PLZ" => $row2['PLZ'], "Ort" => $row2['Ort']);

                    array_push($arrayDist, $data_array);
                }
                $_SESSION['distance_array'] = $arrayDist;

                require('Here/calculateDistances.php');
            }
        } else {

            echo ('<tr><p>Keine Anzeigen gefunden!</p></tr>');
        }



        ?>

     </div>


     <script>
         function changeText(id) {
             var element = document.getElementById('details' + id);

             if (element.innerHTML === 'Mehr Details') {
                 element.innerHTML = 'Weniger Details';
             } else {
                 element.innerHTML = 'Mehr Details';

             }
         }
     </script>