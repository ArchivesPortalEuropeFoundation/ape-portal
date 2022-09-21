var asi_debug = true;
var current_collection_target_id; // contains the current id when dealing with collections in account area
var current_collection_target; // contains the entity type
var collection_can_be_edited = false;

$(function () {
    log('asi functions are listening...');
    listenForSaveSearch();
    listenForSaveBookmark();
    listenForSuggestion();
    listenForAccountSavedSearches();
    listenForAccountSavedBookmarks();
    listenForAccountSavedCollections();
    listenForAccountSavedCollectionsDrill();
    listenForEditCollections();
    listenFoDelete();
    listenForCopyButton();
    listenForLoadCollections();
    listenForLoadCollectionsNotAssignedToThis();
    listenForSaveCollection();
    listenForAccountSearchFilter();
    listenForInlineEdit();
    // listenForSearchParamsDrill();
    listenForUsernameChange();
    listenForTabSwitchAnchor();
    listenForTabSwitch();
    loadSortables();
    listenForSortTrigger();
    listenForNewCollection();
    listenForHiddenOptions();
    listenForParamsPopup();
    listenForRemoveSearchFromCollection();
    listenForBranchSwitch();
});

// @TODO - MH this is a duplication from the ApeSearch class, it should be extendable for this purpose
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
            //sorted_params[nested_key] = params[nested_key];
        } else {
            params[key] = value;
        }
    }
    return params;
}

//TODO Remove if testing does not discover a link to this function
// function sadasdsads() {
//     var qs = [];
//     var request_filters = getQueryParams(qs);
//     $('[data-populate="save_search_parameters"]').html(renderResponseFiltersToList());
// }

function listenForBranchSwitch() {
    
    $('[data-switch-branch]').on('click',function(){
        var parent = $(this).parent(),
            id          = $(this).data('switch-branch'),
            short_label = $(this).data('short-label'),
            long_name   = $(this).text();
        parent.hide();
        $('[data-switch-branch]').removeClass('active');
        $(this).addClass('active');

        $('[data-populate="branch_name"]').text(long_name);
        parent.parent().find('.title').text(short_label);

        $('[data-branch]').each(function(){
            $(this).hide();
        });

        $('[data-branch="'+id+'"]').show();
    });
}

function loadSortables() {

    setTimeout(function(){
        addSortable('search');
        addSortable('bookmark');
        addSortable('collection');
    }, 1000);
}

function listenForRemoveSearchFromCollection() {

    // if delete search from collection is pressed...
    $("body").on("click", '[data-trigger="remove_collection_item"]', function (event) {

        event.preventDefault();
        var collection_id = $(this).closest('[data-collection-id]').attr('data-collection-id');
        var collection_name = $(this).closest('[data-collection-name]').attr('data-collection-name');
        var id = $(this).attr('data-id');
        var target = $(this).attr('data-target');
        var item_name = $(this).attr('data-item-name');

        if (delete_confirm == true) { // if settings state confirm required

            // populate the confirm box and show it
            $('[data-trigger="remove_collection_item_delete_confirm"]').attr('data-id', id).attr('data-collection-id', collection_id).attr('data-target', target);
            $('[data-populate="remove_confirm_item_name"]').text(item_name);
            $('[data-populate="remove_confirm_collection_name"]').text(collection_name);

            $('#deleteConfirmOptionPopup').modal('show');

        } else { // no confirm required, remove now
            removeItemFromCollection(collection_id, id, target);
        }
    });

    // if the confirm delete is pressed...
    $("body").on("click", '[data-trigger="remove_collection_item_delete_confirm"]', function (event) {

        event.preventDefault();
        removeItemFromCollection($(this).attr('data-collection-id'), $(this).attr('data-id'), $(this).attr('data-target'));
        return true; // remove the modal
    });

    // if the preference for the delete confirm is changed...
    $("body").on("click", '[data-trigger="remove_delete_confirm"]', function (event) {

        var input_val = $(this).val();

        // update the local variable
        if(input_val == "1") {
            delete_confirm = true;
        }else {
            delete_confirm = false;
        }

        // store the settings
        var params = {};
        params.action = "update_preference_delete_confirm";
        params.value = input_val;

        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: params
        })
            .done(function(data) {
                var response=JSON.parse(data);
                return; // carry on
            })
            .fail(function() {
                alert("Sorry, there was a problem updating your preference, please try again.");
                log('Preference (delete confirm) could not be updated');
            })

    });
}

