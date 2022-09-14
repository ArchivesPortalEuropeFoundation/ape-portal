<!DOCTYPE html>
<html lang="[[!++cultureKey]]">

<head>
	[[$head]]
</head>
<body>
	[[$header]]

	<style>
		#advSearchControls .contentDropdown {
			color: #555;
		}

		#advSearchControls .contentDropdown .checkbox input::before,
		#advSearchControlsP.blueBG .contentDropdown .checkbox input::before {
			color: #555;
		}

		#advSearchControls .contentDropdown .tipTitle {
			padding-left: 0;
			color: #AAA;
		}

		#advSearchControls .contentDropdown .tooltipstered {
			display: none;
		}

		#advSearchControls .contentDropdown {
			padding: 11px 10px 5px 10px;
			border: 1px solid #aeaeae;
		}

		#advSearchControls .contentDropdown>.title:after {
			top: 12px;
			color: #AAA;
		}
		@media (min-width: 992px) {
			#advSearchControls .advSubmit, #advSearchControlsP .advSubmit {
				text-align: right;
				margin-top: -45px;
			}

		}

	</style>

	<section id="homeHero" style="background-image:url([[*homeHeroBG]]);">
		<div class="overlay">
			<div class="magGlass"></div>
			<div class="container">
				<div class="content text-center">
					<h1>[[!*homeHeroTitle]]</h1>
					[[!*homeHeroSubTitle:notempty=`<h3>[[*homeHeroSubTitle]]</h3>`]]
					[[!*homeHeroText]]
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
						[[!*homeSearchIntroText]]
					</div>
					<form class="search large" action="[[~[[*id]]]]" method="post">
						<input type="text" autocomplete="off" data-input="search_term" class="searchField" name="search"
							placeholder="[[!%asi.type_search_term? &topic=`input` &namespace=`asi`]]"
							value="[[!from_request?&input=`term`]]">
						<input type="submit" data-control="search_term_trigger" data-switch-to="archive">
						<div class="suggestions" data-interface="suggestions">

							<div class="suggest_inner" data-container="section_suggest" style="display: none;">
								<h5>[[!%asi.search_sections? &topic=`search` &namespace=`asi`]]</h5>
								<div data-populate="section_suggest"></div>
								<hr>
							</div>

							<div class="suggest_inner" data-container="spelling_suggest" style="display: none;">
								<h5>[[!%asi.search_spelling? &topic=`search` &namespace=`asi`]]</h5>
								<div data-populate="spelling_suggest"></div>
								<hr>
							</div>

							<div class="suggest_inner" data-container="topic_suggest" style="display: none;">
								<h5>[[!%asi.search_topics? &topic=`search` &namespace=`asi`]]</h5>
								<div data-populate="topic_suggest"></div>
								<hr>
							</div>


							[[-
							<a class="entry" href="#">Archives <strong data-populate="term" data-action="update_term"
									data-template="City of %"></strong> <i class="fas fa-building"></i> <span
									data-populate="suggestion_count_archives"></span></a>
							<a class="entry" href="#">Names <strong data-populate="term" data-action="update_term"
									data-template="John %"></strong> <i class="fas fa-user"></i> <span
									data-populate="suggestion_count_archives"></span></a>
							<a class="entry" href="#">Institutions <strong data-populate="term"
									data-action="update_term"></strong> <i class="fas fa-book"></i> <span
									data-populate="suggestion_count_institutions"></span></a>
							<hr>
							<h5>[[!%asi.did_you_mean? &topic=`default` &namespace=`asi`]]:</h5>
							<a class="entry" href="#" data-populate="did_you_mean_1" data-action="update_term"></a>
							<a class="entry" href="#" data-populate="did_you_mean_2" data-action="update_term"></a>
							]]


						</div>
						<span class="clearSearch">[[!%asi.clear_term? &topic=`search` &namespace=`asi`]]</span>
						<div class="tools clearfix">
							<a class="expandAdv">[[!%asi.show_adv_options? &topic=`search` &namespace=`asi`]] <i
									class="fas fa-angle-down"></i></a>
							<div class="checkboxes" data-control="checkbox_filters">
								<span class="checkbox">
									<input data-type="homepage_filter" data-filter-field="containsdigital" data-filter-value="true"
										data-filter-type="boolean" type="checkbox" name="Contains digital objects">
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
									<input data-type="homepage_filter" data-filter-field="separate" data-filter-value="true" data-filter-type="boolean"
										type="checkbox" name="separate">
									[[++tt_search_check_terms:notempty=`
									<span class="tipText">
										[[!%asi.search_term_sep? &topic=`search` &namespace=`asi`]]
										<div class="tipIcon" data-tooltip-content="#searchTermTooltip">
											<i class="far fa-question-circle"></i>
										</div>
									</span>
									`:default=`
									<span>[[!%asi.search_term_sep? &topic=`search` &namespace=`asi`]]</span>
									`]]
								</span>
							</div>
						</div>
						<div id="advSearchControls">
							<p class="bold">[[*homeSearchAdvText]]</p>
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="advControl">
										<div class="tipTitle">
											<div class="tipIcon" data-tooltip-content="#searchElementTooltip">
												<i class="far fa-question-circle"></i>
											</div>
											<p class="strongLabel">[[!%asi.search_using? &topic=`search` &namespace=`asi`]]</p>
										</div>
										<div class="contentDropdown select-topics" data-g="search-select-topics">
											<div class="title">
												<div class="tipTitle">
													<div class="tipIcon tooltipstered"
														data-tooltip-content="#searchFilterusingTooltip">
														<i class="far fa-question-circle"></i>
													</div>
													[[!%asi.search_using? &topic=`search` &namespace=`asi`]]
												</div>
											</div>
											<div class="inner" data-facet-set="using" style="display: none;">
												[[-
												<div class="searchLight">
													<div class="inputWrapper">
														<i class="fas fa-search"></i>
														<input data-g="search-filter" data-search-target="using"
															type="text" name="search"
															placeholder="[[!%asi.find_search_using? &topic=`input` &namespace=`asi`]]"
															autocomplete="off">
													</div>
												</div>
												]]
												<div class="checkboxList" data-control="using">
													[[- js fills this in ]]
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="advControl">
										<div class="tipTitle">
											<div class="tipIcon" data-tooltip-content="#searchDocumentTooltip">
												<i class="far fa-question-circle"></i>
											</div>
											<p class="strongLabel">[[!%asi.find_doc_type? &topic=`search`
												&namespace=`asi`]]</p>
										</div>

										<div class="contentDropdown">
											<div class="title">
												<div class="tipTitle">
													<div class="tipIcon tooltipstered"
														data-tooltip-content="#searchFiltertypesTooltip">
														<i class="far fa-question-circle"></i>
													</div>
													[[!%asi.drop_doc_type? &topic=`search` &namespace=`asi`]]
												</div>
											</div>
											<div class="inner">
												<div class="checkboxList" data-control="types">
													[[- types is populated by search.js ]]
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 hidden">
									<div class="advControl">
										[[++tt_search_by_date:notempty=`
										<div class="tipTitle">
											<div class="tipIcon" data-tooltip-content="#searchDateTooltip">
												<i class="far fa-question-circle"></i>
											</div>
											<p class="strongLabel">[[!%asi.date_search? &topic=`search`
												&namespace=`asi`]]</p>
										</div>
										`:default=`
										<p class="strongLabel">[[!%asi.date_search? &topic=`search` &namespace=`asi`]]
										</p>
										`]]
										<div class="dateSearch">
											<span class="checkbox">
												<input type="checkbox" name="exactDate" value="1">
												[[!%asi.exact_date_search? &topic=`search` &namespace=`asi`]]
											</span>
											<div class="inputWrapper">
												<i class="far fa-calendar-alt"></i>
												<input type="text" id="dateFrom" name="dateFrom" data-input-type="homepage_date_from"
													placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
											</div>
											<span class="to">[[!%asi.date_to? &topic=`search` &namespace=`asi`]]</span>
											<div class="inputWrapper">
												<i class="far fa-calendar-alt"></i>
												<input type="text" id="dateTo" name="dateTo" data-input-type="homepage_date_to"
													placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="advSubmit">
								<span class="checkbox">
									<input type="checkbox" name="context" value="1" data-tab-target="contextTab">
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
								</span>
								<a class="button large pink submitSearch1" data-control="search_term_trigger" data-switch-to="archive"><i class="fas fa-search"></i>
									[[!%asi.btn_search? &topic=`actions` &namespace=`asi`]]</a>
								<a class="hideAdv">[[!%asi.hide_adv_search_options? &topic=`search` &namespace=`asi`]]<i
										class="fas fa-angle-up"></i></a>
							</div>
						</div>
						<div class="mobileSubmit">
							<a class="button large pink submitSearch2" data-control="search_term_trigger"
								data-switch-to="archive"><i class="fas fa-search"></i> [[!%asi.btn_search?
								&topic=`actions` &namespace=`asi`]]</a>
							<span class="reduceSearch"><i class="fas fa-eye-slash"></i> [[!%asi.reduce_search?
								&topic=`search` &namespace=`asi`]]</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	[[*explorePosition:is=`Yes`:then=`[[$homeExploreSection]]`:else=`[[$homeCountrySection]]`]]

	[[+alternatingContent:notempty=`
	<section class="standard alternatingContent">
		<div class="container">
			[[getImageList?
			&tvname=`hAlternatingContent`
			&tpl=`alternatingContentATpl`
			&tpl_n2=`alternatingContentBTpl`
			&toPlaceholder=`alternatingContent`
			]]
			[[+alternatingContent]]
		</div>
	</section>
	`]]

	[[*explorePosition:is=`No`:then=`[[$homeExploreSection]]`:else=`[[$homeCountrySection]]`]]

	<section class="pink">
		<div class="container">
			<div class="content text-center">
				[[*joinBannerText]]
			</div>
			<div class="centreButtons">
				[[getImageList?
				&tvname=`joinBannerButtons`
				&tpl=`joinBannerButtonsTpl`
				&limit=`4`
				]]
			</div>
		</div>
	</section>

	[[$blogSlider]]

	[[+alternatingContent2:notempty=`
	<section class="standard alternatingContent reducedTopSM">
		<div class="container">
			[[getImageList?
			&tvname=`hAlternatingContent2`
			&tpl=`alternatingContentATpl`
			&tpl_n2=`alternatingContentBTpl`
			&toPlaceholder=`alternatingContent2`
			]]
			[[+alternatingContent2]]
		</div>
	</section>
	`]]

	[[$footer]]

	[[$banners]]

	[[$tooltips]]

	<script>
		var enable_search = true; // this enables the search JS on this page

		var section = 'search-in-archives';
		var force_redirect = true;
	</script>
	[[$scripts]]

	[[$blogSliderScript]]



</body>

</html>