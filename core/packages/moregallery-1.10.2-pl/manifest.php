<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'MoreGallery is proprietary software, developed by Mark Hamstra for modmore. By purchasing MoreGallery via https://www.modmore.com/extras/moregallery/, you have received a usage license for a single (1) MODX Revolution installation, including one year (starting on date of purchase) of email support.

While we hope MoreGallery is useful to you and we will try to help you successfully use MoreGallery, modmore is not liable for loss of revenue, damages or other financial loss resulting from the installation or use of MoreGallery.

By using and installing this package, you acknowledge that you shall only use this on a single MODX installation.

Redistribution in any shape or form is strictly prohibited. You may customize or change the provided source code to tailor MoreGallery for your own use, as long as no attempt is made to remove license protection measures. By changing source code you acknowledge you void the right to support unless coordinated with modmore support.

This software includes other libraries which have been used under open source licenses.
',
    'readme' => '--------------------------------------------
MoreGallery - Awesome Gallery for Revolution
--------------------------------------------
Author: Mark Hamstra - support@modmore.com
--------------------------------------------

MoreGallery is an awesome Gallery add-on for MODX Revolution that puts your galleries where they belong - in the Resource tree. Optimized for speed and an awesome user experience, MoreGallery takes galleries in MODX to a new level.

For more information on features and how to use them, please refer to https://www.modmore.com/extras/moregallery/

MoreGallery includes icons created by Daniel Bruce, licensed as CC BY-SA 3.0.
',
    'changelog' => 'MoreGallery 1.10.2-pl
--------------------
Released on 2020-01-30

- Fix images being broken in 1.10.1

MoreGallery 1.10.1-pl
--------------------
Released on 2020-01-30

- Prevent fatal error when listing images on a resource that\'s no longer a mgResource instance [S21943]
- Halt installation properly when server requirements aren\'t met

MoreGallery 1.10.0-pl
--------------------
Released on 2019-12-19

- Add image rotation buttons to the edit image modal
- Fix bulk image selector having higher z-index than modal mask
- Small license check fix

MoreGallery 1.9.1-pl
--------------------
Released on 2019-08-08

- Update requirements validator to require PHP 7.1 per version support policy: https://modmore.com/about/versions/
- Dependency imagine/imagine updated from v0.7.1 to 1.2.2
- Fix CSS conflict with Cliche causing cropper to look odd

MoreGallery 1.9.0-pl
--------------------
Released on 2019-08-08

- Embedding Vimeo videos will now provide the referer to the API. If your videos have domain-level privacy set, that will now allow your videos to be properly loaded. The referer can be disabled with the new moregallery.vimeo_provide_referer setting
- MoreGallery will now share technical information with modmore based on a consent level that you set. Learn more at: https://docs.modmore.com/en/MoreGallery/v1.x/Data_Sharing.html
- Prevent fatal errors in mgImage.getCrops() when images are assigned to a resource that\'s no longer a Gallery type [#218]

MoreGallery 1.8.5-pl
--------------------
Released on 2019-06-06

- Define multiple_object_delete to improve compatibility with certain cache providers [S20124]
- Make sure the totalVar is also set when retrieving information from cache [S20250]

MoreGallery 1.8.4-pl
--------------------
Released on 2019-01-23

