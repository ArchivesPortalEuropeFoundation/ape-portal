[[-
	// Need to add var to config
]]

<div id="locationPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    [[++location_uk_text]]
			</div>
			<div class="row">
			    <div class="col-sm-6">
			        <a class="button pink full mt20" href="#">[[!%asi.action_take_me_to_site? &topic=`actions` &namespace=`asi`]]</a>
			    </div>
			    <div class="col-sm-6">
    			    <a class="button pink full mt20" data-dismiss="modal">[[!%asi.action_stay_on_this_site? &topic=`actions` &namespace=`asi`]]</a>
			    </div>
			</div>
		</div>
	</div>
</div>