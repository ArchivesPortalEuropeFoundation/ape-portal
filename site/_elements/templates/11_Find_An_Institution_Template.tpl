
<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
<head>
    [[$head]]
</head>
<body>
[[$header]]

<section id="innerHero"[[*heroAlign:is=`left`:then=` class="left"`]]>
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[*heroTitle:notempty=`[[*heroTitle]]`:default=`[[*pagetitle]]`]]</h1>
            [[*heroText]]
        </div>
        <ul class="nav-tabs buttons mt30 mb0">
            <li class="active"><a href="#tabMap" data-tabID="10" data-toggle="tab">[[*findTabsLabel1]]</a></li>
            <li><a href="#tabOther" data-tabID="20" data-toggle="tab">[[*findTabsLabel2]]</a></li>
        </ul>
        <div class="tab-content">
            <div id="tabMap" class="tab-pane fade active in">
                <div id="institutionsMap"></div>
            </div>
            <div id="tabOther" class="tab-pane fade"></div>
        </div>
    </div>
</section>

<section id="resultsTabs">
    <div class="greyBG">
        <div class="container">

            <div id="contextCountry" class="contextDropdown mt10">
                <div class="title row">
                    <div class="col-sm-6">
                        <h3>[[!%asi.search_select_mply_country? &topic=`search` &namespace=`asi`]]</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
                            <form class="searchLight">
                                <div class="inputWrapper">
                                    <i class="fas fa-search"></i>
                                    <input data-filter-type="tile_filter" data-filter-target="countries" type="text" name="search" placeholder="[[!%asi.find_country? &topic=`input` &namespace=`asi`]]">
                                </div>
                            </form>
                            <div class="sortBy">
                                <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                <div class="selectDropdown">
                                    <div class="title">
                                        [[- @TODO - this will need new lexicons I think ]]

                                        [[- OLD !%asi.most_results? &topic=`search` &namespace=`asi`]]
                                        Name A-Z
                                    </div>
                                    <div class="inner">

                                        [[- OLD <a href="#">[[!%asi.most_results? &topic=`search` &namespace=`asi`]]</a>]]
                                        <a data-order="tile_order" data-order-target="countries" data-order-type="a-z" data-container-target="#contextCountry" href="#">Name A-Z</a>
                                        <a data-order="tile_order" data-order-target="countries" data-order-type="z-a" data-container-target="#contextCountry" href="#">Name Z-A</a>
                                    </div>
                                </div>
                            </div>
                            <a class="toggleSlideUp" href="#countrySort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                            <a data-override="dont_toggle_show" class="toggleShow"><span>[[!%asi.hide? &topic=`actions` &namespace=`asi`]]</span> <i class="far fa-angle-up ml"></i></a>
                        </div>
                    </div>
                </div>
                <div class="inner">
                    <div class="row">

                        [[!asi_institution_countries]]
                        
                    </div>
                </div>
            </div>
            <div id="contextInstitution" class="contextDropdown" data-section="landscapes">
                <div class="title row closed">
                    <div class="col-sm-6">
                        <h3>[[!%asi.search_select_mply_archival_landscape? &topic=`search` &namespace=`asi`]]</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
                            <form class="searchLight">
                                <div class="inputWrapper">
                                    <i class="fas fa-search"></i>
                                    <input data-filter-type="tile_filter" data-filter-target="landscapes" type="text" name="search" placeholder="[[!%asi.input_ph_find_landscape? &topic=`input` &namespace=`asi`]]">
                                </div>
                            </form>
                            <div class="sortBy">
                                <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                <div class="selectDropdown">
                                    <div class="title">
                                        Name A-Z
                                    </div>
                                    <div class="inner">
                                        [[-<a href="#">[[!%asi.find_institution? &topic=`input` &namespace=`asi`]]</a>]]
                                        <a data-order="tile_order" data-order-target="landscapes" data-order-type="a-z" data-container-target="#contextInstitution" href="#">Name A-Z</a>
                                        <a data-order="tile_order" data-order-target="landscapes" data-order-type="z-a" data-container-target="#contextInstitution" href="#">Name Z-A</a>
                                    </div>
                                </div>
                            </div>
                            <a class="toggleSlideUp" href="#institutionSort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                            <a data-override="dont_toggle_show" class="toggleShow"><span>[[!%asi.toggle_show? &topic=`filters` &namespace=`asi`]]</span> <i class="far fa-angle-up ml"></i></a>
                        </div>
                    </div>
                </div>
                <div class="inner" style="display: none;" data-results="landscapes">

                    [[- landscape sets go here ]]

                </div>
            </div>
            <div id="contextAids" class="contextDropdown" data-section="results">
                <div class="title row reducedPaddingM closed">
                    <div class="col-sm-6">
                        <h3>[[!%asi.title_archival_institution? &topic=`default` &namespace=`asi`]]</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
                            <form class="searchLight upM">
                                <div class="inputWrapper">
                                    <i class="fas fa-search"></i>
                                    <input data-filter-type="list_filter" data-filter-target="institutions" type="text" name="search" placeholder="[[!%asi.input_ph_find_institution? &topic=`input` &namespace=`asi`]]">
                                </div>
                            </form>
                            <div class="sortBy">
                                <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                <div class="selectDropdown">
                                    <div class="title">
                                        [[!%asi.title_name? &topic=`default` &namespace=`asi`]]
                                    </div>
                                    <div class="inner">
                                        <a href="#">[[!%asi.title_name? &topic=`default` &namespace=`asi`]]</a>
                                    </div>
                                </div>
                            </div>
                            <a class="toggleSlideUp upM" href="#aidSort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                            <a data-override="dont_toggle_show" class="toggleShow"><span>[[!%asi.toggle_show? &topic=`filters` &namespace=`asi`]]</span> <i class="far fa-angle-up ml"></i></a>
                        </div>
                    </div>
                </div>
                <div class="inner" data-results="results" style="display: none;">



                </div>

            </div>
        </div>
