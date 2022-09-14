<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'MoreGallery';
$_lang['moregallery.new'] = 'Nová galerie';
$_lang['moregallery.new_description'] = 'Vytvoření nové galerie, do které budete moci nahrát obrázky.';
$_lang['moregallery.name'] = 'Galerie';
$_lang['moregallery.name_here'] = 'Galerii';
$_lang['moregallery.permission_denied'] = 'Sorry, you do not have the necessary permission to manage this gallery.';
$_lang['moregallery.new_tags_not_allowed'] = 'Sorry, you do not have the necessary permission to add new tags. Please select an existing tag from the typeahead search.';
$_lang['moregallery.please_save_first'] = 'Pro přidání obrázků nejprve prosím uložte galerii. Po prvním uložení galerie, zde bude možné nahrávat obrázky.';



$_lang['moregallery.inherit'] = 'Výchozí';
$_lang['moregallery.inherit.desc'] = 'Použít výchozí nastavení systému.';
$_lang['moregallery.source'] = 'Zdroje médií';
$_lang['moregallery.source.desc'] = 'Zdroj médií, který bude použit pro ukládání obrázků. <b>Poznámka:</b> Pokud změníte zdroj médií po nahrání obrázků, nahrané obrázky NEBUDOU automaticky přesunuty do nového zdroje.';
$_lang['moregallery.relative_url'] = 'Relativní URL';
$_lang['moregallery.relative_url.desc'] = 'Relativní URL pro ukládání obrázků ve zdroji médií. Nezačínejte lomítkem. <b>Poznámka:</b> Pokud změníte zdroj médií po nahrání obrázků, nahrané obrázky NEBUDOU automaticky přesunuty do nového zdroje.';
$_lang['moregallery.content_position'] = 'Pozice obsahu';
$_lang['moregallery.content_position.desc'] = 'Přesune pole pro obsah dokumentu na jinou, více vhodnou pozici.';

$_lang['moregallery.content_position.above'] = 'Nad galerií';
$_lang['moregallery.content_position.below'] = 'Pod galerií';
$_lang['moregallery.content_position.tab'] = 'V samostatné záložce "Obsah dokumentu"';
$_lang['moregallery.content_position.hide'] = 'Skrýt';

$_lang['moregallery.view_full_size_image'] = 'Zabrazit obrázek v plné velikosti';
$_lang['moregallery.delete'] = 'Delete';
$_lang['moregallery.delete_image'] = 'Odstranit obrázek';
$_lang['moregallery.deactivate_image'] = 'Skrýt obrázek z galerie';
$_lang['moregallery.activate_image'] = 'Obrázek označit jako viditelný';
$_lang['moregallery.upload_image'] = 'Nahrát obrázky do galerie';
$_lang['moregallery.upload'] = 'Nahrát';
$_lang['moregallery.import_image'] = 'Importovat obrázky z jiných zdrojů';
$_lang['moregallery.import'] = 'Importovat';
$_lang['moregallery.import_media'] = 'Import from Media';
$_lang['moregallery.images_selected'] = 'images selected'; // is prefixed with a number for the bulk feature, e.g. "5 images selected"
$_lang['moregallery.mediamanager_not_loaded'] = 'The Media Manager is not currently available.';
$_lang['moregallery.add_video'] = 'Add Video';
$_lang['moregallery.add_video_instructions'] = 'Enter the video url below to import it to the gallery.';
$_lang['moregallery.refresh'] = 'Obnovit';
$_lang['moregallery.drop_to_upload'] = 'Přetáhněte sem obrázky pro jejich nahrádní do galerie';
$_lang['moregallery.images_count'] = 'obrázků';
$_lang['moregallery.edit_image_header'] = 'Upravit obrázek';
$_lang['moregallery.name_field'] = 'Název';
$_lang['moregallery.description'] = 'Popis';
$_lang['moregallery.url'] = 'Odkaz nebo ID dokumentu';
$_lang['moregallery.save'] = 'Uložit';
$_lang['moregallery.saving'] = 'Ukládám...';
$_lang['moregallery.saved_at'] = 'Uloženo v [[+time]]';
$_lang['moregallery.confirm_remove'] = 'Opravdu chcete odstranit obrázek "[[+name]]"? Obrázek bude odstraněn ze serveru.';
$_lang['moregallery.confirm_media_remove'] = 'Are you sure you want to remove "[[+name]]" from the gallery? The image will remain available in the Media Manager.';
$_lang['moregallery.confirm_video_remove'] = 'Are you sure you want to remove "[[+name]]"? The thumbnail image will be removed from the server.';
$_lang['moregallery.confirm_bulk_remove'] = 'Are you sure you want to remove [[+amount]] images? Related image files will be removed from the server.';
$_lang['moregallery.preupload_very_big'] = 'Soubor "[[+file]]" je velmi velký. Nahrávání může trvat dlouho a server nemusí mít dostatek paměti ke zpracování obrázku po jeho nahrání. Opravdu chcete pokračovat?';
$_lang['moregallery.upload_error'] = 'Jejda, při nahrávání souboru "[[+file]]" nastal problém: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Nahraný soubor byl větší než [[+size]] MB, což mohlo být více, než server zvládne nahrát a zpracovat. Zkuste před nahráváním obrázek zmenšit.';
$_lang['moregallery.model_error'] = 'Vyskytla se neočekávaná chyba, obrázek nebyl nalezen. Zkuste obnovit stránku.';
$_lang['moregallery.video_load_error'] = 'The video information could not be loaded. This is most likely because the video does not exist, or that it is marked as private.';

