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
                <div class="card-header">Simple map</div>
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
    const map = L.map('map').setView([4.490726480711626, 108.08986853876691], 6);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    // maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

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

    var marker2 = L.marker([2.9645329662050464, 101.72141906718817], {
    icon: iconMarker,
    // draggable:true
    })
    .bindPopup('Starbuck Conezion')
    .addTo(map);
</script>
@endpush