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
                <div class="card-header">Polyline</div>
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
    const map = L.map('map').setView([2.178026489077097, 102.25541266546345], 11);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var latlng = [
        [2.1961322288089016, 102.24859109701414],
        [2.1929588225886336, 102.23614564740967],
        [2.189952674417427, 102.24659882757508],
        [2.194577732331453, 102.25427230305785],
        [2.1961322288089016, 102.24859109701414],
    ];

    const polyline = L.polyline(latlng).bindPopup('Contoh Polyline').addTo(map);
    map.fitBounds(polyline.getBounds());

</script>
@endpush