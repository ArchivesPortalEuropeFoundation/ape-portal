if (typeof enable_search !== 'undefined') {

    // startup functions ///////////////////////////////////////////////////////////////

    // global settings and placeholders
    const asi_debug = true;
    const asi_search_url = "/get-results";
    var filters = new Array();
    var term = null;
    var sort = "Relevance";
    var pages = 5;
    var current_page = 1;
    // @NOTE - section is set in the page template

    /*
    $('.contextDropdown .toggleShow').click(function() {
        var parent =  $(this).parents('.title');
        var toggleText = $(this).children('span');
        $(parent).toggleClass('closed');
        $(parent).siblings('.inner').slideToggle(300,'swing');
        if ($(parent).is('.closed')) {
            $(toggleText).text('Show');
        } else {
            $(toggleText).text('Hide');
        }
    });
     */

// onload
    $(function () {
        log("JS is listening....");
        updateFilters();
        dropdownOpenFilters();
        updateFilterSummary();
        checkTerm();
        listenForFilterSummaryClears();
        updateResults();
        listenForSearchButton();
        listenForLinkClicks();
        listenForSearchFieldFocus();
        listenForSortBy();
        listenForResultDropdownMore();
        listenForPagination();
        listenForSearchSwitch();
        listenForSaveSearch();
        listenForDateDropCascade();
        listenForCheckboxes();
        listenForDropdownOn();
    });

    function updateTabCounts() {
        $('[data-info="result_count"]').each(function () {
            var type = $(this).attr('data-count-type');
            if (type == "archives") {
                var n = Math.floor((Math.random() * 10000) + 1);
                $(this).text('(' + n + ')');
            }
            if (type == "names") {
                var n = Math.floor((Math.random() * 100) + 1);
                $(this).text('(' + n + ')');
            }
            if (type == "institutions") {
                var n = Math.floor((Math.random() * 10) + 1);
                $(this).text('(' + n + ')');
            }
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

    function updateFilterCounts() {
        $('[data-info="result_count"]').each(function () {
            var type = $(this).attr('data-count-type');
            if (type == "archives") {
                var n = Math.floor((Math.random() * 100) + 1);
                $(this).text('(' + n + ')');
            }
        });
    }


    function fakeWhittle(exceptField) {

        // data-filter-field="[[!+filter_field]]"
        var counter = 1;
        $('[data-filter-field]').each(function () {

            if ($(this).attr('data-filter-field') != exceptField && $(this).prop('checked') != "1") {
                if (counter == 7) {
                    $(this).parent().hide();
                    counter = 1;
                } else {
                    counter = (counter + 1);
                }
            }
        });
    }

    function listenForDropdownOn() {

        $('[data-section="search_results"]').on("click", '.searchResult.institution .contentDropdown > .title, .searchResult.name .contentDropdown > .title', function (event) {
            var parent = $(this).parent();
            $(parent).toggleClass('open');
            $(parent).children('.inner').slideToggle(300, 'swing');
        });
    }

    function forceFilterChecks(elem, state) {

        var findField = elem.attr('data-filter-field');
        var findVal = elem.attr('data-filter-value');

        if (state == "0") {
            removeFilter(findField, findVal);
        }

        log("forcing all " + findField + " = " + findVal + " to " + state);

        $('[data-control="checkbox_filters"]').each(function () {
            var checkField = $(this).attr('data-filter-field');
            var checkValue = $(this).attr('data-filter-value');
            if (findField == checkField && findVal == checkValue) {
                $(this).prop('checked', state);
            }
        });
    }

    function listenForCheckboxes() {

        log('listening for checkbox clicks...');

        $('[data-filter-field]').click(function (event) {

            log('filter check has been clicked (' + $(this).prop('checked') + ')...');

            if ($(this).prop('checked') == "0") {
                forceFilterChecks($(this), 0); // this is to fix the dupe filter issue
            }

            if ($(this).prop('checked') == "1") {
                forceFilterChecks($(this), 1); // this is to fix the dupe filter issue
            }

            updateSearchResults();
        })
    }

    function listenForLinkClicks() {

        log('listening for clicks...');

        $('[data-action="update_term"]').click(function (event) {
            event.stopPropagation();
            $('[data-input="search_term"]').stop();
            event.preventDefault();
            term = $(this).text();

            if ($(this)[0].hasAttribute("data-template")) {
                term = $(this).attr('data-template').replace("%", term);
            }

            $('[data-input="search_term"]').val(term);
            updateSearchResults();
        });
    }

    function listenForDateDropCascade() {

        cascadeDateDrop();
        $('[data-filter-type="date_range"]').click(function (event) {
            cascadeDateDrop();
        })
    }

    function cascadeDateDrop() {

        $('.contentDropdown[data-g]').each(function () {
            var noCheckedDates = true;

            var dropdown = $(this);
            var filterElems = dropdown.find("[data-filter-field]");

            $.each(filterElems, function () {

                if ($(this).prop('checked') == true) {

                    // if it's a date sub dropdowndown, make the next one open
                    if ($(this).attr('data-filter-type') == "date_range") {
                        $(this).parent().parent().parent().parent().next().removeClass('disabled');
                        $(this).parent().parent().parent().parent().next().addClass('open');
                        $(this).parent().parent().parent().parent().next().children('.inner').css('display', 'block');
                        noCheckedDates = false;
                    } else {
                        noCheckedDates = false; // this is not a date anyway
                        return false;
                    }
                }
            });
            if (noCheckedDates == true) {
                // none open - make sure the next one is closed

            }
        });
    }

    function listenForSaveSearch() {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;

        $('[data-trigger="save_search"]').click(function (event) {

            if ($('[data-populate="save_search_name"]').val() == "") {
                $('[data-populate="save_search_name"]').val(term);
            }

            if ($('[data-populate="save_search_description"]').val() == "") {
                $('[data-populate="save_search_description"]').val("Search for '" + term + "' in archives on " + today);
            }

            var params = "";
            $.each(filters, function (key, value) {
                params += "<li><strong>" + value.field + "</strong> " + value.value + "</li>";
            });
            $('[data-populate="save_search_parameters"]').html(params);

        })
    }

    function listenForSearchSwitch() {

        $('[data-navigate]').click(function (event) {
            event.preventDefault();
            section = $(this).attr('data-navigate');
            var url = getRoute();
            window.location.href = url;
        });
    }

    function listenForPagination() {

        // first populate the items
        refreshPaginationDisplay();

        // now listen for a click
        $('[data-control="pagination"]').on("click", '[data-paginate]', function (event) {
            event.preventDefault();
            var value = $(this).attr('data-paginate');

            if (value == "pages") return;

            log('page value is ' + value);

            switch (value) {
                case "first":
                    current_page = 1;
                    break;
                case "prev":
                    var thePageWas = current_page;
                    current_page = (thePageWas - 1);
                    break;
                case "last":
                    current_page = pages;
                    break;
                case "next":
                    var thePageWas = current_page;
                    current_page = (thePageWas + 1);
                    break;
                default:
                    var newPage = parseInt(value);
                    current_page = newPage;
                    break;
            }
            refreshPaginationDisplay();
            updateSearchResults(true);
        });
    }

    function refreshPaginationDisplay() {

        var i;
        var pageItemsHtml = "";
        for (i = 1; i < (pages + 1); i++) {
            if (i == current_page) {
                pageItemsHtml += "<li class='active'><a data-paginate='" + i + "' href='#'>" + i + "</a></li>";
            } else {
                pageItemsHtml += "<li><a data-paginate='" + i + "' href='#'>" + i + "</a></li>";
            }
        }
        $('[data-paginate="pages"]').html(pageItemsHtml);
    }

    function listenForResultDropdownMore() {

        $('[data-section="search_results"]').on("click", '[data-control="result-dropdown-more"]', function () {
            log("Result more dropdown clicked...");
            $(this).children('.inner').toggle();
        });
    }

    function listenForSortBy() {

        $('[data-control="sort_by"] .title').text(sort);

        $('[data-control="sort_by"] a').click(function (event) {
            event.preventDefault();
            sort = $(this).text();
            $('[data-control="sort_by"] .title').text(sort);
            $('[data-control="sort_by"]').removeClass('open');
            updateSearchResults();
        });
    }

    function checkTerm() {
        term = $('[data-input="search_term"]').val();
        log('checking if results should be open...');

        // open results if term present
        if (term != "") {
            log('term is present');
            $('[data-section="has_results"]').removeClass("hidden");
            populateDidyoumeans(term);
            updateTabCounts();
        }
        // open results if topic present
        if (filterExists('topics')) {
            log('topic filter exists');
            $('[data-section="has_results"]').removeClass("hidden");
            updateTabCounts();
        }
    }

    function listenForSearchFieldFocus() {

        $('[data-input="search_term"]').focusout(function () {
            setTimeout(function () {
                log('focus out...');
                $('[data-interface="suggestions"]').delay(200).removeClass('open');
            }, 500);
        });

        $('[data-input="search_term"]').on("keyup", function (e) {

            var temp_term = $('[data-input="search_term"]').val();

            $('[data-populate="term"]').html(temp_term);

            populateDidyoumeans(temp_term);
            updateSuggestionCounts();

            if (e.keyCode == 13) {
                $('[data-interface="suggestions"]').removeClass('open');
            }
        });
    }

    function randomiseWord(string) {

        var letters = "abcdefghijklmnopqrstuvwxyz";

        var strArray = string.split('');
        var lettersArray = letters.split('');

        for (var i = 0; i < 1; i++) {
            var pos1 = Math.round(Math.random() * (string.length - 1));
            var pos2 = Math.round(Math.random() * (letters.length - 1));
            strArray[pos1] = lettersArray[pos2];
        }
        return strArray.join("") + " (" + Math.floor((Math.random() * 10000) + 1) + ")";
    }

    function populateDidyoumeans(string) {

        $('[data-populate="did_you_mean_1"]').html(randomiseWord(string));
        $('[data-populate="did_you_mean_2"]').html(randomiseWord(string));
        $('[data-populate="did_you_mean_3"]').html(randomiseWord(string));
        $('[data-populate="did_you_mean_4"]').html(randomiseWord(string));
        $('[data-populate="did_you_mean_5"]').html(randomiseWord(string));
        $('[data-populate="did_you_mean_6"]').html(randomiseWord(string));

    }

    function listenForSearchButton() {
        $('[data-control="search_term_trigger"]').click(function (event) {
            event.preventDefault();
            log('search button clicked...');
            term = $('[data-input="search_term"]').val();
            log('term is: ' + term);
            if (term == "") {
                alert("Please enter a search term");
                return false;
            } else {
                if ($(this).attr('data-switch-to') == "archive") {
                    var url = getRoute();
                    window.location.href = url;
                } else {
                    updateSearchResults();
                    $('[data-section="has_results"]').removeClass("hidden");
                    updateTabCounts();
                }
            }
        });
    }

// general logging function
    function log(msg) {
        if (asi_debug == true) console.log(msg);
    }

// drops down any filters in action
    function dropdownOpenFilters() {
        log('Dropping down any active filters...');

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

                    // if it's a date sub dropdowndown, make it open
                    if ($(this).attr('data-filter-type') == "date_range") {
                        log("found one! ");
                        console.log($(this));
                        $(this).parent().parent().parent().parent().removeClass('disabled');
                        $(this).parent().parent().parent().parent().addClass('open');
                        $(this).parent().parent().parent().css('display', 'block');
                    } else {
                        return false;
                    }
                }
            });
        });
    }