$_lang['moregallery.error_invalid_resource'] = 'Vyskytla se neočekávaná chyba, dokument "[[+resource]]" není platná galerie.';
$_lang['moregallery.error_loading_source'] = 'Vyskytl se chyba při načítání obrázků ze zdroje médií pro tuto galerii.';
$_lang['moregallery.error_invalid_filetype'] = 'Sorry, .[[+extension]] files are not allowed.';
$_lang['moregallery.error_upload_failed'] = 'the file could not be uploaded (Error [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tagy';
$_lang['moregallery.tags.add'] = 'Přidat';
$_lang['moregallery.tags.remove'] = 'Remove';
$_lang['moregallery.tags.cant_be_empty'] = 'The tag can\'t be empty.';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Soubor, který chcete importovat, zřejmě neexistuje nebo není čitelný: [[+ file]]';
$_lang['moregallery.edit_crop'] = 'Upravit oříznutí';
$_lang['moregallery.save_crop'] = 'Uložit oříznutí';
$_lang['moregallery.preview_crop'] = 'Náhled oříznutí';
$_lang['moregallery.processing_crop'] = 'Zpracovávám...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'Zdroj relativní URL';
$_lang['setting_moregallery.source_relative_url_desc'] = 'The URL relative to the root of the selected media source to upload images to. Can be overridden per Gallery resource on its Settings tab.';

$_lang['setting_moregallery.source'] = 'Zdroj médií';
$_lang['setting_moregallery.source_desc'] = 'Zvolte zdroj média pro ukládání obrázků. Toto může být přepsáno v tabu nastavení u každé galerie.';

$_lang['setting_moregallery.image_id_in_name'] = 'Obrázek ID v názvu souboru';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Set to either "prefix" or "suffix" to add the image ID to the file name on upload. This ensures the filename is unique.';
$_lang['setting_moregallery.image_id_separator'] = 'Image ID Separator';
$_lang['setting_moregallery.image_id_separator_desc'] = 'The separator to use between the file name and the image ID on newly uploaded or imported images.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Dokument ID v cestě';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'When enabled, the Gallery Resource ID will be suffixed to the Source Relative URL so each gallery has its own directory.';
$_lang['setting_moregallery.content_position'] = 'Pozice obsahu';
$_lang['setting_moregallery.content_position_desc'] = 'Set to "above", "below", "tab" or "hide" to determine how the Content field will be displayed, if at all.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Použít WYSIWYG editor';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'When enabled, the currently active rich text editor will be loaded into the Image Description field. We recommend using Redactor, but other editors are also supported.';
$_lang['setting_moregallery.crops'] = 'Crops';
$_lang['setting_moregallery.crops_desc'] = 'Insert your Crops configuration here to enable region of interest cropping on images. An example could be <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. As this is an advanced feature, please refer to the <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">full Crops documentation</a> for more information about syntax and functionality.';
$_lang['setting_moregallery.single_image_url_param'] = 'Single Image URL Parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Used with the mgGetImages snippet, the single image url parameter determines whether a listing or single image is displayed. This URL parameter will contain the image ID and, if not found, it will send the user to the configured 404 page. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Přidat ikonu do panelu nástrojů';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'When enabled, a "New Gallery" icon will be added to resource toolbar providing quick access to create new Galleries.';