function removeItemFromCollection(collection_id, id, target) {

    var params = {};
    params.action = "remove_"+target+"_from_collection";
    params.item_id = id;
    params.collection_id = collection_id;

    $.ajax({
        method: "POST",
        url: "/asi-ajax/",
        data: params
    })
        .done(function(data) {
            var response=JSON.parse(data);
            loadCollections();
            loadCollectionContents(collection_id);
            reloadSortables();
            var count_elem = $('[data-collection-id="'+collection_id+'"][data-count="total_'+target+'"]');
            var number = parseInt(count_elem.html());
            count_elem.html(number-1);
            log("re-loading saved collections...");
            loadSavedCollections();
            return; // carry on
        })
        .fail(function() {
            alert("Sorry, there was a problem removing the item from the collection, please try again.");
            log('Item ('+target+') could not be removed from collection');
        })
}

function listenForParamsPopup() {

    $( "body" ).on( "click", '[data-trigger="params_popup"]', function(event) {

        event.preventDefault();

        var results_url = $(this).attr('data-param-results-url');
        var new_results_url = $(this).attr('data-param-new-results-url');

        var params = {};
        params.action = "search_params_show";
        params.id = $(this).attr('data-id');

        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: params
        })
            .done(function(data) {
                var response=JSON.parse(data);
                $('[data-populate="popup_search_params"]').html(response.result);
                $('[data-populate="search_results_url"]').attr("href", results_url);
                $('[data-populate="search_new_results_url"]').attr("href", new_results_url);
                $('#viewParamsPopup').modal("show");
                return; // carry on
            })
            .fail(function() {
                alert("Sorry, there was a problem fetching the parameters, please try again.");
                log('Params could not be loaded');
            })
    });

}

function reloadSortables() {

    // setTimeout(function(){
    //     $('[data-sortable="search"]').isotope('layout');
    //     $('[data-sortable="bookmark"]').isotope('layout');
    //     $('[data-sortable="collection"]').isotope('layout');
    // }, 500);
}

function listenForHiddenOptions() {

    $( "body" ).on( "click", '[data-toggle="show_hidden_options"]', function(event) {
        if( $(this).siblings(".hiddenOptions").css('opacity') == "0" ) {
            $(this).siblings(".hiddenOptions").css('opacity', 1);
            $(this).siblings(".hiddenOptions").css('pointer-events', "auto");
        }else {
            $(this).siblings(".hiddenOptions").css('opacity', 0);
            $(this).siblings(".hiddenOptions").css('pointer-events', "none");
        }
    });
}

function listenForNewCollection() {

    $('[data-trigger="create_new_collection"]').click(function(event){

        event.preventDefault();

        var params = {};
        params.action = "save_collection";
        params.name = $('[data-field="new_collection_name"]').val();

        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: params
        })
            .done(function(data) {
                var response=JSON.parse(data);
                loadSavedCollections();
                $('#createCollectionPopup').modal("hide");
                return; // carry on
            })
            .fail(function() {
                alert("Sorry, there was a problem creating the item, please try again.");
                log('Collection could not be created');
            })
    });

}

function listenForTabSwitchAnchor() {

    var hash = window.location.hash;

    if(hash == "#bookmarks") {
        $('a[href="#tab2"]').tab('show');
        return;
    }
    if(hash == "#collections") {
        $('a[href="#tab3"]').tab('show');
        return;
    }
    return;
}

function listenForTabSwitch() {

    $('a[href="#tab1"], a[href="#tab2"], a[href="#tab3"]').click(function(){
        reloadSortables();
    });
}

