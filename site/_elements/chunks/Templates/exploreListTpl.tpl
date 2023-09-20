                    <div class="[[+template:is=`9`:then=`col-sm-6`:else=`col-md-6`]]">
						<a class="exploreListItem matchHeight" href="[[~[[+id]]]]">
						    [[+tv.heroTitle:notempty=`[[+tv.heroTitle:ellipsis=`50`]]`:default=`[[+pagetitle:ellipsis=`50`]]`]]
							<span class="date">
							    [[+tv.refType:is=`tp`:then=`
                  [[-100,000+ [[%asi.results? &topic=`default` &namespace=`asi`]]]]
							    `:else=`
								(last update on: [[+editedon:date=`%d-%m-%Y`]])
							    `]]
							</span>
						</a>
					</div>