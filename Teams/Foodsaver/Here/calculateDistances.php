<?php
session_start();

$dist_array = $_SESSION['distance_array'];

?>

<script>
  function createArray() {
    var php_array = <?php echo json_encode($dist_array); ?>;
    let arrayLength = php_array.length;


    // Instantiate a map and platform object:
    var platform = new H.service.Platform({
      'apikey': 'Lo513DlcJj8AWDBTQUXh4_6MtLoJDh_XzW1v6yAUQCQ'
    });
    const copy = [];
    for (let i = 0; i < arrayLength; i++) {
      let sellerStreet = php_array[i]['Straße'];
      let sellerHousenr = php_array[i]['Hausnummer'];
      let sellerPLZ = php_array[i]['PLZ'];
      let sellerOrt = php_array[i]['Ort'];
      let record_id = php_array[i]['id'];
      // Get an instance of the geocoding service:
      var service = platform.getSearchService();

      // Call the geocode method with the geocoding parameters,
      // the callback and an error callback function (called if a
      // communication error occurs):


      service.geocode({
        qq: 'houseNumber=' + sellerHousenr + ';street=' + sellerStreet + ';city=' + sellerOrt + ';postalCode=' + sellerPLZ + ''
      }, (result) => {

        // Add a marker for each location found
        const items = result.items;

        var item = items[0];
        copy.push(item);

        localStorage.setItem("adress_array", JSON.stringify(copy));

      }, alert);
    }
    calcRoute();
  }

  function calcRoute() {
    const storedNames = JSON.parse(localStorage.getItem("adress_array"));
    console.log(storedNames);
    const dist_array = [];

    for (let c = 0; c < storedNames.length; c++) {

      const first = storedNames[c];
      const pos = first.position;
      var sellerlat = pos.lat;
      var sellerlon = pos.lng;

      var userlat = localStorage.getItem('userlat');
      var userlon = localStorage.getItem('userlon');

      calculateRouteFromAtoB(platform);

      function calculateRouteFromAtoB(platform) {
        var router = platform.getRoutingService(null, 8),
          routeRequestParams = {
            routingMode: 'fast',
            transportMode: 'car',
            origin: '' + userlat + ',' + userlon + '', // Brandenburg Gate
            destination: '' + sellerlat + ',' + sellerlon + '', // Friedrichstraße Railway Station
            return: 'polyline,turnByTurnActions,actions,instructions,travelSummary'
          };


        router.calculateRoute(
          routeRequestParams,
          onSuccess,
          onError
        );
      }
      /**
       * This function will be called once the Routing REST API provides a response
       * @param  {Object} result          A JSONP object representing the calculated route
       *
       * see: http://developer.here.com/rest-apis/documentation/routing/topics/resource-type-calculate-route.html
       */
      function onSuccess(result) {
        var route = result.routes[0];

        addSummaryToPanel(route);
        // ... etc.
      }

      /**
       * This function will be called if a communication error occurs during the JSON-P request
       * @param  {Object} error  The error message received.
       */
      function onError(error) {
        alert('Can\'t reach the remote server');
      }


      function addSummaryToPanel(route) {
        let duration = 0,
          distance = 0;

        route.sections.forEach((section) => {
          distance += section.travelSummary.length;
          duration += section.travelSummary.duration;
        });
        const addresses = first.address;
        var city = addresses.city;
        var plz = addresses.postalCode + '; ';
        var street = addresses.street + '; ';
        var housenr = addresses.houseNumber + '; ';
        address = street.concat(housenr, plz, city);
        var temp_array = [];
        temp_array.push(distance, duration, address);
        dist_array.push(temp_array);
        temp_array = [];
      }
    }

    var php_array2 = <?php echo json_encode($dist_array); ?>;
    var arrayLength2 = php_array2.length;

    function checkIfFinished() {
      return (dist_array.length >= arrayLength2);
    }


    var timeout = setInterval(function() {
      if (checkIfFinished()) {
        clearInterval(timeout);
        isFinished = true;
        postArray(dist_array);
      }
    }, 100);

  }

  function postArray(array_dist) {

    console.log(array_dist);

    //var data_arr = {array_dist: array_dist};
    //let data_arr = JSON.stringify(array_dist);


    $(document).ready(function() {

      /*array_string = JSON.stringify(dist_array);*/
      $.ajax({
        type: "POST",
        url: './index.php',
        cache: false,
        data: {
          array_dist: array_dist
        },
        beforeSend: function() {
          // Do something before sending request to server
        },
        error: function(jqXHR, textStatus, errorThrown) {

          alert(errorThrown);
        },
        success: function(data) {

          console.log('successfully sent!');
        }
      });

    });
  }


  createArray();
</script>