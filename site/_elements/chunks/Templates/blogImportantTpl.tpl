                    <div class="[[+count:is=`1`:then=`col-xs-12`:else=`col-sm-6`]]">
                        <a class="linkBlock [[+count:is=`1`:then=`single`:else=`wide`]]" href="[[~[[+id]]]]">
                            <div class="imageContainer">
        					    <div class="image" style="background-image:url([[+tv.refImage60:notempty=`[[+tv.refImage60]]`:default=`[[#13.tv.refPlaceholder]]`]]);"></div>
        					</div>
        					<div class="details">
        						<h5>[[+tv.articleTitle:notempty=`[[+tv.articleTitle:ellipsis=`50`]]`:default=`[[+pagetitle:ellipsis=`50`]]`]]</h5>
        						<span class="date"><i class="far fa-calendar-alt mr"></i> [[+publishedon:date=`%d-%m-%Y`]]</span>																
        					</div>
        				</a>
        			</div>