function listenForUsernameChange() {
    $('[ data-alert="username_change"]').click(function(){
        alert('Please contact a system admin if you want to change your username or email');
    })
}

// general logging function
function log(msg) {
    if (asi_debug == true) console.log(msg);
}

// when the pencil is clicked...
function listenForInlineEdit(){

    // when the pencil or the X is clicked
    $( "body" ).on( "click", 'i.editIcon, i.cancel', function(event) {
        $(this).parents('.item').find('.editField').toggleClass('open');
    });

    // when the tick is clicked
    $( "body" ).on( "click", 'i.confirm', function(event) {
        // data-field="name" data-entity="search" data-id="[[!+id]]"

        var params = {};
        params.action = "inline_update";
        params.entity = $(this).siblings('input, textarea').attr('data-entity');
        params.field = $(this).siblings('input, textarea').attr('data-field');
        params.id = $(this).siblings('input, textarea').attr('data-id');
        params.val = $(this).siblings('input, textarea').val();

        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: params
        })
            .done(function(data) {
                var response=JSON.parse(data);
                loadSavedSearches();
                loadSavedBookmarks();
                loadSavedCollections();
                return; // carry on
            })
            .fail(function() {
                alert("Sorry, there was a problem deleting the item, please try again.");
                log('Search could not be deleted');
            })

    });

    // $('i.editIcon, i.confirm, i.cancel').click(function() {
}

function listenForAccountSearchFilter() {

    $('[data-g="account-search-filter"]').keyup(function(){

        // sort out what the target is
        var filter_target = $(this).attr('data-search-target');
        var targetElems = $('[data-search-filter-item="'+filter_target+'"]');

        // get the term
        var term = $(this).val().toLowerCase();
        var n = term.length; // search term length

        // un-hide all results if term null
        if(n==0) {
            targetElems.removeClass('hidden');
            return;
        }

        // for each target element...
        targetElems.each(function(){

            var elem = $(this);
            elem.addClass('hidden');
            var field = $(this).attr('data-search-filter-field');
            var limit = field.length; // stop searching when we reach the end of the field string

            var i;
            for (i = 0; i <= limit; i++) { // loop through the field for a match hello = hel | ell | llo

                var end = (i+n); // end is the end character - so start(i) + search term length(n)
                var check = field.substring(i, end).toLowerCase();

                if( term == check ) {
                    elem.removeClass('hidden');
                    return;
                }
            }
        });
    });
}

function addSortable(section) {

        $('[data-sortable="'+section+'"]').isotope({
            // options
            itemSelector: '[data-sort-item="'+section+'"]',
            layoutMode: 'fitRows',
            getSortData: {
                name: '[data-sort-name]',
                id: '[data-sort-id]',
                date: '[data-sort-date]'
            },
            sortBy: 'name'
        });
}

function listenForSortTrigger() {

    $('[data-control="account_sort_trigger"]').click(function (event) {

        event.preventDefault();

        var target = $(this).attr('data-sort-target');
        var sort = $(this).text();
        $(this).parent().siblings('.title').text(sort);
        $(this).parent().parent().removeClass('open');
        $(this).parent().toggle();
        $('[data-sortable="'+target+'"]').isotope({ sortBy : $(this).attr('data-sort-param') });
    });

}

// in account area, collection drill down into contents
function listenForAccountSavedCollectionsDrill() {

    $( "body" ).on( "click", '[data-trigger="collection_drill"]', function(event) {
        var collection_id = $(this).attr("data-collection-id");
        collection_can_be_edited = false;
        loadCollectionContents(collection_id);
        reloadSortables();
    });
}

