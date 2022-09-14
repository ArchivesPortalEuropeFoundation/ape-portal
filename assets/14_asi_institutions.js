if (typeof enable_institution_search !== 'undefined') {

// global settings and placeholders
    var asi_debug = true;

    var landscape_search_url = "/asi-ajax/?action=load_landscapes_solr";

    var results_search_url= "/asi-ajax/?action=load_landscapes_solr";

    var filters = new Array();
    var term = null;
    var sort = "Relevance";
    var current_page = 1;
    var results_per_page = 10;
    var total_pages;
    var results_start_page;
    var results_last_page;
    var current_response;

    var selected_landscapes = [];

    var xml_country_codes = {AU: "Austria", BE: "Belgium", BG: "Bulgaria", HR: "Croatia", CY: "Cyprus",CZ: "Czechia", DK: "Denmark", EE: "Estonia", FI: "Finland", FR: "France", DE: "Germany", GR: "Greece", HU: "Hungary", IE: "Ireland",IT: "Italy", LV: "Latvia", LT: "Lithuania", LU: "Luxembourg", MT: "Malta", NL: "Netherlands", PL: "Poland", PT: "Portugal", RO: "Romania",SK: "Slovakia", SI: "Slovenia", ES: "Spain", SE: "Sweden", GB: "United Kingdom"};
    var solr_country_codes = ["AUSTRIA:G:30", "BELGIUM:G:8", "BULGARIA:G:17", "CROATIA:G:37", "CZECH_REPUBLIC:G:18", "ESTONIA:G:19", "EUROPE:G:42", "FINLAND:G:14", "FRANCE:G:2", "GEORGIA:G:41", "GERMANY:G:3", "GREECE:G:4", "HUNGARY:G:22", "ICELAND:G:25", "IRELAND:G:10", "ISLE_OF_MAN:G:43", "ITALY:G:34", "LATVIA:G:11", "LITHUANIA:G:35", "LUXEMBOURG:G:26", "MALTA:G:12", "MULTINATIONAL_INSTITUTIONS:G:42", "NETHERLANDS:G:7", "NORWAY:G:33", "POLAND:G:5", "PORTUGAL:G:13", "ROMANIA:G:36", "SLOVAKIA:G:32", "SLOVENIA:G:9", "SPAIN:G:1", "SWEDEN:G:6", "SWITZERLAND:G:28", "UNITED_KINGDOM:G:27"];


    function log(msg) {
        if(asi_debug == true) console.log(msg);
    }

// onload
    $(function () {
        log("JS is listening....");
        listenForFilterChange();
        listenForLandscapeChange();
        updateFilters();
        dropdownOpenFilters();
        listenForNotDropdown();
        listenForLandscapeClick();
        listenForTileFilter();
        listenForTileSort();
    });

    function listenForTileSort() {

        $( "body" ).on( "click", '[data-order="tile_order"]', function(event) {

            event.preventDefault();

            var order_target = $(this).attr('data-order-target');
            var order_type = $(this).attr("data-order-type");
            var target_container = $(this).attr("data-container-target");
            var targetElems = $('[data-tile-filter="'+order_target+'"]');

            var sorted = [];
            targetElems.each(function(){

                var item = {
                    elem: $(this).parent(),
                    value: $(this).children(".name").html().toLowerCase()
                };
                sorted.push(item);
                $(this).parent().remove();
            });

            if(order_type == "a-z") {
                sorted.sort(function (a, b) {
                    if (a.value < b.value) {
                        return -1;
                    }
                    if (a.value > b.value) {
                        return 1;
                    }
                    return 0;
                })
            }

            if(order_type == "z-a") {
                sorted.sort(function (a, b) {
                    if (a.value > b.value) {
                        return -1;
                    }
                    if (a.value < b.value) {
                        return 1;
                    }
                    return 0;
                });
            }

            var string = "";
            $.each(sorted, function (k, v) {
                string+=v.elem.prop('outerHTML');
            });

            $(target_container+" .inner .row").html(string);
            $(this).parent().hide().siblings(".title").html($(this).html()).parent().removeClass('open');
        });
    }

    function listenForTileFilter() {
        //data-filter-type="tile_filter" data-filter-target="context-view-countries"
        // data-populate="context-view-countries"
        // data-filter-field-name

        $( "body" ).on( "keyup", '[data-filter-type="tile_filter"]', function(event) {

            var filter_target = $(this).attr('data-filter-target');
            var targetFieldName = $(this).attr("data-filter-field-name");
            var targetElems = $('[data-tile-filter="'+filter_target+'"]');

            var term = $(this).val().toLowerCase();
            var n = term.length;

            if(n==0) {
                targetElems.each(function(){
                    var elem = $(this);
                    elem.parent().removeClass('hidden');
                });
                return;
            }

            // @TODO
            //$('[data-facet-item-set="'+filter_target+'"] .moreDropdown').addClass("open");

            targetElems.each(function(){

                var elem = $(this);
                elem.parent().addClass('hidden');
                var field = $(this).children(".name").html();
                var limit = field.length;

                var i;
                for (i = 0; i <= limit; i++) {

                    var end = (i+n);
                    var check = field.substring(i, end).toLowerCase();

                    if( term == check ) {
                        elem.parent().removeClass('hidden');
                        return;
                    }
                }
            });
        });

    }

    function translateCountryCodeXML(code) {

        if(code.includes("_")) {
            var parts = code.split("_");
            code = parts[0];
        }
        return country_codes[code];
    }

    function translateCountryCodeSolr(code) {

        if(code.includes(":")) {
            var parts = code.split(":");
            code = parts[0];
        }
        if(code.includes("_")) {
            code = code.replace('_', ' ');
        }

        return code;
    }

    function listenForLandscapeClick() {

        $('[data-results="landscapes"]').on("click", "[data-inst-landscape]", function (event) {
            if($(this).hasClass('active')) {
                $(this).removeClass("active");
            }
            else {
                $(this).addClass("active");
            }
        });
    }

    function listenForLandscapeChange() {

        $('[data-section="landscapes"]').on( "click", '[data-trigger="update_results"]', function() {
            log('landscape clicked...');
            getCurrentFilterValues();
            updateResults();
        });

    }

    function listenForNotDropdown() {

        $('[data-section="landscapes"] .toggleShow').click(function(event){
            log('attempting to open landscapes...');
            event.stopPropagation();
            event.preventDefault();
            if(aCountryIsSelected() == true) {
                var parent =  $(this).parents('.title');
                var toggleText = $(this).children('span');
                $(parent).toggleClass('closed');
                $(parent).siblings('.inner').slideToggle(300,'swing');
                if ($(parent).is('.closed')) {
                    $(toggleText).text('Show');
                } else {
                    $(toggleText).text('Hide');
                }
                return true;
            }else {
                alert("Please select at least 1 country");
                // title row closed
                $('[data-section="landscapes"] .title.row').addClass("closed");
                return false;
            }
        })


        $('[data-section="results"] .toggleShow').click(function(event){
            log('attempting to open results...');
            event.stopPropagation();
            event.preventDefault();
            if(aCountryIsSelected() == true) {
                var parent =  $(this).parents('.title');
                var toggleText = $(this).children('span');
                $(parent).toggleClass('closed');
                $(parent).siblings('.inner').slideToggle(300,'swing');
                if ($(parent).is('.closed')) {
                    $(toggleText).text('Show');
                } else {
                    $(toggleText).text('Hide');
                }
                return true;
            }else {
                alert("Please select at least 1 Archival Landscape");
                $('[data-section="results"] .title.row').addClass("closed");
                return false;
            }
        })
    }

// Might be worth separating country from landscape clicks...
    function listenForFilterChange() {
        $('[data-trigger="update_filters"]').click(function(){
            getCurrentFilterValues();
            updateLandscapeResults();
        });
    }

    function updateLandscapeResults() {

        log("Updating landscape results...");

        var username = "test";
        var password = "letmein";


        $.ajax({
            method: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader ("Authorization", "Basic " + btoa(username + ":" + password));
            },
            url: landscape_search_url,
            data: {
                countries: getCountryFilters(),
            }
        })
            .done(function(data) {
                log("this 255");
                log(data);
                var response=JSON.parse(data);
                log(response);
                drawTilesFromData("landscapes", response.result);
            });
    }

    function drawTilesFromData(area, data) {

        log("HERE 1 >>>>>>>>>>");
        log(data);

        data = JSON.parse(data);
        log("HERE D >>>>>>>>>>");
        log(data);

        data = data.landscapes;

        log("HERE 2 >>>>>>>>>>");
        log(data);

        var string = "";
        $.each(data, function (key, value) {

            string+= "<div class='countryList'>";
            string+= "<h5><i class=\"fas fa-globe-europe\"></i>"+translateCountryCodeSolr(key)+"</h5>";

            $.each(value, function (keyL, valueL) {

                string+= "<div class=\"col-sm-6 col-md-4 item\">\n" +
                    "    <div class=\"institutionItem\" data-tile-filter=\""+area+"\" data-trigger=\"update_results\" data-inst-landscape-country='"+key+"' data-inst-landscape='"+valueL+"'>\n" +
                    "        <span class=\"country\"><i class=\"fas fa-globe-europe\"></i> "+translateCountryCodeSolr(key)+"</span>\n" +
                    "        <span class=\"name\">"+cleanLabel(valueL)+"</span>\n" +
                    "    </div>\n" +
                    "</div>";
            });
            string+= "</div>";

            string+= "<div class=\"row moreListInst\">\n" +
                "        \n" +
                "        <div class=\"col-xs-12\">\n" +
                "            <div class=\"text-center mt30\">\n" +
                "                <a class=\"showMore\">Show more from "+cleanLabel(key)+" <i class=\"far fa-angle-down\"></i></a>\n" +
                "                <a class=\"showLess\">Show less from "+cleanLabel(key)+" <i class=\"far fa-angle-up\"></i></a>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "    </div>";

        });

        $('[data-results="'+area+'"]').html(string);
        $('.institutionItem').matchHeight();
        updateResults();
    }

    function updateResults() {

        log("Updating final results... HERE...");
        $.ajax({
            method: "GET",
            url: results_search_url,
            data: {
                countries: getCountryFilters(),
                landscapes: getLandscapeFilters(),
            }
        })
            .done(function(data) {
                current_page = 1;
                log("this 324");
                var response=JSON.parse(data);
                current_response = response;
                resetPagination(response.result);
                drawInstitutionRows(response.result);
                //$('[data-results="results"]').html(data);
                forceDropdown('results');
            });
    }

    function refreshResults() {
        drawInstitutionRows(current_response.result);
    }

    function resetPagination(data) {

        var result_count = 0;
        log("this 341");
        var dataArr = JSON.parse(data);
        var inst_data = dataArr.institutions;
        $.each(inst_data, function(keyC, valueC) {
            result_count = (result_count + valueC.length);
        });
        total_pages = Math.ceil(result_count / 10);
        refreshPaginationDisplay();
        listenForPagination();
        console.log("result count is "+result_count);
    }

    function cleanLabel(solr_value) {
        var parts = solr_value.split(":");
        return parts[0];
    }

    function listenForPagination() {

        $('[data-control="pagination"]').on("click", '[data-paginate]', function (event) {
            event.preventDefault();
            var value = $(this).attr('data-paginate');
            if (value == "pages") return;
            log('page value is ' + value);

            var c_page = parseInt(current_page);

            switch (value) {
                case "first":
                    c_page = 1;
                    break;
                case "prev":
                    var thePageWas = current_page;
                    c_page = (thePageWas - 1);
                    break;
                case "last":
                    c_page = parseInt(total_pages);
                    break;
                case "next":
                    var thePageWas = c_page;
                    c_page = (thePageWas + 1);
                    break;
                default:
                    var newPage = parseInt(value);
                    c_page = newPage;
                    break;
            }

            current_page = c_page;
            refreshResults();
            refreshPaginationDisplay();
            scrollToResults();
        });
    }

    function scrollToResults() {

        var position = $('[data-results="results"]').offset();
        console.log("position top is "+position.top);
        scrollTo(0, (position.top - 200));
    }

    function refreshPaginationDisplay() {

        var i;
        var pageItemsHtml = "";
        var start_page = 1;
        var last_page = total_pages;
        if(current_page > 5) {
            start_page = (current_page - 5);
            last_page = (current_page + 5);
            if(start_page > (total_pages - 10)) start_page = (total_pages - 10);
            if(last_page > total_pages) last_page = total_pages;
        }
        // @TODO
        results_start_page = start_page;
        results_last_page = last_page;
        for (i = start_page; i < (last_page + 1); i++) {
            if (i == current_page) {
                pageItemsHtml += "<li class='active'><a data-paginate='" + i + "' href='#'>" + i + "</a></li>";
            } else {
                pageItemsHtml += "<li><a data-paginate='" + i + "' href='#'>" + i + "</a></li>";
            }
        }
        $('[data-paginate="pages"]').html(pageItemsHtml);
	$('[data-control="pagination"]').show();
    }

    function drawInstitutionRows(data) {


        var start = (current_page*results_per_page)-results_per_page;
        var limit = (current_page*results_per_page);

        log("this 429");
        var dataArr = JSON.parse(data);
        var inst_data = dataArr.institutions;
        var string = "";

        var counter = 0;

        log("HERE >>>>>>>>>>");
        log(inst_data);


        $.each(inst_data, function(keyC, valueC) {
            $.each(valueC, function (key, value) {

                if(counter >= limit) {
                    return false;
                }

                if(counter >= start) {
                    var parts = keyC.split("_");
                    var country_name = translateCountryCodeSolr(parts[0]);
                    var name_parts = value.split(":");
                    var link_name = name_parts[name_parts.length - 1].trim();

                    string += "<div class=\"aidsResult\">\n" +
                        "                        <div class=\"details\">\n" +
                        "                            <span class=\"country\"><i class=\"fas fa-globe-europe\"></i> " + country_name + "</span>\n" +
                        "                            <h5>" + value + "</h5>\n" +
                        "                            <a class=\"view button blue\" href=\"/advanced-search/search-in-institutions/results-(institutions)/?name=" + link_name + "&term=\"><i class=\"fas fa-eye mr\"></i> View</a>\n" +
                        "                        </div>\n" +
                        "                    </div>";
                }
                counter = (counter+1);
            });
        });
        $('[data-results="results"]').html(string);
    }

    function getCountryFilters() {
        var selectedCountries = [];
        $.each(filters, function(key, value) {
            if(value.name == "country") {
                log('a country is selected');
                selectedCountries.push(value.value);
            }
        });
        return selectedCountries;
    }

    function getLandscapeFilters() {
        var selectedLandscapes = [];
        $.each(filters, function(key, value) {
            if(value.name == "landscape") {
                log('a landscape is selected');
                selectedLandscapes.push(value.value);
            }
        });
        return selectedLandscapes;
    }

    function updateFilters() {
        log("Updating filters...");
        getCurrentFilterValues();
    }

    function getCurrentFilterValues() {

        log("Fetching current filter values...");

        filters = [];
        // countries
        $('[data-inst-country]').each(function(){
            if( $(this).hasClass('active') ) {
                log('foundone');
                var filter = {name: "country", value: $(this).attr('data-inst-country')};
                filters.push(filter);
            }
        });

        // landscapes
        log("checking for landscapes...");
        $('[data-inst-landscape]').each(function(){
            log("found a landscape...");
            if( $(this).hasClass('active') ) {
                log("is acitve...");
                log('foundone');
                var filter = {name: "landscape", value: $(this).attr('data-inst-landscape-country')+"_"+$(this).attr('data-inst-landscape')};
                filters.push(filter);
            }
        });


        log("current filters are...");
        log(filters);
        dropdownOpenFilters();
        return filters;
    }

    function dropdownOpenFilters() {
        log('Dropping down opens...');
        if(aCountryIsSelected() == true) {
            log('forcing...');
            forceDropdown('landscapes');
        }else {
            forceDropdown('landscapes', 'hide');
        }
    }


    function forceDropdown(id, state) {

        if (typeof state === 'undefined') {
            state = 'show';
        }

        log('forcing dropdown '+id+' '+state);

        var section = $('[data-section="'+id+'"]');
        var title = section.children('.title');
        var toggleText = section.children('span');
        var inner = section.children('.inner');

        if(state == "show") {
            if (title.hasClass('closed')) {
                log('dropdown is currently closed');
                inner.slideToggle(300,'swing');
                toggleText.text('Hide');
                title.removeClass('closed');
            }
        }
        else {
            if (!title.hasClass('closed')) {
                log('dropdown is currently open');
                inner.slideToggle(300,'swing');
                toggleText.text('Show');
                title.addClass('closed');
            }
        }
    }

    function aCountryIsSelected() {
        var selected = false;
        $.each(filters, function(key, value) {
            if(value.name == "country") {
                log('a country is selected');
                selected = true;
            }
        });
        if(selected == true){
            return true;
        }
        return false;
    }
}
