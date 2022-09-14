<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

[[$innerHero]]

<section class="lightGreyHalfMargin">
    <div class="container">
        <div class="categoryButtons">
            <h3>[[*pagetitle]] [[!%asi.title_categories? &topic=`default` &namespace=`asi`]]</h3>
            [[pdoResources?
              &parents=`[[*id]]`
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