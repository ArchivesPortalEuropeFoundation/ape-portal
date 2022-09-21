if (typeof enable_institution_search !== 'undefined') {

// global settings and placeholders
    var asi_debug = false;
    var landscape_search_url = "/find-landscapes";
    var results_search_url= "/find-results";
    var filters = new Array();
    var term = null;
    var sort = "Relevance";
    var pages = 5;
    var current_page = 1;

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
    });

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
                return true;
            }else {
                alert("Please select at least 1 country");
                return null;
            }
        })

        $('[data-section="results"] .toggleShow').click(function(event){
            log('attempting to open results...');
            event.stopPropagation();
            event.preventDefault();
            if(aCountryIsSelected() == true) {
                return true;
            }else {
                alert("Please select at least 1 Archival Landscape");
                return null;
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
        log(landscape_search_url);
        log(getCountryFilters());
        $.ajax({
            method: "GET",
            url: landscape_search_url,
            data: {
                countries: getCountryFilters(),
            }
        })
            .done(function(data) {
                $('[data-results="landscapes"]').html(data);
            });
    }

    function updateResults() {

        log("Updating final results...");
        $.ajax({
            method: "GET",
            url: results_search_url,
            data: {
                countries: getCountryFilters(),
                landscapes: getLandscapeFilters(),
            }
        })
            .done(function(data) {
                $('[data-results="results"]').html(data);
                forceDropdown('results');
            });
    }

    function getCountryFilters() {
        var selectedCountries = [];
        $.each(filters, function(key, value) {
            log(key +' - '+ value);
            log(value);
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
        log(selectedLandscapes);
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
        //
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
