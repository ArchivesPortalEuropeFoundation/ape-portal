    			<div class="row">
    			    [[+tv.memberImage:notempty=`
    			    <div class="col-sm-3">
                        <div class="image" style="background-image:url([[+tv.memberImage]]);"></div>
    			    </div>
    			    <div class="col-sm-9">
    			    `:default=`
    			    <div class="col-md-12">
    			    `]]
                        <div class="content">
                            <h2>[[+tv.memberName]]</h2>
                            [[+tv.memberPosition:notempty=`<p><strong>[[+tv.memberPosition]]</strong></p>`]]
                            <p>[[+tv.memberArchival:notempty=`[[+tv.memberArchival]], `]]<strong>[[+tv.memberCountry]]</strong></p>
                            [[+tv.memberWebsite:notempty=`<p><a class="siteLink" href="https://[[+tv.memberWebsite]]" target="_blank">[[+tv.memberWebsite]]</a></p>`]]
                            [[+tv.memberBio]]
                        </div>			        
    			    </div>
    			</div>