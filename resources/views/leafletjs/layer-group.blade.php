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
                <div class="card-header">Leaflet Layer Group</div>
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

    const office = L.layerGroup();
    const places = L.layerGroup();

    var map = L.map('map', {
        center: [-0.49483971374300323, 117.1440951762494],
        zoom: 12,
        layers: [osm,office,places]
    })
    var marker1 = L.marker([-0.4964704364739748, 117.14209960938753]).bindPopup('Marker ke -1').addTo(office)
    var marker2 = L.marker([-0.4969156664339598, 117.14289354321888]).bindPopup('Marker ke -2').addTo(office)
    var marker3 = L.marker([-0.49577308825214617, 117.14483546250067]).bindPopup('Marker ke -3').addTo(office)
    var marker4 = L.marker([-0.4915782690879287, 117.14566158288034]).bindPopup('Marker ke -4').addTo(places)

    const baseLayers = {
        'Openstreetmap': osm,
        'EsriWorldImagery': Esri_WorldImagery,
        'EsriWorldstreetmap': Esri_WorldStreetMap,
    }

    const overLayers = {
        'Office': office,
        'Places': places,
    }

    const layerControl = L.control.layers(baseLayers,overLayers).addTo(map);

</script>
@endpush
