<script>
  var sellerHausnummer = localStorage.getItem('sellerHausnummer');
  var sellerStreet = localStorage.getItem('sellerStreet');
  var sellerCity = localStorage.getItem('sellerCity');
  var sellerPLZ = localStorage.getItem('sellerPLZ');
  var sellerCountry_de = '<?php echo ($_SESSION['verkäuferLand']); ?>';
  var countryNameSeller = localStorage.getItem('countryNameSeller');



  function geocode(platform) {
    var geocoder = platform.getSearchService(),
      geocodingParameters = {
        qq: 'houseNumber=' + sellerHausnummer + ';street=' + sellerStreet + ';city=' + sellerCity + ';postalCode=' + sellerPLZ + ';country=' + countryNameSeller + ''
      };

    geocoder.geocode(
      geocodingParameters,
      onSuccess,
      onError
    );
  }
  /**
   * This function will be called once the Geocoder REST API provides a response
   * @param  {Object} result          A JSONP object representing the  location(s) found.
   *
   * see: http://developer.here.com/rest-apis/documentation/geocoder/topics/resource-type-response-geocode.html
   */
  function onSuccess(result) {
    var locations = result.items;
    /*
     * The styling of the geocoding response on the map is entirely under the developer's control.
     * A representitive styling can be found the full JS + HTML code of this example
     * in the functions below:
     */
    addLocationsToMap(locations);
    addLocationsToPanel(locations);
    // ... etc.
  }

  /**
   * This function will be called if a communication error occurs during the JSON-P request
   * @param  {Object} error  The error message received.
   */
  function onError(error) {
    alert('Can\'t reach the remote server');
  }

  /**
   * Boilerplate map initialization code starts below:
   */

  //Step 1: initialize communication with the platform
  // In your own code, replace variable window.apikey with your own apikey
  var platform = new H.service.Platform({
    apikey: 'Lo513DlcJj8AWDBTQUXh4_6MtLoJDh_XzW1v6yAUQCQ'
  });
  var defaultLayers = platform.createDefaultLayers();

  //Step 2: initialize a map - this map is centered over California
  var map = new H.Map(document.getElementById('map'),
    defaultLayers.vector.normal.map, {
      center: {
        lat: 37.376,
        lng: -122.034
      },
      zoom: 30,
      pixelRatio: window.devicePixelRatio || 1
    });
  // add a resize listener to make sure that the map occupies the whole container
  window.addEventListener('resize', () => map.getViewPort().resize());

  var locationsContainer = document.getElementById('panel');

  //Step 3: make the map interactive
  // MapEvents enables the event system
  // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
  var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

  // Create the default UI components
  var ui = H.ui.UI.createDefault(map, defaultLayers);

  // Hold a reference to any infobubble opened
  var bubble;

  /**
   * Opens/Closes a infobubble
   * @param  {H.geo.Point} position     The location on the map.
   * @param  {String} text              The contents of the infobubble.
   */
  function openBubble(position, text) {
    if (!bubble) {
      bubble = new H.ui.InfoBubble(
        position, {
          content: text
        });
      ui.addBubble(bubble);
    } else {
      bubble.setPosition(position);
      bubble.setContent(text);
      bubble.open();
    }
  }

  /**
   * Creates a series of list items for each location found, and adds it to the panel.
   * @param {Object[]} locations An array of locations as received from the
   *                             H.service.GeocodingService
   */
  function addLocationsToPanel(locations) {

    var nodeOL = document.createElement('ul'),
      i;

    nodeOL.style.fontSize = 'large';
    nodeOL.style.marginLeft = '7.5%';
    nodeOL.style.marginRight = '5%';
    nodeOL.style.marginTop = '30px';
    nodeOL.style.lineHeight = '1.5';
    nodeOL.style.color = 'white';



    for (i = 0; i < locations.length; i += 1) {
      let location = locations[i],
        li = document.createElement('li'),
        divLabel = document.createElement('div'),
        address = location.address,
        content = '<strong style="font-size: x-large;">' + address.label + '</strong></br>';
      position = location.position;

      content += '<strong>Straße:</strong> ' + address.street + '<br/>';
      content += '<strong>Hausnummer:</strong> ' + address.houseNumber + '<br/>';
      content += '<strong>Postleitzahl:</strong> ' + address.postalCode + '<br/>';
      content += '<strong>Ort:</strong> ' + address.city + '<br/>';
      content += '<strong>Landkreis:</strong> ' + address.county + '<br/>';
      content += '<strong>Land:</strong> ' + address.countryName + '<br/>';
      content += '<strong>Position:</strong> ' +
        Math.abs(position.lat.toFixed(4)) + ((position.lat > 0) ? 'N' : 'S') +
        ' ' + Math.abs(position.lng.toFixed(4)) + ((position.lng > 0) ? 'E' : 'W') + '<br/>';

      divLabel.innerHTML = content;
      li.appendChild(divLabel);

      nodeOL.appendChild(li);
    }

    locationsContainer.appendChild(nodeOL);

    /*  window.sellerlat = (Math.abs(position.lat));
      window.sellerlon = (Math.abs(position.lng));
      localStorage.setItem("sellerlat",window.sellerlat);
      localStorage.setItem("sellerlon",window.sellerlon);

    */

  }


  /**
   * Creates a series of H.map.Markers for each location found, and adds it to the map.
   * @param {Object[]} locations An array of locations as received from the
   *                             H.service.GeocodingService
   */
  function addLocationsToMap(locations) {
    var group = new H.map.Group(),
      position,
      i;

    // Add a marker for each location found
    for (i = 0; i < locations.length; i += 1) {
      let location = locations[i];
      marker = new H.map.Marker(location.position);
      marker.label = location.address.label;
      group.addObject(marker);
    }

    group.addEventListener('tap', function(evt) {
      map.setCenter(evt.target.getGeometry());
      openBubble(
        evt.target.getGeometry(), evt.target.label);
    }, false);

    // Add the locations group to the map
    map.addObject(group);
    map.getViewModel().setLookAtData({
      bounds: group.getBoundingBox()
    });
  }


  // Now use the map as required...
  geocode(platform);
</script>