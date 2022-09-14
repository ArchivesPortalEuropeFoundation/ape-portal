var current_map_id;

var mapInit = false;
var instituteMap = '';
var instituteMarker = '';

function initMap() {
    console.log('initMap run!');
    const coords = { lat: current_map_lat, lng: current_map_lng };
    if(!this.mapInit) {
        instituteMap = new google.maps.Map(document.getElementById('google_map_main'), {
            zoom: 15,
            center: coords,
        });
        instituteMarker = new google.maps.Marker({
            position: coords,
            map: instituteMap,
        });
        this.mapInit = true;
    }

}

    $(document).ready(function(){
        initMap();
        console.log('V1');
        console.log(current_map_lat);
        console.log(current_map_lng);
        // $.ajax({
        //     type: "GET",
        //     url: "https://maps.googleapis.com/maps/api/js?key="+map_key+"&callback=initMap",
        //     dataType: "script"
        // });
    $('[data-google-map]').click(function(){
        google_map_id = $(this).parent().attr('id');
        current_map_id = $(this).attr('id');
        console.log(current_map_id);
        console.log(google_map_id);

//New Code - Justin

//End of New Code - Justin

    });
});




$('[data-switch-branch]').on('click',function(){
    var newLng      = $(this).data('longitude'),
        newLat      = $(this).data('latitude');
    console.log(newLng);
    console.log(newLat);
    myLatlng = new google.maps.LatLng(newLat, newLng);
    instituteMarker.setPosition(myLatlng);
    instituteMap.setCenter(myLatlng);
});