<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'modmore is a valid license holder of the Redactor OEM license by Imperavi.

This license is a legal agreement between you and modmore for the use of the Redactor for MODX Extra. By downloading or installing Redactor, you agree to the terms and conditions of this license. modmore reservers the right to alter this agreement at any time, for any reason, without notice.

This license is valid for a single MODX installation and may not be redistributed, changed or removed of its license.

===== Included for reference, the Redactor OEM License ====

This license is a legal agreement between you and Imperavi for the use of Redactor (*all versions*) Software (the “Software”). By downloading any version of redactor you agree to be bound by the terms and conditions of this license. Imperavi reserves the right to alter this agreement at any time, for any reason, without notice.

Restrictions
Unless you have been granted prior, written consent from Imperavi, you may not:
Reproduce, distribute, or transfer the Software as a sole product, or portions thereof, to any third party.
Sell, rent, lease, assign, or sublet the Software as a sole product or portions thereof.
Grant rights to any other person.
Use the software in violation of any Canadian or international laws or regulations.
Display of Copyright Notices
All copyright and proprietary notices and logos (if any) of Redactor/Imperavi and within the Software files must remain intact.

Making Copies
You may make copies of the Software for back-up purposes, provided that you reproduce the Software in its original form and with all proprietary notices on the back-up copy. You may include copies of the Software as an integral part of your product (according to Permitted Use stated above).

Software Modification
You may alter, modify, or extend the Software for your own use or for use in as an integral part of your product or service, or commission a third-party to perform modifications for you, but you may not resell, redistribute or transfer the modified or derivative version of the Software as a sole product without prior written consent from Imperavi. Components from the Software may not be extracted and used in other programs without prior written consent from Imperavi.

Technical Support
Technical support is provided by email. No representations or guarantees are made regarding the response itself or response time in which support questions are answered. For the Support License holders response is guaranteed and the response time is no more than 1 (one) business day (Friday requests are answered on Monday; afternoon requests are answered next day).

Refund Policy
We offer a 30 day money back. If for any reason Redactor doesn’t work out for your project, simply email us within 30 days of purchase for a full refund.

Indemnity
You agree to indemnify and hold harmless Imperavi for any third-party claims, actions or suits, as well as any related expenses, liabilities, damages, settlements or fees arising from your use or misuse of the Software, or a violation of any terms of this license.

Disclaimer Of Warranty
THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE. FURTHER, IMPERAVI DOES NOT WARRANT THAT THE SOFTWARE OR ANY RELATED SERVICE WILL ALWAYS BE AVAILABLE.

Limitations Of Liability
YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE SOFTWARE. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE. LICENSE HOLDERS ARE SOLELY RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND ASSUME ALL RISKS ASSOCIATED WITH ITS USE, INCLUDING BUT NOT LIMITED TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.
',
    'readme' => '------------------------------------------------------
Redactor - Sexy RTE/WYSIWYG Editor for MODX Revolution
------------------------------------------------------
Author: JP DeVries, Mark Hamstra - support@modmore.com
------------------------------------------------------

Redactor is a commercial-grade Rich Text Editor developed by Imperavi, tightly integrated into MODX by modmore. Redactor for MODX has all the features you would expect in a rich text editor with all the flexibility you expect from MODX and modmore.

The media management in Redactor is optimized for client use, providing the site builder with lots of power to enforce upload and selection rules.

For a full list of features and configuration, please check the website: https://www.modmore.com/extras/redactor/
',
    'changelog' => 'Redactor 2.3.7-pl
-----------------
Released on 2019-09-06

- Fix upload errors being returned in wrong format [S20839]
- Make sure errors are shown in a nice popup

Redactor 2.3.7-pl
-----------------
Released on 2019-08-06

- Prevent rendering the content field if ContentBlocks is used. This improves manager performance and prevents errors from getting triggered in the developer console (with ContentBlocks 1.8.12+).
- Fix hardcoded numbers in the replacer window (redactor-plugins@1.2)
- Add new plugin_replacer_button setting that lets you add a button for the find & replace functionality

Redactor 2.3.6-pl
-----------------
Released on 2019-07-11

- Prevent Codemirror plugin from breaking resource save in some cases due to JS error [S20434]

Redactor 2.3.5-pl
-----------------
Released on 2019-06-13

- Catch exceptions in media source when trying to list files or directories outside open_basedir [S19733]
- Prevent invalid HTML from breaking the baseurls plugin, which in turn would prevent content from being stored [S20288]
- Fix typing "a" with linebreaks mode and baseurls plugin breaking the manager

Redactor 2.3.4-pl
-----------------
Released on 2019-02-19

- Fix missing translation for aligning images in the center, by re-using alignment strings for text alignment [S17648]
- Fix E_NOTICE undefined index "style" when the style is not defined on custom formatting [S19277]
- When using multiple classes in a formattingAdd style, the styles now apply in the dropdown too [S19277]
- Fix replaceTags setting not working [F1733]
- Fix plugin for linking to resources missing from Redactor TVs [F1723]
- Fix redactor.linkResource setting not having any effect; it now toggles the custom linking tabs (resource, email, etc) [F1732]

Redactor 2.3.3-pl
-----------------
Released on 2018-07-04

- Fix package installation on MODX3
- Fix broken editor in MODX3 due to missing language (stored in session instead of setting)

Redactor 2.3.2-pl
-----------------
Released on 2018-02-06

- Add Ukrainian language file [S14393]
- Fix license check running daily instead of weekly

Redactor 2.3.1-pl
-----------------
Released on 2017-08-10

- Fix incorrect falling back to default media source instead of redactor-specific settings [S12760]

Redactor 2.3.0-pl
-----------------
Released on 2017-07-10

- Allow custom (inline) formatting to be applied to headers

Redactor 2.2.3-pl
-----------------
Released on 2017-05-04

- Revert change to Fix buttonsHide settings which caused a breaking change

Redactor 2.2.2-pl
-----------------
Released on 2017-05-02

- Fix Bold/italic/underline etc don\'t work in Chrome [#456]
- Fix buttonsHide settings, set these as comma separated lists

Redactor 2.2.1-pl
-----------------
Released on 2017-04-07

