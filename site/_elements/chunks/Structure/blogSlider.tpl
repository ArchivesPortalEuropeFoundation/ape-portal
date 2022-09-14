<section class="standard reducedBottomSM">
    <div class="container">
		<div class="content text-center">
			[[*latestNewsSubTitle:notempty=`<h4 class="superTitle">[[*latestNewsSubTitle]]</h4>`]]
			[[*latestNewsTitle]]
		</div>
		<div id="homeBlogSlider" class="linkBlockSlider inactive">
            [[pdoResources?
              &parents=`13`
              &resources=`[[*latestNewsResources]]`
              &tpl=`blogItemTpl`
              &limit=`4`
              &select=`{"modResource":"id,pagetitle,publishedon"}`
              &sortby=`{"publishedon":"DESC"}`
              &includeTVs=`articleTitle,refImage60`
              &processTVs=`refImage60`
              &setTotal=`1`
              &totalVar=`blogTotal`
            ]]	
		</div>
	</div>
</section>