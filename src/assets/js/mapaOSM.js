// Variables y Objetos globales.
var mapa = null;

function cargarMapa(){
	// Asuncion - Paraguay.
	var longitud = -57.6309129;
	var latitud = -25.2961407;
	var zoom = 14;

    // Se instancia el objeto mapa.
	mapa =  L.map('mapa', {
		fullscreenControl: true,
  		fullscreenControlOptions: {
			title: 'Pantalla completa',
  			titleCancel: 'Salir de la pantalla completa',
    		position: 'topleft'
  		}
	}).setView([latitud, longitud], zoom);

	// Humanitarian Style.
	var layer_osm = L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: 'Data \u00a9 <a href="http://www.openstreetmap.org/copyright">' +
          'OpenStreetMap Contributors </a> Tiles \u00a9 HOT'
	}).addTo(mapa);

    // Buscador.
    var buscador = mapa.addControl(new L.Control.Search({
		url: 'http://nominatim.openstreetmap.org/search/py?format=json&q=%2C+py+{s}',
		jsonpParam: 'json_callback',
		propertyName: 'display_name',
		propertyLoc: ['lat','lon'],
		markerLocation: false,
        circleLocation: false,
		autoCollapse: true,
		autoType: false,
		minLength: 2
	}).on('search_locationfound', function (e) {
        updateLatLng(e.latlng.lat,e.latlng.lng, true);
    }));

    // Marcador por defecto.
    var marcador = L.marker([latitud, longitud], {
        draggable: 'true'
    }).addTo(mapa);

    // Funcion para mover el marcador.
    function onMapClick(e) {
        marcador.on('dragend', function(event){
            var marker = event.target;
            var position = marker.getLatLng();
            marcador.setLatLng(new L.LatLng(position.lat, position.lng),{
                draggable: 'true'
            });
            mapa.panTo(new L.LatLng(position.lat, position.lng));

            // Actualizar latitud y longitud en el formulario.
            updateLatLng(marcador.getLatLng().lat, marcador.getLatLng().lng);
        });
        mapa.addLayer(marcador);
    };

    function updateLatLng(lat, lng, reverse) {
        if(reverse) {
            marcador.setLatLng([lat, lng]);
            mapa.panTo([lat, lng]);
        }else{
             document.getElementById('latitud').value = marcador.getLatLng().lat;
             document.getElementById('longitud').value = marcador.getLatLng().lng;
             mapa.panTo([lat,lng]);
        }
    }

    // Se registran eventos.
    mapa.on('click', onMapClick);
    marcador.on('dragend', function (e) {
        updateLatLng(marcador.getLatLng().lat, marcador.getLatLng().lng);
    });

    // Actualizar latitud y longitud en el formulario.
    updateLatLng(latitud, longitud);
}