// updates the list of filters at the top
    function updateFilterSummary() {
        log('Updating filter summary...');
        $('[data-g="filter-summary"] p a').remove();
        $.each(filters, function (key, value) {
            $('[data-g="filter-summary"] p').append('<a data-g="filter-summary-item" data-g-entity="' + value.field + '" data-g-value="' + value.value + '" href="#">' + ApeSearch.clean_label(v, key) + ' <i class="far fa-times ml"></i></a>');
        });
    }

// listens for someone clicking X in the filter summary and deals with it
    function listenForFilterSummaryClears() {
        $('[data-g="filter-summary"] p').on("click", "a", function (event) {
            event.preventDefault();
            removeFilter($(this).attr('data-g-entity'), $(this).attr('data-g-value'));
        });
    }

// removes a filter from the global filter array and refreshes everything
    function removeFilter(entity, checkValue) {
        log("Removing filter {entity: '" + entity + "', value: '" + checkValue + "}'");
        $.each(filters, function (key, value) {
            if (typeof value != "undefined") {
                log("Checking {entity: '" + value.field + "', value: '" + value.value + "}'");
                if (value.field == entity && value.value == checkValue) {
                    log("Filters before remove...");
                    log(filters);
                    filters.splice(key, 1);
                    log("Filters after remove...");
                    log(filters);
                    //return false;
                }
            }
        });
        updateFilterSummary();
        updateUrl();
        updateResults();
        updateFilterCheckMarks();
    }

