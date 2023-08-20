let map, mapInfoWindow = null;

function initMap() {
    var options = {
        zoom: 2.6,
        center: (new google.maps.LatLng(50, 25)),
    };

    map = new google.maps.Map(document.getElementById("map"), options);

    //to remove the dismiss button alert
    setTimeout(function(){
        if($('#map').find('.dismissButton').length == 1){
            $('#map').children('div:nth-of-type(2)').remove();
        }
    },1000);
}

function addMarker(message, map) {
    let icon = "http://maps.google.com/mapfiles/ms/icons/" + message.marker_color + "-dot.png";

    var marker = new google.maps.Marker({
        position: message.location,
        map: map,
        title: message.name,
        icon: {
            url: icon,
            scaledSize: new google.maps.Size(35, 35)
        }
    });

    // window to show the message
    var mapInfoWindow = new google.maps.InfoWindow({
        content: '<span> Mesasge: ' + message.message + '</span>'
    });

    // marker  with event click .
    google.maps.event.addListener(marker, 'click', function () {
        mapInfoWindow.open(map, marker);
    });
}

function getMessages() {
    let params = (new URL(document.location)).searchParams;
    //console.log(params);
    let status = params.get("status");
    let mapUrl = document.getElementById("map")
        .getAttribute('data-url') + (status ? ('?status=' + status) : '');
    axios.
    get(mapUrl).
    then(response => {
        response.data.data.forEach(function (message) {
            addMarker(message, map)
        })
    })
}

$(document).ready(function(){
    initMap();
    getMessages();
});