function listenForEditCollections() {
    $( "body" ).on( "click", '[data-trigger="collection_edit"]', function(event) {

        // drill into the items...
        var collection_id = $(this).attr("data-collection-id");
        loadCollectionContents(collection_id);
        reloadSortables();

        // hide edit and copy, display finish
        $('[data-copy-clipboard][data-collection-id="'+collection_id+'"]').hide();
        $('[data-trigger="collection_edit"][data-collection-id="'+collection_id+'"]').hide();
        $('[data-trigger="collection_close"][data-collection-id="'+collection_id+'"]').show();

        // replace ellipsis with trash cans
        setTimeout(function(){
            $('[data-collection-id="'+collection_id+'"] [data-toggle="show_hidden_options"]').hide();
            $('[data-collection-id="'+collection_id+'"] [data-item="trash"]').show();
        }, 500);


    });

    // may as well listen for the finish in here as well...
    $( "body" ).on( "click", '[data-trigger="collection_close"]', function(event) {

        var collection_id = $(this).attr("data-collection-id");

        // show edit and copy, hide finish
        $('[data-copy-clipboard][data-collection-id="'+collection_id+'"]').show();
        $('[data-trigger="collection_edit"][data-collection-id="'+collection_id+'"]').show();
        $('[data-trigger="collection_close"][data-collection-id="'+collection_id+'"]').hide();

        // switch the trash can back and collapse
        $('[data-collection-id="'+collection_id+'"] [data-toggle="show_hidden_options"]').show();
        $('[data-collection-id="'+collection_id+'"] [data-item="trash"]').hide();
        // $('[data-container="collection_drill"][data-collection-id="'+collection_id+'"]').slideToggle(300, "swing", reloadSortables());
    });

}

// data-trigger="collection_close" data-control="collection_finish"

function loadCollectionContents(collection_id) {

    var params = {params: {collection_id: collection_id}, template:"collection_drill"};
    var search_target = $('[data-populate="account_saved_collection_searches"][data-collection-id="'+collection_id+'"]');
    var bookmark_target = $('[data-populate="account_saved_collection_bookmarks"][data-collection-id="'+collection_id+'"]');

    log("loading collection saved searches...");
    loadSavedSearches(params, search_target);
    log("<< completed >>");
    log("loading collection saved bookmarks...");
    loadSavedBookmarks(params, bookmark_target);
    log("<< completed >>");
   // $('[data-container="collection_drill"][data-collection-id="'+collection_id+'"]').toggle();
}


// in account area, save collection clicked
function listenForSaveCollection() {

    $( "body" ).on( "click", '[data-control="save_item_to_collection"]', function(event) {

        $('[data-control="add_to_collection"]').each(function(){ // each collection...
            if($(this).is(":checked")) { // add item to collection
                $.ajax({
                    method: "POST",
                    url: "/asi-ajax/",
                    data: {
                        action: "add_"+current_collection_target+"_to_collection",
                        item_id: current_collection_target_id,
                        collection_id: $(this).attr('data-value-collection')
                    }
                })
            }
            else { // remove item from collection
                $.ajax({
                    method: "POST",
                    url: "/asi-ajax/",
                    data: {
                        action: "remove_"+current_collection_target+"_from_collection",
                        item_id: current_collection_target_id,
                        collection_id: $(this).attr('data-value-collection')
                    }
                })
            }
        });
        loadSavedCollections();

    });
}

// in account area, load the collections
function listenForLoadCollections() {

    $( "body" ).on( "click", '[data-trigger="load_collections"]', function(event) {
        loadCollections();

        current_collection_target = $(this).attr('data-collection-target');
        current_collection_target_id = $(this).attr('data-id');
    });
}

// when a search / bookmark is clicked, make sure not to offer collections it's already in
function listenForLoadCollectionsNotAssignedToThis() {

    $( "body" ).on( "click", '[data-trigger="load_collections_not_assigned_to_this"]', function(event) {

        current_collection_target = $(this).attr('data-collection-target');
        current_collection_target_id = $(this).attr('data-id');
        loadCollectionsNotAssignedToThis();
    });
}

function listenForCopyButton() {

    $( "body" ).on( "click", '[data-copy-clipboard]', function(event) {

        event.preventDefault();
        copyTextToClipboard($(this).attr('data-copy-clipboard'));
        $(this).html("<i class=\"fas fa-link\"></i> Copied!");
    });
}

