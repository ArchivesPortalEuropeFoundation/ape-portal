<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

<section id="innerHero"[[*heroAlign:is=`left`:then=` class="left"`]]>
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[*heroTitle:notempty=`[[*heroTitle]]`:default=`[[*pagetitle]]`]]</h1>
            [[*heroText]]
        </div>
        <div class="selectDropdown jumpTo closes">
    	    <div class="title">[[!%asi.title_jump_to_section? &topic=`default` &namespace=`asi`]]</div>
    		<div class="inner">
    			[[getImageList?
    			  &tvname=`alternatingContentID`
    			  &tpl=`jumpToDropdownTpl`
    			]]
    		</div>
    	</div>
    </div>
</section>

<section class="lightGreyHalfMargin">
    <div class="container">
        <div class="categoryButtons">
            <h3>[[#[[*parent]].pagetitle]] [[!%asi.title_categories? &topic=`default` &namespace=`asi`]]</h3>
            [[pdoResources?
              &parents=`[[*parent]]`
              &depth=`0`
              &tpl=`categoryButtonTpl`
              &sortby=`{"menuindex":"ASC"}`
            ]]        
        </div>
    </div>
</section>

<section class="standard alternatingContent">
    <div class="container">
        [[getImageList?
          &tvname=`alternatingContentID`
          &tpl=`alternatingContentATpl`
          &tpl_n2=`alternatingContentBTpl`
        ]]	    
	</div>
</section>

<section class="lightGreyHalfMargin">
    <div class="container">
        <div class="categoryButtons">
            <h3>[[#[[*parent]].pagetitle]] [[!%asi.title_categories? &topic=`default` &namespace=`asi`]]</h3>
            [[pdoResources?
              &parents=`[[*parent]]`
              &depth=`0`
              &tpl=`categoryButtonTpl`
              &sortby=`{"menuindex":"ASC"}`
            ]]        
        </div>
    </div>
</section>

[[$siblingButtonsUltimate]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

	</body>
</html>