<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]

		<style>
			.savedSearch {
				position: relative!important;
				top: 0px!important;
			}
		</style>
	</head>
	<body>
[[$headerAccountTemp]]

[[$innerHero]]
	
<section class="halfBottomMargin">
    <div class="container">
        <ul class="nav-tabs buttons difM mb0" id="navTabsSlider">
    		<li class="active"><a href="#tab1" data-toggle="tab"><span class="hidden-xs">[[!%asi.acc_saved_searches? &topic=`account` &namespace=`asi`]]</span><span class="visible-xs">[[!%asi.acc_searches? &topic=`account` &namespace=`asi`]]</span></a></li>
    		<li><a href="#tab2" data-toggle="tab">[[!%asi.acc_bookmarks? &topic=`account` &namespace=`asi`]]</a></li>
    		<li><a href="#tab3" data-toggle="tab"><span class="hidden-xs">[[!%asi.acc_my_collections? &topic=`account` &namespace=`asi`]]</span><span class="visible-xs">[[!%asi.acc_collections? &topic=`account` &namespace=`asi`]]</span></a></li>
    	</ul>
    </div>
</section>

<div class="tab-content">
    <div class="tab-pane fade active in" id="tab1">
        <section class="lightGreyHalfTopMargin" data-container="saved_searches">
            <div class="container">
			    <div class="savedControls row" data-container="account_saved_searches_filters" style="display: none">
    			    <div class="col-xs-9 col-sm-6">
    			        <form class="searchLight">
    		                <div class="inputWrapper">
    	                        <i class="fas fa-search"></i>
    			                <input data-g="account-search-filter" data-search-target="saved_search" type="text" name="search" placeholder="[[!%asi.input_ph_find_saved_search? &topic=`default` &namespace=`asi`]]">
                            </div>
    			        </form>
    		        </div>
    			    <div class="col-xs-3 col-sm-6">
                        <div class="sortBy">
                            <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                            <div class="selectDropdown">
                            	<div class="title">
                				    [[!%asi.title_search_title? &topic=`default` &namespace=`asi`]]
                            	</div>
                            	<div class="inner">
                            		<a data-control="account_sort_trigger" data-sort-target="search" data-sort-param="name" href="#">[[!%asi.title_search_title? &topic=`default` &namespace=`asi`]]</a>
									<a data-control="account_sort_trigger" data-sort-target="search" data-sort-param="id" href="#">[[!%asi.title_search_id? &topic=`default` &namespace=`asi`]]</a>
									<a data-control="account_sort_trigger" data-sort-target="search" data-sort-param="date" href="#">[[!%asi.title_search_date? &topic=`default` &namespace=`asi`]]</a>
                            	</div>
                            </div>
    			        </div>
    			        <a class="toggleSlideUp" href="#searchesSort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
    			    </div>
    			</div>

    			<div data-populate="account_saved_searches" data-sortable="search">
					[[- searches load here via ajax ]]
				</div>
    			
            </div>
        </section>
    </div>
    
    <div class="tab-pane fade" id="tab2">
        <section class="lightGreyHalfTopMargin" data-container="saved_bookmarks">
            <div class="container">
			    <div class="savedControls row" data-container="account_saved_bookmarks_filters" style="display: none">
    			    <div class="col-xs-9 col-sm-6">
    			        <form class="searchLight">
    		                <div class="inputWrapper">
    	                        <i class="fas fa-search"></i>
    			                <input data-g="account-search-filter" data-search-target="saved_bookmark" type="text" name="search" placeholder="[[!%asi.input_ph_find_bookmarks? &topic=`default` &namespace=`asi`]]">
                            </div>
    			        </form>
    		        </div>
    			    <div class="col-xs-3 col-sm-6">
                        <div class="sortBy">
                            <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                            <div class="selectDropdown">
                            	<div class="title">
                				    [[!%asi.title_bookmark_name? &topic=`default` &namespace=`asi`]]
                            	</div>
								<div class="inner">
									<a data-control="account_sort_trigger" data-sort-target="bookmark" data-sort-param="name" href="#">[[!%asi.title_bookmark_name? &topic=`default` &namespace=`asi`]]</a>
									<a data-control="account_sort_trigger" data-sort-target="bookmark" data-sort-param="id" href="#">[[!%asi.title_bookmark_id? &topic=`default` &namespace=`asi`]]</a>
									<a data-control="account_sort_trigger" data-sort-target="bookmark" data-sort-param="date" href="#">[[!%asi.title_bookmark_date? &topic=`default` &namespace=`asi`]]</a>
								</div>
                            </div>
    			        </div>
    			        <a class="toggleSlideUp" href="#bookmarksSort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
    			    </div>
    			</div>

				<div data-populate="account_saved_bookmarks" data-sortable="bookmark">
					[[- bookmarks load here via ajax ]]
				</div>
    		
            </div>
        </section>
    </div>    
    
    <div class="tab-pane fade" id="tab3">
        <section class="lightGreyHalfTopMargin" data-container="saved_collections">
            <div class="container">
			    <div class="savedControls row" data-container="account_saved_collections_filters" style="display: none">
    			    <div class="col-xs-9 col-sm-4 col-md-6">
    			        <form class="searchLight">
    		                <div class="inputWrapper">
    	                        <i class="fas fa-search"></i>
    			                <input data-g="account-search-filter" data-search-target="saved_collection" type="text" name="search" placeholder="[[!%asi.input_ph_find_collections? &topic=`input` &namespace=`asi`]]">
                            </div>
    			        </form>
    		        </div>
    			    <div class="col-xs-3 col-sm-8 col-md-6">
                        <div class="sortBy">
                            <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                            <div class="selectDropdown">
                            	<div class="title">
                				    [[!%asi.title_collection_name? &topic=`default` &namespace=`asi`]]
                            	</div>
                            	<div class="inner">
									<a data-control="account_sort_trigger" data-sort-target="collection" data-sort-param="name" href="#">[[!%asi.title_collection_name? &topic=`default` &namespace=`asi`]]</a>
									<a data-control="account_sort_trigger" data-sort-target="collection" data-sort-param="id" href="#">[[!%asi.title_collection_id? &topic=`default` &namespace=`asi`]]</a>
									<a data-control="account_sort_trigger" data-sort-target="collection" data-sort-param="date" href="#">[[!%asi.title_collection_date? &topic=`default` &namespace=`asi`]]</a>
                            	</div>
                            </div>
    			        </div>
    			        <a class="toggleSlideUp" href="#collectionsSort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
    			        <a class="button blue large hidden-xs" href="#createCollectionPopup" data-toggle="modal"><i class="fas fa-plus"></i> [[!%asi.action_create_collection? &topic=`actions` &namespace=`asi`]]</a>
    			    </div>
    			    <div class="col-xs-12 visible-xs">
    			        <a class="button blue large full" href="#createCollectionPopup" data-toggle="modal"><i class="fas fa-plus"></i> [[!%asi.action_create_collection? &topic=`actions` &namespace=`asi`]]</a>
    			    </div>
    			</div>

				<div data-populate="account_saved_collections" data-sortable="collection">
					[[- collections load here via ajax ]]
				</div>
    			
            </div>
        </section>
    </div>        
    
</div>
		
[[$siblingButtons]]		
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$addCollectionPopup]]

[[$savedItemsPopups]]

<div id="searchesSort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.title_sort_searches_by? &topic=`default` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_search_name_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_search_name_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<div id="bookmarksSort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.title_sort_bookmarks_by? &topic=`default` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_bookmark_title_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_bookmark_title_z_A? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<div id="collectionsSort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.title_search_collections_by? &topic=`default` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_collection_title_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_collection_title_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<script>
	[[!+user.delete_confirm:eq=`yes`:then=`
	var delete_confirm = true;
	`:else=`
	var delete_confirm = false;
	`]]
</script>

[[$scripts]]

<script>
	var enable_search = true; // this enables the search JS on this page
</script>

<script>
    
    $('i.editIcon, i.confirm, i.cancel').click(function() {
       $(this).parents('.item').find('.editField').toggleClass('open');
    });
    
    $(".switchModals").click(function(e){
      $("#addCollectionPopup").modal('hide');
      setTimeout(function(){
        $("#collectionAddedPopup").modal('show');
      }, 800);
      e.preventDefault();
    });    
    
</script>

	</body>
</html>