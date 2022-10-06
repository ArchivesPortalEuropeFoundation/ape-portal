if (typeof enable_tree !== 'undefined') {

    (function (ApeTree, $, undefined) {

        // private
        var tree_search_url = "asi-ajax/?action=load_tree";
        var tree_load_siblings_url = "asi-ajax/?action=load_tree_siblings";
        var tree_load_children_url = "asi-ajax/?action=load_tree_children";
        var tree_load_detail_url = "asi-ajax/?action=load_archive_detail";

        ApeTree.page_request_params = {};

        ApeTree.init = function () {
            processPageRequest();
            loadInitial();
            listen();
        };

        function listen() {
            listenForLoadSiblingsClick();
            listenForLoadChildrenClick();
        }

        function listenForLoadChildrenClick() {

            $('[data-populate="tree"]').on("click", '[data-trigger="load_tree_children"]', function (event) {

                if ($(event.target).is('i') && $(this).hasClass('open')) {
                    $(this).removeClass('open');
                    $(this).addClass('been-collapsed');
                    event.stopPropagation();
                    return;
                }
                var clicked_element = $(this);
                var new_parent_id = clicked_element.attr("data-id");
                var data_type = clicked_element.attr("data-type");
                var data_level = clicked_element.attr("data-level");
                var unit_id = clicked_element.attr("data-unitid");
                var addParams = "";

                if (typeof data_type != "undefined") {
                    addParams = addParams+"&type="+data_type;
                }
                if (typeof data_level != "undefined") {
                    addParams = addParams+"&level="+data_level;
                }
                if (typeof unit_id != "undefined") {
                    unitId = unit_id;
                    addParams = addParams+"&unitid="+encodeURI(unit_id);
                }

                event.stopPropagation(); // we just want this, not it's parents as well`

                if ( $(this).hasClass('been-collapsed') != true && $(this).hasClass('open') != true) {
                    $.ajax({
                            method: "GET",
                            url: tree_load_children_url + "&parent_id=" + new_parent_id + addParams,
                        })
                        .done(function (data) {
                            var response = JSON.parse(data);
                            clicked_element.append(response.result.children); // the first up to 10 children
                            clicked_element.addClass("open");
                        });
                } else {
                    clicked_element.addClass("open");
                }

                var detailUrl = tree_load_detail_url + "&recordId=" + encodeURIComponent(ApeTree.page_request_params.recordId) + "&c=" + new_parent_id + addParams;

                $(document).find("#documentCaptionSlider").slick('unslick');
                $(document).find("#documentGallerySlider").slick('unslick');

                $.ajax({
                        method: "GET",
                        url: detailUrl,
                    })
                    .done(function (data) {
                        var response = JSON.parse(data);
                        $('[data-populate="archive_detail_rhs"]').html(response.result.rhs);
                        $('[data-populate="archive_detail_top_left"]').html(response.result.top_left);
                        $('[data-populate="archive_detail_top"]').html(response.result.top);
                        this.repoCode = response.result.repoCode;
                        this.recordId = response.result.recordId;
                        eadId = response.result.eadId;
                        clevelId = response.result.clevelId;
                        unitId = '';
                        levelName = response.result.levelName;
                        treeId = response.result.treeId;
                        type = response.result.type;

                        max = response.result.limit;
                        compCurrentPg = response.result.page;
                        compResultsTotal = response.result.resultsTotal;
                        compPageTotal = response.result.pageTotal;

                        if ($(document).find("#documentGallerySlider").length) {
                            initGallerySlider();
                        }
                        updateComponentResults(1);
                        initializeTooltipFunctionality();
                    });
            });
        }

        function initializeTooltipClicks() {
            $('.tipIcon').click(function (e) {
                if ($(this).is('.active')) {
                    $(this).tooltipster('close');
                    $(this).removeClass('active');
                } else {
                    $(this).tooltipster('open');
                    $(this).addClass('active');
                }
                e.stopPropagation();
            });
        }

        function initializeTooltips() {
            $('.tipIcon').tooltipster({
                plugins: ['sideTip'],
                contentCloning: 'true',
                trigger: 'click',
                interactive: 'true',
                maxWidth: 320,
                minWidth: 200,
                side: ['right', 'left', 'bottom', 'top'],
                repositionOnScroll: 'true',
                trigger: 'custom',
                triggerOpen: {},
                triggerClose: {},
                functionBefore: function (instance, helper) {
                    $.each($.tooltipster.instances(), function (i, instance) {
                        instance.close();
                    });
                    $('.tipIcon').removeClass('active');
                },
                functionReady: function () {
                    $('.closeIcon').click(function () {
                        $('.tipIcon').tooltipster('close');
                        $('.tipIcon').removeClass('active');
                    });
                }
            });
        }

        function initializeTooltipFunctionality(){
            initializeTooltipClicks();
            initializeTooltips();
        }

        function updateComponentResults(newPage) {
            var encodedRepoCode = encodeURI(repoCode);
            var encodedRecordId = encodeURI(recordId);
            var apiCall = `${conf.component_endpoint}&page=${newPage}&repositoryCode=${encodedRepoCode}&levelName=${levelName}&recordId=${encodedRecordId}&type=${type}`;
            if (clevelId) {
                apiCall = apiCall + `&c=C${clevelId}`;
            }
            if (unitId) {
                apiCall = apiCall + `&unitId=${unitId}`;
            }
            $(document).find("#componentChildren").css("opacity", "0.3");
            $.ajax({
                    method: "GET",
                    url: apiCall,
                    context: this,
                    dataType: 'json'
                })
                .done(function (data) {
                    compOptions.currentPage = parseInt(data.result.page);
                    compOptions.totalPages = data.result.pageTotal;
                    $("#componentChildren").html(data.result.html);
                    if (compOptions.totalPages > 1) {
                        $('#componentChildren').show();
                        $('#ComponentsPagination').bootstrapPaginator(compOptions);
                    } else {
                        $('#componentChildren').hide();
                    }
                    $(document).find("#componentChildren").css("opacity", "1");
                    $(document).find("#componentChildren").show();
                }).fail(function (err) {
                    console.log(err);
                });
        }

        function listenForLoadSiblingsClick() {

            $('[data-populate="tree"]').on("click", '[data-trigger="load_tree_siblings"]', function (event) {

                var clicked_element = $(this);
                var parent_element = $(this).parent("ul").parent("li");
                var parent_ul = $(this).parent("ul");
                var parent_id = clicked_element.attr('data-id');
                var direction = clicked_element.attr('data-direction');
                var position = clicked_element.attr('data-position');
                var max = clicked_element.attr('data-max');
                var type = clicked_element.attr('data-type');
                var level = clicked_element.attr('data-level');
                var addParams = "";
                if (typeof data_type != "undefined") {
                    addParams = addParams+"&type="+data_type
                }
                if (typeof data_level != "undefined") {
                    addParams = addParams+"&level="+data_level;
                }

                event.stopPropagation(); // we just want this, not it's parents as well`

                $.ajax({
                        method: "GET",
                        url: tree_load_siblings_url + "&parent_id=" + parent_id + "&direction=" + direction + "&position=" + position + "&max=" + max + addParams,
                    })
                    .done(function (data) {
                        var response = JSON.parse(data);
                        if (direction == "UP") {
                            parent_ul.prepend(response.result);
                        } else {
                            parent_ul.append(response.result);
                        }
                        clicked_element.remove();
                    });
            })
        }

        function loadInitial() {

            $.ajax({
                    method: "GET",
                    url: tree_search_url + "&c=" + ApeTree.page_request_params.c + "&unitId=" + ApeTree.page_request_params.unitId + "&recordId=" + ApeTree.page_request_params.recordId + "&repoCode=" + repoCode + "&type=" + type + "&start=0",
                })
                .done(function (data) {
                    var response = JSON.parse(data);
                    $('[data-populate="tree"]').html(response.result);
                    // any sync functions go here
                });
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
                    ApeTree.page_request_params[nested_key] = params[nested_key];
                } else {
                    params[key] = value;
                }
            }
            return params;
        }

        function processPageRequest() {
            ApeTree.page_request_params = getQueryParams(document.location.search);
            console.log(ApeTree.page_request_params);
        }


    }(window.ApeTree = window.ApeTree || {}, jQuery));

    ApeTree.init();
}
