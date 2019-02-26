<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>MapEdit Example</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.9/leaflet.draw.css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		html,body {
			height: 100%;
			margin:0;
			padding:0;
			font-family: 'Roboto', sans-serif;
		}

		#map {
			height: 100%;
			width: 100%;
		}
		
		.maincontainer {
			width: 100%;
			height: 100%;
			transition: margin-left 1s;
			transition: margin-right 1s;
		}
		
		/*.leaflet-control-attribution {
			display: none;
			visibility: hidden;
		}*/
		
		.divTable {
			display: table;
		}
		
		.divTr {
			display: table-row;
		}
		
		.divTd {
			display: table-cell;
		}
		
		#leftsidebar {
			position: fixed;
			top: 0px;
			left: 0px;
			height: 100%;
			color: white;
			background: rgba(0, 0, 0, 0.3);
			z-index: 1020;
			-webkit-box-shadow: 1px 0px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 1px 0px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 1px 0px 5px 0px rgba(0,0,0,0.75);
		}
		
		#rightsidebar {
			position: fixed;
			top: 0px;
			right: 0px;
			height: 100%;
			color: white;
			background: rgba(0, 0, 0, 0.3);
			z-index: 1000;
			-webkit-box-shadow: -1px 0px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: -1px 0px 5px 0px rgba(0,0,0,0.75);
			box-shadow: -1px 0px 5px 0px rgba(0,0,0,0.75);
		}
		
		.sbcollapsed {
			/*display: none;*/
			width: 0px;
			padding: 0px;
			-webkit-transition: width 0.5s ease-out;
			-moz-transition: width 0.5s ease-out;
			-o-transition: width 0.5s ease-out;
			transition: width 0.5s ease-out;
		}
		
		.sbexpanded {
			/*display: visible;*/
			width: 300px;
			padding: 8px;
			-webkit-transition: width 0.5s ease-out;
			-moz-transition: width 0.5s ease-out;
			-o-transition: width 0.5s ease-out;
			transition: width 0.5s ease-out;
		}
		
		.sbbtn {
			width: 100%;
			margin-bottom: 3px;
		}
		
		.sbicon {
			font-size: 12px;
		}
		
		.sbicon img {
			margin-bottom: 5px;
			width: 42px;
			height: 42px;
		}
		
		#togglelsidebar {
			display: block;
			position: absolute;
			top: 50%;
			left: 0px;
			width: 20px;
			height: 40px;
			z-index: 1001;
			font-weight: bold;
			color: white;
			background: rgba(0, 0, 0, 0.3);
			text-align: center;
			line-height: 40px;
			vertical-align: middle;
			-webkit-border-top-right-radius: 4px;
			-webkit-border-bottom-right-radius: 4px;
			-moz-border-radius-topright: 4px;
			-moz-border-radius-bottomright: 4px;
			border-top-right-radius: 4px;
			border-bottom-right-radius: 4px;
			-webkit-box-shadow: 1px 0px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 1px 0px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 1px 0px 5px 0px rgba(0,0,0,0.75);
			-webkit-transition: left 0.5s ease-out;
			-moz-transition: left 0.5s ease-out;
			-o-transition: left 0.5s ease-out;
			transition: left 0.5s ease-out;
		}
		
		#togglelsidebar:hover {
				background: rgba(0, 0, 0, 1.0);
		}
		
		#togglersidebar {
			display: block;
			position: absolute;
			top: 50%;
			right: 0px;
			width: 20px;
			height: 40px;
			z-index: 1001;
			font-weight: bold;
			color: white;
			background: rgba(0, 0, 0, 0.3);
			text-align: center;
			line-height: 40px;
			vertical-align: middle;
			-webkit-border-top-left-radius: 4px;
			-webkit-border-bottom-left-radius: 4px;
			-moz-border-radius-topleft: 4px;
			-moz-border-radius-bottomleft: 4px;
			border-top-left-radius: 4px;
			border-bottom-left-radius: 4px;
			-webkit-box-shadow: -1px 0px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: -1px 0px 5px 0px rgba(0,0,0,0.75);
			box-shadow: -1px 0px 5px 0px rgba(0,0,0,0.75);
			-webkit-transition: right 0.5s ease-out;
			-moz-transition: right 0.5s ease-out;
			-o-transition: right 0.5s ease-out;
			transition: right 0.5s ease-out;
		}
		
		#togglersidebar:hover {
				background: rgba(0, 0, 0, 1.0);
		}
		
		#latlng {
			position: absolute;
			left: 0px;
			bottom: 0px;
			font-size: 12px;
			font-weight: bold;
			font-weight: bold;
			padding-top: 2px;
			padding-bottom: 1px;
			padding-left: 3px;
			padding-right: 7px;
			background-color: white;
			-webkit-border-top-right-radius: 5px;
			-moz-border-radius-topright: 5px;
			border-top-right-radius: 5px;
			-webkit-box-shadow: 2px -2px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 2px -2px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 2px -2px 5px 0px rgba(0,0,0,0.75);
			z-index: 1000;
			display: none;
		}
		
		.leaflet-draw{
			display: none;
		}

		.leaflet-draw-toolbar{
			display: none;
		}
		
		.leaflet-control-layers {
			border-radius: none;
			box-shadow: none;
		}
		
		.leaflet-control-layers-expanded {
			padding: 0px;
			background: transparent;
			color: white;
		}
		
		#layercontrol {
			display: inline-block;
			width: 100%;
			padding: 10px;
			background-color: #343a40;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
		}
		
		#layercontrol legend {
			font-size: 16px;
			font-weight: bold;
		}
		
	</style>