- Add new `root-relative` baseurls mode value for subdirectory-based contexts with shared assets in the site root [S11174]
- Fix potential jQuery conflicts affecting Redactor template variables [S11205]
- Fix context-specific redactor.css setting not being recognized [#443]
- Fix Rich Text TVs on symlinks/weblinks/static resources not getting enhanced [#449]
- Add missing video plugin control on Redactor TVs [#441]
- Fix Dutch translation of "paragraph" [#413]
- Fix for redactor.removeAttr and redactor.allowedAttr syntax
- Fix Search/Replace plugin [#447]
- Fix unintentional typeahead in Edit Image > Alt Text field [#453]

Redactor 2.2.0-pl
-----------------
Released on 2016-05-19

- Fix predefinedLinks plugin
- Hacked redactor.js to add support for multiple modal callbacks

Redactor 2.2.0-rc2
------------------
Released on 2016-05-03

- Fix file path issue with dom4 and no-flexbox polyfills which broke the browser in certain browsers
- Fix issue causing file browser to not open to redactor.file_browse_path
- Fix uncaught type error in Eureka Media Browser when media source is not yet set

Redactor 2.2.0-rc1
------------------
Released on 2016-04-29

- All new Full Screen view in Eureka media browser model
- Eureka: New messaging "no files found" messaging
- Eureka: Separate Storage Prefix for Files and Images [#417]
- Eureka: Setting to disable localStorage via hidden eurekaUseLocalStorage setting [#418]
- Eureka: Control whether of not fullscreen mode is available via hidden eurekaAllowFullScreen System Setting
- Image Title Renamed to Alternative Text [#401]
- Removing references to autoresize [#394]
- Exposed redactor.initial_directory_depth Setting with a default value of 3. This means the Eureka Media Browser connectors will now attempt to recursively list directories three depths deep.

Redactor 2.1.1-pl
-----------------
Released on 2016-04-14

- Fix Broken Link Anchor Tab
- Image and File Browsers now use separate local storage cache keys
- Eureka: Separate Storage Prefix for Files and Images [#417]
- Eureka: Setting to disable localStorage via hidden eurekaUseLocalStorage setting [#418]
- Removing references to autoresize [#394]

Redactor 2.1.0-pl
-----------------
Released on 2016-03-29

- All new "List" View in Eureka Media Browser
- Fix Eureka upload button in Firefox [#405]
- Fix some buttons not available for TV usage [#416]
- Eureka: Option to disable enlarging of focused rows by creating an enlargeFocusRows System Setting set to false
- Fix compatibility with FileSluggy and similar extras [#398]
- Fix some buttons not available for TV usage [#416]
- Fix issue preventing images with uppercase extensions from showing [#404]

Redactor 2.0.7-pl
-----------------
Released on 2016-02-02

- Fix Eureka Media Browser Layout flips out completely on Chrome 48 [#399]

Redactor 2.0.6-pl
-----------------
Released on 2016-01-15

- plugin_uploadcare System Setting now defaults to false
- Respect Selected Text When Inserting Files [#384]
- Fix Weird Clips Behavior [#388]

Redactor 2.0.5-pl
-----------------
Released on 2015-12-23

- Restore the resource typeahead on image links [#372]
- Switching redactor.pastePlainText System Setting to default to false [#375]
- Fix Advanced Attributes don\'t persist in modal [#392]
- Insert Images by URL (See plugin_imageurl Setting)
- Fix issues with Formatting and Custom Formatting options not being used on Redactor TVs [S7400]
- Fix persistence of plugin-related Redactor TV options [S7400]
- Fix disabling plugins on specific Redactor TVs if they\'re enabled globally [S7400]
- Make sure Redactor TV options use the setting lexicons for better and translated descriptions [#109]

Redactor 2.0.4-pl
-----------------
Released on 2015-11-04

- Fix broken flexbox layout on touch devices [#387]
- Fix incorrect choose title when eureka upload is enabled [#386]
- Fix layout when Eureka sidebar is collapsed [#385]

Redactor 2.0.3-pl
-----------------
Released on 2015-10-27

- Fix incorrect link text on convertLink [#374]
- Fix issue with Clips not inserting inline HTML [#378]
- Fix incorrect check causing E_NOTICE errors in upload
- Fix bug with some upload path placeholders not working

Redactor 2.0.2-pl
-----------------
Released on 2015-10-01

- Update Redactor.js to 10.2.5 with several bug fixes
- Fix Eureka growing beyond available size with lots of directories [#367]
- Fix email links adding double mailto: [#368]
- Fix Eureka breaking out of the modal [#370]
- Improve consistency in modal styling [#371]

Redactor 2.0.1-pl
-----------------
Released on 2015-09-16

- Fix thumbnails not showing in certain environments [S6479]
- Fix Broken Image Edit Window [#366]
- Fix various z-index issues when used in MIGX and other components [S6480]

Redactor 2.0.0-pl
-----------------
Released on 2015-09-08

Redactor 2 is here! For the full details of the 2.0 release, please check the changelog for Redactor 2.0.0-rc2 below,
or visit https://www.modmore.com/blog/2015/announcing-redactor-2.0/ for the official announcement.

Fixes in 2.0.0-pl since 2.0.0-rc8:
- Fix loading of Eureka with js compression enabled [#354]
- Fix loadIntrotext not working in certain edge cases

Redactor 2.0.0-rc8
------------------
Released on 2015-09-05

- Show size of image while resizing [#95]
- Fix potential E_NOTICE error when dealing with ultimate parent [#353]
- Fix redactor.date_files not being respected on file uploads [#350]
- Fix dynamic thumbnail being missing from Eureka [#349]
- Fix switching back to visual mode with ace editor on TVs [#355]
- Prevent loading Ace multiple times when used on TVs
- Load Ace from CDN with fallback
- Fix missing limiter setting and incorrect format
- Fix Ace Editor In TVs (and not main content)
- Ensure un-ordered lists are bulleted with list-style-type:disc
- Breakout Media Source TV Input into File/Image [#362]
- Fix marginFloatLeft and marginFloatRight [#360]
- set redactor.linkTooltip to default to true

Redactor 2.0.0-rc7
------------------
Released on 2015-08-15

- Fix bug introduced in rc6 that prevented editing chunks

Redactor 2.0.0-rc6
------------------
Released on 2015-08-15

- Remove searchImages Setting
- ImagePX Plugin Fix (thanks for the Pull Request YvonneYu)
- Fix No Eureka on RedactorTVs [#351]
- Updated Eureka Media Browser localStorage keys to be more specific
- Allot Media Browser Stage more pixels [#328]
- Updated Redactor.js to 10.2.3

Redactor 2.0.0-rc5
------------------
Released on 2015-08-03

- Fix issue where saving a resource duplicated Redactor TVs [#344]
- Fix issue with Clips plugin causing fatal JavaScript error [#346]

Redactor 2.0.0-rc4
------------------
Released on 2015-07-30

- Added ability to use different media sources for uploading and browsing files vs images (does not effect Eureka browser) [#331]
- Fix issue with path placeholders not working as expected [#333]
- Fix issue where uploading files used the configured image path [#334]
- Fix issue with opening eureka for inserting files [#335]
- Fix issue where disabling eureka did not fallback to the legacy browsers [#336]
- Fix browse issue when using legacy (non-eureka) browser [#338]
- Fix broken source mode when using CodeMirror and a Redactor TV [#330]
- Only show images when browsing images in Eureka [S6009]
- Fix dropdown position when toolbar is fixed [S6009]
- Improve compatibility with dynamic media source paths using snippets relying on $modx->resource [#322]
- Fix issue where in some cases TVs that are moved to a new tab with form customizations have no toolbar

Redactor 2.0.0-rc3
------------------
Released on 2015-07-24

- Fix issue with right-side of the manager not loading after update to 2.0 on certain environments
- Fix issue with incorrect media source being initially chosen
- Fix issue where toolbars on TVs were hidden until scrolling [#321]
- Fix issue with fixed toolbars getting stuck when going to fullscreen mode [#324]
- Fix Root Directories not Expanding when selected [#326]

Redactor 2.0.0-rc2
------------------
Released on 2015-07-20

Redactor for MODX v2 is here! Our second major release of Redactor is based on v10.2.2 and ships with a lot of new features and improvements.
For upgrade notes, please visit https://www.modmore.com/redactor/documentation/upgrading-1.x-to-2.0/

Redactor.js v10 highlights:
- Largely rewritten with a modular design with 36 core modules and over a dozen plugins
- Dozens of new settings, callbacks and APIs
- Fixed 60+ formatting issues and 100+ other core editor bugs
- See http://imperavi.com/redactor/docs/whats-new-10/ and http://imperavi.com/redactor/log/ for more Imperavi updates

New Features:
- New, more powerful and better looking Media Browser for inserting images or files
- Syntax Highlighter Support for the source mode powered by Ace or CodeMirror (#262)
- Path placeholders now include Template Variables (with [[+tv.name_of_tv]]), parent alias, ultimate parent alias and all resource fields (#199)
- All settings are now context-aware, allowing per-context overrides on Redactor configuration (#146, #275)
- New custom formatting baked into the core (#260)
- Tagging for Clips plugin allows to find specific clips quicker (#250)
- Ability to set images dimensions in pixels
- Add subject, CC and BCC field to the Insert Link > Email tab as advanced attributes (#203)
- Optionally add a Redactor editor to the introtext (#243)
- Also see the list of Plugins below for more exciting new or improved optional features.

Improvements:
- Uploading images and files now requires the file_upload permission (#159)
- Boolean setting values are now properly recognized (#266)
- Improved handling of image urls, which are now relative to the site base url by default (#288)
- Updated jQuery to 1.11.3
- Show context on hover in Insert Link > Resource typeahead (#204)
- Prevent overwriting existing files by adding an incremental index to filenames instead (file sources only, #198)
- Better abstraction of MODX/modmore-specific overrides for faster Imperavi updates
- Fix issue with using typeahead on third party components (#248)
- Fix issue with attempting to create thumbnails of .svg images (#246)

Includes plugins as of Redactor 2.0:
- Base URLs: normalizes image src attributes to ensure clean output
- Breadcrumbs: shows the markup hierarchy from the cursor
- Clips: easily insert configurable snippets of code or special characters
- Contrast: hit f5 to inverse the editor colors for high contrast mode, works best in full screen
- Counter: shows the length of your content, and approximately how long it will take to read
- Defined Links: allows setting up predefined links that are available in a dropdown when adding a link
- Download: downloads the html source of what\'s in the editor to file
- Eureka: shiny new accessible media browser
- File manager: upload files or browse existing one with Eureka
- Font color: change the color of part of the text
- Font family: change the font family of the text
- Font size: change the size of the text
- Fullscreen: make the editor full screen for more immersive writing
- ImagePX: provides extra options in the image window to specify the size of an image in pixels
- Limiter: makes sure the content does not exceed a certain limit
- Norphan: prevents orphaned words at the end of sentences by adding a   between the last and second last word
- Replace: simple find and replace utility (#254)
- Speek: listen to your written words being spoken with the power of HTML5 speech APIs
- Syntax: use the Ace syntax editor for the source view; codemirror is also available
- Table: the table features that were available before are now available as separate plugin
- Text Direction: set the text direction of a block-level element
- Text Expander: expend small pieces of text into a larger one
- UploadCare: as alternative to locally hosting images, UploadCare lets you upload directly to their service from Redactor

Removed features and breaking changes:
- Please see the upgrade notes at https://www.modmore.com/redactor/documentation/upgrading-1.x-to-2.0/

Redactor 1.5.3-pl
-----------------
Released on 2014-12-30

- Fix issue browsing images when there is only one image in the browse folder.

Redactor 1.5.2-pl
-----------------
Released on 2014-11-07

- Load the current resource more definitively to cover some edge cases where the resource is not in the modX scope
- Loosens Patch 11291 Conditional which caused asset paths to break in Revolution 2.3.2+
- Lexicon Updates

Redactor 1.5.1-pl
-----------------
Released on 2014-10-29

- Fix z-index issue when used with MIGX
- #244 Fixes Adding Classes via Custom Formats

Redactor 1.5.0-pl
-----------------
Released on 2014-08-14

- Several all new features!!! See Redactor 1.5.0-rc1 release notes below for more info https://www.modmore.com/blog/2014/announcing-redactor-1.5/
- Added Hidden Mobile Buttons to TV Level
- Lexicon Updates

Redactor 1.5.0-rc2
------------------
Released on 2014-08-08

- Some more design tweaks in modals and fields for better consistency
- Fix "undefined" placeholder for linking to resources
- #235 Fixed toolbar offset height in MODX 2.2.x
- #237 Fix Linking issue when editing images
- #238 Fixed underlapping toolbar issue
- Added toolbarFixed and toolbarFixedBox settings
- Fix setting lexicon keys for predefinedLinks and shortcutsAdd

Redactor 1.5.0-rc1
------------------
Released on 2014-08-05

- ALL NEW Custom Toolbars Feature!!! https://www.modmore.com/redactor/toolbar
- New Custom Formats WYSIWYG Widget https://www.modmore.com/extras/redactor/documentation/creating-custom-formats#/custom-formats
- Now easier to link image to resources with new typeahead feature
- New Predefined Links Feature for quicker editing
- Added rebeccapurple support to all color settings
- Fix the toolbar within the editor box so it\'s always in screen
- #100 Properly report error to user if upload failed for whatever reason
- Make tweaks to the CSS to make Redactor blend in with 2.3 even better
- Use proper dependency injection model in plugins
- Prevent excessive error logging in 2.3.0
- Added $redactor->versions support for third party packages to determine Redactor\'s version
- Updated fontcolor plugin
- #224 Fixed Editing Link URLs in Firefox
- #219 Fixed Broken Modal in Fullscreen mode
- #194 Fix clearing margins when un-floating images
- #184 Fixed tab inserts "1" bug
- #214 Table pasting issue
- #202 Open in New tab when linking to a file
- Updated redactor.js to 9.2.6
- - New Typewriter mode
- - Hidden Mobile Buttons
- - Toolbar Overflow
- - Image Tab Link Setting
- - Clean Spaces Setting
- - Additional Shortcuts
- - Many bug fixes. See more at http://imperavi.com/redactor/log/


Redactor 1.4.3-pl
-----------------
Released on 2014-07-28

- #227 Enables a patch for broken asset paths. If running MODX 2.2.15 - 2.3.1, Redactor will attempt to patch broken asset URLs caused by modxcms/revolution#11291. To disable create a redactor.patch_11291 System Setting and set to \'No\'.

Redactor 1.4.2-pl
-----------------
Released on 2014-07-07

- #217 Fixes broken image thumbnails when inserting images from a search result
- #221 Loosen image search sensitivity
- Fix typo causing OnRichTextEditorInit event from not getting checked.

Redactor 1.4.1-pl
-----------------
Released on 2014-04-11

- Ensure Redactor TVs have access to the Resource data for upload/browse path placeholders
- Fix loading the proper RTE based on context settings
- #153 Fix E_NOTICE error in redactor class because of check for pre-2.2.9 S3 issue
- Fix lexicon entries for new settings in 1.4.0
- Ensure that the English language set is used as default to prevent undefined issues.

Redactor 1.4.0-pl
-----------------
Released on 2014-02-13

- New Advanced Attributes feature for WYSIWYG editing of classes and ids on images and links!
- 25 New Languages
- Update to Redactor 9.1.9 with several bug fixes!
- Update to jQuery 1.11.0
- #175 Prevent Images from loading until Choose tab is selected
- #176 Fix issue when loading Redactor on non-CMP pages
- #171 Fix undesired base path appended on Edit Link window (set linkProtocol to empty)
- #169 Fix colors in FontColor plugin
- #168 Add Anchors to Links (via Advanced Attributes)
- #94 Add optional class field to images (via Advanced Attributes)
- #163 Add extra placeholder for upload paths (pagetitle, alias, context_key)
- #160 Add linkNoFollow System Setting
- #155 Fix choose file/image when there is only 1 result
- #80 Fix View Source overlapping save buttons

Redactor 1.3.5-pl
-----------------
Released on 2013-11-18

- Fix problem with redactor loading in the content area (reverts #140)

Redactor 1.3.4-pl
-----------------
Released on 2013-11-18

- #143 Fix issues with link* settings
- #140 Ensure Redactor loads in MIGX DB

Redactor 1.3.3-pl
-----------------
Released on 2013-11-14

- Updating to Redactor 9.1.7
- Update to jQuery 1.10.2
- Add [[+day]] tag for dynamic file and image upload paths
- #150 Fix bug with unordered lists in Clips JSON
- #136 Default observeLinks to true

Redactor 1.3.2-pl
-----------------
Released on 2013-10-18

- Add sanitizePattern and sanitizeReplace settings to tweak upload file name sanitization
- Fix issue with page not reloading when creating resources that have a Redactor TV.
- Improve loading in custom components that are built with modManagerControllerDeprecated
- Fix bug with incorrect paths when using the Choose files functionality.
- Update to Redactor 9.1.5:
- - Fix several issues with outdent, video links and uploading
- - new image and file parameter configuration
- - new xhtml setting making code produced by Redactor more XHTML-compatible
- - new linkSize setting to allow links to be truncated
- - improves parsing of Vimeo links
- - improves performance on large texts
- - improves compatibility with IE 7.
- Update to Redactor 9.1.4:
- - fix observeLinks tooltip compatibility when in fullscreen mode
- - fix IE9-10 issues with clipboard paste.

Redactor 1.3.1-pl
-----------------
Released on 2013-09-17

- Ensure linkProtocol can be disabled.
- #52 Ensure floated images stay in their WYM container
- #91 Changing image position improperly unset margins/classes from the former position
- #127 Default to editor_css_path setting if redactor.css is empty
- #128 Fix description of file browse path setting
- Update to Redactor 9.1.4, which fixes observeLinks functionality in iframe and fullscreen and IE9-10 issues with clipboard paste. http://imperavi.com/redactor/log/
- #135 Restore missing CSS since 1.3.0.
- #134 Fix resource search with Redactor TVs
- #133 Fix missing styles for list items

Redactor 1.3.0-pl
-----------------
Released on 2013-09-09

- Update to Redactor 9.1.3 which fixes many formatting and pasting issues and adds copy-paste image support for uploads! Pasting images to S3 Media Sources requires MODX 2.2.9 or later. Thanks to Jan Peca for the MODX 2.2.9 fix!
- Added drag and drop for images support. Just drag images right into the content area!
- Images can be moved/dragged across text.
- Rewritten and improved image resizing.
- Link parsing for images and videos. Paste URLs to images YouTube or Vimeo videos to auto embed.
- Option to open links in new tab.
- Paste as plain text.
- Removed toolbar color selector
- Added color selector plugin
- New tidyHtml setting - allows to turn off nice output code formatting.
- New observeLinks feature allows to follow/edit links by putting cursor to the link
- #130 Add system setting for removeEmptyTags
- #131 Fix for missing styles in iFrame mode

Redactor 1.2.8-pl
-----------------
Released on 2013-09-05

- Fix Redactor TVs when the language is set to something other than English.

Redactor 1.2.7-pl
-----------------
Released on 2013-08-22

- #121 Add [[+id]] placeholder to paths to insert resource IDs.
- Only load clips and styles plugin on TVs when necessary.

Redactor 1.2.6-pl
-----------------
Pre-Released on 2013-08-15
--------------------------

- #123 Mail to tab on insert link modal now is available by default
- #124 Fix issue when displaying image subfolders when choosing images
- #125 Add browse configurations for images and files to Redactor Template Variables
- #118 Fixes issue with remote media sources

Redactor 1.2.5-pl
-----------------
Released on 2013-08-06

- Fix issues with MIGX ("$ is undefined" errors)
- Fix odd issue on PHP 5.3 with not loading the scripts.

Redactor 1.2.4-pl
-----------------
Released on 2013-08-05

- Fix issues with redactor.additionalPlugins.
- Fix issue with regular richtext TVs not loading Redactor.

Redactor 1.2.3-pl
-----------------
Released on 2013-08-04

- #117 Add Custom CSS stylesheet in non-iframe mode
- #113 Add insert advanced option to Styles JSON (set "advanced":"1") to use insertHTMLAdvanced
- Renamed Iframe CSS Setting to Stylesheet

Redactor 1.2.2-pl
-----------------
Released on 2013-08-02

- #112 Improve Styles JSON compatibility
- #113 Consider code tag text-level semantic element (not block)
- #114 Add forceBlock option to JSON

Redactor 1.2.1-pl
-----------------
Released on 2013-08-02

- #110 Fix console error with Clips plugin
- #111 Custom Formatting: wrap inline for text-level semantic tags

Redactor 1.2.0-pl
-----------------
Released on 2013-08-02

- #99 Fix air toolbar not showing in fullscreen mode
- #107 Default media source for Redactor to value of default_media_source setting
- #16 Add ability to load custom plugins through a system setting definition.
- #108 Slightly change text to indicate you need to start typing to find resources.
- #48 Refactor to make use of OnRichTextEditorInit plugin event to allow using Redactor in other components.
- Update to Redactor 9.0.4 to fix amoung other things issue when switching between visual and source code mode in Firefox, pasting in iOS and inline styles. http://imperavi.com/redactor/log/
- #44 Add custom formats like TinyMCE
- #69 Add Clips Plugin
- #105 Add base tag when in iFrame mode (for TinyMCE and CKEditor compatibility)
- Fix for TVs when which_editor != Redactor
- #103 Open in New Tab option when linking to Resources
- #20 Add MIGX Support
- #16 System Setting to load custom plugins


Redactor 1.1.2-pl
-----------------
Released on 2013-07-03

- Add missing cachebust from 1.1.1-pl.

Redactor 1.1.1-pl
-----------------
Released on 2013-07-03

- Update to Redactor 9.0.3, fixing among other things firefox issues with typing after selecting text, various cleanup bugs, switching between ul/ol tags. http://imperavi.com/redactor/log/
- Fix further issues with link editing.
- #46 Fix issues with iframe mode.

Redactor 1.1.0-pl
-----------------
Released on 2013-07-01

- Update to Redactor 9.0.2 fixing among other things pasting lists from Google Docs, inactive buttons, pasting in Chrome, link pasting and undo. http://imperavi.com/redactor/log/
- #40 Add browse feature for adding/linking to files + redactor.browse_files Setting to enable it
- #33 Add fullscreen plugin + redactor.buttonFullScreen Setting to enable it
- #55 Add redactor.displayImageNames Setting to display file names under images in Choose window
- #66 Add redactor.dynamicThumbs Setting to disable dynamic thumbnail (phpthumb)
- #50 Properly change/escape unsafe characters in uploads
- #56 Fix typeahead initialization on non-link modals
- #41 Show warning if no file exist in browsing location.
- #60 Add redactor.browse_path Setting to allow browsing elsewhere than uploads directory.
- #38 Add redactor.linkResource Setting to hide Resource tab in Link window
- #65 Fix Incorrect Link Options bug.
- #58 Combine and Minify JavaScript on frontend.
- #61 Cache Bust JavaScript.
- #62 Fixed broken manager pages with RedactorTV bug.
- #63 Moved Resource Tab to second position in insert link window
- French lexicon updated, partial Dutch and Czech added.

Redactor 1.0.3-pl
-----------------
Released on 2013-06-17

- Update to Redactor 9.0.1, fixing among other things backspace issues, link adding/editing. http://imperavi.com/redactor/log/
- #49 Make sure to use jQuery noConflict mode to make sure it plays nice with other possible jQuery instances.
- Fix wrong method (process instead of render) in TV Input Type.
- #53 Fix undefined on file upload bug.
- #51 Fixed broken links on dated files bug.
- #34 Moved Resource tab to first position.

Redactor 1.0.2-pl
-----------------
Released on 2013-06-05

- Fix additional issue with loading translations in non-English managers due to 9.0.0 changes.

Redactor 1.0.1-pl
-----------------
Released on 2013-06-05

- Fix issue with loading translations in non-English managers due to 9.0.0 changes.

Redactor 1.0.0-pl
-----------------
Released on 2013-06-05

- Fix ability to uninstall the package.
- #35, #36, #45 Update setting descriptions for Redactor 9.0.0 and to be more useful.
- #37 Change insert link text to "Insert/Edit link"
- #42 Add ability to disable the introtext displaying in resource typeahead.
- #43 Add ability to scroll in the resource type ahead
- Upgrade to Imperavi\'s Redactor 9.0.0

Redactor 0.9.3-pl
-----------------
Released on 2013-05-27

- Add French lexicon. Thanks @rtripault!
- #32 Add HTML5 tags to the default allowedTags setting.

Redactor 0.9.2-pl
-----------------
Released on 2013-05-27

- Fix bug where settings and other configuration were not properly passed to Redactor.
- Change default buttons to include separators.

Redactor 0.9.1-pl
-----------------
Released on 2013-05-24

- First released version of Redactor through modmore.
',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'b52dbffa8e904daeb063dde056da208b',
      'native_key' => 'redactor',
      'filename' => 'modNamespace/e888c4b0c1f4c17ccf5ffb461d2423c7.vehicle',
      'namespace' => 'redactor',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => '99c013d3c7da524ee8119adb36db1975',
      'native_key' => '99c013d3c7da524ee8119adb36db1975',
      'filename' => 'xPDOFileVehicle/4ae11c78efd2a08472e99fe2e595d205.vehicle',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'modmoreVehicle',
      'class' => 'modPlugin',
      'guid' => '2a3016885e8409785aeac48ca12dea50',
      'native_key' => NULL,
      'filename' => 'modPlugin/f7bcb9d288740d0c98005721800909c6.vehicle',
      'namespace' => 'redactor',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cbc43ca132d419312f545e71f7b143e2',
      'native_key' => 'redactor.lang',
      'filename' => 'modSystemSetting/6e09b5c8d5f86e47c1d06df9ad5b388b.vehicle',
      'namespace' => 'redactor',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fc34ed5208af03f2a57bf17cb00706e4',
      'native_key' => 'redactor.direction',
      'filename' => 'modSystemSetting/2ebe42131d9a9c7c3732bf2ee2331d5d.vehicle',
      'namespace' => 'redactor',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '795c229681ba2a22b8839d99cdb8af60',
      'native_key' => 'redactor.buttons',
      'filename' => 'modSystemSetting/2cb5a5bf1bcb0b43e588fcffa79b5acd.vehicle',
      'namespace' => 'redactor',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd4d246654701acf3a888659aa004d99a',
      'native_key' => 'redactor.activeButtons',
      'filename' => 'modSystemSetting/7ed57151e2fa2fe504dcf8dd4e08787f.vehicle',
      'namespace' => 'redactor',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5b089f12d52197bfd3d349877e5dc9e8',
      'native_key' => 'redactor.activeButtonsStates',
      'filename' => 'modSystemSetting/e10974869dfc7f9c6c03bd4916b8d053.vehicle',
      'namespace' => 'redactor',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '041bfadd1a7cb3e232fd48e0f8d0bdcb',
      'native_key' => 'redactor.formattingTags',
      'filename' => 'modSystemSetting/fff743654a86579974274847456b002f.vehicle',
      'namespace' => 'redactor',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '25ca3c5cc8e2f68abce10b36b7f451b3',
      'native_key' => 'redactor.buttonSource',
      'filename' => 'modSystemSetting/a805b8ff6f230954258fcbdf49cc702f.vehicle',
      'namespace' => 'redactor',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '827c5565bafed2bf44b9006173b28c58',
      'native_key' => 'redactor.buttonFullScreen',
      'filename' => 'modSystemSetting/4283b9f4dac885bfb255135241fbf557.vehicle',
      'namespace' => 'redactor',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '751d406c8d8db1cebfc1fb6ccfd9347d',
      'native_key' => 'redactor.css',
      'filename' => 'modSystemSetting/cd3e6d183ee19a9490a38c3cf5b68dc1.vehicle',
      'namespace' => 'redactor',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '32b84cc6b119c4e72e30795cc67ee16f',
      'native_key' => 'redactor.shortcuts',
      'filename' => 'modSystemSetting/199bbd04b5e75009aa12a24127a20463.vehicle',
      'namespace' => 'redactor',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a82607be07edb5bbb788a0bb760ee49f',
      'native_key' => 'redactor.cleanup',
      'filename' => 'modSystemSetting/c9344ffc0b80b7d1869f98fb726e2de6.vehicle',
      'namespace' => 'redactor',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '06e3f43d73cbd389dc9ad522beffac8b',
      'native_key' => 'redactor.convertLinks',
      'filename' => 'modSystemSetting/302118842d697c8f8123eb6ac3eb1b7d.vehicle',
      'namespace' => 'redactor',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4acadb9c78a98ed6c6dcda9f5426812c',
      'native_key' => 'redactor.tabindex',
      'filename' => 'modSystemSetting/afd62f5bb7b573d9e61d318c25ea58ca.vehicle',
      'namespace' => 'redactor',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0b2bc76afecffec0a9f4e8e991278105',
      'native_key' => 'redactor.minHeight',
      'filename' => 'modSystemSetting/8fbd2faf54d1dabaf7f625e2c5ef04fe.vehicle',
      'namespace' => 'redactor',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '979e754e57683b4f3ec5f51a5c30fb0f',
      'native_key' => 'redactor.colors',
      'filename' => 'modSystemSetting/b209ec554402c586c2328ceb448dd67a.vehicle',
      'namespace' => 'redactor',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '629f8e82de3719661d1ec6ff05aea5f2',
      'native_key' => 'redactor.wym',
      'filename' => 'modSystemSetting/78c28cf5615642e97978091bd11a73e5.vehicle',
      'namespace' => 'redactor',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd14d76bf358543393915efd8a1e15a6c',
      'native_key' => 'redactor.linkProtocol',
      'filename' => 'modSystemSetting/e42620e79eb20756c6e85b9b5852518b.vehicle',
      'namespace' => 'redactor',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6bb00cb9bc5cf217597dc182d48b9e13',
      'native_key' => 'redactor.placeholder',
      'filename' => 'modSystemSetting/9f5b3ad81aba40e0dda9e8e63c8a02db.vehicle',
      'namespace' => 'redactor',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6e295bfa89c15f7f7456a36759f7edd0',
      'native_key' => 'redactor.linebreaks',
      'filename' => 'modSystemSetting/f31cdb0f9594896c6b5f583e532ac7dd.vehicle',
      'namespace' => 'redactor',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4c42170d3ee5e812945c6aaccdd4469d',
      'native_key' => 'redactor.allowedTags',
      'filename' => 'modSystemSetting/85189cd7db2537e90e173e19bae480e0.vehicle',
      'namespace' => 'redactor',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '00e9db84aeb4df7a37019dfe05378946',
      'native_key' => 'redactor.deniedTags',
      'filename' => 'modSystemSetting/57a868c3486c3fdff7f29d45f36a408b.vehicle',
      'namespace' => 'redactor',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b0eb50d31cbe8ccab5e425b90b6ebe14',
      'native_key' => 'redactor.linkEmail',
      'filename' => 'modSystemSetting/f81628a7487d8d2acb45089cb0185971.vehicle',
      'namespace' => 'redactor',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ded39c2be8419809cb6b32b4b27c383c',
      'native_key' => 'redactor.linkAnchor',
      'filename' => 'modSystemSetting/a0eebc2d090997fd5c913b6176c6d1ec.vehicle',
      'namespace' => 'redactor',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ab52372f672168e2001c5d79e68cbe77',
      'native_key' => 'redactor.pastePlainText',
      'filename' => 'modSystemSetting/d62e3f69eb6421b27369226c735e8de2.vehicle',
      'namespace' => 'redactor',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b1932721c53ed78894982cc1cd86df97',
      'native_key' => 'redactor.paragraphize',
      'filename' => 'modSystemSetting/9d9c93cf86d1ffdc973da0a999f34b94.vehicle',
      'namespace' => 'redactor',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1840e0408a640d2c6d36c313114bc617',
      'native_key' => 'redactor.removeComments',
      'filename' => 'modSystemSetting/97cc553c982e270b7045a5ae98f0cd6f.vehicle',
      'namespace' => 'redactor',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cef0cf5f4138d97fffc6c7e861629122',
      'native_key' => 'redactor.visual',
      'filename' => 'modSystemSetting/8e53469875ed09b9d9e5614fe364c235.vehicle',
      'namespace' => 'redactor',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8e1b36d144c565afe9b9c40a009dbbf0',
      'native_key' => 'redactor.marginFloatLeft',
      'filename' => 'modSystemSetting/cd145960a1227cca504db3054f37480f.vehicle',
      'namespace' => 'redactor',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '27bcef9e20bb55efef3c635594b61b4d',
      'native_key' => 'redactor.marginFloatRight',
      'filename' => 'modSystemSetting/2474f411db8ead1b8246b216b3d295eb.vehicle',
      'namespace' => 'redactor',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3309bd5eedf38faef9488f5c95034448',
      'native_key' => 'redactor.mediasource',
      'filename' => 'modSystemSetting/6ac6255ca6325a24da4c0dc032ea91bc.vehicle',
      'namespace' => 'redactor',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '067098c33287a5e68eb06a07ab2b9db0',
      'native_key' => 'redactor.file_mediasource',
      'filename' => 'modSystemSetting/7b2c4471e396fae4200292a350e0286e.vehicle',
      'namespace' => 'redactor',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '84dcb0a3d9666b25a8e3352311aeccdc',
      'native_key' => 'redactor.image_upload_path',
      'filename' => 'modSystemSetting/186321bd0b8b1bd688d97ca61ae61c67.vehicle',
      'namespace' => 'redactor',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9653b41aa1c7a5c37b75b9ec3d239aab',
      'native_key' => 'redactor.image_browse_path',
      'filename' => 'modSystemSetting/81924b2f8fbd530b25a7225c8937b69c.vehicle',
      'namespace' => 'redactor',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6f29315d91eea5e29659012f577c6a2e',
      'native_key' => 'redactor.file_upload_path',
      'filename' => 'modSystemSetting/d83640ef305a291d2cd12e9ead17bf6a.vehicle',
      'namespace' => 'redactor',
    ),
    37 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '58ea56f4dbb0db20fe7338786fcae897',
      'native_key' => 'redactor.file_browse_path',
      'filename' => 'modSystemSetting/76bbdd2192c595df5eb92ed1cbae10f1.vehicle',
      'namespace' => 'redactor',
    ),
    38 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'eef9882c772243a8b9563c6f7875e1c8',
      'native_key' => 'redactor.browse_files',
      'filename' => 'modSystemSetting/572c03cd2abe42c11b26d750f53a2547.vehicle',
      'namespace' => 'redactor',
    ),
    39 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '41ed36bf35bce2990f3554f3d5d85bf9',
      'native_key' => 'redactor.date_images',
      'filename' => 'modSystemSetting/1f4c20efccb909608f49c581da4048cf.vehicle',
      'namespace' => 'redactor',
    ),
    40 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '53dc1671fbaf447d884805864288ba58',
      'native_key' => 'redactor.date_files',
      'filename' => 'modSystemSetting/13eb3d969ed8bd82bd3d25b90db93bcb.vehicle',
      'namespace' => 'redactor',
    ),
    41 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8d623fa789e358ed33d889e91b3857d7',
      'native_key' => 'redactor.typeahead.include_introtext',
      'filename' => 'modSystemSetting/fc8c7eb6dec20c6ec6e02f2bde025118.vehicle',
      'namespace' => 'redactor',
    ),
    42 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6266170640c28c6836cdd94a146d879e',
      'native_key' => 'redactor.prefetch_ttl',
      'filename' => 'modSystemSetting/dcf6beea68f93aa4c86fa86a572ed276.vehicle',
      'namespace' => 'redactor',
    ),
    43 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2b17f65e59ef34df2a8fa59fb3f0f5d9',
      'native_key' => 'redactor.linkResource',
      'filename' => 'modSystemSetting/46039f364735aa3d44c6ed435b1756a6.vehicle',
      'namespace' => 'redactor',
    ),
    44 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '139811337332806f6ab2afcbda2551e2',
      'native_key' => 'redactor.cleanFileNames',
      'filename' => 'modSystemSetting/23043cd4434693b5ae89db61acb0fc05.vehicle',
      'namespace' => 'redactor',
    ),
    45 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e9ca317656af573804a2f8db4921e625',
      'native_key' => 'redactor.dynamicThumbs',
      'filename' => 'modSystemSetting/a1a43b2de2aad34aa57221441f77c821.vehicle',
      'namespace' => 'redactor',
    ),
    46 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ebf6a1f7c7b7ddae229b637e72bffe36',
      'native_key' => 'redactor.clipsJson',
      'filename' => 'modSystemSetting/24017b94e1c5ebd0f9184311ee157c9b.vehicle',
      'namespace' => 'redactor',
    ),
    47 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '558a77bae9113c0128c2d638bff666f3',
      'native_key' => 'redactor.additionalPlugins',
      'filename' => 'modSystemSetting/fca2e1a89edb0934c806ec120447dec4.vehicle',
      'namespace' => 'redactor',
    ),
    48 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b8e7354a488e93c2c8fcab550d044b78',
      'native_key' => 'redactor.dragUpload',
      'filename' => 'modSystemSetting/96c5b2ac20cadf7493215747b3040088.vehicle',
      'namespace' => 'redactor',
    ),
    49 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f9c531cf5fc5182abf8c7c0d342bc1e7',
      'native_key' => 'redactor.convertImageLinks',
      'filename' => 'modSystemSetting/66d355c103727bc06acd51b7ebdaf831.vehicle',
      'namespace' => 'redactor',
    ),
    50 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3ba4d5e4dbd05b26863498951c06077c',
      'native_key' => 'redactor.convertVideoLinks',
      'filename' => 'modSystemSetting/1f5dfc7babc7e3169f892a798cdb26d6.vehicle',
      'namespace' => 'redactor',
    ),
    51 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '44d77a31b75e07b62eba988fc8a05474',
      'native_key' => 'redactor.tabAsSpaces',
      'filename' => 'modSystemSetting/cbc0807650096f8da918f11afa323ef0.vehicle',
      'namespace' => 'redactor',
    ),
    52 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c4c7fdb9114e3c348ca34d300c7a9cfc',
      'native_key' => 'redactor.removeEmptyTags',
      'filename' => 'modSystemSetting/8b34a1691e5788c1320df09fc136be40.vehicle',
      'namespace' => 'redactor',
    ),
    53 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '67b48122a463e787b75e8a111e654ba1',
      'native_key' => 'redactor.sanitizePattern',
      'filename' => 'modSystemSetting/9a8c7fad563a058b7a0d1a2e7483790a.vehicle',
      'namespace' => 'redactor',
    ),
    54 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c7743c93841b67ffa7eb9ad0e7fcf5b8',
      'native_key' => 'redactor.sanitizeReplace',
      'filename' => 'modSystemSetting/46556a99d129738b6b6b41ecb2c53c67.vehicle',
      'namespace' => 'redactor',
    ),
    55 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '22953b1ebce7c64568862b1574fe242f',
      'native_key' => 'redactor.linkSize',
      'filename' => 'modSystemSetting/ace6d1d7f29c52893e51a95c548c291b.vehicle',
      'namespace' => 'redactor',
    ),
    56 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5596484396f2c5680a5d91bb04cd5664',
      'native_key' => 'redactor.advAttrib',
      'filename' => 'modSystemSetting/40938a67256ce9674be0308ab5144c96.vehicle',
      'namespace' => 'redactor',
    ),
    57 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dda6891339ac02f0877c5e3e2a8d6005',
      'native_key' => 'redactor.linkNofollow',
      'filename' => 'modSystemSetting/83b464b158e70de4f16b9eb7e1d6a4a0.vehicle',
      'namespace' => 'redactor',
    ),
    58 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6d3cc36de6bdce2743fda16599369b40',
      'native_key' => 'redactor.typewriter',
      'filename' => 'modSystemSetting/dd30515f804d4939bd5ed89937aa299b.vehicle',
      'namespace' => 'redactor',
    ),
    59 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f138c2f0d55c9a5a132c8fb215a3eccb',
      'native_key' => 'redactor.buttonsHideOnMobile',
      'filename' => 'modSystemSetting/67f08a9cf173c1eaf385793e40bd7f68.vehicle',
      'namespace' => 'redactor',
    ),
    60 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f464393eac7c61e4ada31e5082ffaeca',
      'native_key' => 'redactor.toolbarOverflow',
      'filename' => 'modSystemSetting/67b4e4e98c0f364ebcbddf4d9f6f3fdd.vehicle',
      'namespace' => 'redactor',
    ),
    61 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '533f364a54612da7cc746eb77987961f',
      'native_key' => 'redactor.imageTabLink',
      'filename' => 'modSystemSetting/fa15ee3ba091e82c8b57000b30ce84d6.vehicle',
      'namespace' => 'redactor',
    ),
    62 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c0a57b59a80bd80f77ac6fb81c85a754',
      'native_key' => 'redactor.cleanSpaces',
      'filename' => 'modSystemSetting/9ed8f924a8ae16030cf16d42f45d97a1.vehicle',
      'namespace' => 'redactor',
    ),
    63 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd55595d7892355182af39768d4208783',
      'native_key' => 'redactor.predefinedLinks',
      'filename' => 'modSystemSetting/6df717e36746fbc949bb817d838d65d6.vehicle',
      'namespace' => 'redactor',
    ),
    64 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '57ebc17926873fa2b515e96b69e5b36f',
      'native_key' => 'redactor.shortcutsAdd',
      'filename' => 'modSystemSetting/7b21b23316cd0e8f87956f9aa3010375.vehicle',
      'namespace' => 'redactor',
    ),
    65 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '109812f25bed19ad29fe07f60b4ea409',
      'native_key' => 'redactor.commemorateRebecca',
      'filename' => 'modSystemSetting/e51d5b1c2f287e5767cd40c4506dcea2.vehicle',
      'namespace' => 'redactor',
    ),
    66 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f8709066326eeabb1b695bdddc0f01de',
      'native_key' => 'redactor.toolbarFixed',
      'filename' => 'modSystemSetting/d1e9d93ad1a689ded94ab209cec8b564.vehicle',
      'namespace' => 'redactor',
    ),
    67 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1d414bb93dbdcea3efcc4963ef1cbbff',
      'native_key' => 'redactor.focus',
      'filename' => 'modSystemSetting/2927e1a3dc1e9fa19d5f38249ca85d4f.vehicle',
      'namespace' => 'redactor',
    ),
    68 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b8a4b0311de38e3ef2e90b674d0730ef',
      'native_key' => 'redactor.focusEnd',
      'filename' => 'modSystemSetting/a7b0de6e1100db239341b8cbe8f0b677.vehicle',
      'namespace' => 'redactor',
    ),
    69 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f3c420bd729018d10ae5ab3d32b95bed',
      'native_key' => 'redactor.scrollTarget',
      'filename' => 'modSystemSetting/cef99c7b07766a86d45a90741d84b3fb.vehicle',
      'namespace' => 'redactor',
    ),
    70 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4644582e1f00caab91c03818d088aa09',
      'native_key' => 'redactor.enterKey',
      'filename' => 'modSystemSetting/ef81210fadc07ccc5c7395d837ccea6e.vehicle',
      'namespace' => 'redactor',
    ),
    71 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e492652b1a2b9ca0c1816538fbad84fc',
      'native_key' => 'redactor.cleanStyleOnEnter',
      'filename' => 'modSystemSetting/a35de0b7a1004772af1cced254a171bf.vehicle',
      'namespace' => 'redactor',
    ),
    72 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6369906f6050b226f67663f7d560c2f8',
      'native_key' => 'redactor.linkTooltip',
      'filename' => 'modSystemSetting/2d7bc2a74018cdaba3be48111f29502f.vehicle',
      'namespace' => 'redactor',
    ),
    73 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a161eba86467472c19fc9cedfbddac57',
      'native_key' => 'redactor.imageEditable',
      'filename' => 'modSystemSetting/6fb1baa62cbd27864f6fad4ab851d680.vehicle',
      'namespace' => 'redactor',
    ),
    74 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3d24e6e87f60b6c6ad578a680f29c1ef',
      'native_key' => 'redactor.imageResizable',
      'filename' => 'modSystemSetting/f379cb04ef6df8d22e48b9fec6ae4c16.vehicle',
      'namespace' => 'redactor',
    ),
    75 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ee381e4608068be5b9eedc3ec412b209',
      'native_key' => 'redactor.imageLink',
      'filename' => 'modSystemSetting/969dc62bf2be69ef73dec978750f32d6.vehicle',
      'namespace' => 'redactor',
    ),
    76 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4e384044791cab1d2f2801e152af47c1',
      'native_key' => 'redactor.imagePosition',
      'filename' => 'modSystemSetting/e406ad8a34090438e802672cfed804b9.vehicle',
      'namespace' => 'redactor',
    ),
    77 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b5de037bb1428eefa12607908624c36f',
      'native_key' => 'redactor.buttonsHide',
      'filename' => 'modSystemSetting/d02cbb81e59625cb17ff009fa42a94fa.vehicle',
      'namespace' => 'redactor',
    ),
    78 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '256ec9cad3fcbd9c38baeda4c20290a1',
      'native_key' => 'redactor.formattingAdd',
      'filename' => 'modSystemSetting/98cf21448f34ad5912a8b704a65058c0.vehicle',
      'namespace' => 'redactor',
    ),
    79 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6d43f53a7855914f2705db5f70b8f1b7',
      'native_key' => 'redactor.tabifier',
      'filename' => 'modSystemSetting/2c397f15fba38cc7485d3494e817140f.vehicle',
      'namespace' => 'redactor',
    ),
    80 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f5474b70dd015c077ff79534e69060e3',
      'native_key' => 'redactor.replaceTags',
      'filename' => 'modSystemSetting/68a88b4db52a06bbc38278c65da6b131.vehicle',
      'namespace' => 'redactor',
    ),
    81 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b982b0f993771bc021bc88845d4bdc73',
      'native_key' => 'redactor.replaceStyles',
      'filename' => 'modSystemSetting/b911eb72c85e537634bc45b2609199ca.vehicle',
      'namespace' => 'redactor',
    ),
    82 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3b338c00cb961af2de5ff98b7178797c',
      'native_key' => 'redactor.removeDataAttr',
      'filename' => 'modSystemSetting/1b66aeca83c2410e41e39003e0d009e6.vehicle',
      'namespace' => 'redactor',
    ),
    83 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '969497d9e62cbec06d2e64099e6e39fb',
      'native_key' => 'redactor.removeAttr',
      'filename' => 'modSystemSetting/d2c5631ed029fc212c8839c94d70422f.vehicle',
      'namespace' => 'redactor',
    ),
    84 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f798c8181e9dcef8b872486aa01c69a0',
      'native_key' => 'redactor.allowedAttr',
      'filename' => 'modSystemSetting/d8b271f16e5595f05c25d5b00c4a4c86.vehicle',
      'namespace' => 'redactor',
    ),
    85 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f776b9005930ca9fcbfd6e5a5d0a5d4e',
      'native_key' => 'redactor.dragImageUpload',
      'filename' => 'modSystemSetting/437b40a57af6d0050c9952741671ee96.vehicle',
      'namespace' => 'redactor',
    ),
    86 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c2b13a4e26ec302bcacfe477893c24ff',
      'native_key' => 'redactor.dragFileUpload',
      'filename' => 'modSystemSetting/0ceddbad7f4d067fc79530d4d3644874.vehicle',
      'namespace' => 'redactor',
    ),
    87 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '07d9d2811bc403564a35bbee3ec82263',
      'native_key' => 'redactor.replaceDivs',
      'filename' => 'modSystemSetting/d4130cdceec7a90b1346748997b1b031.vehicle',
      'namespace' => 'redactor',
    ),
    88 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e8871bf72eb837b1d9e719e279f61575',
      'native_key' => 'redactor.preSpaces',
      'filename' => 'modSystemSetting/1d12b9609bb953f50b8e11a63480aab1.vehicle',
      'namespace' => 'redactor',
    ),
    89 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '71e279e5b57bfa372bbd21a8c412a60c',
      'native_key' => 'redactor.parse_parent_path',
      'filename' => 'modSystemSetting/4386ffd998f008b5667ba770527dc5e9.vehicle',
      'namespace' => 'redactor',
    ),
    90 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '81f177deb9f387c3877e8708067dc9dd',
      'native_key' => 'redactor.increment_file_names',
      'filename' => 'modSystemSetting/7e037653cd90469319d83d7024f91eda.vehicle',
      'namespace' => 'redactor',
    ),
    91 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '76bf439ea514198ab9dcb03187abd2bd',
      'native_key' => 'redactor.parse_parent_path_height',
      'filename' => 'modSystemSetting/da4b8d3f17ce50a095c898fc24b0f869.vehicle',
      'namespace' => 'redactor',
    ),
    92 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ec12ae0248790a69a5696f7b8319f99b',
      'native_key' => 'redactor.baseurls_mode',
      'filename' => 'modSystemSetting/bd4f1d6e1afd1535bfe94961c83c27ea.vehicle',
      'namespace' => 'redactor',
    ),
    93 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f99e5e2e61520e21b5eed03a4efc86b6',
      'native_key' => 'redactor.showDimensionsOnResize',
      'filename' => 'modSystemSetting/a6346f7ed10aa19d97e89fe4f666ed22.vehicle',
      'namespace' => 'redactor',
    ),
    94 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c2b10433187a177f9e5f76e402b5fab5',
      'native_key' => 'redactor.plugin_counter',
      'filename' => 'modSystemSetting/05c84ba37552ec2116ad2299092155c9.vehicle',
      'namespace' => 'redactor',
    ),
    95 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '521649f300f3190f1da15658a900597e',
      'native_key' => 'redactor.plugin_fontcolor',
      'filename' => 'modSystemSetting/e0fbe3316708839cced15821b680de68.vehicle',
      'namespace' => 'redactor',
    ),
    96 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1ee67e6dde03f5c7333571995cc1965d',
      'native_key' => 'redactor.plugin_fontfamily',
      'filename' => 'modSystemSetting/54d4f9a223467b507749da957a4d898c.vehicle',
      'namespace' => 'redactor',
    ),
    97 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4aee6c497a4d9e4bffc4795d939c4eb5',
      'native_key' => 'redactor.plugin_fontsize',
      'filename' => 'modSystemSetting/09d2ff329b546b924e2a8a9722076f37.vehicle',
      'namespace' => 'redactor',
    ),
    98 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ae16b02821eea8db3ff39666e74a37db',
      'native_key' => 'redactor.plugin_limiter',
      'filename' => 'modSystemSetting/cc2678b6b847d366ced140c1d86452cf.vehicle',
      'namespace' => 'redactor',
    ),
    99 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2a527a91073a8ed220807f90e50aee4a',
      'native_key' => 'redactor.plugin_table',
      'filename' => 'modSystemSetting/938f3057a658fdb121d42e9782ff4eea.vehicle',
      'namespace' => 'redactor',
    ),
    100 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '25a8241a20c66ab0fff01b74e25b2ad9',
      'native_key' => 'redactor.plugin_textdirection',
      'filename' => 'modSystemSetting/73b77fcfbd7509237a4da0bf79965859.vehicle',
      'namespace' => 'redactor',
    ),
    101 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '965503b9c71b6dd428787ec04da89016',
      'native_key' => 'redactor.plugin_video',
      'filename' => 'modSystemSetting/45638333aff05f8d80b79d83e2f247dc.vehicle',
      'namespace' => 'redactor',
    ),
    102 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd599a390b74cc04616a17024f71917bd',
      'native_key' => 'redactor.plugin_replacer',
      'filename' => 'modSystemSetting/48b1c4410c930b6fb3cfab173aa71b4f.vehicle',
      'namespace' => 'redactor',
    ),
    103 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7669739d84e0a8978f06175efdf5a645',
      'native_key' => 'redactor.plugin_replacer_button',
      'filename' => 'modSystemSetting/b0337bec8b3af0207221c53d0b072873.vehicle',
      'namespace' => 'redactor',
    ),
    104 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '040f68c548e563d43f07ed5611adc91d',
      'native_key' => 'redactor.plugin_syntax',
      'filename' => 'modSystemSetting/0a307fc8ad73278e2310d865988e3b08.vehicle',
      'namespace' => 'redactor',
    ),
    105 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9899547fd541d395156a25f3571b22ca',
      'native_key' => 'redactor.plugin_speek',
      'filename' => 'modSystemSetting/2c0cb0fb88b2929177f90a1c4f799eab.vehicle',
      'namespace' => 'redactor',
    ),
    106 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'eae40de76990e14281f992f707719ab5',
      'native_key' => 'redactor.plugin_contrast',
      'filename' => 'modSystemSetting/2b1fca95095db996d5ddc4ae7a80e116.vehicle',
      'namespace' => 'redactor',
    ),
    107 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c9811c5a2e1a6e867075247fea05236f',
      'native_key' => 'redactor.plugin_eureka',
      'filename' => 'modSystemSetting/bcc8435c50538ca1429940f1ded254fc.vehicle',
      'namespace' => 'redactor',
    ),
    108 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '09cf0804a6112460aba9521977a18e72',
      'native_key' => 'redactor.plugin_eureka_shivie9',
      'filename' => 'modSystemSetting/ad70920a1a62ff2aa90abcf4772c6ccb.vehicle',
      'namespace' => 'redactor',
    ),
    109 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f155c140160021d48b209dd4fd9f792b',
      'native_key' => 'redactor.eurekaUpload',
      'filename' => 'modSystemSetting/1f8be2a23c5b9c5ed1f2579f1f0798f0.vehicle',
      'namespace' => 'redactor',
    ),
    110 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '15aef2c6f0b0125c1c2b5cb508cf0ee9',
      'native_key' => 'redactor.initial_directory_depth',
      'filename' => 'modSystemSetting/8a7ee0a3c38ed565c9c0ee9db37b7489.vehicle',
      'namespace' => 'redactor',
    ),
    111 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '273d948b1abcd581926f7542a44bd477',
      'native_key' => 'redactor.plugin_zoom',
      'filename' => 'modSystemSetting/9731a742d823a4db75db1791a4eeeb28.vehicle',
      'namespace' => 'redactor',
    ),
    112 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ae8af597d6c354ff88d1e0b737c13b70',
      'native_key' => 'redactor.plugin_download',
      'filename' => 'modSystemSetting/f88c3bb1e6c8c3cfb698d99d968d554e.vehicle',
      'namespace' => 'redactor',
    ),
    113 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3f4c30f2f1799b25b3ca312363cb6f53',
      'native_key' => 'redactor.plugin_imagepx',
      'filename' => 'modSystemSetting/241ce1b2fc64df7f6e76af07051bbfea.vehicle',
      'namespace' => 'redactor',
    ),
    114 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1ee6c5e57fde94e868b51e1d445c0ad2',
      'native_key' => 'redactor.plugin_imageurl',
      'filename' => 'modSystemSetting/012a0b6fd3053e93d73e3792f3f6d84f.vehicle',
      'namespace' => 'redactor',
    ),
    115 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '69b9ad21066bab12a92a00d6ab32f317',
      'native_key' => 'redactor.plugin_breadcrumb',
      'filename' => 'modSystemSetting/35d0542c8bf8afe141ea1835b03c6cf0.vehicle',
      'namespace' => 'redactor',
    ),
    116 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8c680721a6ade07eb2f61422bc45f480',
      'native_key' => 'redactor.plugin_norphan',
      'filename' => 'modSystemSetting/de6e3fd59eace258470e5c7ad4fd2dfb.vehicle',
      'namespace' => 'redactor',
    ),
    117 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c85416fde7554a458e6cc1f5aaa4dfa3',
      'native_key' => 'redactor.plugin_baseurls',
      'filename' => 'modSystemSetting/f1e52361cd4b257862d2f5162892a2ca.vehicle',
      'namespace' => 'redactor',
    ),
    118 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c5a2b2b09681df5615452224faab36b3',
      'native_key' => 'redactor.textexpander',
      'filename' => 'modSystemSetting/2ac7924f4973c5dd91fd3c14e32309a1.vehicle',
      'namespace' => 'redactor',
    ),
    119 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '307d1206ba7c74461e1a1961edcef09e',
      'native_key' => 'redactor.speechPitch',
      'filename' => 'modSystemSetting/38d4dfce8292a9b78950113b887f76cb.vehicle',
      'namespace' => 'redactor',
    ),
    120 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5862207eca0e339d72ec7c47530d1b86',
      'native_key' => 'redactor.speechRate',
      'filename' => 'modSystemSetting/26dd638a970abc9fd657da38014548f3.vehicle',
      'namespace' => 'redactor',
    ),
    121 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5185d19eee11754aac5b48986cdd1949',
      'native_key' => 'redactor.speechVolume',
      'filename' => 'modSystemSetting/463f09d2b11c5ca6e8ee4101ee201f65.vehicle',
      'namespace' => 'redactor',
    ),
    122 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd4abb35705e27134136136c71a2e85aa',
      'native_key' => 'redactor.speechVoice',
      'filename' => 'modSystemSetting/fdf3f5e595f370b4aa1bdd05ce9857e5.vehicle',
      'namespace' => 'redactor',
    ),
    123 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e6a0c417110971164c14faca53c38f10',
      'native_key' => 'redactor.counterWPM',
      'filename' => 'modSystemSetting/766ff32def5c2c56a7c9531fefed1ef4.vehicle',
      'namespace' => 'redactor',
    ),
    124 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '35ffd227bcddd358db21635437362fcf',
      'native_key' => 'redactor.codemirror',
      'filename' => 'modSystemSetting/f1002f29cb7da3f7519cdb0857cf54b2.vehicle',
      'namespace' => 'redactor',
    ),
    125 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '94acdc061846af635c61e3f4305b44e8',
      'native_key' => 'redactor.plugin_uploadcare',
      'filename' => 'modSystemSetting/dc28b3cd1de5f64ef6a3aa25754361a1.vehicle',
      'namespace' => 'redactor',
    ),
    126 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '124caa685f1ea0ef0e6f1e2d53be279e',
      'native_key' => 'redactor.uploadcare_pub_key',
      'filename' => 'modSystemSetting/0941c4d915af04d3508ccef09a425da6.vehicle',
      'namespace' => 'redactor',
    ),
    127 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8a90cdab8520f3e75c7a89b19445685f',
      'native_key' => 'redactor.uploadcare_locale',
      'filename' => 'modSystemSetting/cb77c26628940bdd4c71d9611d9e3c64.vehicle',
      'namespace' => 'redactor',
    ),
    128 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4983d3618a6eb32df32e2dbee1ce5614',
      'native_key' => 'redactor.uploadcare_crop',
      'filename' => 'modSystemSetting/6bd7ae19eff79e665c07f58ea4c01bb4.vehicle',
      'namespace' => 'redactor',
    ),
    129 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '22de0153622426e449d5d1082d17b5d0',
      'native_key' => 'redactor.uploadcare_tabs',
      'filename' => 'modSystemSetting/42a36139ae33030d42c02cd82c3bf54e.vehicle',
      'namespace' => 'redactor',
    ),
    130 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3f8bdb1c354b6dc5a3c5a57ea7ca2431',
      'native_key' => 'redactor.loadIntrotext',
      'filename' => 'modSystemSetting/bc489afbe2c8324783431d68c6ef1025.vehicle',
      'namespace' => 'redactor',
    ),
    131 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '61627d3b9c97a5c56f0f1d9f60b19fac',
      'native_key' => 'redactor.limiter',
      'filename' => 'modSystemSetting/93f081c1b0d9206a74e64791d614c3ec.vehicle',
      'namespace' => 'redactor',
    ),
    132 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOScriptVehicle',
      'class' => 'xPDOScriptVehicle',
      'guid' => 'df621c3621c040284fcd5357f2d245ae',
      'native_key' => 'df621c3621c040284fcd5357f2d245ae',
      'filename' => 'xPDOScriptVehicle/f1071c3c2492546c173715d79cbf6f41.vehicle',
      'namespace' => 'redactor',
    ),
  ),
);