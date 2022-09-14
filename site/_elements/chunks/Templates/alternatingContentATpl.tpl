[[+type:is=`image`:then=`
        [[+label:notempty=`<a class="anchor" id="[[+label:lcase:urlencode:replace=`+==-`]]"></a>`]]
	    <div class="row">
			<div class="col-md-6">
				<div class="vCentre mobileNL[[+_last:is=`1`:then=` last`]]">
					<div class="inner">
						<div class="content[[+centre:notempty=` text-center`]]">
							[[+text]]
							[[+button1:isnot=``:then=`
							    [[+button1:calltoactiontv=`ctaTVButtonBlueTpl`]]
							`]]
							[[+button2:isnot=``:then=`
							    [[+button2:calltoactiontv=`ctaTVButtonBlueTpl`]]
							`]]
						</div>
					</div>
				</div> 
			</div>
		    <div class="col-md-6">
			    <div class="vCentre[[+_last:is=`1`:then=` last`]]">
					<div class="inner">
						<img class="img-responsive" src="[[+image]]">
					</div>
				</div>
			</div>
		</div>
`]]
[[+type:is=`video`:then=`
        [[+label:notempty=`<a class="anchor" id="[[+label:lcase:urlencode:replace=`+==-`]]"></a>`]]
	    <div class="row">
			<div class="col-md-6">
				<div class="vCentre mobileNL[[+_last:is=`1`:then=` last`]]">
					<div class="inner">
						<div class="content[[+centre:notempty=` text-center`]]">
							[[+text]]
							[[+button1:isnot=``:then=`
							    [[+button1:calltoactiontv=`ctaTVButtonBlueTpl`]]
							`]]
							[[+button2:isnot=``:then=`
							    [[+button2:calltoactiontv=`ctaTVButtonBlueTpl`]]
							`]]
						</div>
					</div>
				</div> 
			</div>
		    <div class="col-md-6">
			    <div class="vCentre[[+_last:is=`1`:then=` last`]]">
					<div class="inner">
						<div class="videoContainer">
						    <iframe src="https://www.youtube.com/embed/[[+video]]?enablejsapi=1&version=3&playerapiid=ytplayer&rel=0&modestbranding=1" allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
`]]
[[+type:is=`text`:then=`
        [[+label:notempty=`<a class="anchor" id="[[+label:lcase:urlencode:replace=`+==-`]]"></a>`]]
	    <div class="row">
			<div class="col-md-12">
				<div class="content vCentre[[+_last:is=`1`:then=` last`]][[+centre:notempty=` text-center`]]">
					[[+text]]
					[[+button1:isnot=``:then=`
					    [[+button1:calltoactiontv=`ctaTVButtonBlueTpl`]]
					`]]
					[[+button2:isnot=``:then=`
						[[+button2:calltoactiontv=`ctaTVButtonBlueTpl`]]
					`]]
				</div> 
			</div>
		</div>
`]]