</section>

<section class="noMargin">
    <div class="container">
        <ul class="paging" data-control="pagination" style="display: none;">
            <li data-paginate="first" class="first"><a href="#"><i class="far fa-angle-double-left"></i><span> [[!%asi.pg_first? &topic=`default` &namespace=`asi`]]</a></span></li>
            <li data-paginate="prev" class="prev"><a href="#"><i class="far fa-angle-left"></i><span> [[!%asi.pg_previous? &topic=`default` &namespace=`asi`]]</a></span></li>
            <span data-paginate="pages"></span>
            <li data-paginate="next" class="next"><a href="#"><span>[[!%asi.pg_next? &topic=`default` &namespace=`asi`]] </span><i class="far fa-angle-right"></i></a></li>
            <li data-paginate="last" class="last"><a href="#"><span>[[!%asi.pg_last? &topic=`default` &namespace=`asi`]] </span><i class="far fa-angle-double-right"></i></a></li>
        </ul>
    </div>
</section>

[[$footer]]

[[$banners]]

[[$tooltips]]

<div id="countrySort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.sort_countries_by? &topic=`search` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_find_institution_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_find_institution_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<div id="institutionSort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>Sort landscapes by:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_find_institution_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_find_institution_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<div id="aidSort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.filter_sort_institutions_by? &topic=`filters` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_institution_name_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_institution_name_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<script>
    var enable_institution_search = true; // enables the inst search
</script>

[[$scripts]]

<script>
    $('.countryItem, .institutionItem').click(function() {
        $(this).toggleClass('active');
    });

    $('.moreListInst').each(function() {
        var list = $(this);
        var items = list.find('.item').size();
        var more = list.find('.showMore');
        var less = list.find('.showLess');
        var x = 6;
        var y = 3;
        var z = x;

        if (x > items) {
            more.hide();
        }

        $(this).find('.item:lt('+x+')').css('display', 'block');

        more.click(function () {
            x= (x+y <= items) ? x+y : items;
            list.find('.item:lt('+x+')').css('display', 'block');
            less.show();
            if(x == items){
                more.hide();
            }
        });

        less.click(function () {
            x=(x-y<z) ? z : x-y;
            list.find('.item').not(':lt('+x+')').hide();
            more.show();
            less.show();
            if(x == z){
                less.hide();
            }
        });
    });

