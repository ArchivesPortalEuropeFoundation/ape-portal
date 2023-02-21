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
        <link rel="stylesheet" href="[[++base_url]]site/css/cookieconsent.css">
        <script>
            var section = '';
        </script>
        <script defer src="[[++base_url]]site/js/cookieconsent.js"></script>
        [[-<script defer src="[[++base_url]]site/js/cookieconsent-init.js"></script>]]
        <!-- Inline script -->
            <script>
                window.addEventListener('load', function(){

                    // obtain plugin
                    var cc = initCookieConsent();

                    // run plugin with your configuration
                    cc.run({
                        current_lang: 'en',
                        autoclear_cookies: true,                   // default: false
                        page_scripts: true,                        // default: false

                        // mode: 'opt-in'                          // default: 'opt-in'; value: 'opt-in' or 'opt-out'
                        // delay: 0,                               // default: 0
                        // auto_language: '',                      // default: null; could also be 'browser' or 'document'
                        // autorun: true,                          // default: true
                        // force_consent: false,                   // default: false
                        // hide_from_bots: true,                   // default: true
                        // remove_cookie_tables: false             // default: false
                        // cookie_name: 'cc_cookie',               // default: 'cc_cookie'
                        // cookie_expiration: 182,                 // default: 182 (days)
                        // cookie_necessary_only_expiration: 182   // default: disabled
                        // cookie_domain: location.hostname,       // default: current domain
                        // cookie_path: '/',                       // default: root
                        // cookie_same_site: 'Lax',                // default: 'Lax'
                        // use_rfc_cookie: false,                  // default: false
                        // revision: 0,                            // default: 0
                        revision: 1,

                        onFirstAction: function(user_preferences, cookie){
                            // callback triggered only once on the first accept/reject action
                        },

                        onAccept: function (cookie) {
                            // callback triggered on the first accept/reject action, and after each page load
                        },

                        onChange: function (cookie, changed_categories) {
                            // callback triggered when user changes preferences after consent has already been given
                        },

                        languages: {
                            'en': {
                                consent_modal: {
                                    title: '[[%simplesearch.search? &namespace=`simplesearch` &topic=`default`]]',
                                    description: 'Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent. <button type="button" data-cc="c-settings" class="cc-link">Let me choose</button>',
                                    primary_btn: {
                                        text: 'Accept all',
                                        role: 'accept_all'              // 'accept_selected' or 'accept_all'
                                    },
                                    secondary_btn: {
                                        text: 'Reject all',
                                        role: 'accept_necessary'        // 'settings' or 'accept_necessary'
                                    }
                                },
                                settings_modal: {
                                    title: 'Cookie preferences',
                                    save_settings_btn: 'Save settings',
                                    accept_all_btn: 'Accept all',
                                    reject_all_btn: 'Reject all',
                                    close_btn_label: 'Close',
                                    cookie_table_headers: [
                                        {col1: 'Name'},
                                        {col2: 'Domain'},
                                        {col3: 'Expiration'},
                                        {col4: 'Description'}
                                    ],
                                    blocks: [
                                        {
                                            title: 'Cookie usage 📢',
                                            description: 'I use cookies to ensure the basic functionalities of the website and to enhance your online experience. You can choose for each category to opt-in/out whenever you want. For more details relative to cookies and other sensitive data, please read the full <a href="#" class="cc-link">privacy policy</a>.'
                                        }, {
                                            title: 'Strictly necessary cookies',
                                            description: 'These cookies are essential for the proper functioning of my website. Without these cookies, the website would not work properly',
                                            toggle: {
                                                value: 'necessary',
                                                enabled: true,
                                                readonly: true          // cookie categories with readonly=true are all treated as "necessary cookies"
                                            }
                                        }, {
                                            title: 'Performance and Analytics cookies',
                                            description: 'These cookies allow the website to remember the choices you have made in the past',
                                            toggle: {
                                                value: 'analytics',     // your cookie category
                                                enabled: false,
                                                readonly: false
                                            },
                                            cookie_table: [             // list of all expected cookies
                                                {
                                                    col1: '^_ga',       // match all cookies starting with "_ga"
                                                    col2: 'google.com',
                                                    col3: '2 years',
                                                    col4: 'description ...',
                                                    is_regex: true
                                                },
                                                {
                                                    col1: '_gid',
                                                    col2: 'google.com',
                                                    col3: '1 day',
                                                    col4: 'description ...',
                                                }
                                            ]
                                        }, {
                                            title: 'Advertisement and Targeting cookies',
                                            description: 'These cookies collect information about how you use the website, which pages you visited and which links you clicked on. All of the data is anonymized and cannot be used to identify you',
                                            toggle: {
                                                value: 'targeting',
                                                enabled: false,
                                                readonly: false
                                            }
                                        }, {
                                            title: 'More information',
                                            description: 'For any queries in relation to our policy on cookies and your choices, please <a class="cc-link" href="#yourcontactpage">contact us</a>.',
                                        }
                                    ]
                                }
                            }
                        }
                    });
                });
            </script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script type="text/plain" data-cookiecategory="analytics" async src="https://www.googletagmanager.com/gtag/js?id=G-8S35HEVVZT"></script>
<script type="text/plain" data-cookiecategory="analytics">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8S35HEVVZT');
</script>

[[-++scripts]]