function listenFoDelete() {

    $( "body" ).on( "click", '[data-populate-search-delete]', function() {
        $('[data-control-delete-confirm]').attr('data-control-delete-id', $(this).attr('data-populate-search-delete')).attr('data-control-delete-target', "search");
    });

    $( "body" ).on( "click", '[data-populate-bookmark-delete]', function() {
        $('[data-control-delete-confirm]').attr('data-control-delete-id', $(this).attr('data-populate-bookmark-delete')).attr('data-control-delete-target', "bookmark");
    });

    $( "body" ).on( "click", '[data-populate-collection-delete]', function() {
        $('[data-control-delete-confirm]').attr('data-control-delete-id', $(this).attr('data-populate-collection-delete')).attr('data-control-delete-target', "collection");
    });

    $('[data-control-delete-confirm]').click(function(){
        var target = $(this).attr('data-control-delete-target');
        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: {
                action: "account_saved_"+target+"_delete",
                id: $(this).attr('data-control-delete-id')
            }
        })
            .done(function(data) {
                var response=JSON.parse(data);
                loadSavedSearches();
                loadSavedBookmarks();
                loadSavedCollections();
                return; // carry on
            })
            .fail(function() {
                alert("Sorry, there was a problem deleting the item, please try again.");
                log(target+' could not be deleted');
            })
    });

}

function listenForAccountSavedSearches() {

    $(document).ready(function(){
        if($('[data-populate="account_saved_searches"]').length > 0) {
            loadSavedSearches();
        }
    });
}

function listenForAccountSavedBookmarks() {

    $(document).ready(function(){
        if($('[data-populate="account_saved_bookmarks"]').length > 0) {
            loadSavedBookmarks();
        }
    });
}

function listenForAccountSavedCollections() {

    $(document).ready(function(){
        if($('[data-populate="account_saved_collections"]').length > 0) {
            loadSavedCollections();
        }
    });
}


function loadSavedSearches(params, target) {

    params = params || {}; // carry the params, or create new
    params.action = "account_saved_search_list"; // add action to params
    var default_target = $('[data-populate="account_saved_searches"]'); // default html target if not specified
    target = target || default_target;

    log("params is...");
    log(params);

    $.ajax({
        method: "POST",
        url: "/asi-ajax/?action=account_saved_search_list",
        data: params
    })
        .done(function(data) {
            var response=JSON.parse(data);
            log(response.result);
            if(response.result == "") {
                log("Response is empty, so hide results");
                if(target == default_target) {
                    target.replaceWith("<p class='text-center'>You currently have no saved searches</p>");
                    //$('[data-container="account_saved_searches_filters"]').hide();
                    log("target == default_target, so hide results");
                    if(typeof params.params !== "undefined")  {
                        log("typeof params.params !== undefined, so hide results");
                        //$('[data-collection-search-headings="'+params.params.collection_id+'"]').hide();
                    }
                } else {
                    target.html("<p class='text-center'>You currently have no saved searches</p>");
                    log("target != default_target, so hide results");
                    //$('[data-container="account_saved_searches_filters"]').hide();
                    if(typeof params.params !== "undefined") {
                        //$('[data-collection-search-headings="'+params.params.collection_id+'"]').hide();
                    }
                }
                return;
            }
            log(response.result);
            target.html(response.result);
            log("Response found so show results");
        //    $('[data-container="account_saved_searches_filters"]').show();
            if(typeof params.params !== "undefined") {
               // $('[data-collection-search-headings="'+params.params.collection_id+'"]').show();
            }
        })
        .fail(function() {
            log('Saved searches could not be loaded');
            if(typeof params.params !== "undefined") {
        //        $('[data-collection-search-headings="'+params.params.collection_id+'"]').hide();
            }
        })
}