$_lang['setting_moregallery.sanitize_replace'] = 'Sanitazovat náhradu';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Any characters in the uploaded filenames that do not match the sanitize pattern will be replaced with this character.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Sanitizace vzoru';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'A RegEx pattern for cleaning up filenames on upload.';
$_lang['setting_moregallery.crop_jpeg_quality'] = 'JPEG Crop Quality';
$_lang['setting_moregallery.crop_jpeg_quality_desc'] = 'For JPEG images you can control the quality of the thumbnails being generated by specifying a number between 0 and 100.';
$_lang['setting_moregallery.png_compression_level'] = 'PNG Compression Level';
$_lang['setting_moregallery.png_compression_level_desc'] = 'For PNG images you can control the quality of the thumbnails being generated by specifying a number between 0 and 9 where 9 is the best quality.';
$_lang['setting_moregallery.thumbnail_format'] = 'Manager Thumbnail Format';
$_lang['setting_moregallery.thumbnail_format_desc'] = 'Set the format (png, gif or jpg) that is used for thumbnails in the manager (mgr_thumb). This does not affect image cropping; those will use the same format as the original image.';
$_lang['setting_moregallery.prefill_from_iptc'] = 'Prefill from IPTC';
$_lang['setting_moregallery.prefill_from_iptc_desc'] = 'When enabled the image will automatically populate the name, description and tags with information stored in the image.';
$_lang['setting_moregallery.vimeo_prefill_description'] = 'Prefill Vimeo Description';
$_lang['setting_moregallery.vimeo_prefill_description_desc'] = 'When enabled videos loaded from Vimeo will get its description set to the description of the video.';
$_lang['setting_moregallery.youtube_prefill_description'] = 'Prefill YouTube Description';
$_lang['setting_moregallery.youtube_prefill_description_desc'] = 'When enabled videos loaded from YouTube will get its description set to the description of the video.';


$_lang['setting_moregallery.translit'] = "Transliteration";
$_lang['setting_moregallery.translit_desc'] = "When set to a value that is not \"none\" or empty, this will enable transliteration prior to the sanitization process, enabling translating of invalid characters to valid ones. If this value is empty, it will inherit from the core \"friendly_alias_translit\" setting.";

$_lang['setting_moregallery.translit_class'] = "Translit Class";
$_lang['setting_moregallery.translit_class_desc'] = "The name of the class to use for transliteration. If this value is empty, it will inherit from the core \"friendly_alias_translit_class\" setting.";
$_lang['setting_moregallery.translit_class_path'] = "Translit Class Path";
$_lang['setting_moregallery.translit_class_path_desc'] = "The path to the class to use for transliteration. If this value is empty, it will inherit from the core \"friendly_alias_translit_class_path\" setting.";
$_lang['setting_moregallery.custom_fields'] = "Custom Fields";
$_lang['setting_moregallery.custom_fields_desc'] = "Allows you to add additional options to the image edit modal. This setting requires a JSON object. For more information about how custom fields are defined and used, please <a href=\"https://www.modmore.com/moregallery/documentation/custom-fields/\">read the documentation here</a>.";

$_lang['setting_moregallery.prefetch_image_as_base64'] = "Prefetch Images as Base64";
$_lang['setting_moregallery.prefetch_image_as_base64_desc'] = "Set to a number representing the amount of images that should be preloaded as base64 resources. While loading the images as base64 makes images show up near instant (there is no delay where the browser loads the image), it can slow down filling the gallery in the back-end for slow or remote media sources.";
$_lang['setting_moregallery.allowed_extensions_per_source'] = "Allowed Extensions per Media Source";
$_lang['setting_moregallery.allowed_extensions_per_source_desc'] = "Enable this setting to look at the media source configuration for determining the allowed extensions during upload. When disabled MoreGallery will look at the upload_images setting for allowed extensions instead. ";

$_lang['setting_mgr_tree_icon_mgresource'] = 'Ikona galerie ve stromu';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'The Font Awesome icon class to add to MoreGallery Resources in the file tree. ';

$_lang['setting_moregallery.vimeo_provide_referer'] = 'Send referer to Vimeo';
$_lang['setting_moregallery.vimeo_provide_referer_desc'] = 'When embedding a Vimeo video with this setting enabled, MoreGallery will send your site url to Vimeo. This allows videos with domain-level privacy to be successfully loaded. If you don\'t use domain-level privacy, this can be disabled.';

