<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

[[$innerHero]]

[[getImageList?
  &tvname=`alternatingContent`
  &tpl=`alternatingContentATpl`
  &tpl_n2=`alternatingContentBTpl`
  &toPlaceholder=`alternatingContent`
]]

[[+alternatingContent:notempty=`
<section class="noTopMargin alternatingContent">
    <div class="container">
	    [[+alternatingContent]]
	</div>
</section>
`]]

<section class="standard" style="margin-top:-40px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-6">
                <div class="apiBlock">
                    <h3>[[!%asi.search_archives_portal_europe? &topic=`default` &namespace=`asi`]]</h3>
                    <form class="search">
                        <input type="text" class="searchField" name="search" placeholder="[[!%asi.input_ph_search_all_content? &topic=`input` &namespace=`asi`]]">
        				<input type="submit">
                    </form>
                    <p class="small mt10"><strong>[[!%asi.powered_by_ape? &topic=`default` &namespace=`asi`]]</strong></p>
                </div>
            </div>
        </div>                
    </div>
</section>

[[*latestNewsShow:is=`yes`:then=`[[$blogSlider]]`]]

[[$siblingButtons]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

[[$blogSliderScript]]

	</body>
</html>