<div id="membersPopup[[+idx]]" class="modal fade membersPopup">
    <div class="modal-dialog full">
        <div class="modal-content standard p30">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
            <div id="membersSlider[[+idx]]" class="membersSlider">

            [[pdoResources?
                &parents=`[[*id]]`
                &tpl=`memberSliderTpl`
                &limit=`0`
                &sortby=`{"menuindex":"ASC"}`
                &includeTVs=`memberName,memberImage,memberPosition,memberArchival,memberCountry,memberBio,memberWebsite,memberFeatured`
                &processTVs=`memberImage`
                &where=`[[!TaggerGetResourcesWhere? &tags=`[[+alias]]` &where=`{"memberFeatured": "yes"}`]]`
            ]]
            
            [[pdoResources?
                &parents=`[[*id]]`
                &tpl=`memberSliderTpl`
                &limit=`0`
                &sortby=`{"menuindex":"ASC"}`
                &includeTVs=`memberName,memberImage,memberPosition,memberArchival,memberCountry,memberBio,memberWebsite,memberFeatured`
                &processTVs=`memberImage`
                &where=`[[!TaggerGetResourcesWhere? &tags=`[[+alias]]` &where=`{"memberFeatured:IS": null}`]]`
            ]]

			</div>
			<div class="row">
			    <div class="offset">
			         <hr>
			         <div class="controls">
			             <span class="counter">0/0</span>
			         </div>
			     </div>
			</div>
		</div>
	</div>
</div>