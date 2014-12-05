function initialize() {
	//var data = <?php echo json_encode($test); ?>;
    var mapOptions = {
            center: { lat: 43.70, lng: -79.388752},
            zoom: 12,
    //mapTypeId: google.maps.MapTypeId.TERRAIN,
    mapTypeControl: false
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);

    //map.data.loadGeoJson('data/police_division_wgs84.geojson');
    map.data.loadGeoJson('_/components/data/map.geojson');
    var featureStyle = {
            fillColor: 'green',
            strokeWeight: 0.5
            }
    map.data.setStyle(featureStyle);
    var infowindow = new google.maps.InfoWindow();

    map.data.addListener('mouseover', function(event) {
            document.getElementById('info-box').textContent =
            event.feature.getProperty('AREA_NAME');
    });
    
    map.data.addListener('click', function(event) {
            var info = event.feature.getProperty('AREA_NAME');
            infowindow.setContent("<div style='width:200px; text-align: center;'>"
                            + event.feature.getProperty('AREA_NAME')+"<br />"+event.feature.getProperty('AREA_MUNI')+"</div>");
        infowindow.setPosition(event.latLng);
        //infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
            infowindow.open(map);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