function loadSavedBookmarks(params, target) {

    params = params || {}; // carry the params, or create new
    params.action = "account_saved_bookmark_list"; // add action to params
    var default_target = $('[data-populate="account_saved_bookmarks"]'); // default html target if not specified
    target = target || default_target;

    $.ajax({
        method: "POST",
        url: "/asi-ajax/",
        data: params
    })
        .done(function(data) {
            var response=JSON.parse(data);
            if(response.result == "") {
                if(target == default_target) {
                    target.replaceWith("<p class='text-center'>You currently have no saved bookmarks</p>");
                   // $('[data-container="account_saved_bookmarks_filters"]').hide();
                    if(typeof params.params !== "undefined") {
                   //     $('[data-collection-bookmark-headings="'+params.params.collection_id+'"]').hide();
                    }
                } else {
                    target.html("<p class='text-center'>You currently have no saved bookmarks</p>");
                  //  $('[data-container="account_saved_bookmarks_filters"]').hide();
                    if(typeof params.params !== "undefined") {
                    //    $('[data-collection-bookmark-headings="'+params.params.collection_id+'"]').hide();
                    }
                }
                return;
            }
            target.html(response.result);
           // $('[data-container="account_saved_bookmarks_filters"]').show();
            if(typeof params.params !== "undefined") {
            //    $('[data-collection-bookmark-headings="'+params.params.collection_id+'"]').show();
            }
        })
        .fail(function() {
            log('Saved bookmarks could not be loaded');
           // $('[data-container="account_saved_bookmarks_filters"]').hide();
            if(typeof params.params !== "undefined") {
            //   $('[data-collection-bookmark-headings="'+params.params.collection_id+'"]').hide();
            }
        })
}

function loadSavedCollections(target) {

    var default_target = $('[data-populate="account_saved_collections"]'); // default html target if not specified
    target = target || default_target;

    $.ajax({
        method: "POST",
        url: "/asi-ajax/",
        data: {
            action: "account_saved_collection_list"
        }
    })
        .done(function(data) {
            var response=JSON.parse(data);
            if(response.result == "") {
                target.replaceWith("<p class='text-center'>You currently have no saved collections</p>");
                return;
            }
            $('[data-populate="account_saved_collections"]').html(response.result);
        })
        .fail(function() {
            log('Saved collections could not be loaded');
        })
}

function listenForSaveBookmark() {

    // listen for the button which does the popup
    $('[data-trigger="save_bookmark"]').click(function (event) {

        event.preventDefault();
    //TODO KOSTAS The below was not commented out as the overall bookmarking functionality was commented out in the HTML. However this would make it need an Account before showing correctly.
        if(logged_in == false) {

            // accountNeededPopup
            $('#accountNeededPopup').modal('show');
            return;
        }
        loadCollections();
        $('#bookmarkPopup').modal("show");
    });

    // listen for save bookmark save
    $('[data-control="save_bookmark"]').click(function(event){

        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: {
                action: "save_bookmark",
                name: $('[data-populate="save_bookmark_name"]').val(),
                description: $('[data-populate="save_bookmark_description"]').val(),
                url: window.location.href,
                type: $('[data-populate="save_bookmark_type"]').val(),
                resource_id: $('[data-populate="save_bookmark_id"]').val(),
                params: $('[data-populate="save_bookmark_params"]').val(),
            }
        })
            .done(function(data) {

                var response=JSON.parse(data);

                // now check to see if any collections selected...
                $('[data-control="add_to_collection"]').each(function(){
                    if($(this).is(":checked")) {
                        $.ajax({
                            method: "POST",
                            url: "/asi-ajax/",
                            data: {
                                action: "add_bookmark_to_collection",
                                item_id: response.bookmark_id,
                                collection_id: $(this).attr('data-value-collection')
                            }
                        })
                    }
                });
            })
            .fail(function() {
                alert( "Sorry, there was an error saving your bookmark, please try again." );
            })
    });
}

