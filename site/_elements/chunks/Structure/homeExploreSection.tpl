<section class="halfTopMargin">
	<div class="container">
		<div class="content text-center">
			[[*exploreSubTitle:notempty=`<h4 class="superTitle">[[*exploreSubTitle]]</h4>`]]
			[[*exploreTitle]]
		</div>
		<ul class="nav-tabs buttons mt30">
			<li class="active"><a href="#tabDocuments" data-toggle="tab">[[!%asi.title_highlights? &topic=`default` &namespace=`asi`]]</a></li>
			<li><a href="#tabTopics" data-toggle="tab">[[!%asi.tab_topics? &topic=`default` &namespace=`asi`]]</a></li>
		</ul>
		<div class="tab-content">
			<div id="tabDocuments" class="tab-pane fade active in">
				[[*exploreDocsHomeText:notempty=`
				<div class="content text-center">
					[[*exploreDocsHomeText]]
				</div>
				`:default=`
				[[#10.tv.exploreDocsText:notempty=`
				<div class="content text-center">
					[[#10.tv.exploreDocsText]]
				</div>
				`]]
				`]]
				<div id="homeDocumentsSlider" class="linkBlockSlider">
					[[pdoResources?
					&parents=`36`
					&tpl=`linkBlockSlider60Tpl`
					&limit=`6`
					[[*exploreDocsIDs:notempty=`
					&resources=`[[*exploreDocsIDs]]`
					`]]
					&sortby=`{"editedon":"DESC"}`
					&includeTVs=`heroTitle,refImage60,refText`
					&processTVs=`refImage60`
					]]
				</div>
				<div class="content text-center">
					<a class="button pink mt20" href="[[~10]]?tab=documents">[[!%asi.action_view_all_highlights? &topic=`actions` &namespace=`asi`]]</a>
				</div>
			</div>
			<div id="tabTopics" class="tab-pane fade">
				[[*exploreTopicsHomeText:notempty=`
				<div class="content text-center">
					[[*exploreTopicsHomeText]]
				</div>
				`:default=`
				[[#10.tv.exploreTopicsText:notempty=`
				<div class="content text-center">
					[[#10.tv.exploreTopicsText]]
				</div>
				`]]
				`]]
				<div id="homeTopicsSlider" class="linkBlockSlider">
					[[pdoResources?
					&parents=`37`
					&tpl=`linkBlockSlider60Tpl`
					&limit=`6`
					[[*exploreTopicsIDs:notempty=`
					&resources=`[[*exploreTopicsIDs]]`
					`]]
					&sortby=`{"publishedon":"DESC"}`
					&includeTVs=`heroTitle,refImage60,refText,refType`
					&processTVs=`refImage60`
					]]
				</div>
				<div class="content text-center">
					<a class="button pink mt20" href="[[~10]]?tab=topics">[[!%asi.action_view_all_topics? &topic=`actions` &namespace=`asi`]]</a>
				</div>
			</div>
		</div>
	</div>
</section>