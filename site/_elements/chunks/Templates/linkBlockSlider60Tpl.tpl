                    <div class="slide">
						<a class="linkBlock" href="[[~[[+id]]]]">
						    <span class="type [[#[[+parent]].tv.lbIconBG]]"><i class="[[#[[+parent]].tv.lbIcon]]"></i></span>
						    <div class="imageContainer">
							    <div class="image short" style="background-image:url([[+tv.refImage60:phpthumbof=`&w=400`]]);"></div>
							</div>
						    <div class="details">
							    <h5>[[+tv.heroTitle:notempty=`[[+tv.heroTitle]]`:default=`[[+pagetitle]]`]]</h5>
							    <p>[[+tv.refText]]</p>

							    <div class="date" style="bottom:10px">
							        [[+tv.refType:is=`tp`:then=`
							        [[-100,000+ [[%asi.results? &topic=`default` &namespace=`asi`]]]]
							        `:else=`
							            <div style="font-size:12px; color:#545454;margin-bottom:2px">last updated on</div>
                                        <i class="far fa-calendar-alt mr"></i> [[+editedon:date=`%d-%m-%Y`]]
							        `]]
			                    </div>
						    </div>
						</a>
					</div>