</script>
<script type="text/javascript">
    //Array of JSON objects.
    var markers = [[!get_map_markers]];
    window.onload = function () {
        LoadMap();
    }
    function LoadMap() {
        var mapOptions = {
            center: new google.maps.LatLng(51.473172, -0.104572),
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var map = new google.maps.Map(document.getElementById("institutionsMap"), mapOptions);

        for (var i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.latitude, data.longitude);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.name
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.name + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
            latlngbounds.extend(marker.position);
        }
        var bounds = new google.maps.LatLngBounds();
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
    }
</script>
<script>
    {*function initMap() {*}
    {*    // var markers = [[!getMapMarkers]];*}
    {*    var markers = [*}
    {*        {*}
    {*            "title": 'Aksa Beach',*}
    {*            "lat": '19.1759668',*}
    {*            "lng": '72.79504659999998',*}
    {*            "description": 'Aksa Beach is a popular beach and a vacation spot in Aksa village at Malad, Mumbai.'*}
    {*        },*}
    {*        {*}
    {*            "title": 'Juhu Beach',*}
    {*            "lat": '19.0883595',*}
    {*            "lng": '72.82652380000002',*}
    {*            "description": 'Juhu Beach is one of favorite tourist attractions situated in Mumbai.'*}
    {*        },*}
    {*        {*}
    {*            "title": 'Girgaum Beach',*}
    {*            "lat": '18.9542149',*}
    {*            "lng": '72.81203529999993',*}
    {*            "description": 'Girgaum Beach commonly known as just Chaupati is one of the most famous public beaches in Mumbai.'*}
    {*        },*}
    {*        {*}
    {*            "title": 'Jijamata Udyan',*}
    {*            "lat": '18.979006',*}
    {*            "lng": '72.83388300000001',*}
    {*            "description": 'Jijamata Udyan is situated near Byculla station is famous as Mumbai (Bombay) Zoo.'*}
    {*        },*}
    {*        {*}
    {*            "title": 'Sanjay Gandhi National Park',*}
    {*            "lat": '19.2147067',*}
    {*            "lng": '72.91062020000004',*}
    {*            "description": 'Sanjay Gandhi National Park is a large protected area in the northern part of Mumbai city.'*}
    {*        }*}
    {*    ];*}
    {*    var position = {lat: 51.473172, lng: -0.104572};*}
    {*    var latlngbounds = new google.maps.LatLngBounds();*}
    {*    var map = new google.maps.Map(document.getElementById('institutionsMap'), {zoom: 4, center: position});*}
    {*    var image = {url: '[[++site_url]]/assets/images/marker.png', size: new google.maps.Size(17, 23)};*}
    {*    //var marker = new google.maps.Marker({position: position, icon: image,  map: map});*}
    {*    var contentString = '<div class="content">'+*}
    {*        '<p>The institution name displays here</p> ' +*}
    {*        '<a href="#">View <i class="far fa-angle-right ml"></i></a> ' +*}
    {*        '</div>'*}
    {*    ;*}
    {*    for (var i = 0; i < markers.length; i++) {*}
    {*        var data = markers[i]*}
    {*        var myLatlng = new google.maps.LatLng(data.lat, data.lng);*}
    {*        var marker = new google.maps.Marker({*}
    {*            position: myLatlng,*}
    {*            icon: image,*}
    {*            map: map,*}
    {*            title: data.title*}
    {*        });*}
    {*        (function (marker, data) {*}
    {*            google.maps.event.addListener(marker, "click", function (e) {*}
    {*                infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");*}
    {*                infoWindow.open(map, marker);*}
    {*            });*}
    {*        })(marker, data);*}
    {*        latlngbounds.extend(marker.position);*}
    {*    }*}
    {*    // var infowindow = new google.maps.InfoWindow({*}
    {*    //     content: contentString*}
    {*    // });*}
    {*    // var prev_infowindow = false;*}
    {*    // marker.addListener('click', function() {*}
    {*    //     if( prev_infowindow ) {*}
    {*    //         prev_infowindow.close();*}
    {*    //         prev_infowindow = false;*}
    {*    //     } else {*}
    {*    //         prev_infowindow = infowindow;*}
    {*    //         infowindow.open(map, marker);*}
    {*    //     }*}
    {*    // });*}
    {*}*}


</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=[[++gmaps_api_key]]&callback=initMap">
</script>

<script>
    var section = 'find-an-institution';
</script>

</body>
</html>