// look at the current filters and add / remove check marks in filter interface and dropdown states
    function updateFilterCheckMarks() {

        log('Updating checked filters (and drop states)...');

        console.log(filters);

        // foreach search bar checkbox
        $('[data-control="checkbox_filters"] [data-filter-field]').each(function () {

            //log("checking field ["+$(this).attr('data-filter-field')+"] value ["+$(this).attr('data-filter-value')+"]");

            if (filterExists($(this).attr('data-filter-field'), $(this).attr('data-filter-value'))) {
                $(this).prop('checked', true);
            }
        });

        // foreach dropdown filter dropdown
        $('.contentDropdown[data-g]').each(function () {

            var dropdown = $(this);
            var filterElems = dropdown.find("[data-filter-field]");
            var shouldBeOpen = false; // we'll set this to true if we find an active one

            // foreach filter in the dropdown
            $.each(filterElems, function () {

                var filterShouldBeChecked = false;
                var thisFilterElem = $(this);

                // foreach active filter
                $.each(filters, function (key, value) {
                    // if the filter matches the element...
                    //log('checking [filter] (element) FIELD ['+value.field+'] ('+thisFilterElem.attr('data-filter-field')+') NAME ['+value.name+'] ('+thisFilterElem.attr('name')+')')
                    if (value.field == thisFilterElem.attr('data-filter-field') && value.name == thisFilterElem.attr('name')) {
                        log('**** MATCH *****');
                        filterShouldBeChecked = true;
                        shouldBeOpen = true;
                        return false; // break
                    }
                });

                // update filter check
                if (filterShouldBeChecked == true) {
                    thisFilterElem.prop('checked', true);
                } else {
                    thisFilterElem.prop('checked', false);
                }
            });

            // update dropdown
            if (shouldBeOpen == true && dropdown.hasClass('open') != true) {
                dropdown.addClass('open');
                dropdown.children('.inner').slideToggle(300, 'swing');
                return false;
            } else if (shouldBeOpen == false && dropdown.hasClass('open') == true) {
                dropdown.removeClass('open');
                dropdown.children('.inner').slideToggle(300, 'swing');
                return false;
            }
        });
    }

