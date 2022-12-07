[[!user]]
[[!language]]

        <!-- Website created by GEL Studios Ltd https://www.gelstudios.co.uk/ //-->
		<title>[[+seoPro.title]]</title>
        <base href="[[++site_url]]" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="[[*description]]">
        <meta name="keywords" content="[[getKeywords]]">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="robots" content="[[+seoTab.robotsTag]]">
        <meta name="author" content="[[++site_name]]">

       	<meta property="og:title" content="[[*longtitle:default=`[[*pagetitle]]`]]">
        <meta property="og:type" content="website">
        <meta property="og:url" content="[[fullURL? &id=`[[*id]]`]]">
        <meta property="og:image" content="[[++site_url]][[*og_image:replace=`/assets/==assets/`:default=`assets/images/fb_img.jpg`]]">
        <meta property="og:site_name" content="[[++site_name]]">
        <meta property="og:description" content="[[*description]]">

        <link rel="shortcut icon" href="[[++base_url]]assets/images/favicon.ico" type="image/vnd.microsoft.icon" />
    	<link rel="icon" href="[[++base_url]]assets/images/favicon.ico" type="image/vnd.microsoft.icon" />
        <!--<link rel="canonical" href="[[~[[*id]]? &scheme=`full`]]" />-->
        
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