$_lang['setting_moregallery.data_consent'] = 'Data Consent Level';
$_lang['setting_moregallery.data_consent_desc'] = 'MoreGallery shares implementation information with modmore automatically. You can configure what data may be shared with this setting. For details on how this works and what levels are supported, please visit: https://docs.modmore.com/en/MoreGallery/v1.x/Data_Sharing.html';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Uložit výstup galerie do cache?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Specify a resource ID or comma-separated IDs to get images from.';
$_lang['moregallery.mggetimages.activeonly_desc'] = 'When enabled only active images will be shown. Disable to also show inactive images.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Pole pro řazení. Platné hodnoty: filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'Směr řazení obrázků. Hodnota "asc" pro vzestupné a "desc" pro sestupné řazení.';
$_lang['moregallery.mggetimages.tags_desc'] = 'Čárkou oddělený seznam tagů nebo ID, dle kterých se mají obrázky vyfiltrovat.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Nastavte název URL parametru pro filtrování.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'Řetězec, který bude oddělovat jednotlivé tagy v rámci všech obrázků.';
$_lang['moregallery.mggetimages.gettags_desc'] = 'When enabled tags will be loaded for each image.';
$_lang['moregallery.mggetimages.getresourcecontent_desc'] = 'When enabled, the resource content will be loaded for use in the image template.';
$_lang['moregallery.mggetimages.getresourceproperties_desc'] = 'When enabled, the resource properties will be loaded for use in the image template.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'Pokud je povoleno, hodnoty políček dokumentu budou dostupné v šabloně obrázku.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Zadejte čárkou oddělený seznam názvů TV, které mají být dostupné v šabloně obrázku.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'Název chunku, který se použije jako šablona pro tagy.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'Název chunku, který se použije jako šablona pro obrázky.';
$_lang['moregallery.mggetimages.mediatpl_desc'] = 'The name of a Chunk to load for templating images that were imported from Sterc\'s Media Manager. Defaults to the value of imageTpl if not set.';
$_lang['moregallery.mggetimages.youtubetpl_desc'] = 'The name of a Chunk to load for templating embedded YouTube videos.';
$_lang['moregallery.mggetimages.vimeotpl_desc'] = 'The name of a Chunk to load for templating embedded Vimeo videos.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'The name of a Chunk to load when viewing an image in single image view';
$_lang['moregallery.mggetimages.singlemediatpl_desc'] = 'The name of a Chunk to load when viewing an image in single image view, which was imported from Sterc\'s Media Manager. Defaults to the value of singleImageTpl if not set.';
$_lang['moregallery.mggetimages.singleyoutubetpl_desc'] = 'The name of a Chunk to load when viewing a YouTube video in single image view.';
$_lang['moregallery.mggetimages.singlevimeotpl_desc'] = 'The name of a Chunk to load when viewing a Vimeo video in single image view.';
$_lang['moregallery.mggetimages.singleimageenabled_desc'] = 'When set to 1, the snippet will respond to requests with the singleImageParam URL property by showing the single image view.';
$_lang['moregallery.mggetimages.singleimageparam_desc'] = 'Can be used to override the moregallery.single_image_url_param system setting per snippet call. Useful if you show multiple galleries on the same page.';
$_lang['moregallery.mggetimages.singleimageresource_desc'] = 'Used in generating the link in the view_url placeholder. Set this to a resource that should be used for showing single images if it is not the resource the image was uploaded to.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'Řetězec, který bude oddělovat jednotlivé šablony obrázků v rámci výpisu galerie.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'Pokud je definován, tak se tento chunk použije jako vnější obal celého výstupu.';
$_lang['moregallery.mggetimages.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'Pokud je definován, tak snippet uloží výstup do placeholderu pro pozdější použití.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Používá se pro getPage stránkování, nastavte placeholder pro celkový počet výsledků.';
$_lang['moregallery.mggetimages.limit_desc'] = 'Počet obrazů k načtení v rámci jednoho dotazu.';
$_lang['moregallery.mggetimages.offset_desc'] = 'Počet obrázků, které se mají přeskočit v rámci daného dotazu.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'Schéma, které se má použít při generování URL; Výchozí hodnota je shodná s hodnotou link_tag_scheme.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';
$_lang['moregallery.mggetimages.debug_desc'] = 'Enable to show a dump of debug information (useful for bug reports) appended to the snippet output.';
$_lang['moregallery.mggetimages.timing_desc'] = 'Enable to show the total processing time for the snippet at the end of the snippet output.';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Ukládat výstup tagu do cache?';
$_lang['moregallery.mggettags.resource_desc'] = 'Zadejte ID galerie, ze které se mají získat tagy.';
$_lang['moregallery.mggettags.sortby_desc'] = 'Pole pro řazení tagů. Platné hodnoty: display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'Směr řazení tagů. Hodnota "asc" pro vzestupné a "desc" pro sestupné řazení.';
$_lang['moregallery.mggettags.tpl_desc'] = 'Název chunku, který se použije jako šablona pro tagy.';
$_lang['moregallery.mggettags.separator_desc'] = 'Řetězec, který se použije pro oddělené jednotlivých tagů.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'Pokud je definován, tak se tento chunk použije jako vnější obal celého výstupu.';
$_lang['moregallery.mggettags.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'Pokud je definován, tak snippet uloží výstup do placeholderu pro pozdější použití.';
$_lang['moregallery.mggettags.includecount_desc'] = 'When set to 1 the [[+image_count]] placeholder will contain the number of active images that are using this tag.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Používá se pro getPage stránkování, nastavte placeholder pro celkový počet výsledků.';
$_lang['moregallery.mggettags.limit_desc'] = 'Počet obrazů k načtení v rámci jednoho dotazu.';
$_lang['moregallery.mggettags.offset_desc'] = 'Počet obrázků, které se mají přeskočit v rámci daného dotazu.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';
