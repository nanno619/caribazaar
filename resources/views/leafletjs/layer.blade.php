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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Leaflet Layer Control</div>
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
    // const map = L.map('map').setView([4.490726480711626, 108.08986853876691], 6);

    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP,UPR-EGP, and the GIS User Community'
    });

    var Esri_WorldStreetMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
    });

    var map = L.map('map', {
        center: [4.490726480711626, 108.08986853876691],
        zoom: 5,
        layers: [osm]
    });

    var iconMarker = L.icon({
        iconUrl: '{{ asset('iconMarkers/marker.png') }}',
        iconSize: [32, 32], // size of the icon
    });

    var marker = L.marker([4.490726480711626, 108.08986853876691], {
        icon: iconMarker,
        draggable:true
    })
    .bindPopup('Tampilan pesan disini')
    .addTo(map);

    var baseMaps = {
        'Open Street Map': osm,
        'Esri World': Esri_WorldStreetMap,
        'Esri World Imagery': Esri_WorldImagery,
    }

    var overlayers = {
        'Marker': marker
    }

    L.control.layers(baseMaps,overlayers).addTo(map);
</script>
@endpush