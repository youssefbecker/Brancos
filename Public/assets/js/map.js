(function () {
  "use strict";

  var myCenter = new google.maps.LatLng(13.54175, 2.06571);
  function initialize() {
    var mapProp = {
      center: myCenter,
      zoom: 16,
      scrollwheel: false,
    };

    var map = new google.maps.Map(document.getElementById("map"), mapProp);

    var marker = new google.maps.Marker({
      position: myCenter
    });

    var infowindow = new google.maps.InfoWindow({
      content: "cameroon"
    });

    marker.setMap(map);
  }

  google.maps.event.addDomListener(window, 'load', initialize);
})();