// update search functions ///////////////////////////////////////////////////////////////

    function updateSearchResults(scrollToTop) {

        if (typeof scrollToTop === 'undefined') {
            scrollToTop = false;
        }

        log("Updating search results...");
        updateFilters();
        updateFilterSummary();
        updateUrl();
        updateResults(scrollToTop);
        updateFilterCheckMarks();
    }

    function updateUrl() {
        log("Updating URL...");
        var route = getRoute();

        // @TODO - need to read-up on state and title!
        var state;
        var title;
        var url = route;

        if (typeof force_redirect !== 'undefined' && force_redirect == true) {
            window.location.replace(url);
        }

        history.pushState(state, title, url);
    }

    function updateResults(scrollToTop) {
        log("Updating results...");

        if (typeof scrollToTop === 'undefined') {
            scrollToTop = false;
        }

        $.ajax({
            method: "GET",
            url: asi_search_url + "?term=" + term + "&section=" + section + "&sort=" + sort + "&page=" + current_page + generateParamsString(),

            /*
            data: {
                term: term,
                section: section,
                sort: sort,
                page: current_page,
            }

             */
        })
            .done(function (data) {
                $('[data-section="search_results"]').html(data);
                if (scrollToTop == true) {
                    scrollTo('[data-section="search_results"]', -160);
                }
            });
    }

    function scrollTo(identifier, adjust) {

        var scrollPosition = ($(identifier).offset().top + adjust);
        log('position is ' + scrollPosition);
        $("html, body").animate({scrollTop: scrollPosition});
    }

    function updateFilters() {
        log("Updating filters...");
        getCurrentFilterValues();
        updateFilterCheckMarks();
    }

    function getCurrentFilterValues() {
        log("Fetching current filter values...");
        filters = [];
        $('[data-filter-field]').each(function () {
            var inputType = $(this).prop('type');
            //console.log(inputType);
            if (inputType == "checkbox") {
                if ($(this).prop('checked') == true) {
                    var filter = {
                        type: $(this).attr('data-filter-type'),
                        name: $(this).prop('name'),
                        field: $(this).attr('data-filter-field'),
                        value: $(this).attr('data-filter-value')
                    };

                    if (filterExists(filter.field, filter.value) != true) {
                        log('adding filter');
                        filters.push(filter);
                        fakeWhittle(filter.field);
                    }

                    if ($(this).attr('data-filter-exclusive') == '1') {
                        log('this is an exclusive filter...');
                        clearOutFiltersExcept(filter.field, filter.value);
                        uncheckFiltersExcept(filter.field, filter.value);
                    }
                }
            }
        })
        log(filters);
        return filters;
    }

    function clearOutFiltersExcept(entity, checkValue) {
        //log(filters);
        if (typeof filters !== "undefined") {
            $.each(filters, function (key, value) {
                if (typeof value !== "undefined") {
                    log(value);
                    log("Checking {entity: '" + value.field + "', value: '" + value.value + "}'");
                    if (value.field == entity && value.value != checkValue) {
                        filters.splice(key, 1);
                    }
                }
            });
        }
    }

    function uncheckFiltersExcept(entity, checkValue) {
        $('[data-filter-field="' + entity + '"]').each(function () {
            if ($(this).attr('data-filter-value') != checkValue) {
                $(this).prop('checked', false);
            }
        });
    }

    function filterExists(field_name, field_value) {
        var check_any = false;
        if (typeof field_value === 'undefined') {
            check_any = true;
        }
        var exists = false;
        $.each(filters, function (key, value) {
            log("Checking {entity: '" + value.field + "', value: '" + value.value + "}'");
            if ((value.field == field_name && value.value == field_value) || (check_any == true && value.field == field_name)) {
                log('Filter already exists!');
                exists = true;
            }
        });
        return exists;
    }

    function getRoute() {
        log("Fetching route...");
        var termUrl = encodeURIComponent(term);
        var new_route = "/advanced-search/" + section + "/?term=" + termUrl + generateParamsString();
        console.log("New route is " + new_route);
        return new_route;
    }

    function generateParamsString() {
        var params = "";
        $.each(filters, function (key, value) {
            log(value);
            params += "&" + value.field + "[]=" + value.value;
        });
        var query = params + "&sort=" + sort + "&page=" + current_page;
        return query;
    }

}