- Fix the resource reloading when using Magic Preview
- Fix the batch editing toolbar showing up on smaller screens / non-English languages [#215, S19253]
- Update to encryptedVehicle 2.0

MoreGallery 1.8.3-pl
--------------------
Released on 2018-12-14

- Clean invalid data that\'s automatically retrieved for YouTube videos
- Fix loading width and height for images stored in a remote (e.g. S3) media source
- Fix slow processing for images stored in remote (e.g. S3) media sources, due to failing mgr_thumb check

MoreGallery 1.8.2-pl
--------------------
Released on 2018-10-19

- Add missing data controller (for viewing page info in the manager) [S17976]

MoreGallery 1.8.1-pl
--------------------
Released on 2018-07-16

- Fix ContentBlocks when the content is moved to a tab

MoreGallery 1.8.0-pl
--------------------
Released on 2018-07-12

- Adding and remove tags can now be done from the bulk toolbar on many images at once [#211]
- YouTube/Vimeo/PDFs now have a small ribbon to make its type more obvious and scannable

MoreGallery 1.7.1-pl
--------------------
Released on 2018-07-06

- Fix modal windows being pushed down out of view in MODX 3
- Fix issue with duplicated content fields (w/ ContentBlocks) when content is in tab

MoreGallery 1.7.0-pl
--------------------
Released on 2018-07-04

New features:
- Thumbnails for PDFs are now created from the first page
- New mgGetImages properties &pdfTpl and &singlePdfTpl to ease integration of PDFs
- Added extension field to images for easy access of (source) extension
- Add [[+idx1]] placeholder to mgGetImages snippet for easier mod support ([[+idx1:mod=`3`:is=`0`:then=`...]]) [#202]

MODX3 Compatibility:
- Fix installation on MODX3
- Update the MoreGallery design and positioning (with content position set to "above") to match the latest MODX 3 alpha

Improvements:
- Make sure thumbnails can be created for SVGs that lack the <?xml header
- Expand droptarget for the file tree to include the toolbar [#195]
- Make sure image sort order when uploading multiple images is preserved [#196]
- Editing a PDF image\'s metadata now shows the (png) thumbnail instead of broken image

MoreGallery 1.6.2-pl
--------------------
Released on 2017-10-06

- Add moregallery.image_id_separator system setting to control the separator used between file name and image id [S14715]
- Add some missing setting lexicons
- Prevent uncaught exceptions when creating thumbnails of PDFs, improve file writing logic [#203]

MoreGallery 1.6.1-pl
--------------------
Released on 2017-04-19

- Fix issue on PHP 5.3 with the mgMediaManagerImage object [S11648]

MoreGallery 1.6.0-pl
--------------------
Released on 2017-04-10

- Add batch show, hide and remove functionality [#14]
- Show all tags when focus lands on the tags input
- Allow import by drag/dropping from the file tree
- Add support for importing from Sterc\'s Media Manager
- Make the delete confirmation text depend on the type of image
- Allow import and videos to be added correctly when allow_url_fopen is disabled [#178]

Fixes:
- Add missing png_compression_level setting to the build
- Remove no longer used thumbnail_format setting from build [#174]
- Fix YouTube previews loading over HTTP instead of HTTPS
- Fix call to fixOrientation missing format on import
- Fix importing images from remote media sources (e.g. Amazon S3) [#184]

Design & Accessibility improvements
- Buttons now use semantic buttons instead of anchors
- Add tooltip to image actions
- Improved focus and hover styles on images in the gallery, now has a blue border instead of a transparent mask
- Image actions are now shown in a small image toolbar instead of the name/filename when hovering/focusing on the image
- Use left and right keys (or tab) to navigate through images with the keyboard
- Use space to select an image for the batch actions
- Use down key when focused on an image to get to the image actions, use left and right keys to navigate actions, use up key to put focus back on image
- Styles and icons specific to MODX < 2.3 have been removed
- First input/button/link in modal is auto focused on open
- When closing a modal the keyboard focus is restored to where it was before
- Close/save buttons in modals are now semantic buttons so can be triggered with space

MoreGallery 1.5.9-pl
--------------------
Released on 2017-03-29

- No longer removes images when sort fails (for example because of permissions or a db error) [S11532]
- Disable sort if the user does not have image_edit permission

MoreGallery 1.5.8-pl
--------------------
Released on 2017-01-18

- Prevent potential mod_security related issue caused by video metadata
- Don\'t allow empty tags to be created, and make sure errors are shown to the user
- Automatically remove empty tags that already exist in the database
- Fix bug where a gallery might get filtered by empty tag when not specified [S11105]
- Add ability to prefer GD over Imagick with `moregallery.imagine_prefer_gd` for cases where Imagick is broken [S11109]
- Add cache busting to 2 files that weren\'t cachebusted yet [S11093]

MoreGallery 1.5.7-pl
--------------------
Released on 2017-01-18

- Prevent E_FATAL error breaking the manager if alpacka is missing [S10730]
- Silence E_WARNING for exif data in certain environments
- Fix usage of global jQuery instead of scoped version [S10945]

MoreGallery 1.5.6-pl
--------------------
Released on 2016-11-24

- Clean invalid characters out of IPTC data

MoreGallery 1.5.5-pl
--------------------
Released on 2016-10-12

- Prevent error when using Gitify or Teleport (Cloud Snapshots) to extract MoreGallery resources
- Fix mgGetTags snippet to show all tags with &resource=0, and current if &resource is empty (default) [#176]

MoreGallery 1.5.4-pl
--------------------
Released on 2016-09-30

- Ensure EXIF and IPTC data get cleaned up properly, even if uploaded prior to 1.4.2 [S10021]
- Fix back-end not showing images if an image is missing a file value [S10015]

MoreGallery 1.5.3-pl
--------------------
Released on 2016-09-12

- Fix clearing of image caches when adding/removing tags
- Fix [[+tags]] placeholder not being available in image lists [S9948]

MoreGallery 1.5.2-pl
--------------------
Released on 2016-09-07

- Fix clearing of image caches when an image was sorted/edited [S9924]

MoreGallery 1.5.1-pl
--------------------
Released on 2016-09-01

- Make the add video modal use lexicons
- Fix the media browser not opening when clicking Import [S9857]
- Fix issue creating crops when only the width OR height is specified [#175]
- Prevent E_WARN for loading exif data from non-supported file type

MoreGallery 1.5.0-pl
--------------------
Released on 2016-08-24

- Make sure previous and next urls for mgGetImages single image view respects &singleImageResource
- Fix &singleImageParam not defaulting to the setting if not set on snippet call

MoreGallery 1.5.0-rc2
---------------------
Released on 2016-08-05

- Fix BC break in 1.5.0-rc1: [[+idx]] now starts at 0 again instead of 1
- Make sure exceptions are caught properly when generating a thumbnail fails
- Make sure trying to add a private/non-existent video doesn\'t crash the gallery [#173]

MoreGallery 1.5.0-rc1
---------------------
Released on 2016-08-03

New features:
- Automatically duplicate images (and related data, like tags and crops) when duplicating a gallery resource [#94]
- Add embedding of videos from YouTube and Vimeo, with different chunks per type [#152]
- Add &singleImageResource property to mgGetImages which allows you to link detail pages to a specific resource [#162]
- mgGetImages now accepts multiple comma-separated resources in &resource [#26]
- Ability to limit available features on Galleries through permissions (ACLS) [#125]

Improvements:
- Refactored mgGetImages snippet to be more easily maintained and extended
- Replaced internal phpthumb with Imagine library which can use imagick and offers more features for the future
- SVG uploads will now get PNG thumbnails/crops rather than broken images [#131]
- Default mgImage chunk now wraps items in a li to accommodate for video embeds

Fixes:
- Fix rounding issue in certain crops [#111]
- Prevent double thumbnail generation on upload [#155]

MoreGallery 1.4.2-pl
--------------------
Released on 2016-06-23

- Fix issue showing images when &sortBy is random and &wrapperTpl is set [#167]
- Fix invalid shutdown callback warning when importing files [#169]
- Fix opening the media browser a second time, or after opening the browser in TVs [#164]
- Prevent invalid EXIF or IPTC data from breaking uploads or listing images [S9225]

MoreGallery 1.4.1-pl
--------------------
Released on 2016-05-04

- Properly filter out EXIF and IPTC data from AJAX requests to prevent tripping over mod_security rules [#149]
- Allow changing the number of thumbnails that are prefetched as base64 in the manager (useful on slow disks) [#148]
- Add missing allowed_extensions_per_source setting to build
- Make sure media source specific extensions are checked case insensitively
- Add DISTINCT to the image query to prevent duplicate results when filtering on tags (Thanks Adam!) [#140]
- Prevent pretty noisy "[[+resource.id]] is not a valid integer" error [S8750]

MoreGallery 1.4.0-pl
--------------------
Released on 2016-04-06

- Fix logic issue in fetching tags, causing errors to appear in the log when using tags. [S8392]

MoreGallery 1.4.0-rc2
---------------------
Released on 2016-03-29

- Fix critical issue when calling mgGetImages with different resource values (Alpacka v0.2.3) [S8392]

MoreGallery 1.4.0-rc1
---------------------
Released on 2016-03-23

New Features:
- Custom fields! Add text fields, text areas, rich text or select fields to the image edit modal [#74]
- Automatically regenerate the mgr_thumb if it no longer exists or the mgr_thumb column is empty [#138]
- Add crop_jpeg_quality setting to control the quality of thumbnails that are generated as jpegs [#137]
- Add thumbnail_format setting to control the format of the mgr_thumb file [#120]
- Add allowed_extensions_per_source setting to limit uploads to media-source specific allowed imageExtensions [#132]
- Add &includeCount property to mgGetTags to get the number of images using a specific tag [#135]
- Allow excluding images by tag with mgGetImages with "-tag" [#136 - thanks Thomas!]
- Add &wrapperIfEmpty property to mgGetTags and mgGetImages that allows disabling the wrapperTpl if there are no results [#118]
- Add &singleImageParam property to mgGetImages to allow changing the parameter per snippet call
- Add &singleImageEnabled property to mgGetImages to disable the single image view completely
- Automatically create tags when keywords are found in the image IPTC data [#112]
- Make IPTC data available via a new iptc image field
- Add support for path placeholders in the gallery path, including dates, a selection of settings and all resource fields and TVs
- Provide support for extras like FileSluggy that sanitise file names on upload [#142]

Improvements:
- Prevent potential fatal error in mgGetImages/mgGetTags if $modx->resource isn\'t set [#119]
- Make sure mgGetImages/mgGetTags set the working context
- Remove hardcoded tooltip on the resource toolbar icon [#117]
- Make sure mgGetTags with a resource filter also checks if images are hidden
- Make visual difference between active and inactive images bigger [#116]
- Implement modmore/Alpacka for shared utilities [#141]
- Add support for transliteration for filename sanitization [#121]
- Improve styling of the Gallery header in MODX 2.4
- Automatically refresh the resource update page if the content position or crops are changed
- Add prefill_from_iptc setting to allow disabling the automatic name/tag prefilling [#144]
- Add resource data to the wrapperTpl [#145]
- Allow deleting images when the confirm dialogs are dismissed [#143]
- IPTC and EXIF data can be inspected with iptc_dump, iptc_json, exif_dump and exif_json placeholders

Fixes:
- Fix loading the lexicon for the Content > New Gallery menu item [#87]
- Fix toolbar icon position being out of order
- Fix image URL generation on Windows [S7588]
- Synchronise processing with importing with the upload processing
- Ensure mgImage->toArray respects the $keyPrefix value


MoreGallery 1.3.7-pl
--------------------
Released on 2015-10-08

- Fix loading crop information from resource settings, was causing images to not get cropped properly automatically
- Improve how the manager thumbs are created to ensure crisp images, even for very tall/wide images
- Strip out invalid control/hidden characters from EXIF data on upload to prevent errors

MoreGallery 1.3.6-pl
--------------------
Released on 2015-09-28

- Make sure the memory limit is consistently increased when generating crops [S6583]
- Fix case sensitive extension check to be case insensitive [#134]
- Fix undefined variable error and broken image_count wrapper placeholder in mgGetImages
- Make sure description field is big enough when rich text is disabled [#128]
- Fix background of crops preview with transparent images
- Fix unnecessary hardcoded PNG format for crops, now only used when source image is png as well

MoreGallery 1.3.5-pl
--------------------
Released on 2015-09-02

- Make sure only valid image extensions are allowed to be uploaded [S6405]
- Catch failed uploads when server limits caused the error rather than MODX [#122]

MoreGallery 1.3.4-pl
--------------------
Released on 2015-07-13

- Updated translations, contributions are welcome via https://crowdin.com/project/modmore-moregallery
- Hardened XHR security to prevent leaking session IDs cross-domain (#114)
- Fix issue with double quotes in image fields not working as expected (potential self-XSS)

MoreGallery 1.3.3-pl
--------------------
Released on 2015-05-16

- Fix uploads - sorry about that!

MoreGallery 1.3.2-pl
--------------------
Released on 2015-05-16

- Fix bug that could cause the inability to save a resource when using unicode characters in moregallery (#113)
- Fix potential issues with MySQL strict mode
- Change how editedon/by details are updated to prevent constant changes with Gitify

MoreGallery 1.3.1-pl
--------------------
Released on 2015-03-27

- Prevent paste from being intercepted by moregallery, resulting in errors (#41)
- Fix issue when using Gitify where the mgImage representation has duplicated mgr_thumb paths

MoreGallery 1.3.0-pl
--------------------
Released on 2015-02-20

- Please see the 1.3.0-rc1 changelog below for what\'s new in 1.3.x
- Ensure the moregallery service is loaded before accessing it in mgImage

MoreGallery 1.3.0-rc2
---------------------
Released on 2015-02-10

- Fix issue requiring &resource to be specified on mgGetImages calls
- Fix positioning issues on URL label text and wide crop previews (#108, 109)
- Make sure removing an image also removes the crop thumbnails (#107)

MoreGallery 1.3.0-rc1
---------------------
Released on 2015-02-04

New Features:
- Add region of interest cropping for responsive images or better art direction (#5)
- Add new visible/hidden state to images so you can hide an image from the front-end without removing it (#85)
- Add typeahead to tags for much easier tag selection (#84)
- On image upload, automatically extract image name from IPTC data if available (#91)
- Add 5 plugin events to hook into various parts of the gallery interaction (#62)
- Automatically rotate images to the right orientation on upload
- Now context-aware, so all settings can be overridden on context level as well

Improvements:
- Add snippet properties to build (#72, #95)
- Ensure transparent backgrounds remain transparent (instead of black) for thumbnails (#51)
- Add &where property to mgGetImages and mgGetTags for generic filtering, accepts JSON formatted queries. (#83)
- Add loading indicator for image tags (#57)
- New [[+width]] and [[+height]] placeholders for images
- Make sure settings have a lexicon and description (#96)
- Improve image centering/cropping in back-end to be always centered and filling the area
- Prevent conflicts with other phpthumb libraries that may be loaded (#73)
- Change how EXIF data is loaded to make it easier to work with (no thumbnail, flat structure)
- Attempt to increase the available memory on upload to make sure the extra processing is possible even with larger images

Bugfixes:
- Fix issue where editing image information causes data multiplication in the js (#97)

MoreGallery 1.2.3-pl
--------------------
Released on 2015-01-29

- Fix upload issue when image contained invalid EXIF data

MoreGallery 1.2.2-pl
--------------------
Released on 2015-01-19

- Fix image alignment issues with screens of exactly 1600px wide
- Updated translations (see https://crowdin.com/project/modmore-moregallery)

MoreGallery 1.2.1-pl
--------------------
Released on 2014-10-28

- Fix potential issue on PHP 5.5/6 related to exif data
- Change how the "Add Gallery" button in the toolbar is loaded so it also loads on components (thanks Wieger Sloot!)
- Change "Add Gallery" button to use Font Awesome in 2.3.
- Small speed optimization for large galleries (thanks Rico!)

MoreGallery 1.2.0-pl
--------------------
Released on 2014-08-04

- Fix issue filtering on non-existent tags
- Fix icon in the resource tree in 2.3.? (depends on modxcms/revolution#11736)

MoreGallery 1.2.0-rc1
---------------------
Released on 2014-07-18

New Features:
- By default set source, relative url and content position to "inherit" so they continue to inherit system defaults after save.
- Allow dragging resources into the image URL field for quick insertion
- Add ability to control placement of image IDs into image file name
- Add ability to prevent the gallery ID from getting added to the file path
- Add ability to use sortBy=`random` with mgGetImages to get random images from cached data

Improvements:
- Improve ContentBlocks compatibility with some styling tweaks and support for content-in-tab
- Improve compatibility with Tagger (Thanks TheBoxer!)
- Make sure TinyMCE is initialised when editing images
- #65 Strip out unnecessary data from AJAX requests that could trigger mod_security errors
- Adjust resource validation to allow for derivatives
- Add [[+idx]] to the tpl in the mgGetTags snippet.
- Added Swedish translation
- Improve UX on adding tags to images by indicating you need to add it with a button or enter
- Update styling to match Revolution 2.3

Bugfixes
- Fix z-index issue with fixed toolbar
- Fix issue loading wrong media source when using import from file feature
- Prevent "`[[+resource.id]]` is not a valid integer and may not be passed to makeUrl()" errors
- Fix javascript issue causing gallery initialisation to fail when the resource tree is not available.
- Make sure the total results is set when data is retrieved from cache
- Fix TinyMCE rendering in image description

MoreGallery 1.1.0-pl
--------------------
Released on 2014-01-25

New Features:
- Add Tagging functionality: back-end adding of tags, mgGetTags snippet to list tags and updates to mgGetImages to filter on tags and added [[+tags]] placeholder
- Import file into the Gallery by selecting it using the MODX Browser
- #55 Sanitise file names on upload

Fixes:
- Fix toolbar to top of the manager when it goes out of view due to scrolling
- Fix broken images in back-end when using remote media sources (like S3)
- #54 Make sure the container is resized upon opening a full image view modal
- #56 Fix errors being logged due to caching check

Improvements:
- Gallery Toolbar now stays in view when scrolling past it
- Change icon set to sprite-based icon set
- Updated Danish translation.

MoreGallery 1.0.2-pl
--------------------
Released on 2013-11-06

- Add Danish translation

MoreGallery 1.0.1-pl
--------------------
Released on 2013-11-06

- Add getResourceFields and getResourceTVs properties to mgGetImages to include fields or TVs placeholders.
- Only use the FileReader (for image previews during upload) when it is supported.
- Fix small content field if there\'s no RTE in use.
- Add French translation.

MoreGallery 1.0.0-pl
--------------------
Released on 2013-10-30

- Prevent toolbar icon from being duplicated after saving a resource.
- Tiny fix to the CSS to prevent left box shadows from disappearing from the first image in each row.
- Prevent annoying jump in image previews when the image completed upload.
- Added Dutch, Czech, Russian and German translations.
- Extract text into a lexicon file for translation.
- Clear the MoreGallery cache when using the Site > Clear Cache menu option.

MoreGallery 0.9.16-pl
---------------------
Released on 2013-10-15

- Fix fatal error in snippet.
- Fix issue with content location setting.

MoreGallery 0.9.15-pl
---------------------
Released on 2013-10-12

- Handle exotic image type errors without triggering E_* errors.
- #25 Open full image in a modal instead of new tab
- #23 Change mgResource\'s to modDocument\'s during uninstall
- Add icon to create new gallery to the resource toolbar (can be disabled with add_icon_to_toolbar setting)
- Add single_image_url_param setting to change the "iid" url param to something different.
- Set the top position of the modal so it\'s within view.
- Fix loading of relative_url setting on resource panel (introduced in 0.9.13)

MoreGallery 0.9.14-pl
---------------------
Released on 2013-10-08

- Implement better UI through usage of modal window for editing instead of weird sliding panel.
- Refactored to use jQuery UI\'s sortable plugin, while bigger it provides a better drag experience.
- #36 Check memory_limit on server and alert if file is probably to large to resize once uploaded.
- Fix issue creating images with MySQL 5.6 (columns always need a value, default or accept null.)
- Add feature to load RTEs into the edit panel (enabled by default, setting moregallery.use_rte_for_images)

MoreGallery 0.9.13-pl
---------------------
Released on 2013-09-27

- #38 Hide content field or move it below images or into a new tab
- Add [[+image_count]] placeholder to wrapper tpl.
- #40 Properly load default options (source, url) from system settings on creating a new gallery.
- Fix weird issue with specific environments

MoreGallery 0.9.12-pl
---------------------
Released on 2013-09-02

- Add some indices for additional (uncached) performance.
- Add "Resource" relation from mgImage to mgResource.
- Fix mgResource>mgImage relation from one to many
- Fix improper class_key setting.

MoreGallery 0.9.11-pl
---------------------
Released on 2013-07-29

- Add relative_url and source settings to Resource > Settings tab to manage properties.
- Improve focus handling with auto save.
- Set "name" field of the image to the filename without extension by default.
- Improve error messages when upload fails.
- Accept empty value for moregallery.source_relative_url setting (ie, root of media source)

MoreGallery 0.9.10-pl
---------------------
Released on 2013-07-23

- Add moregallery.source_relative_url and moregallery.source setting.
- Add error (and remove uploading image) if upload failed.

MoreGallery 0.9.9-pl
--------------------
Released on 2013-07-21

- Fix annoying and broken reload when saving the resource

MoreGallery 0.9.8-pl
--------------------
Released on 2013-07-19

- Lots of CSS tweaks to make it integrate better with latest 2.2/2.3 design.
- Add ability to link to resources by entering the resource ID.
- Add proper uploading image for images > 700kb.
- Fix loading RTEs.

MoreGallery 0.9.7-pl
--------------------
Released on 2013-07-16

- Fix E_WARN error on certain environments.

MoreGallery 0.9.6-pl
--------------------
Released on 2013-07-16

- Fix z-index conflicts with #modAB when editing images.
- Auto focus on name field when opening edit panel.
- Further improvements to performance of the manager, especially when uploading large images:
- - Minimize re-renders of backbone templates
- - Only show image previews for images that are smaller than 700kb to preserve the browser
- - Use data URIs to prevent additional requests for first 20 images in list, and freshly uploaded images.
- - Delay upload by 1s to let the browser do one thing at a time.
- - Only load full size images when opening the edit pane

MoreGallery 0.9.5-pl
--------------------
Released on 2013-07-15

- Improve browser performance during upload.

MoreGallery 0.9.4-pl
--------------------
Released on 2013-07-15

- Fix LOG_LEVEL_WARN error "Could not load package metadata"
- Fix prev/next when sortBy is not sortorder or with a descending sortDir
- Add resolver to increase upload_maxsize from 1MB to 10MB on install.
- More sensible (pretty) default chunks.
- Add uploadedon, uploadedby, editedon and editedby fields to images.
- Add ability to paginate through images with getPage
- Add check to make sure chunks referenced are still the same. Removes need to disable &cache.
- Remove dependency on phpthumbof for default chunks.

MoreGallery 0.9.3-pl
--------------------
Released on 2013-07-14

- Add helpful note to indicate you can drop images into the gallery.
- Improve drag/dropping behavior between sorting and upload.
- Fix issue with uploading images when exif_read_data is not available.
- Make sure link_tag_scheme is used for generating of view_url.

MoreGallery 0.9.2-pl
--------------------
Released on 2013-07-13

- Fix issue with gallery not properly refreshing when saving a resource.

MoreGallery 0.9.1-pl
--------------------
Released on 2013-07-10

- Styling improvements.

MoreGallery 0.9.0-pl
--------------------
Released on 2013-07-10

- Initial beta release.
',
    'setup-options' => 'moregallery-1.10.2-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '406627aa80084665317dda8e561eb2b8',
      'native_key' => 'moregallery',
      'filename' => 'modNamespace/5ac36c439ab05169dcb8d545247f1c44.vehicle',
      'namespace' => 'moregallery',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => 'ffb89685e118dd3c817ed6bb69876c6a',
      'native_key' => 'ffb89685e118dd3c817ed6bb69876c6a',
      'filename' => 'xPDOFileVehicle/376a079f22828f168c147a793c74ae58.vehicle',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => 'b13f238da5f1cce0af0c0d5368ba7e9a',
      'native_key' => 'b13f238da5f1cce0af0c0d5368ba7e9a',
      'filename' => 'xPDOFileVehicle/d23788b617de5a4a44c148760d7faeac.vehicle',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicyTemplate',
      'guid' => '08d157ff80fee513c9d6d9859fe1626f',
      'native_key' => NULL,
      'filename' => 'modAccessPolicyTemplate/9d031b7bd07932363b22d4d0b1c2b97e.vehicle',
      'namespace' => 'moregallery',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '937065ea6fb6987577a3360846f4a764',
      'native_key' => 'moregallery.source_relative_url',
      'filename' => 'modSystemSetting/9065a59141439e4ae2dbf0413663f076.vehicle',
      'namespace' => 'moregallery',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a0e7a56f6bcfcda990d759de33d93ebb',
      'native_key' => 'moregallery.source',
      'filename' => 'modSystemSetting/23b0bf21ed5233563d160af88c104d4a.vehicle',
      'namespace' => 'moregallery',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a3e155379256608d65794bccc45da378',
      'native_key' => 'moregallery.image_id_in_name',
      'filename' => 'modSystemSetting/63307f851e91346c195cf6ca51a58db6.vehicle',
      'namespace' => 'moregallery',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '76a0a181be47141b4749a1c111cd98bc',
      'native_key' => 'moregallery.image_id_separator',
      'filename' => 'modSystemSetting/01c588c4bb451485702505849bede1a2.vehicle',
      'namespace' => 'moregallery',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '88c0e8a455962588aaf68e9139c8d3a0',
      'native_key' => 'moregallery.resource_id_in_path',
      'filename' => 'modSystemSetting/d8d984e321c3deb1588de90a48dfa9a6.vehicle',
      'namespace' => 'moregallery',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e750a6974214d607b10f9d36b970db1a',
      'native_key' => 'moregallery.content_position',
      'filename' => 'modSystemSetting/50615959e0ffce9ae117405e310bf5cc.vehicle',
      'namespace' => 'moregallery',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3261ca364eb47fac042ee2a24879d82d',
      'native_key' => 'moregallery.custom_fields',
      'filename' => 'modSystemSetting/41e0934e0a1bc8a391ee118f8c3ed4c8.vehicle',
      'namespace' => 'moregallery',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fe03cdd0e372528d8be92a635a59e4dd',
      'native_key' => 'moregallery.use_rte_for_images',
      'filename' => 'modSystemSetting/82cf43fc62b514f2433d5f4394f89149.vehicle',
      'namespace' => 'moregallery',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c0e9cf6ac0fe38eefc6ec66f15d5b156',
      'native_key' => 'moregallery.prefill_from_iptc',
      'filename' => 'modSystemSetting/d96a61755651d1920d3f4d90b70badc5.vehicle',
      'namespace' => 'moregallery',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b03df102f7b6ce793f81193fe1cc5324',
      'native_key' => 'moregallery.vimeo_prefill_description',
      'filename' => 'modSystemSetting/f029063b1273a2b10190288a7ffa129d.vehicle',
      'namespace' => 'moregallery',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1dae2abb0c5eb806f8a2d48aacd0d755',
      'native_key' => 'moregallery.vimeo_provide_referer',
      'filename' => 'modSystemSetting/f4e20bee13c75487443728e0e79c7422.vehicle',
      'namespace' => 'moregallery',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'efc5a3adf8e06955d14bec876a5da9cd',
      'native_key' => 'moregallery.youtube_prefill_description',
      'filename' => 'modSystemSetting/fde9a81e1f76038cc3bb617bd8419395.vehicle',
      'namespace' => 'moregallery',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b17ea3e9e2f41f07eb90fe51fc62b5ba',
      'native_key' => 'moregallery.prefetch_image_as_base64',
      'filename' => 'modSystemSetting/d3312594a1cebe89d75432673c897458.vehicle',
      'namespace' => 'moregallery',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd6fec41e80d07f21b86ea0f94161935f',
      'native_key' => 'moregallery.crops',
      'filename' => 'modSystemSetting/14638c0affa43f58c6f42b199d57d05c.vehicle',
      'namespace' => 'moregallery',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b8fc1133e2f166f374a7d7aacb50743e',
      'native_key' => 'moregallery.crop_jpeg_quality',
      'filename' => 'modSystemSetting/ee90b1e35b86434c9fabd0df638dded3.vehicle',
      'namespace' => 'moregallery',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd7766fe5ff87154710c390a513a95375',
      'native_key' => 'moregallery.png_compression_level',
      'filename' => 'modSystemSetting/64e8596ed28d51dea905618eed4518d1.vehicle',
      'namespace' => 'moregallery',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '12aa351bb042ff7535f10e078875cbdb',
      'native_key' => 'moregallery.single_image_url_param',
      'filename' => 'modSystemSetting/585b9e9c60aeb37b55bfebb02df6cb44.vehicle',
      'namespace' => 'moregallery',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5725ba271a7219fa5eca1bb16352c656',
      'native_key' => 'moregallery.allowed_extensions_per_source',
      'filename' => 'modSystemSetting/a886c1882cc45655f5002f16a08c3bd4.vehicle',
      'namespace' => 'moregallery',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '62487369d64d4a56a74d83eaf2131835',
      'native_key' => 'moregallery.add_icon_to_toolbar',
      'filename' => 'modSystemSetting/198ce1e3282d251fa30097391fc13ea5.vehicle',
      'namespace' => 'moregallery',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2a7674779d926331c31a807766e41eca',
      'native_key' => 'moregallery.data_consent',
      'filename' => 'modSystemSetting/1432cde27ba061cfa13d722949f716ff.vehicle',
      'namespace' => 'moregallery',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a9af227bb230dea876cc62e228cddb13',
      'native_key' => 'moregallery.sanitize_replace',
      'filename' => 'modSystemSetting/a23f7eb430a011c6f9e07d7a47722ab8.vehicle',
      'namespace' => 'moregallery',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f7f0586053b4422e5cace0cda06d6bd0',
      'native_key' => 'moregallery.sanitize_pattern',
      'filename' => 'modSystemSetting/115261ca703adb5199878888c2965f7d.vehicle',
      'namespace' => 'moregallery',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7e79c023b6c0006d34d36d5864b24206',
      'native_key' => 'moregallery.translit',
      'filename' => 'modSystemSetting/0b307bbdd52113d3ca41d6d7b1daaaa6.vehicle',
      'namespace' => 'moregallery',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f7ca8920d3645a21caf9c0bbac330e26',
      'native_key' => 'moregallery.translit_class',
      'filename' => 'modSystemSetting/fc6c7b0da169cb29f61fe464930805ab.vehicle',
      'namespace' => 'moregallery',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'eb1a499835f4e5b293b773e7a61eb20e',
      'native_key' => 'moregallery.translit_class_path',
      'filename' => 'modSystemSetting/574fd1f753b2565205744646d3decfd5.vehicle',
      'namespace' => 'moregallery',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f96214e119eaccd16dde7e2a90c96e1b',
      'native_key' => 'mgr_tree_icon_mgresource',
      'filename' => 'modSystemSetting/8bc1203be6cd4112797b4f3b81283887.vehicle',
      'namespace' => 'moregallery',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '90d93962ef3e98d6cc1b695d590930d3',
      'native_key' => 'MoreGallery_OnImageCreate',
      'filename' => 'modEvent/1c6cfc1f31a95a72780766bdaee8901c.vehicle',
      'namespace' => 'moregallery',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '4c0d795fc00d011d1f0f32022cef95b2',
      'native_key' => 'MoreGallery_OnImageRemove',
      'filename' => 'modEvent/dfc4f6f97210abd91a1cfb19e02c3bb6.vehicle',
      'namespace' => 'moregallery',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '771af416d57e241eb389a4ba98734290',
      'native_key' => 'MoreGallery_OnTagCreate',
      'filename' => 'modEvent/10e105a187bb1abe81792f0ce3c61922.vehicle',
      'namespace' => 'moregallery',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '5723724d0249fb2c6c714ac9096ea456',
      'native_key' => 'MoreGallery_OnImageTagCreate',
      'filename' => 'modEvent/ef4c74a4ca6ec56f01e531e0dcc4fb85.vehicle',
      'namespace' => 'moregallery',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'acf70fdbb3372cdd5ee710fa7aad1019',
      'native_key' => 'MoreGallery_OnImageTagRemove',
      'filename' => 'modEvent/94f260b5c51500d62118aeaf19e4b259.vehicle',
      'namespace' => 'moregallery',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'encryptedVehicle',
      'class' => 'modCategory',
      'guid' => '30d7c9aa4ea225cb74393d695f473bc5',
      'native_key' => 1,
      'filename' => 'modCategory/0a50f47237dad7a0d30eb799b2aa156b.vehicle',
      'namespace' => 'moregallery',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOScriptVehicle',
      'class' => 'xPDOScriptVehicle',
      'guid' => '16fdf333366397c19169e11617acdb4a',
      'native_key' => '16fdf333366397c19169e11617acdb4a',
      'filename' => 'xPDOScriptVehicle/7d60c18682c0a439d894eef2613c36ee.vehicle',
      'namespace' => 'moregallery',
    ),
  ),
);