</head>
<body>
	<div id='leftsidebar' class='sbcollapsed'></div>
	<div id='togglelsidebar'>&gt;</div>
	<div class='maincontainer'>
		<div id="map"></div>
	</div>
	<div id='togglersidebar'>&lt;</div>
	<div id='rightsidebar' class='sbcollapsed'>
		<span id="rsb-tools">
		<!--<a href='' class="btn btn-primary sbbtn" id="createlayer" title='Create Layer'>Create Layer</a>-->
		<a href='' class="btn btn-dark sbicon" data-toggle="modal" data-target="#OpenJSONModal" id="importgeojson" title='Import GeoJSON'><img src='images/importjson.png'><br>Import</a>
		<a href='' class="btn btn-dark sbicon" id="exportgeojson" title='Export GeoJSON'><img src='images/exportjson.png'><br>Export</a>
		<a href='' class="btn btn-dark sbicon" id="cleargeojson" title='Clear GeoJSON'><img src='images/clearjson.png'><br>Clear</a>
		<a href='' class="btn btn-dark sbicon" id="toggledraw" title='Toggle Draw'><img src='images/edit.png'><br>Edit</a>
		</span><hr>
		<span id="layercontrol">
		<fieldset><legend>Layers</legend></fieldset>
		</span>
	</div>
	<div id="latlng"></div>
	
	<!-- Modal -->
	<div class="modal fade" id="OpenJSONModal" tabindex="-1" role="dialog" aria-labelledby="OpenJSONModalTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="OpenJSONModalTitle">Open GeoJSON Data</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form id="geoJSONUploadForm" method="post" action="" enctype="multipart/form-data">
				<label>File Input: <input type="file" name="file" id="demo1" /></label>
				<div id="uploads">

				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.9/leaflet.draw.js'></script>
	<script src="js/leaflet.ajax.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/jquery.ajaxfileupload.js"></script>
	<script>
		$(document).ready(function() {
			$.ajaxSetup({ cache: false });
		});
	
		//Init BaseMap Layers
		var basemaps = { 
			'Street': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
			{
				minZoom:2,
				maxZoom:19,
				id:'osm.streets'
			}), 
			'Satellite': L.tileLayer('http://maps.six.nsw.gov.au/arcgis/rest/services/public/NSW_Imagery/MapServer/tile/{z}/{y}/{x}',
			{
				minZoom:2,
				maxZoom:20,
				id:'six.satellite'
			})
		};
	
		//Map Options
		var mapOptions = {
            zoomControl: false,
			attributionControl: false,
			center: [-29.0529434318608,152.01910972595218],
			zoom: 2,
			layers: [basemaps.Street]
         }
	
		//Render Main Map
		var map = L.map('map', mapOptions);
		
		//Render Zoom Control
		L.control.zoom({position:'topleft'}).addTo(map);
		
		var editableLayers = new L.FeatureGroup();
		map.addLayer(editableLayers);
		
		//Fetch Layer Config
		//var jsonLayer = new L.geoJson().addTo(map);
		var layerControl = L.control.layers(basemaps, {}, {position:'topright',collapsed:false}).addTo(map);
		var oldLayerControl = layerControl.getContainer();
		var newLayerControl = document.getElementById('layercontrol')
		newLayerControl.appendChild(oldLayerControl);
		
		var mapBounds=map.getBounds();
		var bounds= new L.latLngBounds();
		var layerGroup = L.layerGroup();
		var layerConfig = [];
		
		//Map GeoJSON Feature Handler
		function addDataToMap(data, map, layername, layervisible) {
			//console.log(layername);
			var dataLayer = L.geoJson(data,{
				style: function(feature) {
					return {
						fillColor: feature.properties['fill'],
						fillOpacity: feature.properties['fill-opacity'],
						color: feature.properties['stroke'],
						width: feature.properties['stroke-width'],
						opacity: feature.properties['opacity']
					}
				},
				onEachFeature: function(feature, layer) {
					if(typeof feature.properties.description != "undefined")
					{
						layer.bindPopup(feature.properties.description,layer);
					}
					if(typeof feature.properties.name != "undefined")
					{
						layer.bindTooltip(feature.properties.name);
					}
				}
			});
			if(layervisible!="false")
			{
				bounds.extend(dataLayer.getBounds());
				map.fitBounds(bounds);
				//map.setMaxBounds(bounds);
				layerGroup.addLayer(dataLayer);
				layerGroup.addTo(map);
			}
			layerControl.addOverlay(dataLayer, layername);
		}
		
		function refreshMap()
		{
			layerGroup.clearLayers();
			$.getJSON("layers.json", function(data) {})
			.done(function( data ) {
				$.each( data.layers, function( i, layer ) {
					if(layer.enabled!="false")
					{
						$.getJSON(layer.geojson, function(data) { addDataToMap(data, map, layer.name, layer.visible); });
					}
				});
			});
		}
		
		var options = {
		  position: 'topleft',
		  draw: {
			polyline: true,
			polygon: {
			  allowIntersection: false, // Restricts shapes to simple polygons 
			  drawError: {
				color: '#e1e100', // Color the shape will turn when intersects 
				message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect 
			  }
			},
			circle: true, // Turns off this drawing tool 
			rectangle: true,
			marker: true
		  },
		  edit: {
			featureGroup: editableLayers, //REQUIRED!! 
			remove: true
		  }
		};

		var drawControl = new L.Control.Draw(options);
		map.addControl(drawControl);
		
		//Handle Map click to Display Lat/Lng
		map.on('click', function(e) {
			$("#latlng").html("Lat/Lon: " + e.latlng.lat + ", " + e.latlng.lng);
			$("#latlng").show();
		});
		
		//Map Move/Zoom End Handler
		map.on('moveend zoomend', function() {
			mapBounds=map.getBounds();
			//console.log(mapBounds);
		});
		
		map.on(L.Draw.Event.CREATED, function(e) {
		  var type = e.layerType, layer = e.layer;

		  if (type === 'marker') {
			layer.bindPopup('LatLng: ' + layer.getLatLng().lat+','+layer.getLatLng().lng).openPopup();
		  }

		  editableLayers.addLayer(layer);
		  $('.drawercontainer .drawercontent').html(JSON.stringify(editableLayers.toGeoJSON()));
		});
		
		map.on(L.Draw.Event.EDITSTOP, function(e) {
			$('.drawercontainer .drawercontent').html(JSON.stringify(editableLayers.toGeoJSON()));
		});
		
		map.on(L.Draw.Event.DELETED, function(e) {
			$('.drawercontainer .drawercontent').html('');
		});
		
		var lsidebarmode="collapsed";
		var rsidebarmode="collapsed";
		
		//Left Sidebar Toggle Handler
		$("#togglelsidebar").click(function() {
			if(lsidebarmode=="collapsed")
			{
				$("#leftsidebar").removeClass("sbcollapsed");
				$("#leftsidebar").addClass("sbexpanded");
				$("#togglelsidebar").css("left","300px");
				$("#togglelsidebar").html("&lt;");
				lsidebarmode="expanded";
			}
			else if(lsidebarmode=="expanded")
			{
				$("#leftsidebar").removeClass("sbexpanded");
				$("#leftsidebar").addClass("sbcollapsed");
				$("#togglelsidebar").css("left","0px");
				$("#togglelsidebar").html("&gt;");
				lsidebarmode="collapsed";
			}
		});
		
		//Right Sidebar Toggle Handler
		$("#togglersidebar").click(function() {
			if(rsidebarmode=="collapsed")
			{
				$("#rightsidebar").removeClass("sbcollapsed");
				$("#rightsidebar").addClass("sbexpanded");
				$("#togglersidebar").css("right","300px");
				$("#togglersidebar").html("&gt;");
				rsidebarmode="expanded";
			}
			else if(rsidebarmode=="expanded")
			{
				$("#rightsidebar").removeClass("sbexpanded");
				$("#rightsidebar").addClass("sbcollapsed");
				$("#togglersidebar").css("right","0px");
				$("#togglersidebar").html("&lt;");
				rsidebarmode="collapsed";
			}
		});
		
		$(window).on('hidden.bs.modal', function() { 
			$('#importgeojson').blur();
		});
		
		//Export JSON Button Clicked
		$('#exportgeojson').click(function(e) {
			this.blur();
			if(editableLayers.getLayers().length>0)
			{
				// Extract GeoJson from featureGroup
				var data = editableLayers.toGeoJSON();

				// Stringify the GeoJson
				var convertedData = 'text/json;charset=utf-8,' + encodeURIComponent(JSON.stringify(data));
				
				// Create export
				$('#exportgeojson').attr('href', 'data:' + convertedData);
				$('#exportgeojson').attr('download','data.geojson');
			}
			else
			{
				alert("No Objects to Export!");
				return false;
			}
        });
		
		//Clear Layers Button Clicked
		$('#cleargeojson').click(function(e) {
			this.blur();
			$("#latlng").html("");
			$("#latlng").hide();
			if(editableLayers.getLayers().length>0)
			{
				editableLayers.clearLayers();
			}
			else
			{
				alert("No Objects to Clear!");
				return false;
			}
        });
		
		//Edit Button Clicked
		$('#toggledraw').click(function(e) {
			$(".leaflet-draw").toggle();
			$(".leaflet-draw-toolbar").toggle();
			this.blur();
			return false;
        });
		
		//TODO: Create New Layer Button
		$('#createlayer').click(function(e) {
			return false;
        });
		
		//Handle Copy Lat/Lng to clipboard
		$('#latlng').click(function(e) {
			var $tempElement = $("<input>");
			$("body").append($tempElement);
			$tempElement.val($("#latlng").text()).select();
			document.execCommand("Copy");
			$tempElement.remove();
			alert("Copied: "+$("#latlng").text());
			$("#latlng").hide();
        });
		
		function zoomTo() {
			var lat = $("#lat").val();
			var lng = $("#lng").val();
			if(lat != "" && lng != "")
			{
				L.marker(new L.LatLng(lat, lng)).addTo(editableLayers);
				map.flyTo(new L.LatLng(lat, lng),18);
				$('.drawercontainer .drawercontent').html(JSON.stringify(editableLayers.toGeoJSON()));
			}
		}
		
		//JSON Upload Import Handler
		$(document).ready(function() {
			var interval;
			function applyAjaxFileUpload(element) {
				$(element).AjaxFileUpload({
					action: "upload.php",
					onChange: function(filename) {
						// Create a span element to notify the user of an upload in progress
						var $span = $("<span />")
							.attr("class", $(this).attr("id"))
							.text("Uploading")
							.insertAfter($(this));
						$(this).remove();
						interval = window.setInterval(function() {
							var text = $span.text();
							if (text.length < 13) {
								$span.text(text + ".");
							} else {
								$span.text("Uploading");
							}
						}, 200);
					},
					onSubmit: function(filename) {
						// Return false here to cancel the upload
						/*var $fileInput = $("<input />")
							.attr({
								type: "file",
								name: $(this).attr("name"),
								id: $(this).attr("id")
							});
						$("span." + $(this).attr("id")).replaceWith($fileInput);
						applyAjaxFileUpload($fileInput);
						return false;*/
						// Return key-value pair to be sent along with the file
						return true;
					},
					onComplete: function(filename, response) {
						window.clearInterval(interval);
						var $span = $("span." + $(this).attr("id")).text(filename + " "),
							$fileInput = $("<input />")
								.attr({
									type: "file",
									name: $(this).attr("name"),
									id: $(this).attr("id")
								});
						if (typeof(response.error) === "string") {
							$span.replaceWith($fileInput);
							applyAjaxFileUpload($fileInput);
							alert(response.error);
							return;
						}
						$span.replaceWith($fileInput);
						applyAjaxFileUpload($fileInput);
						 $('#OpenJSONModal').modal('toggle');
						 var geojsonLayer = new L.GeoJSON.AJAX("layers/"+filename);       
						 geojsonLayer.addTo(map);
						/*$("<a />")
							.attr("href", "#")
							.text("x")
							.bind("click", function(e) {
								$span.replaceWith($fileInput);
								applyAjaxFileUpload($fileInput);
							})
							.appendTo($span);*/
					}
				});
			}
			applyAjaxFileUpload("#demo1");
			refreshMap();
		});
		
		$(document).on('change', '.leaflet-control-layers-selector', function() {
			// Create new empty bounds
			var bounds = new L.LatLngBounds();
			// Iterate the map's layers
			map.eachLayer(function (layer) {
				// Check if layer is a featuregroup
				if (layer instanceof L.FeatureGroup) {
					// Extend bounds with group's bounds
					bounds.extend(layer.getBounds());
				}
			});
			// Check if bounds are valid (could be empty)
			if (bounds.isValid()) {
				// Valid, fit bounds
				map.fitBounds(bounds);
			} else {
				// Invalid, fit world
				//map.fitWorld();
			}
		});
	</script>
	</script>
</body>
</html>