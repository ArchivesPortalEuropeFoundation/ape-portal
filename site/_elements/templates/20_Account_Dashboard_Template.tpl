[[-!getUserExtFields]]
<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$headerAccountTemp]]

<section id="innerHero"[[*heroAlign:is=`left`:then=` class="left"`]]>
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[!%asi.msg_hello? &topic=`account` &namespace=`asi`]] [[!getUserFirstName]]</h1>
            [[*heroText]]
        </div>
    </div>
</section>
	
<section class="halfBottomMargin">
    <div class="container">
        <div class="row">


            [[pdoResources?
              &parents=`[[*id]]`
              &resources=`[[!+user.is_admin:neq=`1`:then=`-[[!BabelTranslation:default=`76`? &contextKey=`[[+contextKey]]` &resourceId=`76`]]`]]`
              &tpl=`childLinkBlockTpl`
              &sortby=`{"menuindex":"ASC"}`
              &includeTVs=`heroTitle,refText`
            ]]
        </div>
    </div>
</section>
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[-$welcomePopup]]

[[$scripts]]

<script>
    if ('[[-+userExtFields.new_user]]' === 'yes') {
        $('#welcomePopup').modal({backdrop: 'static', keyboard: false});
    }
</script>

	</body>
</html>