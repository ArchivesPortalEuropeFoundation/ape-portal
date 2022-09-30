var oldSection = section;
if (typeof enable_search !== 'undefined') {

    (function (ApeSearch, $, undefined) {

        // private
        var asi_search_url = "/get-results";
        var lazy_load_url = '/lazy-data';

        var popping_suggest_sections = false;

        // public
        ApeSearch.request_params = {}; // raw (everything)
        ApeSearch.request_filters = {}; // sorted (just facets)
        ApeSearch.response_filters = {};
        ApeSearch.filterTranslations = {};
        ApeSearch.search_type = section;
        ApeSearch.term = null;
        ApeSearch.sort = "Relevance";
        ApeSearch.using = "default";
        ApeSearch.since = null;
        ApeSearch.pages = 0;
        ApeSearch.current_page = 1;
        ApeSearch.results_count = 0;
        ApeSearch.start_page = 0;
        ApeSearch.last_page = 0;
        ApeSearch.more_after_count = 10;

        ApeSearch.context = "listTab";

        ApeSearch.all_sorts = [];
        ApeSearch.all_sorts.archives = ["Relevance", "Title", "Date", "Reference code", "Finding aid no"];
        ApeSearch.all_sorts.names = ["Relevance", "Date"];
        ApeSearch.all_sorts.institutions = ["Relevance", "Name"];

        ApeSearch.all_usings = [];
        ApeSearch.all_usings.archives = ["Title", "Content summary", "Reference code"];
        ApeSearch.all_usings.names = ["Name", "Identifier", "Place", "Occupation", "Mandate", "Function"];
        ApeSearch.all_usings.institutions = ["Name", "Place"];

        ApeSearch.all_types = [];
        ApeSearch.all_types.archives = ["fa", "hg", "sg"];
        ApeSearch.all_types.names = ["corporatebody", "person", "family"];
        ApeSearch.all_types.institutions = ["municipalArchives", "countyArchives", "universityArchives", "regionalArchives", "nationalArchives", "culturalArchives", "churchArchives", "specialisedArchives", "politicalArchives", "businessArchives", "privateArchives", "mediaArchives"];
        ApeSearch.all_countries = ["AUSTRIA:G:30", "BELGIUM:G:8", "BULGARIA:G:17", "CROATIA:G:37", "CZECH_REPUBLIC:G:18", "ESTONIA:G:19", "FINLAND:G:14", "FRANCE:G:2", "GEORGIA:G:41", "GERMANY:G:3", "GREECE:G:4", "HUNGARY:G:22", "ICELAND:G:25", "IRELAND:G:10", "ISLE_OF_MAN:G:43", "ITALY:G:34", "LATVIA:G:11", "LITHUANIA:G:35", "LUXEMBOURG:G:26", "MALTA:G:12", "MULTINATIONAL_INSTITUTIONS:G:42", "NETHERLANDS:G:7", "NORWAY:G:33", "POLAND:G:5", "PORTUGAL:G:13", "ROMANIA:G:36", "SLOVAKIA:G:32", "SLOVENIA:G:9", "SPAIN:G:1", "SWEDEN:G:6", "SWITZERLAND:G:28", "UNITED_KINGDOM:G:27"];

        ApeSearch.exclusive_filters = ["containsdigital"];

        ApeSearch.tab_target = null;

        var homepage_filters = [];

        ApeSearch.search_clicked = false;

        ApeSearch.init = function () {
            cycle();
            listen();
            checkTopBoolFilters();
            preloadFilters();
        };

        function preloadFilters() {
            sortUsings();
            sortTypes();
            sortCountries();
        }

        function cycle(scrollToTop) {
            // 'async' cycle - see 'promise cycle' below
            if (typeof scrollToTop === 'undefined') {
                scrollToTop = false;
            }
            processRequest();
            sortParams();
            updateResults(scrollToTop);
            populateDidyoumeans();
            updateFilterSummary();
            checkTopBoolFilters();
            checkContextFilters();
            checkForContext();
        }

        function listen() {
            listenForCheckboxes();
            listenForSearchFieldFocus();
            listenForSearchButton();
            listenForLinkClicks();
            listenForFilterSummaryClears();
            listenForPagination();
            listenForFilterFind();
            listenForSearchTabSwitch();
            listenForSortBy();
            listenForContextShowMore();
            listenForContextFilterClick();
            listenForFilterMoreDropdown();
            listenForUsing();
            listenForExactDate();
            listenForTileFilter();
            listenForTileSort();
            listenForContextSearchTerm();
            listenForEnterKey();
            listenForTabTarget();
            listenForContextSwitch();
        }

        function processRequest() {
            ApeSearch.request_params = getQueryParams(document.location.search);
        }

        function sortParams() {
            ApeSearch.term = ApeSearch.request_params.term;
            if (typeof ApeSearch.request_params.sort !== "undefined") ApeSearch.sort = ApeSearch.request_params.sort;
            if (typeof ApeSearch.request_params.page !== "undefined") ApeSearch.current_page = ApeSearch.request_params.page;
            if (typeof ApeSearch.request_params.since !== "undefined") ApeSearch.since = ApeSearch.request_params.since;
        }

        function listenForEnterKey() {

            // add any elements to this list that you don't want enter to be active on...
            $("body").on("keypress", '[data-control="update_term"], [data-filter-type="tile_filter"]', function (event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });
        }

        function listenForContextSwitch() {

            $('[href="#listTab"], [href="#contextTab"]').click(function () {
                
                ApeSearch.context = $(this).attr("href").replace("#", "");
                updateRequest();
                cycle();
            });
        }

        function checkForContext() {
            $('[href="#' + ApeSearch.request_params.context + '"]').tab("show");
        }

        function listenForContextSearchTerm() {

            //  data-control="update_term"
            $("body").on("keyup", '[data-control="update_term"]', function (event) {
                
                ApeSearch.term = $(this).val();
                updateRequest();
                cycle();
            });
        }

        function checkContextFilters() {

            if (typeof ApeSearch.request_filters.types !== "undefined" && ApeSearch.request_filters.types.includes('fa')) {
                $('[data-filter-value="fa"]').prop("checked", true);
            } else {
                $('[data-filter-value="fa"]').prop("checked", false);
            }

            if (typeof ApeSearch.request_filters.types !== "undefined" && ApeSearch.request_filters.types.includes('hg')) {
                $('[data-filter-value="hg"]').prop("checked", true);
            } else {
                $('[data-filter-value="hg"]').prop("checked", false);
            }
        }

        function listenForTabTarget() {

            $.urlParam = function (name) {
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);
                return (results !== null) ? results[1] || 0 : false;
            };

            if ($.urlParam('tab')) {
                $('a[href="#' + $.urlParam('tab') + '"]').tab('show');
            }

            $("body").on("click", '[data-tab-target]', function (event) {
                var target = $(this).val();
                if ($(this).prop("checked") == true) {
                    ApeSearch.tab_target = $(this).attr("data-tab-target");
                } else {
                    ApeSearch.tab_target = null;
                }
                
                
            });
        }

        function listenForTileSort() {

            $("body").on("click", '[data-order="tile_order"]', function (event) {

                event.preventDefault();

                var order_target = $(this).attr('data-order-target');
                var order_type = $(this).attr("data-order-type");
                var target_container = $(this).attr("data-container-target");
                var targetElems = $('[data-tile-filter="' + order_target + '"]');

                var sorted = [];
                targetElems.each(function () {

                    var item = {
                        elem: $(this).parent(),
                        value: $(this).children(".name").html().toLowerCase()
                    };
                    sorted.push(item);
                    $(this).parent().remove();
                });

                if (order_type == "a-z") {
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

                if (order_type == "z-a") {
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
                    string += v.elem.prop('outerHTML');
                });

                

                $(target_container + " .inner .row").html(string);
                $(this).parent().hide().siblings(".title").html($(this).html()).parent().removeClass('open');
            });
        }

        function listenForTileFilter() {
            //data-filter-type="tile_filter" data-filter-target="context-view-countries"
            // data-populate="context-view-countries"
            // data-filter-field-name

            $("body").on("keyup", '[data-filter-type="tile_filter"]', function (event) {

                

                var filter_target = $(this).attr('data-filter-target');
                var targetFieldName = $(this).attr("data-filter-field-name");
                var targetElems = $('[data-populate="' + filter_target + '"] [data-filter-field="' + targetFieldName + '"]');

                var term = $(this).val().toLowerCase();
                var n = term.length;

                
                

                if (n == 0) {
                    targetElems.each(function () {
                        var elem = $(this);
                        elem.parent().removeClass('hidden');
                    });
                    return;
                }

                // @TODO
                //$('[data-facet-item-set="'+filter_target+'"] .moreDropdown').addClass("open");

                targetElems.each(function () {

                    //

                    var elem = $(this);
                    elem.parent().addClass('hidden');
                    var field = $(this).children(".name").html();
                    var limit = field.length;

                    var i;
                    for (i = 0; i <= limit; i++) {

                        var end = (i + n);
                        var check = field.substring(i, end).toLowerCase();

                        if (term == check) {
                            elem.parent().removeClass('hidden');
                            return;
                        }
                    }
                });
            });

        }

        function listenForExactDate() {
            $('#filterSidebar').on("keyup", '#exactStartstarttimespan', function (event) {
                var val = $(this).val();
                if (val.length == 4) {

                    if (Array.isArray(ApeSearch.request_filters['starttimespan_y'])) {} else {
                        ApeSearch.request_filters['starttimespan_y'] = [];
                    }
                    ApeSearch.request_filters['starttimespan_y'].push(val);
                    updateRequest();
                    cycle();
                }
            });
            $('#filterSidebar').on("keyup", '#exactStartendtimespan', function (event) {
                var val = $(this).val();
                if (val.length == 4) {

                    if (Array.isArray(ApeSearch.request_filters['endtimespan_y'])) {} else {
                        ApeSearch.request_filters['endtimespan_y'] = [];
                    }
                    
                    ApeSearch.request_filters['endtimespan_y'].push(val);
                    updateRequest();
                    cycle();
                }
            });
        }

        function sortDates(field, db_field) {

            var set_c = field + "_c";
            var set_d = field + "_d";
            var set_y = field + "_y";
            var parentElem = '[data-g="search-date-' + field + '"]';

            // first check for hierarchy on c->d->y and clean up loose ends
            if (typeof ApeSearch.request_filters[set_c] === "undefined" || ApeSearch.request_filters[set_c].length == 0) {

                ensureClosed($(parentElem));
                ensureClosed($(parentElem + ' [data-section="date_set_century"]'));

                if (typeof ApeSearch.request_filters[set_d] !== "undefined") {
                    delete ApeSearch.request_filters[set_d];
                    ensureClosed($(parentElem + ' [data-section="date_set_decade"]'));
                    updateRequest();
                    cycle();
                }

                if (typeof ApeSearch.request_filters[set_y] !== "undefined") {
                    delete ApeSearch.request_filters[set_y];
                    ensureClosed($(parentElem + ' [data-section="date_set_year"]'));
                    updateRequest();
                    cycle();
                }
            }

            if (typeof ApeSearch.request_filters[set_d] === "undefined" || ApeSearch.request_filters[set_d].length == 0) {

                if (typeof ApeSearch.request_filters[set_y] !== "undefined") {
                    delete ApeSearch.request_filters[set_y];
                    ensureClosed($(parentElem + ' [data-section="date_set_year"]'));
                    updateRequest();
                    cycle();
                }
            }

            // @NOTE - ignore "start_" wording - it's just from original code before refactor
            var start_years = [];
            var end_date = [];
            $.each(ApeSearch.response_filters[db_field], function (key, value) {
                //
                //
                if (value > 0) {
                    var year = key.substring(0, 4);
                    start_years[year] = value;
                }
            });

            var start_c = [];
            var start_d = [];
            $.each(start_years, function (key, value) {

                var v = Number(value);
                var k = Number(key);

                if (!isNaN(v)) {
                    var c = (Math.floor((k / 100))) * 100;
                    if (c in start_c) {
                        start_c[c] = (start_c[c] + v);
                    } else {
                        start_c[c] = v;
                    }

                    var d = (Math.floor((k / 10))) * 10;
                    if (d in start_d) {
                        start_d[d] = (start_d[d] + v);
                    } else {
                        start_d[d] = v;
                    }
                }
            });
            //
            //

            // empty the centuries
            $(parentElem + ' [data-section="date_set_century"] .checkboxList li').each(function () {
                $(this).remove();
            });


            // populate the centuries
            var html_c = "";
            $.each(start_c, function (key, value) {

                if (key > 0 && value > 0) {

                    var check = key.toString();
                    var selected = "";
                    if (typeof ApeSearch.request_filters[set_c] !== "undefined" && ApeSearch.request_filters[set_c].includes(check)) {
                        selected = "checked='checked'";
                        ensureOpen($(parentElem + ' [data-g="search-date-starttimespan"]'));
                        ensureOpen($(parentElem + ' [data-section="date_set_century"]'));
                        ensureOpen($(parentElem + ' [data-section="date_set_decade"]'));
                    }

                    html_c += "<li class=\"checkbox\" data-facet-item-set=\"" + field + "\" data-facet-item=\"" + key + "\" data-search-filter-item=\"\">\n" +
                        "    <input " + selected + " data-filter-field=\"" + set_c + "\" data-filter-value=\"" + key + "\" data-filter-type=\"date_range\" type=\"checkbox\" name=\"" + key + "\">\n" +
                        "    <span>" + key + "</span> <span data-info=\"result_count\">(" + value + ")</span>\n" +
                        "</li>";
                }
            });

            $(parentElem + ' [data-section="date_set_century"] .checkboxList').append(html_c);

            // empty the decades
            $(parentElem + ' [data-section="date_set_decade"] .checkboxList li').each(function () {
                $(this).remove();
            });

            // populate the decades
            var html_d = "";
            $.each(start_d, function (key, value) {

                if (key > 0 && value > 0) {

                    // only show decades within the range of the selected centuries
                    var k = Number(key);
                    var c = (Math.floor((k / 100))) * 100;
                    var c_check = c.toString();

                    if (typeof ApeSearch.request_filters[set_c] !== "undefined" && ApeSearch.request_filters[set_c].includes(c_check)) {

                        var check = key.toString();
                        var selected = "";
                        if (typeof ApeSearch.request_filters[set_d] !== "undefined" && ApeSearch.request_filters[set_d].includes(check)) {
                            selected = "checked='checked'";
                            ensureOpen($(parentElem));
                            ensureOpen($(parentElem + ' [data-section="date_set_century"]'));
                            ensureOpen($(parentElem + ' [data-section="date_set_decade"]'));
                            ensureOpen($(parentElem + ' [data-section="date_set_year"]'));
                        }

                        html_d += "<li class=\"checkbox\" data-facet-item-set=\"" + field + "\" data-facet-item=\"" + key + "\" data-search-filter-item=\"\">\n" +
                            "    <input " + selected + " data-filter-field=\"" + set_d + "\" data-filter-value=\"" + key + "\" data-filter-type=\"date_range\" type=\"checkbox\" name=\"" + key + "\">\n" +
                            "    <span>" + key + "</span> <span data-info=\"result_count\">(" + value + ")</span>\n" +
                            "</li>";
                    }
                }
            });

            $(parentElem + ' [data-section="date_set_decade"] .checkboxList').append(html_d);


            // empty the years
            $(parentElem + ' [data-section="date_set_year"] .checkboxList li').each(function () {
                $(this).remove();
            });

            // populate the years
            var html_y = "";
            $.each(start_years, function (key, value) {

                if (key > 0 && value > 0) {

                    // only show years within the range of the selected decades
                    var k = Number(key);
                    var d = (Math.floor((k / 10))) * 10;
                    var d_check = d.toString();

                    if (typeof ApeSearch.request_filters[set_d] !== "undefined" && ApeSearch.request_filters[set_d].includes(d_check)) {

                        var check = key.toString();
                        var selected = "";
                        if (typeof ApeSearch.request_filters[set_y] !== "undefined" && ApeSearch.request_filters[set_y].includes(check)) {
                            selected = "checked='checked'";
                            ensureOpen($(parentElem));
                            ensureOpen($(parentElem + ' [data-section="date_set_century"]'));
                            ensureOpen($(parentElem + ' [data-section="date_set_decade"]'));
                            ensureOpen($(parentElem + ' [data-section="date_set_year"]'));
                        }

                        html_y += "<li class=\"checkbox\" data-facet-item-set=\"" + field + "\" data-facet-item=\"" + key + "\" data-search-filter-item=\"\">\n" +
                            "    <input " + selected + " data-filter-field=\"" + set_y + "\" data-filter-value=\"" + key + "\" data-filter-type=\"date_range\" type=\"checkbox\" name=\"" + key + "\">\n" +
                            "    <span>" + key + "</span> <span data-info=\"result_count\">(" + value + ")</span>\n" +
                            "</li>";
                    }
                }
            });

            $(parentElem + ' [data-section="date_set_year"] .checkboxList').append(html_y);

        }

        function ensureOpen(element) {
            var toggle_element = element;
            if (!toggle_element.hasClass('open')) {
                toggle_element.addClass('open');
                toggle_element.removeClass('disabled');
                toggle_element.children('.inner').slideToggle(300, 'swing');
            }
        }

        function ensureClosed(element) {
            var toggle_element = element;
            if (toggle_element.hasClass('open')) {
                toggle_element.removeClass('open');
                toggle_element.children('.inner').slideToggle(300, 'swing');
            }
        }

        function checkTopBoolFilters() {

            if (typeof ApeSearch.request_filters['separate'] != "undefined" && ApeSearch.request_filters['separate'] == "true") {
                $('[data-filter-field="separate"]').prop('checked', true);
            } else {
                $('[data-filter-field="separate"]').prop('checked', false);
            }
            if (typeof ApeSearch.request_filters['containsdigital'] != "undefined" && ApeSearch.request_filters['containsdigital'] == "true") {
                $('[data-filter-field="containsdigital"]').prop('checked', true);
            } else {
                $('[data-filter-field="containsdigital"]').prop('checked', false);
            }
            
            if (typeof ApeSearch['using'] != "undefined") {
                console.warn(ApeSearch.value);
                $(document).find(`input[data-value="${ApeSearch.value}"]`).prop('checked', true);
            } 
            
        }

        function lazyLoadData() {

            $('[data-section="search_results"] [data-lazy-load]').each(function () {
                var parent_element = $(this);
                var fa_id = $(this).attr('data-lazy-load');
                $.ajax({
                        method: "GET",
                        url: lazy_load_url + "?section=" + section + "&fa_id=" + fa_id,
                    })
                    .done(function (data) {
                        var response = JSON.parse(data);
                        parent_element.find('[data-lazy-populate="date"]').html('<i class="far fa-calendar-alt mr"></i> ' + response.date);
                    });
            });
        }

        function listenForCheckboxes() {
            $('#filterSidebar').on("click", '[data-filter-field]', function (event) {
                updateRequestFilter($(this), $(this).prop('checked'));
                updateRequest();
                cycle();
            });
            $('#searchContainer').on("click", '[data-filter-field]', function (event) {
                if ($(this).attr('data-type') == "preset_filter") {
                    
                    return;
                }
                if ($(this).attr('data-type') == "sortTypes") {
                    updateRequestFilter($(this), $(this).prop('checked'));
                    
                    return;
                }
                updateRequestFilter($(this), $(this).prop('checked'));
                updateRequest();
                cycle();
            });
        }

        function updateRequestFilter(elem, value) {

            var params = ApeSearch.request_filters;
            var field_name = elem.attr('data-filter-field');
            var field_value = elem.attr('data-filter-value');
            var field_label = elem.attr('data-filter-label');

            if (ApeSearch.exclusive_filters.includes(field_name)) {
                
                removeFilter(field_name, "true");
                removeFilter(field_name, "false");
                if (elem.attr('data-type') == "top_filter_switch") {
                    
                    
                    if (elem.prop("checked") == false) {
                        
                        //params[field_name].splice("true", 1);
                        params[field_name] = [];
                        
                        return;
                        //params[field_name].push("false");
                    }
                }
                if (elem.prop("checked") == false) {
                    return;
                }
            }

            if (Array.isArray(params[field_name])) {
                var index = params[field_name].indexOf(field_value);
                if (params[field_name].indexOf(field_value) != -1 && value == false) {
                    params[field_name].splice(index, 1);
                } else {
                    params[field_name].push(field_value);
                }
            } else {
                params[field_name] = [field_value];
            }
            ApeSearch.request_filters = params;
            ApeSearch.current_page = 1;
        }

        function updateRequest() {
            updateUrl();
        }

        function getQueryParams(qs) {
            qs = qs.split('+').join(' ');
            var params = {},
                tokens,
                re = /[?&]?([^=]+)=([^&]*)/g;
            while (tokens = re.exec(qs)) {
                var key = decodeURIComponent(tokens[1]);
                var value = decodeURIComponent(tokens[2]);
                if (key.substring((key.length - 2)) == "[]") {
                    var nested_key = key.substring(0, (key.length - 2));
                    if (!Array.isArray(params[nested_key])) {
                        params[nested_key] = new Array();
                    }
                    params[nested_key].push(value);
                    ApeSearch.request_filters[nested_key] = params[nested_key];
                } else {
                    params[key] = value;
                }
                if (key == "using") {
                    ApeSearch.using = value;
                }
            }
            return params;
        }

        function getRoute() {
            var new_route;
            if (typeof ApeSearch.term === "undefined") {
                new_route = "/advanced-search/" + section;
            } else {
                var termUrl = encodeURIComponent(ApeSearch.term);
                new_route = "/advanced-search/" + section + "/?term=" + termUrl + generateParamsString();
            }
            return new_route;
        }

        function getNewRoute() {
            var new_route;
            ApeSearch.current_page = 1;
            
            let params = '';

            if (Object.keys(ApeSearch.request_filters).length !== 0) {
                // Create new params based on whats set 
                if ("countries" in ApeSearch.request_filters) {
                    $.each(ApeSearch.request_filters.countries, function (key, value) {
                        params += "&countries[]=" + value;
                    });
                }
                // Add aid for digital objects
                if ("containsdigital" in ApeSearch.request_filters) {
                    params += "&containsdigital[]=true";
                }
                // Add aid for term separation 
                if ("separate" in ApeSearch.request_filters) {
                    params += "&separate[]=true";
                }
                // Set finding types
                if ("types" in ApeSearch.request_filters) {
                    $.each(ApeSearch.request_filters.types, function (key, value) {
                        params += "&types[]=" + value;
                    });
                }
            }
            // Sort
            if ("using" in ApeSearch) {
                params += "&using=" + ApeSearch.using;
            }

            ApeSearch.request_filters = {};
            ApeSearch.sort = "Relevance";
            if (typeof ApeSearch.term === "undefined") {
                new_route = "/advanced-search/" + section;
            } else {
                var termUrl = encodeURIComponent(ApeSearch.term);
                if(oldSection !== section ) {
                    new_route = "/advanced-search/" + section + "/?term=" + termUrl;
                } else {
                    new_route = "/advanced-search/" + section + "/?term=" + termUrl + params;
                }
            }
            return new_route;
        }

        function generateParamsString() {
            var params = "";
            $.each(ApeSearch.request_filters, function (key, value) {
                $.each(value, function (k, v) {
                    params += "&" + key + "[]=" + v;
                });
            });
            
            var since = "";
            if (ApeSearch.since != null) {
                
                since = "&since=" + ApeSearch.since;
            }
            var query = params + "&using=" + ApeSearch.using + "&sort=" + ApeSearch.sort + "&context=" + ApeSearch.context + "&page=" + ApeSearch.current_page + since;
            if (ApeSearch.tab_target != null) {
                query += "&tab=" + ApeSearch.tab_target;
            }
            return query;
        }

        function updateResults(scrollToTop) {

            if (typeof ApeSearch.term !== "undefined") {

                //$('footer').css("margin-top", "200px");
                $('footer').animate({
                    marginTop: '200px'
                }, 200);

                // Removed timeout to prevent edge case of ajax request completing before timeout finishes
                $('[data-display="loading-spinner"]').show();
                $('[data-section="has_results"]').css("opacity", "0.4");
                

                if (typeof scrollToTop === 'undefined') {
                    scrollToTop = false;
                }
                $.ajax({
                        method: "GET",
                        url: asi_search_url + "?term=" + ApeSearch.term + "&section=" + section + "&sort=" + ApeSearch.sort + "&context=" + ApeSearch.context + "&page=" + ApeSearch.current_page + generateParamsString(),
                    })
                    .done(function (data) {
                        // remove loader and open the tab as soon as possible
                        $('#resultsTabs').removeClass('hidden');
                        $('[data-display="loading-spinner"]').hide();
                        $('[data-section="has_results"]').css("opacity", "1");
                        
                        var response = JSON.parse(data);

                        $('[data-populate="results_count"]').html(ApeSearch.format_number(response.count));
                        $('[data-display="results_count"]').show();
                        
                        if (response.results == null || response.results == undefined) {
                            $(document).find("#noResults").show();
                            
                            return false;
                        }

                        ApeSearch.response_filters = response.filters;
                        $('[data-populate="results_start"]').html(response.start);
                        
                        if (response.count < response.end) {

                            $('[data-populate="results_end"]').html(response.count);
                        } else {
                            $('[data-populate="results_end"]').html(response.end);
                        }
                        if(response.count > 99999) {
                            $('.sortBy').hide();
                        } else {
                            $('.sortBy').show();
                        }
                        
                        $('[data-section="search_results"]').html(response.results);
                        $('[data-section="search_aids"]').html(response.aids);
                        if (section == "search-in-institutions") $('[data-section="inst_search_within"]').html(response.checks);

                        // 'promise cycle'
                        ApeSearch.results_count = response.count;
                        drawFiltersFromResults();
                        if (section == "search-in-archives") {
                            drawContextsFromResults();
                        }
                        updateFilterSummary();
                        calculateTotalpages();
                        refreshPaginationDisplay();
                        getTabTotals();
                        updateSortBy();
                        sortUsings();
                        if (section != "search-in-institutions") {
                            sortDates("starttimespan", "startDate");
                            sortDates("endtimespan", "endDate");
                        }

                        $('footer').css("margin-top", "0");
                        if (scrollToTop == true) {
                            
                            if ($('[data-section="search_results"]').is(':visible')) {
                                
                                var position = $('[data-section="search_results"]').offset();
                                
                                scrollTo(0, (position.top - 160));
                            } else {
                                
                                var position = $('[data-section="search_aids"]').offset();
                                
                                setTimeout(function () {
                                    scrollTo(0, (position.top + 10));
                                }, 1000);
                            }
                        }
                        // $('h3.shaveitem').shave(70);
                        // $('.description').shave(120);

                    })
                    .fail(function() {
                        console.error('Failed to return results');
                        // Show error message 
                        $('#resultsTabs').removeClass('hidden');
                        $(document).find("#noResults").show();
                        $('[data-display="loading-spinner"]').hide();
                        $('[data-section="has_results"]').css("opacity", "1");
                    })
                    .always(function() {
                        // set a time large timeout to take into account large searches
                        $('[data-display="loading-spinner"]').hide();
                        $('[data-section="has_results"]').css("opacity", "1");
                    });

            }
        }

        function ucwords(str, force) {
            return (str + '')
                .replace(/^(.)|\s+(.)/g, function ($1) {
                    return $1.toUpperCase()
                })
        }

        function ucwordsOLD(str, force) {
            str = force ? str.toLowerCase() : str;
            return str.replace(/(\b)([a-zA-Z])/g,
                function (firstLetter) {
                    return firstLetter.toUpperCase();
                });
        }

        function listenForContextFilterClick() {

            $('#contextTab').on("click", '[data-filter-field]', function (event) {
                updateRequestFilter($(this), $(this).hasClass("inactive"));
                updateRequest();
                cycle();
            });
        }

        function drawContextsFromResults() {

            // wipe the context countries
            $('[data-populate="context-view-countries"] div').each(function () {
                $(this).remove();
            });

            if (typeof ApeSearch.request_filters.countries != "undefined") {
                $.each(ApeSearch.response_filters.countries, function (key, value) {

                    var label = ApeSearch.clean_label(key, "countries");

                    // 

                    var active = "inactive";
                    if (filterRequested("countries", key) == true) {
                        var active = "active";
                    }

                    if (value > 0) {
                        var context_country_content = "<div class=\"col-xs-6 col-sm-3 col-md-2\">\n" +
                            "<div data-tile-filter=\"countries\" class=\"countryItem " + active + "\" data-filter-field='countries' data-filter-value='" + key + "'>\n" +
                            "<span class=\"name\">" + label + "</span>\n" +
                            "<span class=\"count\">(" + ApeSearch.format_number(value) + ")</span>\n" +
                            "</div>\n" +
                            "</div>";
                        $('[data-populate="context-view-countries"]').append(context_country_content);
                    }
                });
                // wipe the context institutions
                $('[data-populate="context-view-institutions"] div').each(function () {
                    $(this).remove();
                });

                // now we need to load the insts by country, as by default they will not have the country assigned in facets

                $.each(ApeSearch.request_filters.countries, function (key, value) {

                    var country_label = ApeSearch.clean_label(value, "countries");

                    // ajax load the results by using the request and removing the countries except this one

                    var params = "";
                    $.each(ApeSearch.request_filters, function (key, value) {
                        $.each(value, function (k, v) {
                            if (key != "countries") {
                                params += "&" + key + "[]=" + v;
                            }
                        });
                    });
                    var params = params + "&countries[]=" + value;

                    $.ajax({
                            method: "GET",
                            url: asi_search_url + "?term=" + ApeSearch.term + "&section=" + section + "&sort=" + ApeSearch.sort + "&context=" + ApeSearch.context + "&page=" + ApeSearch.current_page + params,
                        })
                        .done(function (data) {
                            var response = JSON.parse(data);
                            var filters = response.filters;

                            // @TODO - sort moreListInst

                            var counter = 0;
                            var display = "style='display: block'";
                            var output = "<div class='countryList'><h5><i class=\"fas fa-globe-europe\"></i> " + country_label + "</h5><div class='row moreListInst'>";

                            if ("institutions" in filters) {

                                $.each(filters.institutions, function (key, instval) {
    
                                    if (instval > 0) {
                                        var inst_label = ApeSearch.clean_label(key, "institutions");
    
                                        if (counter > 5) {
                                            display = null;
                                        }
    
                                        output += "<div class=\"col-sm-6 col-md-4 item\" " + display + ">\n" +
                                            "<div data-tile-filter=\"institutions\" class=\"institutionItem\" data-filter-field='institutions' data-filter-value='" + key + "'>\n" +
                                            "<span class=\"country\"><i class=\"fas fa-globe-europe\"></i> " + country_label + "</span>\n" +
                                            "<span class=\"name\">" + inst_label + "</span>\n" +
                                            "<span class=\"count\">(" + instval + ")</span>\n" +
                                            "</div>\n" +
                                            "</div>";
    
                                        counter = (counter + 1);
                                    }
                                });
                            }
                            if (counter > 5) {
                                output += "<div class=\"col-xs-12\">\n" +
                                    "<div class=\"text-center mt30\">\n" +
                                    "<a class=\"showMore\">Show more from " + country_label + " <i class=\"far fa-angle-down\"></i></a>\n" +
                                    "<a class=\"showLess\" style='display: none;'>Show less from " + country_label + " <i class=\"far fa-angle-up\"></i></a>\n" +
                                    "</div>\n" +
                                    "</div>";
                            }
                            output += "</div></div>";

                            $('[data-populate="context-view-institutions"]').append(output);
                            $('.institutionItem').matchHeight();
                        });


                });
            }

        }

        function listenForContextShowMore() {

            $('#contextTab').on("click", ".showMore", function (event) {

                $(this).parent().parent().parent().find(".item").each(function (k, y) {
                    $(this).css("display", "block");
                });
                $(this).siblings(".showLess").css("display", "block");
                $(this).css("display", "none");
            });

            $('#contextTab').on("click", ".showLess", function (event) {

                var counter = 0;
                $(this).parent().parent().parent().find(".item").each(function (k, y) {
                    if (counter > 5) $(this).css("display", "none");
                    counter = (counter + 1);
                });
                $(this).siblings(".showMore").css("display", "block");
                $(this).css("display", "none");
            });
        }

        function listenForFilterMoreDropdown() {

            $('[data-facet-set]').on("click", ".moreDropdown > .title", function (event) {
                var parent = $(this).parent();
                if ($(parent).is('.open')) {
                    $(parent).removeClass('open');
                    $(this).text('More')
                } else {
                    $(parent).addClass('open');
                    $(this).text('Less')
                }
            });

            $('[data-g="search-select-countries"]').on("click", ".moreDropdown > .title", function (event) {
                
                
                if (typeof ApeSearch.term === "undefined") {
                    var parent = $(this).parent();
                    
                    if ($(parent).is('.open')) {
                        $(parent).removeClass('open');
                        $(this).text('More')
                    } else {
                        $(parent).addClass('open');
                        $(this).text('Less')
                    }
                }
            });

        }

        function drawFiltersFromResults() {
            var liCounts = {};
            $('#filterSidebar [data-facet-set]').each(function () {
                var set_container_elem = $(this);
                var set_name = $(this).attr('data-facet-set');
                //
                $('#filterSidebar [data-facet-set="' + set_name + '"] .checkboxList').empty();
                var context_country_content = null;
                
                if (typeof ApeSearch.response_filters[set_name] != "undefined") {
                    var filter_counter = 0;
                    $.each(ApeSearch.response_filters[set_name], function (key, value) {

                        var checked = null;
                        if (filterRequested(set_name, key) == true) {
                            var checked = "checked='checked'";
                        }

                        var label = key;
                        label = ApeSearch.clean_label(label, set_name);

                        if (value > 0 || value.count > 0) {
                            var element = "";
                            if (value.count) {
                                ApeSearch.filterTranslations[key] = value.translated;
                                element = "<li class=\"checkbox\" data-facet-item-set=\"" + set_name + "\" data-facet-item=\"" + key + "\" data-search-filter-field='" + key + "'>\n" +
                                    "    <input data-filter-field=\"" + set_name + "\" data-filter-label='" + value.translated + "' data-filter-value=\"" + key + "\" data-filter-type=\"\" type=\"checkbox\" " + checked + " name=\"" + key + "\">\n" +
                                    "    <span>" + value.translated + "</span> <span data-info=\"result_count\">(" + ApeSearch.format_number(value.count) + ")</span>\n" +
                                    "</li>";
                            } else {
                                element = "<li class=\"checkbox\" data-facet-item-set=\"" + set_name + "\" data-facet-item=\"" + key + "\" data-search-filter-field='" + key + "'>\n" +
                                    "    <input data-filter-field=\"" + set_name + "\" data-filter-value=\"" + key + "\" data-filter-type=\"\" type=\"checkbox\" " + checked + " name=\"" + key + "\">\n" +
                                    "    <span>" + label + "</span> <span data-info=\"result_count\">(" + ApeSearch.format_number(value) + ")</span>\n" +
                                    "</li>";
                            }
                            $('#filterSidebar [data-facet-set="' + set_name + '"] .checkboxList').append(element);
                            filter_counter = (filter_counter + 1);
                        }
                    });
                    liCounts[set_name] = $('#filterSidebar [data-facet-set="' + set_name + '"] .checkboxList li').size();
                    var more_container = "<div class='boxrow'><div class='boxcol left'><div id='showMore-" + set_name + "'>Load more</div></div>\n" +
                        "<div class='boxcol right'><div id='showLess-" + set_name + "'>Show less</div></div></div>";
                    $('#filterSidebar [data-facet-set="' + set_name + '"] .checkboxList').append(more_container);
                    liCounts[set_name + '-x'] = 10;
                    // size_li = $(".checkboxList li").size();
                    $('#filterSidebar [data-facet-set="' + set_name + '"] .checkboxList li:lt(' + liCounts[set_name + '-x'] + ')').show();
                    if (liCounts[set_name] < liCounts[set_name + '-x']) {
                        $('#showMore-' + set_name).hide();
                        $('#showLess-' + set_name).hide();
                    }
                    $('#showMore-' + set_name).click(function () {
                        liCounts[set_name + '-x'] = (liCounts[set_name + '-x'] + 10 <= liCounts[set_name]) ? liCounts[set_name + '-x'] + 10 : liCounts[set_name];
                        $('#filterSidebar [data-facet-set="' + set_name + '"] .checkboxList li:lt(' + liCounts[set_name + '-x'] + ')').show();
                        $('#showLess-' + set_name).show();
                        if (liCounts[set_name + '-x'] == liCounts[set_name]) {
                            $('#showMore-' + set_name).hide();
                        }
                        if (liCounts[set_name + '-x'] >= liCounts[set_name]) {
                            $('#showMore-' + set_name).hide();
                        }
                        
                    });
                    $('#showLess-' + set_name).click(function () {
                        
                        
                        
                        liCounts[set_name + '-x'] = (liCounts[set_name + '-x'] - 10 < 10) ? 10 : liCounts[set_name + '-x'] - 10;
                        

                        $('#filterSidebar [data-facet-set="' + set_name + '"] .checkboxList li').not(':lt(' + liCounts[set_name + '-x'] + ')').hide();
                        $('#showMore-' + set_name).show();
                        $('#showLess-' + set_name).show();
                        if (liCounts[set_name + '-x'] == 10) {
                            $('#showLess-' + set_name).hide();
                        }
                    });
                } else {}
            });
            dropdownOpenFilters();
        }

        function update_query_parameters(key, val) {
            uri = window.location.href
                .replace(RegExp("([?&]" + key + "(?=[=&#]|$)[^#&]*|(?=#|$))"), "&" + key + "=" + encodeURIComponent(val))
                .replace(/^([^?&]+)&/, "$1?");
            return uri;
        }

        function updateUrl() {
            var route = getRoute();
            var state;
            var title;
            var url = route;

            if (typeof force_redirect !== 'undefined' && force_redirect == true) {
                //

                return;
                if (ApeSearch.search_clicked == true) {
                    window.location.replace(url);
                }
            } else {
                history.pushState(state, title, url);
            }
        }

        function filterRequested(field_name, field_value) {
            if (typeof ApeSearch.request_filters[field_name] === "undefined") return false;
            if (ApeSearch.request_filters[field_name].indexOf(field_value) != -1) {
                return true;
            }
            return false;
        }

        function listenForSortBy() {

            $('[data-control="sort_by"]').on("click", ".title", function (event) {
                var parent = $(this).parent();
                $(parent).toggleClass('open');
                $(parent).children('.inner').slideToggle(300, 'swing');
            });

            $('[data-control="sort_by"]').on("click", "a", function (event) {
                event.preventDefault();
                ApeSearch.sort = $(this).text();
                updateRequest();
                cycle();
            });
        }

        function listenForUsing() {

            $('[data-control="using"]').on("change", '[data-action="switch-using"]', function (event) {

                if ($(this).prop('checked') == true) {
                    ApeSearch.using = $(this).attr("data-value");
                } else {
                    ApeSearch.using = "default";
                }
                updateRequest();
                cycle();
            });
        }

        function sortUsings() {

            //log("sorting usings...");
            //log(section);

            var all_usings = ApeSearch.all_usings.institutions;
            if (section == "search-in-archives") {
                all_usings = ApeSearch.all_usings.archives;
            }
            if (section == "search-in-names") {
                all_usings = ApeSearch.all_usings.names;
            }

            // data-control="using"

            var content = "";
            $.each(all_usings, function (key, value) {
                var checked = "";
                if (ApeSearch.using == value) {
                    checked = "checked='checked'";
                }
                content += '<li class="checkbox">\n' +
                    '    <input type="checkbox" ' + checked + ' data-action="switch-using" data-value="' + value + '">\n' +
                    '    <span>' + value + '</span>\n' +
                    '</li>';
            });

            $('[data-control="using"]').html(content);
        }

        function sortTypes() {

            log("sorting types...");
            log(section);

            var all_types = ApeSearch.all_types.institutions;
            var set_name = "repositoryTypeFacet";
            if (section == "search-in-archives") {
                all_types = ApeSearch.all_types.archives;
                set_name = "types";
            }
            if (section == "search-in-names") {
                all_types = ApeSearch.all_types.names;
                set_name = "entityTypeFacet";
            }

            var content = "";
            $.each(all_types, function (key, value) {
                var checked = "";

                if (typeof ApeSearch.request_filters['types'] != "undefined") {
                    if (ApeSearch.request_filters.types.includes(value)) {
                        checked = "checked='checked'";
                    }
                } 

                content += '<li class="checkbox">\n' +
                    '    <input type="checkbox" ' + checked + ' data-filter-field="' + set_name + '" data-filter-value="' + value + '">\n' +
                    '    <span>' + ApeSearch.clean_label(value, set_name) + '</span>\n' +
                    '</li>';
            });

            // data-facet-set="types"

            $('[data-control="types"]').html(content);
        }

        function sortCountries() {

            // log("sorting countries...");
            //
            // var all_countries = ApeSearch.all_countries;
            // var set_name = "countries";
            //
            // var filter_counter = 0;
            // var content="";
            // $.each(all_countries, function (key, value) {
            //
            //     var checked = "";
            //     var label = ApeSearch.clean_label(value, set_name);
            //
            //         var element = "<li class=\"checkbox\" data-facet-item-set=\"" + set_name + "\" data-facet-item=\"" + key + "\" data-search-filter-field='" + value + "'>\n" +
            //             "    <input data-filter-field=\"" + set_name + "\" data-filter-value=\"" + value + "\" data-filter-type=\"\" type=\"checkbox\" " + checked + " name=\"" + key + "\">\n" +
            //             "    <span>" + label + "</span> <span data-info=\"result_count\"></span>\n" +
            //             "</li>";
            //         if(filter_counter > ApeSearch.more_after_count) {
            //             $('[data-facet-set="' + set_name + '"] .checkboxList .moreDropdown .inner').append(element);
            //         }
            //         else {
            //             $('[data-facet-set="' + set_name + '"] .checkboxList').append(element);
            //         }
            //         if(filter_counter == ApeSearch.more_after_count) {
            //
            //             // var more_container = "<div class='loadMore'><div class='inner'></div><div class='title'>More</div></div>";
            //             // $('[data-facet-set="' + set_name + '"] .checkboxList').append(more_container);
            //         }
            //         filter_counter = (filter_counter+1);
            //
            // });
            // var country_li_count = $('[data-facet-set="' + set_name + '"] .checkboxList li').size();
            // var more_container = "<div class='boxrow'><div class='boxcol left'><div id='showMore-"+ set_name +"'>Load more</div></div>\n" +
            //     "<div class='boxcol right'><div id='showLess-"+ set_name +"'>Show less</div></div></div>";
            // $('[data-facet-set="' + set_name + '"] .checkboxList').append(more_container);
            //
            // 
            // // size_li = $(".checkboxList li").size();
            // 
            // var country_x = 10;
            // $('[data-facet-set="' + set_name + '"] .checkboxList li:lt('+country_x+')').show();
            // if(country_li_count < country_x) {
            //     $('#showMore-'+ set_name).hide();
            //     $('#showLess-'+ set_name).hide();
            // }
            // $('#showMore-'+ set_name).click(function () {
            //     
            //     country_x= (country_x+10 <= country_li_count) ? country_x+10 : country_li_count;
            //     $('[data-facet-set="' + set_name + '"] .checkboxList li:lt('+country_x+')').show();
            //     $('#showLess-'+ set_name).show();
            //     if(country_x == country_li_count){
            //         $('#showMore-'+ set_name).hide();
            //     }
            //     if(country_x>=country_li_count){
            //         $('#showMore-'+ set_name).hide();
            //     }
            //     
            // });
            // $('#showLess-'+ set_name).click(function () {
            //     
            //     
            //     
            //     country_x=(country_x-10<10) ? 10 : country_x-10;
            //     
            //
            //     $('[data-facet-set="' + set_name + '"] .checkboxList li').not(':lt('+country_x+')').hide();
            //     $('#showMore-'+ set_name).show();
            //     $('#showLess-'+ set_name).show();
            //     if(country_x == 10){
            //         $('#showLess-'+ set_name).hide();
            //     }
            // });
            // //$('[data-control="countries"]').html(content);
        }

        function updateSortBy() {

            var content = "<div class=\"title\">" + ApeSearch.sort + "</div>";
            content += "<div class=\"inner\">";

            var all_sorts = ApeSearch.all_sorts.institutions;
            if (section == "search-in-archives") {
                all_sorts = ApeSearch.all_sorts.archives;
            }
            if (section == "search-in-names") {
                all_sorts = ApeSearch.all_sorts.names;
            }

            $.each(all_sorts, function (key, value) {
                if (value != ApeSearch.sort) {
                    content += "<a href='#'>" + value + "</a>";
                }
            });
            content += "</div>";
            $('[data-control="sort_by"]').html(content);
            return true;
        }

        function dropdownOpenFilters() {
            $('.contentDropdown[data-g]').each(function () {
                var dropdown = $(this);
                var filterElems = dropdown.find("[data-filter-field]");
                $.each(filterElems, function () {
                    var count = 0;
                    if ($(this).prop('checked') == true) {
                        if (!dropdown.hasClass('open')) {
                            dropdown.addClass('open');
                            dropdown.children('.inner').slideToggle(300, 'swing');
                        }
                        // @TODO - refactor (add atts) - this looks expensive
                        if ($(this).attr('data-filter-type') == "date_range") {
                            $(this).parent().parent().parent().parent().removeClass('disabled');
                            $(this).parent().parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().css('display', 'block');
                        } else {
                            return false;
                        }
                    }
                });
            });

            $('[data-facet-set] .moreDropdown').each(function () {
                var dropdown = $(this);
                var filterElems = dropdown.find("[data-filter-field]");
                $.each(filterElems, function () {
                    var count = 0;
                    if ($(this).prop('checked') == true) {
                        if (!dropdown.hasClass('open')) {
                            dropdown.addClass('open');
                            dropdown.find('.title').text('Less')
                            //dropdown.children('.inner').slideToggle(300, 'swing');
                        }
                    }
                });
            });

        }

        function listenForSearchButton() {
            $('[data-control="search_term_trigger"]').click(function (event) {
                event.preventDefault();

                $('#advSearchControls').hide();
                term = $('[data-input="search_term"]').val();
                if (term == "") {
                    
                    alert("Please enter a search term");
                    return false;
                } else {
                    ApeSearch.search_clicked = true;
                    if ($(this).attr('data-switch-to') == "archive") {
                        ApeSearch.term = term;
                        var url = getNewRoute();
                        url = appendHomepageDates(url);
                        window.location.href = url;
                    } else {
                        ApeSearch.term = term;
                        var url = getNewRoute();
                        window.location.href = url;
                        // updateRequest();
                        // cycle();
                    }
                }
            });
        }

        function appendHomepageDates(url) {
            var date_from = $('[data-input-type="homepage_date_from"]').val();
            var date_to = $('[data-input-type="homepage_date_to"]').val();
            if (date_from.length) {
                if (date_from != "") {
                    
                    url += buildDateUrlQueryString(date_from, "starttimespan");
                }
            }
            if (date_to.length) {
                if (date_to != "") {
                    
                    url += buildDateUrlQueryString(date_to, "endtimespan");
                }
            }
            return url;
        }

        function buildDateUrlQueryString(date_string, name) {
            var parts = date_string.split('/');
            var year_string = parts[2];
            var c = year_string.substring(2, 0) + "00";
            var d = year_string.substring(3, 0) + "0";
            var y = year_string;
            return "&" + name + "_c[]=" + c + "&" + name + "_d[]=" + d + "&" + name + "_y[]=" + y;
        }

        function listenForSearchFieldFocus() {

            $('[data-input="search_term"]').focusout(function () {
                setTimeout(function () {
                    $('[data-interface="suggestions"]').delay(200).removeClass('open');
                }, 500);
            });



            $('[data-input="search_term"]').on("keyup", function (e) {

                $('[data-input="search_term"]').on("keyup", function (e) {
                    e.stopPropagation();
                });

                var temp_term = $('[data-input="search_term"]').val();
                var term_length = temp_term.length;
                if (term_length > 3) {

                    $('[data-populate="term"]').html(temp_term);
                    populateDidyoumeans(temp_term);
                    //updateSuggestionCounts();
                    //populateSectionSuggests(temp_term);
                    setTimeout(function () {
                        populateSectionSuggests(temp_term);
                    }, 500);
                    populateTopicSuggests(temp_term);
                    populateSpellingSuggests(temp_term);
                }
                if (e.keyCode == 13) {
                    $('[data-interface="suggestions"]').removeClass('open');
                }
            });
        }

        function populateSectionSuggests(temp_term) {
            
            var encodedTerm = encodeURIComponent(temp_term);
            var all_sections = ["search-in-archives", "search-in-names", "search-in-institutions"];
            $('[data-count-type="' + section + '"]').html("(" + ApeSearch.format_number(ApeSearch.results_count) + ")");

            var items = [];
            var archiveSuggestions = '',
                institutionSuggestions = '',
                nameSuggestions = '';
            $.each(all_sections, function (key, value) {
                $.ajax({
                        method: "GET",
                        url: asi_search_url + "?term=" + temp_term + "&section=" + value + "&sort=" + ApeSearch.sort + "&context=" + ApeSearch.context + "&page=" + ApeSearch.current_page + generateParamsString(),
                    })
                    .done(function (data) {

                        var response = JSON.parse(data);
                        var icon = "fa-book";
                        if (value == "search-in-archives") {
                            icon = "fa-book";
                        }
                        if (value == "search-in-names") {
                            icon = "fa-user";
                        }
                        if (value == "search-in-institutions") {
                            icon = "fa-building";
                        }
                        var record = "<a class=\"entry\" href=\"/advanced-search/" + value + "/?term=" + encodedTerm + "\"><strong data-populate=\"term\" data-action=\"update_term\" data-template=\"City of %\">" + temp_term + "</strong> <i class=\"fas " + icon + "\"></i> <span data-populate=\"suggestion_count_archives\">" + response.count + "</span></a>";
                        if (value == "search-in-archives") {
                            
                            archiveSuggestions = record;
                        }
                        if (value == "search-in-names") {
                            nameSuggestions = record;
                        }
                        if (value == "search-in-institutions") {
                            institutionSuggestions = record;
                        }
                        items.push("<a class=\"entry\" href=\"/advanced-search/" + value + "/?term=" + temp_term + "\"><strong data-populate=\"term\" data-action=\"update_term\" data-template=\"City of %\">" + temp_term + "</strong> <i class=\"fas " + icon + "\"></i> <span data-populate=\"suggestion_count_archives\">" + response.count + "</span></a>");

                        if (items.length > 2) {
                            $('[data-populate="section_suggest"]').empty();
                            // $('[data-populate="section_suggest"]').append(items.join(""));
                            $('[data-populate="section_suggest"]').append(archiveSuggestions);
                            $('[data-populate="section_suggest"]').append(nameSuggestions);
                            $('[data-populate="section_suggest"]').append(institutionSuggestions);
                            items = [];
                            $('[data-container="section_suggest"]').show();
                        } else {
                            $('[data-container="section_suggest"]').hide();
                        }

                        //$('[data-count-type="'+value+'"]').html("("+response.count+")");
                    });
            });


        }

        function populateTopicSuggests(temp_term) {

            $.ajax({
                    method: "GET",
                    url: "/asi-ajax/?action=load_topic_suggest&term=" + temp_term,
                })
                .done(function (data) {

                    var response = JSON.parse(data);
                    var icon = "fa-file";
                    var items = [];

                    $.each(response.result, function (key, value) {
                        items.push("<a class=\"entry\" href=\"/" + value.link + "\"><strong>" + value.title + "</strong> <i class=\"fas " + icon + "\"></i></a>");
                    });
                    if (items.length > 0) {

                        $('[data-populate="topic_suggest"]').empty();
                        $('[data-populate="topic_suggest"]').append(items.join(""));
                        $('[data-container="topic_suggest"]').show();
                        // data-container="spelling_suggest"
                    } else {
                        $('[data-container="topic_suggest"]').hide();
                    }


                    //$('[data-count-type="'+value+'"]').html("("+response.count+")");
                });
        }

        function populateSpellingSuggests(temp_term) {
            
            
            

            $.ajax({
                    method: "GET",
                    url: "/asi-ajax/?action=spell&term=" + temp_term + "&section=" + section,
                })
                .done(function (data) {

                    

                    var response = JSON.parse(data);
                    var icon = "fa-file";
                    var items = [];

                    $.each(response.result, function (key, value) {
                        items.push("<a class=\"entry\" href=\"" + value.link + "\"><strong>" + value.title + "</strong> <i class=\"fas " + icon + "\"></i></a>");
                    });
                    if (items.length > 0) {
                        $('[data-populate="spelling_suggest"]').empty();
                        $('[data-populate="spelling_suggest"]').append(items.join(""));
                        $('[data-container="spelling_suggest"]').show();
                    } else {
                        $('[data-container="spelling_suggest"]').hide();
                    }

                    //$('[data-count-type="'+value+'"]').html("("+response.count+")");
                });
        }

        function randomiseWord(string) {

            if (typeof string == "undefined" || string.length < 1) {
                return;
            }
            var letters = "abcdefghijklmnopqrstuvwxyz";
            var strArray = string.split('');
            var lettersArray = letters.split('');
            for (var i = 0; i < 1; i++) {
                var pos1 = Math.round(Math.random() * (string.length - 1));
                var pos2 = Math.round(Math.random() * (letters.length - 1));
                strArray[pos1] = lettersArray[pos2];
            }
            return strArray.join("");
        }

        function populateDidyoumeans() {

            $.ajax({
                    method: "GET",
                    url: "/asi-ajax/?action=suggest&term=" + ApeSearch.term + "&section=" + section,
                })
                .done(function (data) {

                    

                    var response = JSON.parse(data);
                    var icon = "fa-file";
                    var items = [];

                    $.each(response.result, function (key, value) {
                        items.push("<a href=\"" + value.link + "\">" + value.title + "</a>");
                    });
                    if (items.length > 0) {
                        $('[data-populate="did_you_mean"]').empty();
                        $('[data-populate="did_you_mean"]').append(items.join(""));
                        $('[data-container="did_you_mean"]').show();
                    } else {
                        $('[data-container="did_you_mean"]').hide();
                    }

                    //$('[data-count-type="'+value+'"]').html("("+response.count+")");
                });

        }

        function updateSuggestionCounts() {
            $('[data-info="result_count"]').each(function () {
                var type = $(this).attr('data-count-type');
                if (type == "suggest_city") {
                    var n = Math.floor((Math.random() * 100) + 1);
                    $(this).text('(' + n + ')');
                }
                if (type == "suggest_name") {
                    var n = Math.floor((Math.random() * 100) + 1);
                    $(this).text('(' + n + ')');
                }
                if (type == "suggest_topic") {
                    var n = Math.floor((Math.random() * 100) + 1);
                    $(this).text('(' + n + ')');
                }
            });
        }

        function listenForLinkClicks() {

            $('[data-action="update_term"]').click(function (event) {
                event.stopPropagation();
                $('[data-input="search_term"]').stop();
                event.preventDefault();
                term = $(this).text();

                if ($(this)[0].hasAttribute("data-template")) {
                    term = $(this).attr('data-template').replace("%", term);
                }

                $('[data-input="search_term"]').val(term);
                ApeSearch.term = term;
                updateRequest();
                ApeSearch.current_page = 1;
                cycle();
            });
        }

        function hasFilters() {
            var filters = ApeSearch.request_filters;
            var response = false;
            $.each(filters, function (key, value) {
                if (value.length > 0) {
                    response = true;
                }
            });
            return response;
        }

        function updateFilterSummary() {
            if (hasFilters()) {
                $('[data-g="filter-summary"] p a').remove();
                $.each(ApeSearch.request_filters, function (key, value) {
                    $.each(value, function (k, v) {
                        
                        $('[data-g="filter-summary"] p').append('<a data-g="filter-summary-item" data-g-entity="' + key + '" data-g-value="' + v + '" href="#">' + ApeSearch.clean_label(v, key) + ' <i class="far fa-times ml"></i></a>');
                    });
                });
                $('[data-g="filter-summary"]').show();
            } else {
                $('[data-g="filter-summary"]').hide();
            }
        }

        function listenForFilterSummaryClears() {
            $('[data-g="filter-summary"] p').on("click", "a", function (event) {
                event.preventDefault();
                removeFilter($(this).attr('data-g-entity'), $(this).attr('data-g-value'));
                updateRequest();
                cycle();
            });
        }

        function removeFilter(field_name, field_value) {

            var params = ApeSearch.request_filters;

            if (Array.isArray(params[field_name])) {
                var index = params[field_name].indexOf(field_value);
                if (params[field_name].indexOf(field_value) != -1) {
                    params[field_name].splice(index, 1);
                }
            }
        }

        function listenForPagination() {

            $('[data-control="pagination"]').on("click", '[data-paginate]', function (event) {
                event.preventDefault();
                var value = $(this).attr('data-paginate');
                if (value == "pages") return;
                log('page value is ' + value);

                var current_page = parseInt(ApeSearch.current_page);

                switch (value) {
                    case "first":
                        current_page = 1;
                        break;
                    case "prev":
                        var thePageWas = current_page;
                        current_page = (thePageWas - 1);
                        break;
                    case "last":
                        current_page = parseInt(ApeSearch.pages);
                        break;
                    case "next":

                        if (current_page == parseInt(ApeSearch.pages)) return;

                        var thePageWas = current_page;
                        current_page = (thePageWas + 1);
                        break;
                    default:
                        var newPage = parseInt(value);
                        current_page = newPage;
                        break;
                }

                ApeSearch.current_page = current_page;

                updateRequest();
                cycle(true);
            });
        }

        function refreshPaginationDisplay() {

            var i;
            var pageItemsHtml = "";
            var current_page = parseInt(ApeSearch.current_page);
            var total_pages = parseInt(ApeSearch.pages);

            if (total_pages < 2) {
                $('[data-control="pagination"]').hide();
            } else {
                $('[data-control="pagination"]').show();
            }
            var start_page = 1;
            var last_page = 10;

            if (total_pages < last_page) last_page = total_pages;

            if (current_page > 5) {
                start_page = (current_page - 5);
                last_page = (current_page + 5);
                if (start_page > (total_pages - 10)) start_page = (total_pages - 10);
                if (last_page > total_pages) last_page = total_pages;
            }
            ApeSearch.start_page = start_page;
            ApeSearch.last_page = last_page;
            for (i = start_page; i < (last_page + 1); i++) {
                if (i == current_page) {
                    pageItemsHtml += "<li class='active'><a data-paginate='" + i + "' href='#'>" + i + "</a></li>";
                } else {
                    pageItemsHtml += "<li><a data-paginate='" + i + "' href='#'>" + i + "</a></li>";
                }
            }
            $('[data-paginate="pages"]').html(pageItemsHtml);
            if (current_page == last_page) {
                
                $('[data-paginate="last"], [data-paginate="next"]').hide();
            } else {
                $('[data-paginate="last"], [data-paginate="next"]').show();
            }
            if (current_page == start_page) {
                
                $('[data-paginate="first"], [data-paginate="prev"]').hide();
            } else {
                $('[data-paginate="first"], [data-paginate="prev"]').show();
            }
        }

        function calculateTotalpages() {
            var total_results = parseInt(ApeSearch.results_count);
            ApeSearch.pages = Math.ceil((total_results / 10));
        }

        function listenForFilterFind() {

            $("body").on("keyup", '[data-g="search-filter"]', function (event) {

                

                var filter_target = $(this).attr('data-search-target');
                var targetElems = $('[data-facet-item-set="' + filter_target + '"]');

                
                

                var term = $(this).val().toLowerCase();
                var n = term.length;

                
                

                if (n == 0) {
                    targetElems.removeClass('hidden');
                    return;
                }
                //TODO JUSTIN
                $('[data-facet-item-set="' + filter_target + '"] .moreDropdown').addClass("open");

                targetElems.each(function () {

                    //

                    var elem = $(this);
                    elem.addClass('hidden');
                    var field = $(this).attr('data-search-filter-field');
                    var limit = field.length;

                    var i;
                    for (i = 0; i <= limit; i++) {

                        var end = (i + n);
                        var check = field.substring(i, end).toLowerCase();

                        if (term == check) {
                            if (elem.css('display') == 'none') {
                                elem.show();
                            }
                            elem.removeClass('hidden');
                            return;
                        }
                    }
                });
            });

        }

        function listenForSearchTabSwitch() {

            $('[data-navigate]').click(function (event) {
                event.preventDefault();
                oldSection = section;
                section = $(this).attr('data-navigate');
                var url = getNewRoute();
                window.location.href = url;
            });
        }

        function getTabTotals() {

            var all_sections = ["search-in-archives", "search-in-names", "search-in-institutions"];
            $('[data-count-type="' + section + '"]').html("(" + ApeSearch.format_number(ApeSearch.results_count) + ")");

            $.each(all_sections, function (key, value) {
                if (value != section) {
                    $.ajax({
                            method: "GET",
                            url: asi_search_url + "?term=" + ApeSearch.term + "&section=" + value + "&sort=" + ApeSearch.sort + "&context=" + ApeSearch.context + "&page=" + ApeSearch.current_page + generateParamsString(),
                        })
                        .done(function (data) {
                            var response = JSON.parse(data);
                            $('[data-count-type="' + value + '"]').html("(" + ApeSearch.format_number(response.count) + ")");
                        });
                }
            });
        }

        ApeSearch.format_number = function (number) {
            return new Intl.NumberFormat(js_locale).format(number);
        }

        ApeSearch.clean_label = function (label, set_name) {
            translate = false;
            translateText = label;
            if (ApeSearch.filterTranslations[label]) {
                translateText = ApeSearch.filterTranslations[label];
                
                translate = true;
                return translateText;
            }

            if (label.indexOf(':') > -1) {
                var bits = label.split(":");
                label = bits[0];
            }
            label = label.replace("_", " ");
            label = label.replace("_", " ");
            label = ucwords(label, true);

            if (label == "Containsdigital") label = "Contains Digital";

            // @TODO - refactor label cleans into other function

            // clean up labels (containsdigital)
            if (set_name == "containsdigital") {
                switch (label) {
                    case "True":
                        label = "Digital objects only";
                        break;
                    default:
                        // keep the original label
                }
            }

            // clean up labels (containsdigital)
            if (set_name == "repositoryTypeFacet") {
                label = label.replace("archives", "");
            }

            // clean up labels (separate)
            if (set_name == "separate") {
                switch (label) {
                    case "True":
                        label = "Separate Terms";
                        break;
                    default:
                        // keep the original label
                }
            }

            // clean up labels (doc type)
            if (set_name == "types") {
                switch (label) {
                    case "Fa":
                        label = "Finding Aid";
                        break;
                    case "Hg":
                        label = "Holdings Guide";
                        break;
                    case "Sg":
                        label = "Source Guide";
                        break;
                    default:
                        // keep the original label
                }
            }

            // clean up labels (levels)
            if (set_name == "levels") {
                switch (label) {
                    case "Clevel":
                        label = "C Level";
                        break;
                    case "Archdesc":
                        label = "Archive Description";
                        break;
                    default:
                        // keep the original label
                }
            }

            // clean up labels (contains digital)
            if (set_name == "containsdigital") {
                switch (label) {
                    case "False":
                        label = "No digital objects";
                        break;
                    case "True":
                        label = "Contains digital objects";
                        break;
                    default:
                        // keep the original label
                }
            }

            // clean up labels (date types)
            if (set_name == "datetypes") {
                switch (label) {
                    case "Otherdate":
                        label = "Other Date";
                        break;
                    case "Nodate":
                        label = "No Date";
                        break;
                    default:
                        // keep the original label
                }
            }

            // clean up labels (topic)
            if (set_name == "topics") {
                switch (label) {
                    case "First.World.War":
                        label = "First World War (1914-1918)";
                        break;
                    case "Second.World.War":
                        label = "Second World War (1939-1945)";
                        break;
                    case "Civil.Wars.Events":
                        label = "Civil wars (events)";
                        break;
                    case "French.Revolution":
                        label = "French Revolution (1789-1799)";
                        break;
                    case "French.Revolutionary.Wars":
                        label = "French Revolutionary Wars (1792-1800)";
                        break;
                    case "French.Napoleon.I":
                        label = "Napoléon I, Emperor of the French, 1769-1821";
                        break;
                    case "French.Napoleon.Iii":
                        label = "Napoléon III, Emperor of the French, 1808-1873";
                        break;
                    case "Napoleonic.Wars":
                        label = "Napoleonic Wars (1800-1815)";
                        break;
                    case "Wars.Events":
                        label = "Wars (events)";
                        break;
                    case "Germany.Sed.Fdgb":
                        label = "GDR parties and trade unions";
                        break;
                    case "German.Democratic.Republic":
                        label = "GDR (German Democratic Republic)";
                        break;
                    default:
                        label = label.replace(/\./g, " ");
                }
            }

            // clean up labels (entityTypeFacet)
            if (set_name == "entityTypeFacet") {
                switch (label) {
                    case "Corporatebody":
                        label = "Corporate Body";
                        break;
                    default:
                        // keep the original label
                }
            }

            // clean up labels (datetypes)
            if (set_name == "datetypes") {
                switch (label) {
                    case "Unknownstartdate":
                        label = "Unknown Start Date";
                        break;
                    case "Unknowndate":
                        label = "Unknown Date";
                        break;
                    case "Unknownenddate":
                        label = "Unknown End Date";
                        break;
                    default:
                        // keep the original label
                }
            }

            return label;
        }

        ApeSearch.getRoute = function () {
            return getRoute();
        }

    }(window.ApeSearch = window.ApeSearch || {}, jQuery));

    ApeSearch.init();
    size_li = $(".checkboxList li").size();
    x = 10;
    $('.checkboxList li:lt(' + x + ')').show();
    $('#loadMore').click(function () {
        x = (x + 10 <= size_li) ? x + 10 : size_li;
        $('.checkboxList li:lt(' + x + ')').show();
        $('#showLess').show();
        if (x >= size_li) {
            $('#loadMore').hide();
        }
    });
    $('#showLess').click(function () {
        x = (x - 10 < 10) ? 10 : x - 10;
        $('.checkboxList li').not(':lt(' + x + ')').hide();
        $('#loadMore').show();
        $('#showLess').show();
        if (x <= 10) {
            $('#showLess').hide();
        }
    });
}