function listenForSuggestion() {

    $('[data-trigger="suggestion"]').click(function (event) {

        event.preventDefault();

        //TODO KOSTAS - The below was commented out so that suggestions would be able to be made without being logged in.

        // if(logged_in == false) {
        //
        //     $('#accountNeededPopup').modal('show');
        //     return;
        // }

        $('#suggestionPopup').modal('show');
        return;

    });
}

function listenForSaveSearch() {

    // listen for save search request

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    $('[data-trigger="save_search"]').click(function (event) {

        event.preventDefault();

        log(ApeSearch);

        if(logged_in == false) {

            $('#accountNeededPopup').modal('show');
            return;
        }

        loadCollections();

        if ($('[data-populate="save_search_name"]').val() == "") {
            $('[data-populate="save_search_name"]').val(ApeSearch.search_name);
        }
        if ($('[data-populate="save_search_term"]').val() == "") {
            $('[data-populate="save_search_term"]').val(ApeSearch.term);
        }

        if ($('[data-populate="save_search_description"]').val() == "") {
            $('[data-populate="save_search_description"]').val("Search for '" + ApeSearch.term + "' in archives on " + today);
        }

        $('[data-populate="save_search_parameters"]').html(renderResponseFiltersToList());
        $('#saveSearchPopup').modal('show');
    });

    // listen for save search save
    $('[data-control="save_search"]').click(function(event){

        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: {
                action: "save_search",
                name: $('[data-populate="save_search_name"]').val(),
                description: $('[data-populate="save_search_description"]').val(),
                filters: JSON.stringify(ApeSearch.request_filters),
                url: ApeSearch.getRoute(),
                term: $('[data-populate="save_search_term"]').val(),
                type: section,
            }
        })
            .done(function(data) {

                var response=JSON.parse(data);

                // now check to see if any collections selected...
                $('[data-control="add_to_collection"]').each(function(){
                    if($(this).is(":checked")) {
                        $.ajax({
                            method: "POST",
                            url: "/asi-ajax/",
                            data: {
                                action: "add_search_to_collection",
                                item_id: response.search_id,
                                collection_id: $(this).attr('data-value-collection')
                            }
                        })
                    }
                });

                // popup the success box
                $('#searchSavedPopup').modal("show");
            })
            .fail(function() {
                alert( "Sorry, there was an error saving your search, please try again." );
            })
    });

    // listen for save collection
    $('[data-control="save_collection"]').click(function(event){

        event.preventDefault();

        var collection_name = $('[data-populate="save_collection_name"]').val();

        if(collection_name == "") {
            alert("Please enter a name for your collection");
            return;
        }

        $.ajax({
            method: "POST",
            url: "/asi-ajax/",
            data: {
                action: "save_collection",
                name: collection_name,
                filters: JSON.stringify(ApeSearch.response_filters)
            }
        })
            .done(function() {
                $('[data-feedback="save_collection_success"]').html("<i class=\"fas fa-check mr\"></i> A new collection has been created:<br class=\"visible-xs\"> "+collection_name);
                $('[data-populate="save_collection_name"]').val("");
                loadCollections();
            })
            .fail(function() {
                alert( "Sorry, there was an error saving your collection, please try again." );
            })
    });
}

function loadCollections() {

    $.ajax({
        method: "POST",
        url: "/asi-ajax/",
        data: {
            action: "list_collections"
        }
    })
        .done(function(data) {
            var response=JSON.parse(data);
            var string ="";
            $.each(response.result, function (k, v) { // foreach collection

                var checked = null;

                // here we switch between search and bookmark, depending on what we're dealing with...
                if(current_collection_target == "search") {
                    if(v.searches != null) { // if searches are already saved in the collection
                        var searches = v.searches.split(',');
                        if (searches.includes(current_collection_target_id)) {
                            checked = "checked"; // mark the option as checked
                        }
                    }
                }else { // (bookmarks)
                    if(v.bookmarks != null) { // if bookmarks are already saved in the collection
                        var bookmarks = v.bookmarks.split(',');
                        if (bookmarks.includes(current_collection_target_id)) {
                            checked = "checked"; // mark the option as checked
                        }
                    }
                }

                string += "<div class=\"checkbox\"><input "+checked+" data-collection-target='"+current_collection_target+"' data-control='add_to_collection' data-value-collection='"+v.id+"' type=\"checkbox\" name=\"collections["+v.id+"]\" value=\"1\"><span>"+v.name+"</span></div>";
            });

            $('[data-populate="collection_list"]').html(string);
        })
        .fail(function() {
            alert( "Sorry, there was an error loading your collections, please try refreshing the page." );
        })
}

