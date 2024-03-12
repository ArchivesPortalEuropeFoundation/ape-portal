[[!user]]
[[!language]]

[[!asi_search_result_detail_metatags? &baseurl=`[[!++site_url]]`]]

        <!-- Website created by GEL Studios Ltd https://www.gelstudios.co.uk/ //-->
		<title>[[!+metacontent.metacontent.title:is=null:then=`[[!+seoPro.title]]`:else=`[[+metacontent.metacontent.title]] | [[++site_name]]`]]</title>
        <base href="[[++site_url]]" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="[[*description:is=null:then=`[[!+metacontent.metacontent.description]]`:else=`[[*description]]`]]">
        <meta name="abstract" content="[[*description:is=null:then=`[[!+metacontent.metacontent.description]]`:else=`[[*description]]`]]">
        <meta name="keywords" content="[[!+metacontent.metacontent.keywords:is=null:then=`[[getKeywords]]`:else=`[[+metacontent.metacontent.keywords]]`]]">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="robots" content="[[+seoTab.robotsTag]]">
        <meta name="publisher" content="[[++site_name]]">
        <meta name="author" content="[[!+metacontent.metacontent.publisher:is=null:then=`[[!++site_name]]`:else=`[[+metacontent.metacontent.publisher]]`]]">

        <meta property="og:title" content="[[!+metacontent.metacontent.title:is=null:then=`[[!+seoPro.title]]`:else=`[[+metacontent.metacontent.title]]`]]">
        <meta property="og:type" content="website">
        <meta property="og:url" content="[[++site_url]][[!+metacontent.metacontent.url]]">
        <meta property="og:image" content="[[++site_url]][[!+metacontent.metacontent.image:is=null:then=`[[*og_image:replace=`/assets/==assets/`:default=`assets/images/ape_poster.jpg`]]`:else=`[[+metacontent.metacontent.image]]`]]">
        <meta property="og:site_name" content="[[++site_name]]">
        <meta property="og:description" content="[[*description:is=null:then=`[[!+metacontent.metacontent.description]]`:else=`[[*description]]`]]">

        <meta name="apple-mobile-web-app-title" content="[[!+metacontent.metacontent.title:is=null:then=`[[!+seoPro.title]]`:else=`[[+metacontent.metacontent.title]]`]]">
        <meta name="apple-touch-icon" content="[[++site_url]][[!+metacontent.metacontent.image:is=null:then=`[[*og_image:replace=`/assets/==assets/`:default=`assets/images/ape_poster.jpg`]]`:else=`[[+metacontent.metacontent.image]]`]]">
        <meta name="apple-touch-startup-image" content="[[++site_url]][[!+metacontent.metacontent.image:is=null:then=`[[*og_image:replace=`/assets/==assets/`:default=`assets/images/ape_poster.jpg`]]`:else=`[[+metacontent.metacontent.image]]`]]">

        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:title" content="[[!+metacontent.metacontent.title:is=null:then=`[[!+seoPro.title]]`:else=`[[+metacontent.metacontent.title]]`]]">
        <meta name="twitter:description" content="[[*description:is=null:then=`[[!+metacontent.metacontent.description]]`:else=`[[*description]]`]]">
        <meta name="twitter:image" content="[[++site_url]][[!+metacontent.metacontent.image:is=null:then=`[[*og_image:replace=`/assets/==assets/`:default=`assets/images/ape_poster.jpg`]]`:else=`[[+metacontent.metacontent.image]]`]]">
        <meta name="twitter:site" content="@ArchivesPortal">

        <link rel="shortcut icon" href="[[++base_url]]assets/images/favicon.ico" type="image/vnd.microsoft.icon" />
    	<link rel="icon" href="[[++base_url]]assets/images/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="canonical" href="[[++site_url]][[!+metacontent.metacontent.url]]" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="[[++base_url]]assets/css/tooltipster.bundle.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="[[++base_url]]assets/css/bootstrap-datetimepicker.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="[[++base_url]]assets/css/quill.snow.css" media="screen" />
        [[-<link rel="stylesheet" type="text/css" href="[[++base_url]]assets/css/fc-core-main.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="[[++base_url]]assets/css/fc-grid-main.min.css" media="screen" />]]
        <link rel="stylesheet" type="text/css" href="[[++base_url]]assets/css/fullcalendar.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="[[++base_url]]assets/style.css?[[+now:default=`now`:strtotime]]" media="screen" />
        <script>
            var section = '';
        </script>
[[-++scripts]]
