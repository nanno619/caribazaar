@extends('layouts.dashboard-volt')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<style>
    #map {
        height: 800px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Markers</div>
                <div class="card-body">
                    <div id="map"></div>
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
    console.log(L);
    // Initializes map
    const map = L.map('map');

    // Sets initial coordinates and zoom level
    map.setView([4.490726480711626, 108.08986853876691], 6);

    // Create tileLayer and get the tileLayer from openstreetmap server to a specified zoom level and longitude and latitude
    // Second argument specify maximum level of zoom and attribution on the tileLayer
    // Use addTo() to add it to the current map that we just initialized
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Request current position of user using geolocation API
    navigator.geolocation.watchPosition(success, error);

    let marker, circle, zoomed;

    // When coordinate of current user is retrieved, the success function is going to fire
    function success(pos)
    {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        const accuracy = pos.coords.accuracy;

        // Removes any existing marker and circule (new ones about to be set)
        if(marker){
            map.removeLayer(marker);
            map.removeLayer(circle);
        }

        // Adds marker to the map and a circle for accuracy
        marker = L.marker([lat, lng]).addTo(map);
        circle = L.circle([lat, lng], { radius:accuracy }).addTo(map);

        // Set zoom to boundaries of accuracy circle
        if(!zoomed){
            // Set current bounds of the map
            zoomed = map.fitBounds(circle.getBounds());
        }

        // Set map focus to current user position
        map.setView([lat.lng]);

    }

    // Handle error
    function error(err)
    {
        if(err.code === 1){
            alert("Please allow your location access");
        }else{
            alert("Cannot get current location.")
        }
    }

    L.marker([2.9645199567418143, 101.72121063684324],{
        title: 'Starbuck Conezion'
    })
    .bindPopup('<h4>Starbuck Conezion</h4>')
    .addTo(map);
</script>
@endpush