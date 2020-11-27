<script>
  var countryHausnummer = '<?php echo ($_SESSION['verkäuferHausnummer']); ?>';
  var countryStreet = '<?php echo ($_SESSION['verkäuferStraße']); ?>';
  var countryCity = '<?php echo ($_SESSION['verkäuferStadt']); ?>';
  var countryPLZ = '<?php echo ($_SESSION['verkäuferplz']); ?>';


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

      localStorage.setItem("countryNameSeller", address.countryName);
      localStorage.setItem("sellerHausnummer", address.houseNumber);
      localStorage.setItem("sellerStreet", address.street);
      localStorage.setItem("sellerCity", address.city);
      localStorage.setItem("sellerPLZ", address.postalCode);

      localStorage.setItem("sellerlat", sellerCords.lat);
      localStorage.setItem("sellerlon", sellerCords.lng);
      localStorage.setItem("sellerCords", sellerCords);

    });
  }, alert);
</script>