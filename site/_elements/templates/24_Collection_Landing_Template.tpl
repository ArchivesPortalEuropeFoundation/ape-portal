<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

[[!asi_landing_collection]]

<section id="innerHero" class="left">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-7 col-lg-8">
                [[$breadcrumbs]]
                <div class="content">
                    <h1>[[!+collection.name]]</h1>
                    [[*heroText]]
                </div>        
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4">
				[[!+user.logged_in:eq=`0`:then=`
                <div class="ctaBlock">
                    <h4>[[!%asi.title_create_own_collections_with_account? &topic=`default` &namespace=`asi`]]</h4>
                    <div class="row">
                        <div class="col-sm-7">
                            <a class="button blue full" href="[[~78]]">[[!%asi.action_create_account? &topic=`actions` &namespace=`asi`]]</a>
                        </div>
                        <div class="col-sm-5">
                            <a class="button pink full" href="[[~78]]">[[!%asi.label_login? &topic=`label` &namespace=`asi`]]</a>
                        </div>
                    </div>
                </div>
				`]]
            </div>
        </div>
    </div>
</section>

<section class="lightGreyHalfMargin">
    <div class="container">
        <h2 class="pink mb30">[[!%asi.title_collection_details? &topic=`default` &namespace=`asi`]]</h2>
        <div class="alignedText p160">
            <span class="title">(ID) [[!%asi.title_collection_id_title? &topic=`default` &namespace=`asi`]]:</span>
            <p>([[!+collection.id]]) [[!+collection.name]]</p>
        </div>
		[[!+collection.description:neq=``:then=`
		<div class="alignedText p160">
			<span class="title">[[!%asi.title_description? &topic=`default` &namespace=`asi`]]:</span>
			<p>[[!+collection.description:htmlentities:nl2br]]</p>
		</div>
		`]]
        <div class="alignedText p160">
            <span class="title">[[!%asi.title_collection_searches? &topic=`default` &namespace=`asi`]]:</span>
            <p>[[!+collection.count_searches]]</p>
        </div>
        <div class="alignedText p160">
            <span class="title">[[!%asi.title_bookmarks? &topic=`default` &namespace=`asi`]]:</span>
			<p>[[!+collection.count_bookmarks]]</p>
        </div>
        <div class="alignedText p160">
            <span class="title">[[!%asi.title_created_on? &topic=`default` &namespace=`asi`]]:</span>
            <p>[[!+collection.created_at]]</p>
        </div>
        <div class="alignedText p160">
            <span class="title">[[!%asi.title_created_by? &topic=`default` &namespace=`asi`]]:</span>
            <p>[[!+collection.owner_firstname]] [[!+collection.owner_lastname]]</p>
        </div>
    </div>
</section>

<section class="halfMargin">
    <div class="container">
        <div class="savedSearch landing">
        
		<div class="category">
			<h3>[[!%asi.title_searches? &topic=`default` &namespace=`asi`]]</h3>
			[[!+collection.count_searches:neq=`0`:then=`
			<div class="details hidden-xs">
				<div class="row">
					<div class="col-sm-3">
						<div class="item">
							<div class="title">(ID) [[!%asi.title_search_title? &topic=`default` &namespace=`asi`]]</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="item">
							<div class="title">[[!%asi.title_description? &topic=`default` &namespace=`asi`]]</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="item padR">
							<div class="title">[[!%asi.title_search_term? &topic=`default` &namespace=`asi`]]</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="item offsetL">
							<div class="icons">
								<span>[[!%asi.title_remove? &topic=`default` &namespace=`asi`]]</span>
							</div>
							<div class="title">[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]</div>
						</div>
					</div>
				</div>
			</div>
			`]]

			[[!+collection.count_searches:eq=`0`:then=`
			<p style="text-align: center; margin-top: 10px;">You currently have no saved searches</p>
			`:else=`
				[[!+collection.searches_html]]
			`]]

		</div>

		<div class="category">
			<h3>[[!%asi.title_bookmarks? &topic=`default` &namespace=`asi`]]</h3>

			[[!+collection.count_bookmarks:neq=`0`:then=`
			<div class="details hidden-xs">
				<div class="row">
					<div class="col-sm-3">
						<div class="item">
							<div class="title">(ID) [[!%asi.title_bookmark_name? &topic=`default` &namespace=`asi`]]</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="item">
							<div class="title">[[!%asi.title_description? &topic=`default` &namespace=`asi`]]</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="item padR">
							<div class="title">[[!%asi.title_type_of_archive? &topic=`default` &namespace=`asi`]]</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="item offsetL">
							<div class="title">[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]</div>
							<div class="icons">
								<span>[[!%asi.title_remove? &topic=`default` &namespace=`asi`]]</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			`]]

			[[!+collection.count_bookmarks:eq=`0`:then=`
			<p style="text-align: center; margin-top: 10px;">You currently have no saved bookmarks</p>
			`:else=`
			[[!+collection.bookmarks_html]]
			`]]

        
        </div>
    </div>
