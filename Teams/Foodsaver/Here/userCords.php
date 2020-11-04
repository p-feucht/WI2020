<script>


window.userHausnummer = '<?php echo($_SESSION['session_housenr']); ?>';
window.userStreet = '<?php echo($_SESSION['session_street']); ?>';
window.userCity = '<?php echo($_SESSION['session_ort']); ?>';
window.userPLZ = '<?php echo($_SESSION['session_plz']); ?>';
window.userCountry_ip = '<?php echo(trim($_SESSION['ip_country'])); ?>';
window.userCountry_de = '<?php echo($_SESSION['session_country']); ?>';
var countryNameUser = localStorage.getItem('countryNameUser');

if($_SESSION['session_plz'] == $_SESSION['ip_plz']){
  userCountry = 
}
else{
  userCountry = 
}

// Instantiate a map and platform object:
var platform = new H.service.Platform({
    'apikey': 'Lo513DlcJj8AWDBTQUXh4_6MtLoJDh_XzW1v6yAUQCQ'
  });
  
  // Get an instance of the geocoding service:
  var service = platform.getSearchService();
  
  // Call the geocode method with the geocoding parameters,
  // the callback and an error callback function (called if a
  // communication error occurs):
  service.geocode({
    qq: 'houseNumber=' + userHausnummer + ';street=' + userStreet + ';city=' + userCity + ';postalCode=' + userPLZ + ';country=' + countryNameUser + ''
  }, (result) => {
    // Add a marker for each location found
    result.items.forEach((item) => {
      console.log(item.address);
      console.log(item.position);
      position = item.position;
      window.userlat = (Math.abs(position.lat));
      window.userlon = (Math.abs(position.lng));
      localStorage.setItem("userlat",window.userlat);
      localStorage.setItem("userlon",window.userlon);
    });
  }, alert);

  </script>