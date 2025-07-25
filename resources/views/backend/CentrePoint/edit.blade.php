@extends('layouts.dashboard-volt')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<style>
    #map {
        height: 400px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Leaflet Get Coordinate</div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Coordinate Point</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Coordinate</label>
                        <input type="text" class="form-control" name="coordinate" id="coordinate">
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude">
                    </div>
                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
</script>

<script>
    // Initialize map with center coordinates for Malaysia/Borneo region

    // Define OpenStreetMap tile layer
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    // Define Esri World Imagery (satellite) tile layer
    var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP,UPR-EGP, and the GIS User Community'
    });

    // Define Esri World Street Map tile layer
    var Esri_WorldStreetMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
    });

    // Create map instance with default view centered on Malaysia/Borneo
    var map = L.map('map', {
        center: [4.490726480711626, 108.08986853876691],
        zoom: 5,
        layers: [osm] // Set OpenStreetMap as default layer
    });

    // Create a draggable marker at the map center
    var marker = L.marker([4.490726480711626, 108.08986853876691], {
        draggable:true
    }).addTo(map);

    // Define base map options for layer control
    var baseMaps = {
        'Open Street Map': osm,
        'Esri World': Esri_WorldStreetMap,
        'Esri World Imagery': Esri_WorldImagery,
    }

    // Add layer control to switch between different map types
    L.control.layers(baseMaps).addTo(map);

    // Method 1: Handle map click events to get coordinates
    function onMapClick(e){
        // Get form input elements
        var coords = document.querySelector("[name=coordinate]");
        var latitude = document.querySelector("[name=latitude]");
        var longitude = document.querySelector("[name=longitude]");

        // Extract latitude and longitude from click event
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Create new marker or move existing marker to clicked location
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        }else{
            marker.setLatLng(e.latlng)
        }

        // Update form inputs with new coordinates
        coords.value = lat + "," + lng;
        latitude.value = lat;
        longitude.value = lng;
    }

    // Attach click event listener to map
    map.on('click', onMapClick)

    // Method 2: Handle marker drag events to get coordinates
    marker.on('dragend', function(){
        // Get new marker position after drag
        var coordinate = marker.getLatLng();

        // Update marker position (redundant but maintains draggable property)
        marker.setLatLng(coordinate, {
            draggable:true
        })

        // Update form inputs using jQuery and trigger keyup events
        $('#coordinate').val(coordinate.lat + "," + coordinate.lng).keyup()
        $('#latitude').val(coordinate.lat).keyup()
        $('#longitude').val(coordinate.lng).keyup()
    })

    // Method 3: (placeholder for additional coordinate capture method)
</script>
@endpush
