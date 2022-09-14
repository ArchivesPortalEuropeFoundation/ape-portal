<div id="searchWithinPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			[[++search_within_text]]
			<h4 class="mt30 mb10">[[!%asi.title_choose_institutions? &topic=`default` &namespace=`asi`]]</h4>
			<form class="searchLight">
                <div class="inputWrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="[[!%asi.input_ph_find_institution? &topic=`input` &namespace=`asi`]]">
                </div>
            </form>
			<form class="standard mt10" action="/advanced-search/search-in-archives/">
			    <div class="checkboxList" data-section="inst_search_within">

                    <div class="moreDropdown">
                        <div class="inner">
                            <div class="checkbox">
                                <input type="checkbox" name="inst5" value="1">
                                <span>Institution name displays here (Country)</span>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="inst6" value="1">
                                <span>Institution name displays here (Country)</span>
                            </div>
                        </div>
                        <div class="title inContent">
                            [[!%asi.action_more? &topic=`actions` &namespace=`asi`]]
                        </div>
                    </div>
                </div>
			    <p class="fieldLabel">[[!%asi.label_your_search? &topic=`label` &namespace=`asi`]]</p>
			    [[++within_your_search_text]]
			    <div class="inputWrapper">
			        <input type="text" name="term" placeholder="[[!%asi.input_ph_type_term_here? &topic=`input` &namespace=`asi`]]">
			    </div>
			    
                    <div class="tools clearfix">
						<a class="expandAdvP">[[!%asi.expand_show_advanced_search_options? &topic=`search` &namespace=`asi`]] <i class="fas fa-angle-down"></i></a>
						<div class="checkboxes" data-control="checkbox_filters">
							<span class="checkbox">
								<input data-filter-field="containsdigital" data-filter-value="true" data-filter-type="boolean" type="checkbox" name="Contains digital objects">
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
								<input data-filter-field="separate" data-filter-value="true" data-filter-type="boolean" type="checkbox" name="separate" >
								
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
					<div id="advSearchControlsP">
					    <p class="bold">[[#50.tv.advSearchOptionsText]]</p>
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
							<span class="checkbox">
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
							</span>
						</div>
					</div>			    
			    
			    <input type="submit" class="full pink" value="[[!%asi.action_search_within_chosen_institutions? &topic=`actions` &namespace=`asi`]]">
			    
		    </form>
		</div>
	</div>
</div>