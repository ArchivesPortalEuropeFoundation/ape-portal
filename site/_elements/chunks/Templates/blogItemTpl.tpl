                    <div class="[[+blogTotal:gt=`3`:then=`col-md-3`]][[+blogTotal:is=`3`:then=`col-md-4`]][[+blogTotal:is=`2`:then=`col-md-6`]][[+blogTotal:is=`1`:then=`col-md-12`]]">
                        <a class="linkBlock[[+blogTotal:is=`2`:then=` wide`]][[+blogTotal:is=`1`:then=` single margins`]]" href="[[~[[+id]]]]">
                            <span class="type yellow"><i class="fas fa-tag"></i><span class="text open">[[TaggerGetTags? &resources=`[[+id]]` &rowTpl=`taggerNameTpl` &limit=`1` &sort=`{"rank": "ASC"}`]]</span></span>
        					<div class="imageContainer">
        					    <div class="image" style="background-image:url([[+tv.refImage60:notempty=`[[+tv.refImage60]]`:default=`[[#13.tv.refPlaceholder]]`]]);"></div>
        					</div>
        					<div class="details">
        						<h5>[[+tv.articleTitle:notempty=`[[+tv.articleTitle:ellipsis=`50`]]`:default=`[[+pagetitle:ellipsis=`50`]]`]]</h5>
        						<span class="date"><i class="far fa-calendar-alt mr"></i> [[+publishedon:date=`%d-%m-%Y`]]</span>																
        					</div>
        				</a>
        			</div>