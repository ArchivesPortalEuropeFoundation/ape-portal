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
    'changelog' => 'Redactor 2.3.4-pl
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
      'guid' => '87b9a3f1b15421f19bf42eb8765fc8b4',
      'native_key' => 'redactor',
      'filename' => 'modNamespace/17acfd8827a80b6ce9a33940c90e78db.vehicle',
      'namespace' => 'redactor',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => 'a8e7289911b54255697b9befb067dde6',
      'native_key' => 'a8e7289911b54255697b9befb067dde6',
      'filename' => 'xPDOFileVehicle/077224f6f5cd42dc9d7914ffb732ff14.vehicle',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'modmoreVehicle',
      'class' => 'modPlugin',
      'guid' => 'a1d54d179e23e6aa270749ad4e830b54',
      'native_key' => NULL,
      'filename' => 'modPlugin/adb2ad2fb313fe33ed294a27a8209727.vehicle',
      'namespace' => 'redactor',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9d4387824cb7bf7c797f95259d948909',
      'native_key' => 'redactor.lang',
      'filename' => 'modSystemSetting/d0e8738a14fa01800c48c4f1e14c7838.vehicle',
      'namespace' => 'redactor',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8e0a67024a63c71e88cd80f84a15c1d3',
      'native_key' => 'redactor.direction',
      'filename' => 'modSystemSetting/8b7f047886723def647bd11e02d38c4e.vehicle',
      'namespace' => 'redactor',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '848b5cc48e358f7450551d22f5244862',
      'native_key' => 'redactor.buttons',
      'filename' => 'modSystemSetting/0431032e25d02a681fae2cd2ca57d447.vehicle',
      'namespace' => 'redactor',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b01306f7cdb2c1bcda7f46a4efc546b1',
      'native_key' => 'redactor.activeButtons',
      'filename' => 'modSystemSetting/9b0c9572fc575189f855059b01b5ec4d.vehicle',
      'namespace' => 'redactor',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '79dfee8cb239fea0a1c57fa574d6e747',
      'native_key' => 'redactor.activeButtonsStates',
      'filename' => 'modSystemSetting/0ff77284d37b42923d21f163b74b23ec.vehicle',
      'namespace' => 'redactor',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1e01e3862e59e7eaf7d55ebe00c44023',
      'native_key' => 'redactor.formattingTags',
      'filename' => 'modSystemSetting/5a6b19da9f169243db773452c81fadd0.vehicle',
      'namespace' => 'redactor',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bde81222ce003f720740c0f0d0d5f824',
      'native_key' => 'redactor.buttonSource',
      'filename' => 'modSystemSetting/ace1eeb0c5a195e1dde47128faa915d1.vehicle',
      'namespace' => 'redactor',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1962f853669c5963149ba28b69f13d8e',
      'native_key' => 'redactor.buttonFullScreen',
      'filename' => 'modSystemSetting/171dd40dc710e740f549f0c2d97072f9.vehicle',
      'namespace' => 'redactor',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a78b3e87f33054ad5abb012f137ed321',
      'native_key' => 'redactor.css',
      'filename' => 'modSystemSetting/8f7ab474da2aec45668551d4ad6de457.vehicle',
      'namespace' => 'redactor',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fda01b776d6cffd263aa4bc227d21dd1',
      'native_key' => 'redactor.shortcuts',
      'filename' => 'modSystemSetting/6c36850a3f03907361a35d88cfbbfbe9.vehicle',
      'namespace' => 'redactor',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e0933777b8f93713dd3e2f73a84b0322',
      'native_key' => 'redactor.cleanup',
      'filename' => 'modSystemSetting/c93d91984076acd0c9252c11d82ddfd8.vehicle',
      'namespace' => 'redactor',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4be558296848130e31e09a9a0f59685b',
      'native_key' => 'redactor.convertLinks',
      'filename' => 'modSystemSetting/3b19254b05db9892bbe31e9bad4f3e23.vehicle',
      'namespace' => 'redactor',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0b62f044f4182e48a5728f5e0ef8ddd4',
      'native_key' => 'redactor.tabindex',
      'filename' => 'modSystemSetting/5e3a6894291642455829d89e5a459bd7.vehicle',
      'namespace' => 'redactor',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dd2104124d505b4ccc7521dfeee254d3',
      'native_key' => 'redactor.minHeight',
      'filename' => 'modSystemSetting/f9f1ca341eff844cf1a031b50da1afc2.vehicle',
      'namespace' => 'redactor',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd5de2c2e803020190568ea426d85057c',
      'native_key' => 'redactor.colors',
      'filename' => 'modSystemSetting/77f7207cf06528811ed24ee776df5e8a.vehicle',
      'namespace' => 'redactor',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7be4834e98ef3f74e428e10f7963ad8d',
      'native_key' => 'redactor.wym',
      'filename' => 'modSystemSetting/5c2d389cb664e49114c813312fa6ffc2.vehicle',
      'namespace' => 'redactor',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a0ae36c2c055a6ac92fac627aaa26f99',
      'native_key' => 'redactor.linkProtocol',
      'filename' => 'modSystemSetting/17b075ddeb9e372b5011c58e7e406059.vehicle',
      'namespace' => 'redactor',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '74bf55f56b310683d9e7c0d80d2a4268',
      'native_key' => 'redactor.placeholder',
      'filename' => 'modSystemSetting/b9a9dd4ef840a9848bfcfabc0c081cab.vehicle',
      'namespace' => 'redactor',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e1292fb313130bf9c71cda21edd87c52',
      'native_key' => 'redactor.linebreaks',
      'filename' => 'modSystemSetting/f8de7cd1c6afb08dc14e5b636139d35f.vehicle',
      'namespace' => 'redactor',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b423af0d119321533b5a978de14bc0e1',
      'native_key' => 'redactor.allowedTags',
      'filename' => 'modSystemSetting/ff6bd479745d053e142db691861dc2c2.vehicle',
      'namespace' => 'redactor',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f772b7064fcf8b852fa3acf7aa9e3121',
      'native_key' => 'redactor.deniedTags',
      'filename' => 'modSystemSetting/b699ae881d3373ff6b0bcfdc78741e07.vehicle',
      'namespace' => 'redactor',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '80612d9f789354e2f54ad080456d43f2',
      'native_key' => 'redactor.linkEmail',
      'filename' => 'modSystemSetting/c09cf3f2a0cb3d8b9a1c4e88cc207942.vehicle',
      'namespace' => 'redactor',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c7fc31e91a7881ca5b8bddb9431da01e',
      'native_key' => 'redactor.linkAnchor',
      'filename' => 'modSystemSetting/be153f81b58ba5e6f11fc3639e43f0d4.vehicle',
      'namespace' => 'redactor',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4e626b46482ad6f7719677e6b72ed613',
      'native_key' => 'redactor.pastePlainText',
      'filename' => 'modSystemSetting/f3efd7c55d0961455c76262535be6c05.vehicle',
      'namespace' => 'redactor',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '26c10c34bb9e378d56cb913088b1a8c5',
      'native_key' => 'redactor.paragraphize',
      'filename' => 'modSystemSetting/048e1c68b6d21f7fced442eae2193019.vehicle',
      'namespace' => 'redactor',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f009766bd11cf4e7b751180188775cb6',
      'native_key' => 'redactor.removeComments',
      'filename' => 'modSystemSetting/b5c820cf17cd458594bc7f1200c67eb8.vehicle',
      'namespace' => 'redactor',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6e9d51a5cba3d1a05c86ac1f24b3cc70',
      'native_key' => 'redactor.visual',
      'filename' => 'modSystemSetting/4112e10cd8c41142ef3be6e6c279d3a9.vehicle',
      'namespace' => 'redactor',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f8efef262fbee23009552cc22807e7bc',
      'native_key' => 'redactor.marginFloatLeft',
      'filename' => 'modSystemSetting/574079ccc5e3ab78220a8a8780670022.vehicle',
      'namespace' => 'redactor',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bb1659d96e3ad93f20176eb74d913276',
      'native_key' => 'redactor.marginFloatRight',
      'filename' => 'modSystemSetting/26c5277fabd6e11438771da5dd11db10.vehicle',
      'namespace' => 'redactor',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8c5ddf68504a67bfc740fbda0378612f',
      'native_key' => 'redactor.mediasource',
      'filename' => 'modSystemSetting/fd5a3b2f143d969c1d46a65feda73ff9.vehicle',
      'namespace' => 'redactor',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '949259c46ee6bd9a05e95c162f4e8eda',
      'native_key' => 'redactor.file_mediasource',
      'filename' => 'modSystemSetting/8e3c91036081412689392ff598892ff7.vehicle',
      'namespace' => 'redactor',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '77b9351ce0c6a0c850714f11ea5607f0',
      'native_key' => 'redactor.image_upload_path',
      'filename' => 'modSystemSetting/82131619786536cb7a8b57a75dd1368c.vehicle',
      'namespace' => 'redactor',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '15db1c85eb3ada3fa80d9792cbe6cfbc',
      'native_key' => 'redactor.image_browse_path',
      'filename' => 'modSystemSetting/2dd51542b50db64837b7f6e47492eb57.vehicle',
      'namespace' => 'redactor',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '608498cc72454dbd56aadf9e9297b1e2',
      'native_key' => 'redactor.file_upload_path',
      'filename' => 'modSystemSetting/ed87b31990e036327cac9a568aff2e95.vehicle',
      'namespace' => 'redactor',
    ),
    37 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8362c602f93761fa8ecc3fc3c0b171de',
      'native_key' => 'redactor.file_browse_path',
      'filename' => 'modSystemSetting/0dda8551b50cd3e851ef786132818a54.vehicle',
      'namespace' => 'redactor',
    ),
    38 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '12c00fa4bf1f81177f46ce444ff405cf',
      'native_key' => 'redactor.browse_files',
      'filename' => 'modSystemSetting/6cb3d8a6d6e5e6b059a4d2eaa7ca8101.vehicle',
      'namespace' => 'redactor',
    ),
    39 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2075d75da1bdcc02bc0d02b6c60ba871',
      'native_key' => 'redactor.date_images',
      'filename' => 'modSystemSetting/bc37a4715aa7fb8228e1c0f2485c2094.vehicle',
      'namespace' => 'redactor',
    ),
    40 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2d1f95f75818f82c66167c76ce407d74',
      'native_key' => 'redactor.date_files',
      'filename' => 'modSystemSetting/3d9ad2502d7e08b9af76a4fd4e9689da.vehicle',
      'namespace' => 'redactor',
    ),
    41 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b60600ef3f5e05b310c04a21d14b2d0d',
      'native_key' => 'redactor.typeahead.include_introtext',
      'filename' => 'modSystemSetting/08d80206ec76b6f123824b54540ca071.vehicle',
      'namespace' => 'redactor',
    ),
    42 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9f81d57134ecaef9c5737be0fdad66fb',
      'native_key' => 'redactor.prefetch_ttl',
      'filename' => 'modSystemSetting/b27b4718cd677edc1ea19ab15a50c1b4.vehicle',
      'namespace' => 'redactor',
    ),
    43 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '12204fbf58ed4b1f1f4a421c651d99c2',
      'native_key' => 'redactor.linkResource',
      'filename' => 'modSystemSetting/4c48583c8853bd48ec152dbd9bd0efa8.vehicle',
      'namespace' => 'redactor',
    ),
    44 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '415c4614000be0df8d9bf97fb14d8838',
      'native_key' => 'redactor.cleanFileNames',
      'filename' => 'modSystemSetting/cf79851f5d85612a98f213fcb6398946.vehicle',
      'namespace' => 'redactor',
    ),
    45 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '054d818dac73929cfcd7674a5c857c2f',
      'native_key' => 'redactor.dynamicThumbs',
      'filename' => 'modSystemSetting/b67f1081b10788fedff647af96a9b299.vehicle',
      'namespace' => 'redactor',
    ),
    46 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '99424732213dfb4ca6a8417469a509b4',
      'native_key' => 'redactor.clipsJson',
      'filename' => 'modSystemSetting/9bf6a10434f80e1b49814ae5e07c4059.vehicle',
      'namespace' => 'redactor',
    ),
    47 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0153d1dfb540b95902b069bbb9f6c0a8',
      'native_key' => 'redactor.additionalPlugins',
      'filename' => 'modSystemSetting/223e601d6280bb67c1e51cff3840fce6.vehicle',
      'namespace' => 'redactor',
    ),
    48 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b9198b8d396da94bf9dfc43a204f2e17',
      'native_key' => 'redactor.dragUpload',
      'filename' => 'modSystemSetting/646df870bfd92576040b2fd6419cb464.vehicle',
      'namespace' => 'redactor',
    ),
    49 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e02e8fbbdb9b06c02470f99cb22189a8',
      'native_key' => 'redactor.convertImageLinks',
      'filename' => 'modSystemSetting/fdb16fec2dd0245876590cad28a9c086.vehicle',
      'namespace' => 'redactor',
    ),
    50 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0b49218da6ddf525c30d38a75ac3412a',
      'native_key' => 'redactor.convertVideoLinks',
      'filename' => 'modSystemSetting/656fe07ebde1206bc852e22fa714852d.vehicle',
      'namespace' => 'redactor',
    ),
    51 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4c84df02322fe17d5348668a159ed44d',
      'native_key' => 'redactor.tabAsSpaces',
      'filename' => 'modSystemSetting/f8f1eafd04050f6c965fa15a3fc5c61a.vehicle',
      'namespace' => 'redactor',
    ),
    52 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f471315b53986d594861ddc18d5ffe49',
      'native_key' => 'redactor.removeEmptyTags',
      'filename' => 'modSystemSetting/017250d70919341fcb05e9b46209c437.vehicle',
      'namespace' => 'redactor',
    ),
    53 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '48549efb9dedec8df7af7f0e6bf16b95',
      'native_key' => 'redactor.sanitizePattern',
      'filename' => 'modSystemSetting/4c7af7293943d64d44edc85af7aa002a.vehicle',
      'namespace' => 'redactor',
    ),
    54 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6c65fa72f91074e5a05d23fa99819139',
      'native_key' => 'redactor.sanitizeReplace',
      'filename' => 'modSystemSetting/18d4b015ea2f66887e2b3d18aa6fbfa4.vehicle',
      'namespace' => 'redactor',
    ),
    55 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '80fb86b19b13aea579515a96ccc3df41',
      'native_key' => 'redactor.linkSize',
      'filename' => 'modSystemSetting/0d4773dce7f2ab9d43704b5b966d8b8e.vehicle',
      'namespace' => 'redactor',
    ),
    56 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '84b6d56de123ff6e69e31d141cd55854',
      'native_key' => 'redactor.advAttrib',
      'filename' => 'modSystemSetting/f5bd7b293706fce49812fdacd816d7af.vehicle',
      'namespace' => 'redactor',
    ),
    57 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0ee725ef9a43ab77de4fd298355906c0',
      'native_key' => 'redactor.linkNofollow',
      'filename' => 'modSystemSetting/869190fd38588283e3061b70b4814706.vehicle',
      'namespace' => 'redactor',
    ),
    58 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '070c70e7d14754a7ed48c6b9213e2a85',
      'native_key' => 'redactor.typewriter',
      'filename' => 'modSystemSetting/9cd5c8ac01358dd07bab2eac775b16df.vehicle',
      'namespace' => 'redactor',
    ),
    59 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e8c4c2d1c979c5979c2a66ed115b698a',
      'native_key' => 'redactor.buttonsHideOnMobile',
      'filename' => 'modSystemSetting/19ae3b8118df4fad884fb078a6c3ff56.vehicle',
      'namespace' => 'redactor',
    ),
    60 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '669769152be703dfc5c3c99d1253ca37',
      'native_key' => 'redactor.toolbarOverflow',
      'filename' => 'modSystemSetting/726eb7b78df5699906ff17b597b3b65b.vehicle',
      'namespace' => 'redactor',
    ),
    61 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c74213789400dc8199f14c53f0aedf6d',
      'native_key' => 'redactor.imageTabLink',
      'filename' => 'modSystemSetting/38f5504aea50f6c8d2a1752e40f201b0.vehicle',
      'namespace' => 'redactor',
    ),
    62 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5df2724f180605fb3bc56491487099db',
      'native_key' => 'redactor.cleanSpaces',
      'filename' => 'modSystemSetting/656b36c5196cc1d19c677f06874ebbed.vehicle',
      'namespace' => 'redactor',
    ),
    63 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ecbe406d4c33ab8fd22a20c3cc2e5fcd',
      'native_key' => 'redactor.predefinedLinks',
      'filename' => 'modSystemSetting/8b7aad8edc442fed848eef3e3e36e28b.vehicle',
      'namespace' => 'redactor',
    ),
    64 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'df0d2b257eebcfc07e1fb2b4b27adff1',
      'native_key' => 'redactor.shortcutsAdd',
      'filename' => 'modSystemSetting/2d3e855f14d4d8b48eacbcacc2688a57.vehicle',
      'namespace' => 'redactor',
    ),
    65 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9177e9552680e34439286608993d4af6',
      'native_key' => 'redactor.commemorateRebecca',
      'filename' => 'modSystemSetting/72603b8795748ff9d6c0b98c0868914e.vehicle',
      'namespace' => 'redactor',
    ),
    66 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '60e5988265221eaf24aa83cbb6c622bc',
      'native_key' => 'redactor.toolbarFixed',
      'filename' => 'modSystemSetting/6f5730c8a819b965fc988eea0d1795e4.vehicle',
      'namespace' => 'redactor',
    ),
    67 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cf2066df3e19dc9ff3801514e40b2417',
      'native_key' => 'redactor.focus',
      'filename' => 'modSystemSetting/e098acede2efb8cf99048cb59469b732.vehicle',
      'namespace' => 'redactor',
    ),
    68 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8d8bf2304e2f39d4e5d0666ab649fcd9',
      'native_key' => 'redactor.focusEnd',
      'filename' => 'modSystemSetting/c6f3441961ee34858c7007745711ee3f.vehicle',
      'namespace' => 'redactor',
    ),
    69 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b35b6007746ee90c39b359df004f408e',
      'native_key' => 'redactor.scrollTarget',
      'filename' => 'modSystemSetting/aa7e4c2ea118e5793096e60c4d94f3be.vehicle',
      'namespace' => 'redactor',
    ),
    70 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ae4ca43c1536bf0ab031ee59b842d35b',
      'native_key' => 'redactor.enterKey',
      'filename' => 'modSystemSetting/b998e37cfb296af06eef2fa59cdc83b8.vehicle',
      'namespace' => 'redactor',
    ),
    71 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '137a3d2fac656849fc9d90e6142603a2',
      'native_key' => 'redactor.cleanStyleOnEnter',
      'filename' => 'modSystemSetting/09a039f8f4a96193cc0198b8a7585768.vehicle',
      'namespace' => 'redactor',
    ),
    72 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '308cb6dc48e0c85cd696dabae2b5747b',
      'native_key' => 'redactor.linkTooltip',
      'filename' => 'modSystemSetting/175aff762532e070db7afbc9a30a95bb.vehicle',
      'namespace' => 'redactor',
    ),
    73 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '963a002a1f4f5283d2ef631dbc98661f',
      'native_key' => 'redactor.imageEditable',
      'filename' => 'modSystemSetting/d838a6fa1e4cddb9f506ebddefe656fe.vehicle',
      'namespace' => 'redactor',
    ),
    74 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '210cfb0de07ac7d3994dc3215c178f89',
      'native_key' => 'redactor.imageResizable',
      'filename' => 'modSystemSetting/1d9ff78a109cb6ac6f3a6cdad5b05da3.vehicle',
      'namespace' => 'redactor',
    ),
    75 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '619620b02a493374f7502fac58872e02',
      'native_key' => 'redactor.imageLink',
      'filename' => 'modSystemSetting/0ff9e75630155dd9f45b28b5d0a3a1e0.vehicle',
      'namespace' => 'redactor',
    ),
    76 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cd8743b4b2b1e20e85bd26168561ef16',
      'native_key' => 'redactor.imagePosition',
      'filename' => 'modSystemSetting/286fbe490ca99997ab5b135cd8a913c1.vehicle',
      'namespace' => 'redactor',
    ),
    77 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '09e228792b7fb16a3bbf2392f6e99a4e',
      'native_key' => 'redactor.buttonsHide',
      'filename' => 'modSystemSetting/808ce9adbcdec7646f9e1e6831730941.vehicle',
      'namespace' => 'redactor',
    ),
    78 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bf215f423d315fe98411c413b211b4ca',
      'native_key' => 'redactor.formattingAdd',
      'filename' => 'modSystemSetting/7116d408c6bd65784d7c9b365f4de4e6.vehicle',
      'namespace' => 'redactor',
    ),
    79 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c410b856e009b0accaef5d3921d57d0b',
      'native_key' => 'redactor.tabifier',
      'filename' => 'modSystemSetting/653d338a2b22df9a683153f11537e807.vehicle',
      'namespace' => 'redactor',
    ),
    80 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4e850abbf9ad2d1b71a6766050b952c2',
      'native_key' => 'redactor.replaceTags',
      'filename' => 'modSystemSetting/1b447b34710b0694b451c2501ee1e8b2.vehicle',
      'namespace' => 'redactor',
    ),
    81 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '396a392f6fd4e0fc18d3e607ca6a71c4',
      'native_key' => 'redactor.replaceStyles',
      'filename' => 'modSystemSetting/3dd238cf2ee8155c906a60f22ba1c095.vehicle',
      'namespace' => 'redactor',
    ),
    82 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '07d88c58a0a766367cfc793fa3dec0a3',
      'native_key' => 'redactor.removeDataAttr',
      'filename' => 'modSystemSetting/b190a7ea0aef899200bb931420d3f62f.vehicle',
      'namespace' => 'redactor',
    ),
    83 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bd44b14839daf4f0f1f4c6eabb300262',
      'native_key' => 'redactor.removeAttr',
      'filename' => 'modSystemSetting/7b814a7f53986fb051c24bdb78fa41c1.vehicle',
      'namespace' => 'redactor',
    ),
    84 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5fb747c7a11224a87de506dcdc95c9b2',
      'native_key' => 'redactor.allowedAttr',
      'filename' => 'modSystemSetting/cfe3eafa9f6cdb50a8f348bed7f49292.vehicle',
      'namespace' => 'redactor',
    ),
    85 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1f1dc07cb85012c901fd4808d65452ae',
      'native_key' => 'redactor.dragImageUpload',
      'filename' => 'modSystemSetting/2754866de5d03bc8344ed3c869e29205.vehicle',
      'namespace' => 'redactor',
    ),
    86 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ff59361d8fb02995874ab16be153c42a',
      'native_key' => 'redactor.dragFileUpload',
      'filename' => 'modSystemSetting/9ca0a80a92c9679388fd30c90a1eec7e.vehicle',
      'namespace' => 'redactor',
    ),
    87 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8ead486fcb256216e90b93979db8d4d5',
      'native_key' => 'redactor.replaceDivs',
      'filename' => 'modSystemSetting/94ce8339864c87b0e75cdc6a7c44f222.vehicle',
      'namespace' => 'redactor',
    ),
    88 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5998347b36d9cd8d61301636b42b9678',
      'native_key' => 'redactor.preSpaces',
      'filename' => 'modSystemSetting/1e608627ecc0538710ec3ee6eb8f7116.vehicle',
      'namespace' => 'redactor',
    ),
    89 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '88dcfa31bb6691cfafa727f3c1e0fa6c',
      'native_key' => 'redactor.parse_parent_path',
      'filename' => 'modSystemSetting/8662752c584a4cf81a63ca71e9c09ee7.vehicle',
      'namespace' => 'redactor',
    ),
    90 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3db0cc3d061f2fab1ce14ed48fe9e9bf',
      'native_key' => 'redactor.increment_file_names',
      'filename' => 'modSystemSetting/68b1ba9343caaa614ec20985f330e2d6.vehicle',
      'namespace' => 'redactor',
    ),
    91 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'daa14eca5c9cb2867642122b91709857',
      'native_key' => 'redactor.parse_parent_path_height',
      'filename' => 'modSystemSetting/ca5ed59fd7f4917f4c7d5787a33b5e8e.vehicle',
      'namespace' => 'redactor',
    ),
    92 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '372f2b6a55e128c278c8f6772c720ade',
      'native_key' => 'redactor.baseurls_mode',
      'filename' => 'modSystemSetting/bb95d40b7748523f39bc0374e94ac193.vehicle',
      'namespace' => 'redactor',
    ),
    93 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0684d43c76234a7aa67c50de2cbf4dc1',
      'native_key' => 'redactor.showDimensionsOnResize',
      'filename' => 'modSystemSetting/1ca60a42cb0197156ccde7904baef220.vehicle',
      'namespace' => 'redactor',
    ),
    94 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0a20f5eddf598b8e8a16f342095920e4',
      'native_key' => 'redactor.plugin_counter',
      'filename' => 'modSystemSetting/61cb271c65a1a924b210482ee1088373.vehicle',
      'namespace' => 'redactor',
    ),
    95 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e6fe1026cdaff02ba528df1d1f5aa69b',
      'native_key' => 'redactor.plugin_fontcolor',
      'filename' => 'modSystemSetting/eb4888238b51238424a20da00b275f57.vehicle',
      'namespace' => 'redactor',
    ),
    96 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0feaf1c14f1385f8307f18011b1aac45',
      'native_key' => 'redactor.plugin_fontfamily',
      'filename' => 'modSystemSetting/40d03c89fd24d30bf3f463215f26dfc5.vehicle',
      'namespace' => 'redactor',
    ),
    97 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ce0bbd1107169bfd16490602765cf295',
      'native_key' => 'redactor.plugin_fontsize',
      'filename' => 'modSystemSetting/706088d3be1d1329f39d230d6615d7fc.vehicle',
      'namespace' => 'redactor',
    ),
    98 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1184fa43444c6a8b8dd1947e1abaf478',
      'native_key' => 'redactor.plugin_limiter',
      'filename' => 'modSystemSetting/06dda2508b4553dd6437ae89fc71ec11.vehicle',
      'namespace' => 'redactor',
    ),
    99 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '803a6f5f4d619d53a85c18d506f8c1bb',
      'native_key' => 'redactor.plugin_table',
      'filename' => 'modSystemSetting/5aa171268d2fb0b2ccfaa5cc71d15c63.vehicle',
      'namespace' => 'redactor',
    ),
    100 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '86d2d8cc052c5bbcfb40787b0e2329ae',
      'native_key' => 'redactor.plugin_textdirection',
      'filename' => 'modSystemSetting/beca3c51a460a84565cb5a77060f518a.vehicle',
      'namespace' => 'redactor',
    ),
    101 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8b36320ceed7a58c293670c6edb36091',
      'native_key' => 'redactor.plugin_video',
      'filename' => 'modSystemSetting/0c9cb774e3220f87b6384ce7db67fec6.vehicle',
      'namespace' => 'redactor',
    ),
    102 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '616e60809c0da4e2d6b7dcc6effcc16a',
      'native_key' => 'redactor.plugin_replacer',
      'filename' => 'modSystemSetting/e729b5d232a976c2fbfb1b38aadc701b.vehicle',
      'namespace' => 'redactor',
    ),
    103 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f9666344904186f651622469fa40d5d5',
      'native_key' => 'redactor.plugin_syntax',
      'filename' => 'modSystemSetting/cb6fae07c92635dce8121983ef38d3be.vehicle',
      'namespace' => 'redactor',
    ),
    104 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '610a338560486b0e2119eb8fbba0f152',
      'native_key' => 'redactor.plugin_speek',
      'filename' => 'modSystemSetting/40d63febc042ab5113e78074bbe967b2.vehicle',
      'namespace' => 'redactor',
    ),
    105 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dc419e20797b26d6779e25f66bae899b',
      'native_key' => 'redactor.plugin_contrast',
      'filename' => 'modSystemSetting/9fdf6d7789e7659bba52b29b4da8e148.vehicle',
      'namespace' => 'redactor',
    ),
    106 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e444f84c437ce95017e161b39bda1fdb',
      'native_key' => 'redactor.plugin_eureka',
      'filename' => 'modSystemSetting/3792ada1e349704186bceac26601c430.vehicle',
      'namespace' => 'redactor',
    ),
    107 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4dc034111275c8c3ad918bb9897b3439',
      'native_key' => 'redactor.plugin_eureka_shivie9',
      'filename' => 'modSystemSetting/c5239ecc9eaa68b7af78e36e6c5caa74.vehicle',
      'namespace' => 'redactor',
    ),
    108 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '16407409b93c11817b17e52f9318e031',
      'native_key' => 'redactor.eurekaUpload',
      'filename' => 'modSystemSetting/8b7018604c8ca5b9bb1ee1c1ac1155be.vehicle',
      'namespace' => 'redactor',
    ),
    109 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6789a31ea4b4d8d859ce095503aa9496',
      'native_key' => 'redactor.initial_directory_depth',
      'filename' => 'modSystemSetting/ae16c4ad6525997d5932c623453723d1.vehicle',
      'namespace' => 'redactor',
    ),
    110 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e050ff02a88e9a33884b319af47c32f0',
      'native_key' => 'redactor.plugin_zoom',
      'filename' => 'modSystemSetting/e24f1eca14580611100489b5df5c52f6.vehicle',
      'namespace' => 'redactor',
    ),
    111 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '00735022cf22fd1fd3f78a485070e2c9',
      'native_key' => 'redactor.plugin_download',
      'filename' => 'modSystemSetting/e8afafabcc989e8b4e320450d53b3ef4.vehicle',
      'namespace' => 'redactor',
    ),
    112 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '52843ecdebfc01a57a9da19e31c7771f',
      'native_key' => 'redactor.plugin_imagepx',
      'filename' => 'modSystemSetting/3cee067b898a264b8e9d12eb62364d34.vehicle',
      'namespace' => 'redactor',
    ),
    113 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2316c9f9eb8b3e5f17af3927d50841aa',
      'native_key' => 'redactor.plugin_imageurl',
      'filename' => 'modSystemSetting/d75586ae46e5b2be4579148a5ae2766f.vehicle',
      'namespace' => 'redactor',
    ),
    114 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '315eb7cb7399a650be7ea4c89d8c53a0',
      'native_key' => 'redactor.plugin_breadcrumb',
      'filename' => 'modSystemSetting/e422bba5da0e3e678b3af7985608b055.vehicle',
      'namespace' => 'redactor',
    ),
    115 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a7a19cc5e48ecd9f9514ba75d85a10f3',
      'native_key' => 'redactor.plugin_norphan',
      'filename' => 'modSystemSetting/d19e1463d2e9c58fb4a8d7eed45acbe8.vehicle',
      'namespace' => 'redactor',
    ),
    116 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '00843ee7a7882480d066714c1770dc32',
      'native_key' => 'redactor.plugin_baseurls',
      'filename' => 'modSystemSetting/6a2e81c9fd83db25f16040296d0645b9.vehicle',
      'namespace' => 'redactor',
    ),
    117 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f6a1b1826f9a879c6634e16564ccc1f1',
      'native_key' => 'redactor.textexpander',
      'filename' => 'modSystemSetting/380353dd09834c02ef2f24dfe0c234e9.vehicle',
      'namespace' => 'redactor',
    ),
    118 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '609980b35786940b2d62f16a5e07add2',
      'native_key' => 'redactor.speechPitch',
      'filename' => 'modSystemSetting/456ae5d1984d2bdf254635798e132c8c.vehicle',
      'namespace' => 'redactor',
    ),
    119 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '255d2c4a99ab7fadb13a6f550fbee7e9',
      'native_key' => 'redactor.speechRate',
      'filename' => 'modSystemSetting/324cdec17a87f96070be1ce322bae99a.vehicle',
      'namespace' => 'redactor',
    ),
    120 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd4e823c66f8bb635c06878c1175af269',
      'native_key' => 'redactor.speechVolume',
      'filename' => 'modSystemSetting/f91830418611cc72decdc1fc337c79ab.vehicle',
      'namespace' => 'redactor',
    ),
    121 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b705fb754073dfd81e3ee0412368342b',
      'native_key' => 'redactor.speechVoice',
      'filename' => 'modSystemSetting/d785da2a54568418d4009667f963ea84.vehicle',
      'namespace' => 'redactor',
    ),
    122 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '126ba3b9d6cb0c2c4c38af93104b9164',
      'native_key' => 'redactor.counterWPM',
      'filename' => 'modSystemSetting/8090bd1e674d76049a37311f64f594fd.vehicle',
      'namespace' => 'redactor',
    ),
    123 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '563ca81b64aa48dc3f91833658129cf4',
      'native_key' => 'redactor.codemirror',
      'filename' => 'modSystemSetting/e01e7613ab9bf2d25d1453f05ea5a4c7.vehicle',
      'namespace' => 'redactor',
    ),
    124 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '630032e10626b89f6dbb51084797aff4',
      'native_key' => 'redactor.plugin_uploadcare',
      'filename' => 'modSystemSetting/cf80dd4b45f18a6c3f9eee9b55648882.vehicle',
      'namespace' => 'redactor',
    ),
    125 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a20cf6185b396ec0bc3a35f25453a8ba',
      'native_key' => 'redactor.uploadcare_pub_key',
      'filename' => 'modSystemSetting/c77043cfa879d9a457bbf00aad7ddb97.vehicle',
      'namespace' => 'redactor',
    ),
    126 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '348a117bd5d87d11039879ef4094b23d',
      'native_key' => 'redactor.uploadcare_locale',
      'filename' => 'modSystemSetting/fd50f87ee3ecaffac4bea8eabcf21f70.vehicle',
      'namespace' => 'redactor',
    ),
    127 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '941dd85ee01eea5aa8fd0633cd5338d2',
      'native_key' => 'redactor.uploadcare_crop',
      'filename' => 'modSystemSetting/5aa5ddfd25d324caa3a2fa460417829a.vehicle',
      'namespace' => 'redactor',
    ),
    128 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9ef166fb81ee28faa17e7b78be73d00c',
      'native_key' => 'redactor.uploadcare_tabs',
      'filename' => 'modSystemSetting/9c8df831cf5e152e1dffd8670db5d17f.vehicle',
      'namespace' => 'redactor',
    ),
    129 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e453417dcf35406d5b44a5d039a79d2d',
      'native_key' => 'redactor.loadIntrotext',
      'filename' => 'modSystemSetting/cc668acfbe0be81c8aa86ff789423fa1.vehicle',
      'namespace' => 'redactor',
    ),
    130 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2bf04cf8bac2f4f474859c829df11f36',
      'native_key' => 'redactor.limiter',
      'filename' => 'modSystemSetting/d2825f48421c717e9c5ed81147d2daa0.vehicle',
      'namespace' => 'redactor',
    ),
    131 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOScriptVehicle',
      'class' => 'xPDOScriptVehicle',
      'guid' => '927607a1ea7c5d7c4ab601a4b9791adf',
      'native_key' => '927607a1ea7c5d7c4ab601a4b9791adf',
      'filename' => 'xPDOScriptVehicle/a7a7a359cfdcc2907c0e59943683f789.vehicle',
      'namespace' => 'redactor',
    ),
  ),
);