</section>
		
<section id="homeHero" style="background-image:url([[#1.tv.homeHeroBG]]);" class="landing">
    <div class="overlay">
        <div class="magGlass"></div>
		<div class="container">
			<div class="content text-center">
				<h3>[[#1.tv.homeHeroSubTitle]]</h3>
			</div>
			<div id="searchContainer">
				<div class="content text-center">
					[[++tt_search_main:notempty=`
					<div class="tipTitle">
						<div class="tipIcon" data-tooltip-content="#searchMainTooltip">
							<i class="far fa-question-circle"></i>
						</div>
						<h4>[[!%asi.start_your_search? &topic=`search` &namespace=`asi`]]</h4>
					</div>
					`:default=`
					<h4>[[!%asi.start_your_search? &topic=`search` &namespace=`asi`]]</h4>
					`]]
					[[#1.tv.homeSearchIntroText]]
				</div>
				<form class="search large" action="[[~[[*id]]]]" method="post">
					<input type="text" class="searchField" name="search" placeholder="[[!%asi.input_ph_search_all_content? &topic=`input` &namespace=`asi`]]">
					<input type="submit">
					<div class="suggestions">
						<a class="entry" href="#">City of <strong>London</strong> <i class="fas fa-building"></i> <span>(100,000+)</span></a>
						<a class="entry" href="#">John <strong>London</strong> <i class="fas fa-user"></i> <span>(10)</span></a>
						<a class="entry" href="#">Topic <strong>London</strong> <i class="fas fa-book"></i> <span>(1)</span></a>
						<hr>
						<h5>[[!%asi.did_you_mean? &topic=`default` &namespace=`asi`]]:</h5>
						<a class="entry" href="#">Result name here <i class="fas fa-landmark"></i> <span>(100,000+)</span></a>
						<a class="entry" href="#">Another result <i class="fas fa-users"></i> <span>(10,000+)</span></a>
					</div>	
					<span class="clearSearch"><i class="fas fa-times"></i></span>
					<div class="tools clearfix">
						<a class="expandAdv">[[!%asi.show_adv_options? &topic=`search` &namespace=`asi`]] <i class="fas fa-angle-down"></i></a>
						<div class="checkboxes">
							<span class="checkbox">
								<input type="checkbox" name="digital" value="1">
								[[++tt_search_check_digital:notempty=`
								<span class="tipText">
								    [[!%asi.show_digital_objs? &topic=`search` &namespace=`asi`]]
								    <div class="tipIcon" data-tooltip-content="#searchDigitalTooltip">
										<i class="far fa-question-circle"></i>
									</div>
								</span>
								`:default=`
								<span>[[!%asi.show_digital_objs? &topic=`search` &namespace=`asi`]]</span>
								`]]
							</span>
						    <span class="checkbox">
								<input type="checkbox" name="seperate" value="1">
								[[++tt_search_check_terms:notempty=`
								<span class="tipText">
								    [[!%asi.label_search_each_term_sep? &topic=`label` &namespace=`asi`]]
									<div class="tipIcon" data-tooltip-content="#searchTermTooltip">
										<i class="far fa-question-circle"></i>
									</div>
								</span>
								`:default=`
								<span>[[!%asi.label_search_each_term_sep? &topic=`label` &namespace=`asi`]]</span>
								`]]
							</span>  
						</div>
					</div>
					<div id="advSearchControls">
					    <p class="bold">[[#1.tv.homeSearchAdvText]]</p>
						<div class="row">
							<div class="col-sm-6 col-md-3">
							    <div class="advControl">
							        [[++tt_search_select_element:notempty=`
    							    <div class="tipTitle">
    									<div class="tipIcon" data-tooltip-content="#searchElementTooltip">
    								        <i class="far fa-question-circle"></i>
    									</div>
    								    <p class="strongLabel">[[!%asi.search_using? &topic=`search` &namespace=`asi`]]</p>
    								</div>
    								`:default=`
    								<p class="strongLabel">[[!%asi.search_using? &topic=`search` &namespace=`asi`]]</p>
    								`]]
									<div class="selectWrapper">
										<select name="elements">
											<option value="">All elements</option>
											<option value="1">Element 1</option>
											<option value="2">Element 2</option>
											<option value="3">Element 3</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="advControl">
    								[[++tt_search_select_document:notempty=`<div class="tipTitle">
    									<div class="tipIcon" data-tooltip-content="#searchDocumentTooltip">
    										<i class="far fa-question-circle"></i>
    									</div>
    									<p class="strongLabel">[[!%asi.drop_doc_type? &topic=`search` &namespace=`asi`]]</p>
    								</div>
    								`:default=`
    								<p class="strongLabel">[[!%asi.drop_doc_type? &topic=`search` &namespace=`asi`]]</p>
    								`]]
									<div class="selectWrapper">
										<select name="documents">
										    <option value="">All documents</option>
											<option value="1">Document 1</option>
											<option value="2">Document 2</option>
											<option value="3">Document 3</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="advControl">
    								[[++tt_search_by_date:notempty=`
    								<div class="tipTitle">
    									<div class="tipIcon" data-tooltip-content="#searchDateTooltip">
    										<i class="far fa-question-circle"></i>
    									</div>
    									<p class="strongLabel">[[!%asi.date_search? &topic=`search` &namespace=`asi`]]</p>
    								</div>
    								`:default=`
    								<p class="strongLabel">[[!%asi.date_search? &topic=`search` &namespace=`asi`]]</p>
    								`]]
									<div class="dateSearch">
										<span class="checkbox">
											<input type="checkbox" name="exactDate" value="1">
											[[!%asi.exact_date_search? &topic=`search` &namespace=`asi`]]
										</span>  
    									<div class="inputWrapper">
    										<i class="far fa-calendar-alt"></i>
    										<input type="text" id="dateFrom" name="dateFrom" placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
    									</div>
										<span class="to">[[!%asi.date_to? &topic=`search` &namespace=`asi`]]</span>
										<div class="inputWrapper">
    									    <i class="far fa-calendar-alt"></i>
    										<input type="text" id="dateTo" name="dateTo" placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
    									</div>
									</div>
								</div>
							</div>
						</div>
						<div class="advSubmit">
							[[-<span class="checkbox">
								<input type="checkbox" name="context" value="1">
								[[++tt_search_in_context:notempty=`
								<span class="tipText">
									[[!%asi.view_in_context? &topic=`search` &namespace=`asi`]]
									<div class="tipIcon" data-tooltip-content="#searchContextTooltip">
									    <i class="far fa-question-circle"></i>
									</div>
								</span>
								`:default=`
								<span>[[!%asi.view_in_context? &topic=`search` &namespace=`asi`]]</span>
								`]]
							</span>]]
							<a class="button large pink submitSearch1"><i class="fas fa-search"></i> [[!%asi.btn_search? &topic=`actions` &namespace=`asi`]]</a>
							<a class="hideAdv">[[!%asi.hide_adv_search_options? &topic=`search` &namespace=`asi`]]<i class="fas fa-angle-up"></i></a>
						</div>
					</div>
					<div class="mobileSubmit">
					    <a class="button large pink submitSearch2"><i class="fas fa-search"></i> [[!%asi.btn_search? &topic=`actions` &namespace=`asi`]]</a>
					    <span class="reduceSearch"><i class="fas fa-eye-slash"></i> [[!%asi.reduce_search? &topic=`search` &namespace=`asi`]]</span>
					</div>
				</form>		
			</div>
		</div>
	</div>
</section>		
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$savedItemsPopups]]

[[$scripts]]

	</body>
</html>
