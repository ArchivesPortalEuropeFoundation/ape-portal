                 [[+tv.memberFeatured:is=`yes`:then=`
                    <div class="col-md-12">
                        <div class="member full">
                            <div class="image" style="background-image:url([[+tv.memberImage]]);"></div>
                            <div class="text">
                                <h4>[[+tv.memberName]]</h4>
                                [[+tv.memberPosition:notempty=`<p><strong>[[+tv.memberPosition]]</strong></p>`]]
                                <p>[[+tv.memberArchival:notempty=`[[+tv.memberArchival]], `]]<strong>[[+tv.memberCountry]]</strong></p>
                                <div class="bio">[[+tv.memberIntro]]</div>
                                <a class="bioLink" href="" data-toggle="modal">[[!%asi.action_full_bio? &topic=`actions` &namespace=`asi`]] <i class="far fa-expand-alt ml"></i></a>
                                [[+tv.memberWebsite:notempty=`<a class="siteLink" href="https://[[+tv.memberWebsite]]" target="_blank">[[!%asi.title_website? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-right ml"></i></a>`]]
                            </div>
                        </div>
                    </div>
                `:else=`
                    <div class="col-sm-4 col-md-3">
                        <div class="member normal">
                            [[+tv.memberImage:notempty=`<div class="image" style="background-image:url([[+tv.memberImage]]);"></div>`]]
                            <div class="text">
                                <h4>[[+tv.memberName]]</h4>
                                [[+tv.memberPosition:notempty=`<p class="mb10"><strong>[[+tv.memberPosition]]</strong></p>`]]
                                <p>[[+tv.memberArchival:notempty=`[[+tv.memberArchival]],<br> `]]<strong>[[+tv.memberCountry]]</strong></p>
                                <a class="bioLink" href="" data-toggle="modal">[[!%asi.action_full_bio? &topic=`actions` &namespace=`asi`]] <i class="far fa-expand-alt ml"></i></a>
                                [[+tv.memberWebsite:notempty=`<a class="siteLink" href="https://[[+tv.memberWebsite]]" target="_blank">[[!%asi.title_website? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-right ml"></i></a>`]]
                            </div>
                        </div>
                    </div>
                `]]