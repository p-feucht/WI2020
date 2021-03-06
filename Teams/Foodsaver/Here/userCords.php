<script>
  var countryHausnummer = '<?php echo ($_SESSION['session_housenr']); ?>';
  var countryStreet = '<?php echo ($_SESSION['session_street']); ?>';
  var countryCity = '<?php echo ($_SESSION['session_ort']); ?>';
  var countryPLZ = '<?php echo ($_SESSION['session_plz']); ?>';


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
    qq: 'houseNumber=' + countryHausnummer + ';street=' + countryStreet + ';city=' + countryCity + ';postalCode=' + countryPLZ + ''
  }, (result) => {
    // Add a marker for each location found
    result.items.forEach((item) => {
      address = item.address,
        console.log(item.address);
      console.log(item.position);
      var sellerCords = item.position;

      localStorage.setItem("countryNameUser", address.countryName);
      localStorage.setItem("userHausnummer", address.houseNumber);
      localStorage.setItem("userStreet", address.street);
      localStorage.setItem("userCity", address.city);
      localStorage.setItem("userPLZ", address.postalCode);

      localStorage.setItem("userlat", sellerCords.lat);
      localStorage.setItem("userlon", sellerCords.lng);
      localStorage.setItem("userCords", sellerCords);
    });
  }, alert);
</script>