<!-- Google Map -->
<div id="map-canvas"></div>
<div id="legends" class="nicebox">
	<div class="color-key"><br></div>
	<div id="minmax" style="height:25px; text-align:center;"></div>
</div>

<div id="legend" style="display:none"><h4><b># of Crime</b></h4></div>
<!-- Google Markerclusterer -->
<script type="text/javascript">
	var script = '<script type="text/javascript" src="_/components/js/markerclusterer';
	script += '.js"><' + '/script>';
	document.write(script);
</script>

<script type="text/javascript">
	var map;
	var markers = [];
	var markerCluster;
	var sector;
	var price = null;
	var maxPrice;
	var minPrice;
	
	function updateHousingMap() {
		sector = document.getElementById("sectors").value;
		var display = document.forms[1].displayMLS;
		if (display.checked) {
			display.checked = "";
		}
		
		var owner = document.getElementById('owner').value;
		var hType = document.getElementById('hTypes').value;
		$.ajax({
			url : "_/components/php/housingquery.php",
			type : "POST",
			data : {
				'fname' : "getHousingAvgCost",
				'owner' : owner,
				'htype' : hType
			},
			success : function (response) {
				//console.log(response);
				response = JSON.parse(response);
				price = response;
				var cost = price.map(function(obj) { return obj.cost; });
				minPrice = Math.min.apply(null, cost);
				maxPrice = Math.max.apply(null, cost);
				document.getElementById('minmax').innerHTML = "min: $"+minPrice+"<span id='fakespan'></span>max: $"+maxPrice;
				document.getElementById('fakespan').style.margin=20;
			},
			error : function () {
				console.log(response);
			}
		});
		map.data.setStyle(styleFeature);
	}

	function onSectorUpdate()
	{
		sector = document.getElementById("sectors").value;
		onCrimeCheckboxUpdate();
                
        if (document.getElementsByName("displayMLS")[0].checked == false) {
        	updateHousingMap();
        }
	}

	// coloring map test stage..
	function styleFeature(feature) {
		
		var value = -1;
		if (sector != "All") {
			if (feature.getProperty('AREA_MUNI') == sector) {
				for (var i = 0; i < price.length; i++)
				{
					if (feature.getProperty('AREA_MUNI') == price[i].name)
					{
						value = (price[i].cost - minPrice) / (maxPrice - minPrice);
					}
				}
			}
			else {
				return {
					strokeWeight: 0.3,
					fillOpacity: 0.0
		  		};
			}
		}
		else
		{
			if (price)
			{
				for (var i = 0; i < price.length; i++)
				{
					if (feature.getProperty('AREA_MUNI') == price[i].name)
					{
						value = (price[i].cost - minPrice) / (maxPrice - minPrice);
					}
				}
			}
			else
			{
				return {
					strokeWeight: 0.3,
					fillOpacity: 0.0
		  		};
			}		
		}

		var hue = ((1-value)*120);
		var light = 50;
		if (hue > 100 || hue <= 20)
			light = 20;
		else if (hue > 80 || hue < 30)
			light = 30;
		else if (hue > 70 || hue < 40)
			light = 40;
		else if (hue > 50)
			light = 50;

		if (hue == 240)
		{
			return {
				strokeWeight: 0.3,
				fillOpacity: 0.3,
				fillColor: "grey"
			}
		}
		hue=hue.toString();
		light=light.toString();
		return {
			strokeWeight: 0.3,
			fillOpacity: 0.6,
			fillColor: "hsl("+hue+",100%,"+light+"%)"
  		};
	}
	
	function onDisplayCheckboxUpdate()
	{
		var display = document.forms[1].displayMLS;
		if (display.checked) {
			var featureStyle = {
		            fillOpacity: 0.0,
		            strokeWeight: 0.3
		            };
		    map.data.setStyle(featureStyle);
                    
			//Disable housing forum options
			document.getElementById("owner").disabled = true;
			document.getElementById("hTypes").disabled = true;
		}
		else
		{
			map.data.setStyle(styleFeature);
                        
            //Enable housing forum options
            document.getElementById("owner").disabled = false;
            document.getElementById("hTypes").disabled = false;
		}
	}
	var crimeTypes = [];
	
	function onCrimeAllCheckboxUpdate()
	{
		clearMarkers();
                var lastBox = document.forms[0].crime.length - 1;
		var crime = document.forms[0].crime;
	    if (!crime[lastBox].checked)
	    {
		    
	    	for (i = 0; i < crime.length; i++) {
	    		if (crime[i].checked) {
	    			crime[i].checked = false;
	    		}
	    	}
		    crimeTypes = [0];
	    }
	    else
	    {
		    for (i = 0; i < crime.length; i++) {
		        if (!crime[i].checked) {
			        crime[i].checked = true;
		        }
			}
			crimeTypes = [1,2,3,4,5,6,7,8];
	    }
	    updateCrimeMap(crimeTypes);
	}

	function checkCrimeCheckbox()
	{
            var lastBox = document.forms[0].crime.length - 1;
		var crime = document.forms[0].crime;
                
		for (i = 0; i < crime.length; i++) {
	    	if (!crime[i].checked)
	    	{
		    	crime[lastBox].checked = false;
	    	}
		}
	}
	function clearMarkers()
	{
		if (markerCluster) {
			markerCluster.clearMarkers();
			markers = [];
			
		}
		var le = document.getElementById('legend').style.display="none";
	}
	
	function onCrimeCheckboxUpdate()
	{
		checkCrimeCheckbox();
		clearMarkers();
                var lastBox = document.forms[0].crime.length - 1;
		var crime = document.forms[0].crime;
		var crimeTypes = [];
		markers = [];
		for (i = 0; i < crime.length-1; i++) {
                    if (crime[i].checked) {
                            crimeTypes.push(i+1);
                    }
                    //Uncheck "Display All" checkbox if one of the crime check box is unselected
                    else if (crime[i].checked == false) {
                        document.getElementsByName("crime")[lastBox].checked = false;
                    }
		}
		
		if (crimeTypes.length > 0) {
			updateCrimeMap(crimeTypes);
		}
	}
	
	function updateCrimeMap(crimeTypes)
	{
		var temp;
		sector = document.getElementById("sectors").value;
		if (sector != "All")
			temp = sector;
		else
			temp = null;
		
		$.ajax({
			url : "_/components/php/crimequery.php",
			type : "POST",
			data : {
				'crimetypes[]' : crimeTypes,
				'sector' : temp
			},
			success : function (response) {
				//console.log(response);
				response = JSON.parse(response);
				popCircle(response);
			},
			error : function () {
				console.log(response);
			}
		});
	}
	
	function popCircle(data)
	{
		
		/*if (markers.length == data.length)
		{
			markerCluster = new MarkerClusterer(map, markers, {
		          gridSize: 100
		        });
	        return;
		}*/
		clearMarkers();
		var imageUrl = 'http://chart.apis.google.com/chart?cht=mm&chs=24x32&chco=FFFFFF,008CFF,000000&ext=.png';
		var markerImage = new google.maps.MarkerImage(imageUrl, new google.maps.Size(24, 32));
		for (var i = 0; i < data.length; i++)
		{
			var point = new google.maps.LatLng(data[i].latitude, data[i].longitude);
			marker = new google.maps.Marker({
				position:point,
				icon: markerImage
				});
			markers.push(marker);
		}

		if (data.length > 0)
		{
			var le = document.getElementById('legend').style.display="inline";
			markerCluster = new MarkerClusterer(map, markers, {
		          gridSize: 100
		        });
		}
		else
		{
			var le = document.getElementById('legend').style.display="none";
		}
	}

	function initialize() 
	{
	    var mapOptions = {
	            center: { lat: 43.70, lng: -79.388752},
	            zoom: 11,
	    mapTypeControl: false
	    };
	
	    map = new google.maps.Map(document.getElementById('map-canvas'),
	    mapOptions);
	
	    map.data.loadGeoJson('_/components/data/map.geojson');
	    sector = "All";
	    map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(
	    		  document.getElementById('legends'));

	    var legend = document.getElementById('legend');
	    var iconBase = '_/img/';
        var icons = {
          m1: {
              name: '< 10 ',
              icon: iconBase + 'nm1.png'
          },
          m2: {
              name: '< 100',
              icon: iconBase + 'nm2.png'
          },
          m3: {
              name: '< 1k',
              icon: iconBase + 'nm3.png'
          },
          m4: {
              name: '< 10k',
              icon: iconBase + 'nm4.png'
          },
          m5: {
              name: '> 10k',
              icon: iconBase + 'nm5.png'
          }
        };
	    for (var key in icons) {
	          var type = icons[key];
	          var name = type.name;
	          var icon = type.icon;
	          var div = document.createElement('div');
	          div.innerHTML = '<img src="' + icon + '" width="35" height="34" > <span style="font-size:large;">' + name+'</span>';
	          legend.appendChild(div);
        }
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
        
	    var infowindow = new google.maps.InfoWindow();

	    
	    map.data.addListener('click', function(event) {
		    var mPrice = 0;
		    //console.log(price);
	    	for (var i = 0; i < price.length; i++)
			{
				if (event.feature.getProperty('AREA_MUNI') == price[i].name)
				{
					mPrice = price[i].cost;
				}
			}
            var info = event.feature.getProperty('AREA_NAME');
            infowindow.setContent("<div style='width:200px; text-align: center;'>"
	                            + event.feature.getProperty('AREA_NAME')+"<br />Price:"+mPrice+"<br />"+event.feature.getProperty('AREA_MUNI')+"</div>");
	        infowindow.setPosition(event.latLng);
	        infowindow.open(map);
	    });
	}
	
	google.maps.event.addDomListener(window, 'load', function () {
		initialize();
		updateCrimeMap([0]);
		getSectorDropdownList();
		getHousingTypesDropdownList();
		
		setTimeout(function () {
			updateHousingMap();
		}, 1000);
		map.data.setStyle(styleFeature);
	});
</script>
