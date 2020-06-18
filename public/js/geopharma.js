var map = L.map('map').setView([
    -4.340249213281,
    15.315284729003],
    12.5
);
var baseUrl = "{{ url('/') }}";

// Favorite

var favorite = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});

// OpenStreetMap
var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 18
});
// Wikimedia
var mainLayer = L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
    attribution: '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>',
    minZoom: 1,
    maxZoom: 19
});


var controlLayer = L.control.layers({
    'Favorite': favorite,
    'Wikimedia': mainLayer

});

favorite.addTo(map);
controlLayer.addTo(map);

L.control.zoom({
    position: "topright"
}).addTo(map);

var sidebar = L.control
    .sidebar({ container: "sidebar", position: "right" })
    .addTo(map)
    .open("home");