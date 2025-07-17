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
                <div class="card-header">Leaflet GeoJson</div>
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
    // WHAT IT DOES: Creates a tile layer that downloads and displays OpenStreetMap tiles
    // HOW IT WORKS: Requests map tiles from OpenStreetMap servers using the URL template pattern
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19, // Maximum zoom level allowed
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' // Copyright text
    });

    // WHAT IT DOES: Creates a satellite imagery tile layer from Esri's servers
    // HOW IT WORKS: Downloads satellite images instead of street map tiles
    var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP,UPR-EGP, and the GIS User Community'
    });

    // WHAT IT DOES: Creates a detailed street map tile layer from Esri's servers
    // HOW IT WORKS: Downloads enhanced street map tiles with more detail than OSM
    var Esri_WorldStreetMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
    });

    // Get this data from geojson.io
    // WHAT IT DOES: Stores hospital location and building data in GeoJSON format
    // HOW IT WORKS: Defines geographic features with coordinates and properties
    const hospital = {
        "type": "FeatureCollection", // Container for multiple geographic features
        "features": [{
                "type": "Feature", // Individual geographic feature
                "properties": {
                    "popupContent": "RSUD Korpri" // Text to show when clicked
                },
                "geometry": {
                    "type": "Point", // Single point location on the map
                    "coordinates": [
                        117.150415, // Longitude (East-West position)
                        -0.492775   // Latitude (North-South position)
                    ]
                }
            },
            {
                "type": "Feature",
                "properties": {
                    "popupContent": "RSUD Korpri"
                },
                "geometry": {
                    "type": "Polygon", // Closed shape defining an area
                    "coordinates": [
                        [ // Array of coordinate pairs forming the polygon boundary
                            [
                                117.14864,  // Each array is [longitude, latitude]
                                -0.494338
                            ],
                            [
                                117.149238,
                                -0.494658
                            ],
                            [
                                117.149109,
                                -0.494797
                            ],
                            [
                                117.149037,
                                -0.494934
                            ],
                            [
                                117.148892,
                                -0.495223
                            ],
                            [
                                117.148326,
                                -0.494886
                            ],
                            [
                                117.148457,
                                -0.494666
                            ],
                            [
                                117.14864,  // Last point must match first to close polygon
                                -0.494338
                            ]
                        ]
                    ]
                }
            },
            {
                "type": "Feature",
                "properties": {
                    "name": "" // Empty property
                },
                "geometry": {
                    "type": "Point", // Another point marker
                    "coordinates": [
                        117.147151,
                        -0.495932
                    ]
                }
            }
        ]
    }

    // WHAT IT DOES: Stores campus location data with different geometry types
    // HOW IT WORKS: Contains a rectangular area and a line path
    const campus = {
        "type": "FeatureCollection",
        "features": [{
                "type": "Feature",
                "properties": {
                    "popupContent": "Unmul"
                },
                "geometry": {
                    "type": "Polygon", // Rectangular campus boundary
                    "coordinates": [
                        [
                            [
                                117.153944, // Bottom-left corner
                                -0.470454
                            ],
                            [
                                117.153944, // Top-left corner
                                -0.468158
                            ],
                            [
                                117.156733, // Top-right corner
                                -0.468158
                            ],
                            [
                                117.156733, // Bottom-right corner
                                -0.470454
                            ],
                            [
                                117.153944, // Close the rectangle
                                -0.470454
                            ]
                        ]
                    ]
                }
            },
            {
                "type": "Feature",
                "properties": {
                    "popupContent": "STMIK WIDYA CIPTA DHARMA"
                },
                "geometry": {
                    "type": "LineString", // Connected line segments forming a path
                    "coordinates": [
                        [ // Each point connects to the next with a line
                            117.149043, // Starting point
                            -0.463352
                        ],
                        [
                            117.149485, // Second point - line drawn from previous
                            -0.46336
                        ],
                        [
                            117.149493, // Third point - continues the path
                            -0.463314
                        ],
                        [
                            117.150024,
                            -0.463448
                        ],
                        [
                            117.149924,
                            -0.463615
                        ],
                        [
                            117.149764,
                            -0.463545
                        ],
                        [
                            117.149742,
                            -0.463575
                        ],
                        [
                            117.1499,
                            -0.463663
                        ],
                        [
                            117.149833,
                            -0.463803
                        ],
                        [
                            117.149077,
                            -0.463631
                        ],
                        [
                            117.148996,
                            -0.463526
                        ],
                        [
                            117.149041,
                            -0.463379
                        ],
                        [
                            117.149039, // Final point - completes the path
                            -0.463376
                        ]
                    ]
                }
            }
        ]
    }

    // WHAT IT DOES: Creates the main interactive map object and displays it
    // HOW IT WORKS: Targets the HTML element with ID 'map' and configures initial view
    var map = L.map('map', {
        center: [-0.49483971374300323, 117.1440951762494], // Starting position [lat, lng]
        zoom: 12, // How zoomed in the map starts (1=world view, 20=street level)
        layers: [osm] // Which tile layer to show initially
    })

    // WHAT IT DOES: Creates an object containing all available map backgrounds
    // HOW IT WORKS: Groups tile layers so users can switch between them
    const baseLayers = {
        'Openstreetmap': osm, // Key: display name, Value: layer object
        'EsriWorldImagery': Esri_WorldImagery,
        'EsriWorldstreetmap': Esri_WorldStreetMap,
    }

    // WHAT IT DOES: Defines what happens when user clicks on any GeoJSON feature
    // HOW IT WORKS: Automatically called by Leaflet for each feature added to map
    function onEachFeature(feature,layer){
        // Build popup text starting with geometry type
        let popupContent = `Data Geojson  ${feature.geometry.type} `;

        // Check if feature has custom popup text and add it
        if (feature.properties && feature.properties.popupContent) {
            popupContent += feature.properties.popupContent;
        }

        // Attach the popup to this map feature
        layer.bindPopup(popupContent);
    }

    // WHAT IT DOES: Converts GeoJSON data into map layers and adds them to the map
    // HOW IT WORKS: Processes both hospital and campus data, applies styling and popups
    const geoJson = L.geoJSON([hospital,campus],{
        // Function to apply visual styles to features (currently returns undefined)
        style(feature){
            return feature.properties && feature.properties.style
        },
        onEachFeature, // Call popup function for each feature
    }).addTo(map); // Immediately add to the map

    // WHAT IT DOES: Creates a control widget for switching between different map backgrounds
    // HOW IT WORKS: Adds a layer selector in the top-right corner of the map
    const layerControl = L.control.layers(baseLayers).addTo(map);

</script>
@endpush