function loadCollectionsNotAssignedToThis() {

    log("target = "+current_collection_target);
    log("target id = "+current_collection_target_id);

    $.ajax({
        method: "POST",
        url: "/asi-ajax/",
        data: {
            action: "list_collections_not_assigned_to_this",
            target: current_collection_target,
            target_id: current_collection_target_id,
        }
    })
        .done(function(data) {
            var response=JSON.parse(data);
            var string ="";
            $.each(response.result, function (k, v) { // foreach collection

                var checked = null;

                // here we switch between search and bookmark, depending on what we're dealing with...
                if(current_collection_target == "search") {
                    if(v.searches != null) { // if searches are already saved in the collection
                        var searches = v.searches.split(',');
                        if (searches.includes(current_collection_target_id)) {
                            checked = "checked"; // mark the option as checked
                        }
                    }
                }else { // (bookmarks)
                    if(v.bookmarks != null) { // if bookmarks are already saved in the collection
                        var bookmarks = v.bookmarks.split(',');
                        if (bookmarks.includes(current_collection_target_id)) {
                            checked = "checked"; // mark the option as checked
                        }
                    }
                }

                string += "<div class=\"checkbox\"><input "+checked+" data-collection-target='"+current_collection_target+"' data-control='add_to_collection' data-value-collection='"+v.id+"' type=\"checkbox\" name=\"collections["+v.id+"]\" value=\"1\"><span>"+v.name+"</span></div>";
            });

            $('[data-populate="collection_list"]').html(string);
        })
        .fail(function() {
            alert( "Sorry, there was an error loading your collections, please try refreshing the page." );
        })
}

function renderResponseFiltersToList(request_filters) {
    log('ApeSearch.request_filters');
    log(ApeSearch.request_filters);

    request_filters = request_filters || ApeSearch.request_filters;
    log('request_filters');
    log(request_filters);

    var params = "";
    var current_filter = null;

    $.each(request_filters, function (filter, item) {
        log('request_filter');
        log(filter);
        log('item');
        log(item);
        $.each(item, function (k, v) {

                if(filter == current_filter) {
                    params += "<li><strong>&nbsp;</strong> " + ApeSearch.clean_label(v, filter) + "</li>";
                }
                else {
                    params += "<li><strong>" + ApeSearch.clean_label(filter) + ":</strong> " + ApeSearch.clean_label(v, filter) + "</li>";
                }
            current_filter = filter;
        });

    });
    log('Params');
    log(params);
    return params;
}

function renderResponseFiltersToListAlt(request_filters) {

    request_filters = request_filters || ApeSearch.request_filters;

    var params = "";
    var current_filter = null;

    $.each(request_filters, function (filter, item) {

        $.each(item, function (k, v) {

            if(filter == current_filter) {
                params += "<li><strong>&nbsp;</strong> " + ApeSearch.clean_label(v, filter) + "</li>";
            }
            else {
                params += "<li><strong>" + filter + "</strong> " + ApeSearch.clean_label(v, filter) + "</li>";
            }
            current_filter = filter;
        });

    });
    return params;
}

function copyTextToClipboard(text) {

    var textArea = document.createElement("textarea");

    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
    textArea.style.width = '2em';
    textArea.style.height = '2em';
    textArea.style.padding = 0;
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
    textArea.style.background = 'transparent';
    textArea.value = text;

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
    } catch (err) {
        log('Unable to copy');
    }
    document.body.removeChild(textArea);
}