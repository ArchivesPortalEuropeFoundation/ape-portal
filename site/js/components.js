if (typeof enable_components !== 'undefined') {

    (function( ApeComponents, $, undefined ) {

        // private
        var component_search_url = "asi-ajax/?action=load_components";

        // public
        ApeComponents.page_request_params = {};
        ApeComponents.request_params = {"start": 0};
        ApeComponents.pages = 0;
        ApeComponents.current_page = 1;
        ApeComponents.results_count = 0;
        ApeComponents.start_page = 0;
        ApeComponents.last_page = 0;

        ApeComponents.init = function() {
            processPageRequest();
            cycle();
            listen();
        };

        function cycle() {
            updateResults();
        }

        function listen() {
            listenForPagination();
        }

        function refreshPaginationDisplay() {

            var i;
            var pageItemsHtml = "";
            var current_page = parseInt(ApeComponents.current_page);
            var total_pages = parseInt(ApeComponents.pages);
            var start_page = 1;
            var last_page = 10;
            if(current_page > 5) {
                start_page = (current_page - 5);
                last_page = (current_page + 5);
                if(start_page > (total_pages - 10)) start_page = (total_pages - 10);
                if(last_page > total_pages) last_page = total_pages;
            }
            ApeComponents.start_page = start_page;
            ApeComponents.last_page = last_page;
            for (i = start_page; i < (last_page + 1); i++) {
                if (i == current_page) {
                    pageItemsHtml += "<li class='active'><a data-components-paginate='" + i + "' href='#'>" + i + "</a></li>";
                } else {
                    pageItemsHtml += "<li><a data-components-paginate='" + i + "' href='#'>" + i + "</a></li>";
                }
            }
            $('[data-components-paginate="pages"]').html(pageItemsHtml);
        }

        function listenForPagination() {

            $('[data-components-control="pagination"]').on("click", '[data-components-paginate]', function (event) {
                event.preventDefault();
                var value = $(this).attr('data-components-paginate');
                if (value == "pages") return;

                var current_page = parseInt(ApeComponents.current_page);

                switch (value) {
                    case "first":
                        current_page = 1;
                        break;
                    case "prev":
                        var thePageWas = current_page;
                        current_page = (thePageWas - 1);
                        break;
                    case "last":
                        current_page = parseInt(ApeComponents.pages);
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

                ApeComponents.current_page = current_page;

                updateResults();
                cycle();
            });
        }

        function updateResults() {

                $.ajax({
                    method: "GET",
                    url: component_search_url + "&recordId=" + ApeComponents.page_request_params.recordId + "&start=" + ApeComponents.current_page,
                })
                    .done(function (data) {
                        var response = JSON.parse(data);
                        $('[data-populate="components_results_count"]').html(response.count);
                        $('[data-section="components_search_results"]').html(response.result);
                        ApeComponents.results_count = response.count;
                        calculateTotalpages();
                        refreshPaginationDisplay();
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
                    ApeComponents.page_request_params[nested_key] = params[nested_key];
                } else {
                    params[key] = value;
                }
            }
            return params;
        }

        function processPageRequest() {
            ApeComponents.page_request_params = getQueryParams(document.location.search);
        }

        function calculateTotalpages() {
            var total_results = parseInt(ApeComponents.results_count);
            ApeComponents.pages = Math.ceil( (total_results/10) );
        }

    }( window.ApeComponents = window.ApeComponents || {}, jQuery ));

    ApeComponents.init();
}