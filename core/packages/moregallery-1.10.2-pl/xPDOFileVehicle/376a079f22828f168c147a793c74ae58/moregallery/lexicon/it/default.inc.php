<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'MoreGallery';
$_lang['moregallery.new'] = 'Nuova galleria';
$_lang['moregallery.new_description'] = 'Creare una nuova galleria che ti permetta di caricare le immagini.';
$_lang['moregallery.name'] = 'Galleria';
$_lang['moregallery.name_here'] = 'Creare una galleria qui';
$_lang['moregallery.permission_denied'] = 'Siamo spiacenti, non disponi dell\'autorizzazione per gestire questa galleria.';
$_lang['moregallery.new_tags_not_allowed'] = 'Mi spiace, non hai i permessi necessari per agigungere nuovi tag. Per favore seleziona un tag esistente nel campo di ricerca.';
$_lang['moregallery.please_save_first'] = 'Per iniziare ad aggiungere immagini, si prega di salvare prima la galleria. Dopo aver salvato la galleria, è possibile caricare immagini qui.';



$_lang['moregallery.inherit'] = 'Eredita';
$_lang['moregallery.inherit.desc'] = 'Usa le impostazioni di default.';
$_lang['moregallery.source'] = 'Sorgente media';
$_lang['moregallery.source.desc'] = 'The media source to store images in. <b>Note:</b> When changing this after uploading, uploaded images will NOT be moved to their new source automatically; please do this yourself.';
$_lang['moregallery.relative_url'] = 'URL relativo';
$_lang['moregallery.relative_url.desc'] = 'The relative URL to store images in for the media source. Don\'t start with a slash. <b>Note:</b> When changing this after uploading, uploaded images will NOT be moved to their new location automatically; please do this yourself.';
$_lang['moregallery.content_position'] = 'Posizione del contenuto';
$_lang['moregallery.content_position.desc'] = 'Moves the Resource Content field to a different, more convenient location.';

$_lang['moregallery.content_position.above'] = 'Sopra le immagini';
$_lang['moregallery.content_position.below'] = 'Sotto le immagini';
$_lang['moregallery.content_position.tab'] = 'In Content Tab';
$_lang['moregallery.content_position.hide'] = 'Nascondi';

$_lang['moregallery.view_full_size_image'] = 'Visualizza immagine full-size';
$_lang['moregallery.delete'] = 'Elimina';
$_lang['moregallery.delete_image'] = 'Elimina immagine';
$_lang['moregallery.deactivate_image'] = 'Nascondi l\'immagine dalla Gallery';
$_lang['moregallery.activate_image'] = 'Marca immagine come visibile';
$_lang['moregallery.upload_image'] = 'Carica immagini nella Galleria';
$_lang['moregallery.upload'] = 'Carica';
$_lang['moregallery.import_image'] = 'Importa immagini da altre fonti';
$_lang['moregallery.import'] = 'Importa';
$_lang['moregallery.import_media'] = 'Importazione da Media';
$_lang['moregallery.images_selected'] = 'immagini selezionate'; // is prefixed with a number for the bulk feature, e.g. "5 images selected"
$_lang['moregallery.mediamanager_not_loaded'] = 'Media Manager non è attualmente disponibile.';
$_lang['moregallery.add_video'] = 'Aggiungi Video';
$_lang['moregallery.add_video_instructions'] = 'Immettere qui sotto l\'url del video per importarlo nella galleria.';
$_lang['moregallery.refresh'] = 'Ricarica';
$_lang['moregallery.drop_to_upload'] = 'Drop Images to upload them to the Gallery';
$_lang['moregallery.images_count'] = 'immagini';
$_lang['moregallery.edit_image_header'] = 'Modifica immagine';
$_lang['moregallery.name_field'] = 'Nome';
$_lang['moregallery.description'] = 'Descrizione';
$_lang['moregallery.url'] = 'URL (o ID della risorsa)';
$_lang['moregallery.save'] = 'Salva';
$_lang['moregallery.saving'] = 'Salvataggio...';
$_lang['moregallery.saved_at'] = 'Salvato (alle [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Sei sicuro di che voler rimuovere "[[+ nome]]"? L\'immagine verrà rimossa dal server.';
$_lang['moregallery.confirm_media_remove'] = 'Sei sicuro di che voler rimuovere "[[+name]]" dalla Galleria? L\'immagine rimarrà disponibile in Media Manager.';
$_lang['moregallery.confirm_video_remove'] = 'Sei sicuro di che voler rimuovere "[[+name]]"? L\'immagine verrà rimossa dal server.';
$_lang['moregallery.confirm_bulk_remove'] = 'Sei sicuro di che voler rimuovere [[+amount]] immagini? Le relative immagini verranno rimosse dal server.';
$_lang['moregallery.preupload_very_big'] = 'Il file "[[+file]]" è molto grande. Il caricamento potrebbe richiedere parecchio tempo, e il server potrebbe non disporre di sufficiente memoria per elaborarlo una volta caricato. Sei sicuro di che voler continuare?';
$_lang['moregallery.upload_error'] = 'Ops, si è verificato un errore nel tentativo di caricare [[+file]]: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'The uploaded image was over [[+size]]MB in size, which may have been too much for the server to upload and process. Try resizing the image before uploading.';
$_lang['moregallery.model_error'] = 'An unexpected error occurred, the image model could not be found. Try refreshing the page.';
$_lang['moregallery.video_load_error'] = 'The video information could not be loaded. This is most likely because the video does not exist, or that it is marked as private.';

$_lang['moregallery.error_invalid_resource'] = 'Si è verificato un errore inatteso, la risorsa [[+resource]] non è una Gallery valida.';
$_lang['moregallery.error_loading_source'] = 'An error occurred loading the Media Source for this Gallery.';
$_lang['moregallery.error_invalid_filetype'] = 'Mi spiace, i file con estensione .[[+extension]] non sono permessi.';
$_lang['moregallery.error_upload_failed'] = 'non è stato possibile caricare il file (Errore [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tags';
$_lang['moregallery.tags.add'] = 'Aggiungi';
$_lang['moregallery.tags.remove'] = 'Rimuovi';
$_lang['moregallery.tags.cant_be_empty'] = 'Il tag non può essere vuoto.';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Il file da importare non sembrano esistere o non è leggibile: [[+file]]';
$_lang['moregallery.edit_crop'] = 'Modifica Crop';
$_lang['moregallery.save_crop'] = 'Salva Crop';
$_lang['moregallery.preview_crop'] = 'Anteprima Crop';
$_lang['moregallery.processing_crop'] = 'In elaborazione...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'Source Relative URL';
$_lang['setting_moregallery.source_relative_url_desc'] = 'The URL relative to the root of the selected media source to upload images to. Can be overridden per Gallery resource on its Settings tab.';

$_lang['setting_moregallery.source'] = 'Sorgente media';
$_lang['setting_moregallery.source_desc'] = 'Choose a Media Source to upload images to. Can be overridden per Gallery resource on its Settings tab.';

$_lang['setting_moregallery.image_id_in_name'] = 'ID dell\'immagine nel nome file';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Set to either "prefix" or "suffix" to add the image ID to the file name on upload. This ensures the filename is unique.';
$_lang['setting_moregallery.image_id_separator'] = 'Image ID Separator';
$_lang['setting_moregallery.image_id_separator_desc'] = 'The separator to use between the file name and the image ID on newly uploaded or imported images.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Resource ID in Path';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'When enabled, the Gallery Resource ID will be suffixed to the Source Relative URL so each gallery has its own directory.';
$_lang['setting_moregallery.content_position'] = 'Posizione del contenuto';
$_lang['setting_moregallery.content_position_desc'] = 'Imposta a "sopra", "sotto", "tab" o "hide" per determinare come verrà visualizzato il campo content.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Usa editor rich text';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'When enabled, the currently active rich text editor will be loaded into the Image Description field. We recommend using Redactor, but other editors are also supported.';
$_lang['setting_moregallery.crops'] = 'Crops';
$_lang['setting_moregallery.crops_desc'] = 'Insert your Crops configuration here to enable region of interest cropping on images. An example could be <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. As this is an advanced feature, please refer to the <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">full Crops documentation</a> for more information about syntax and functionality.';
$_lang['setting_moregallery.single_image_url_param'] = 'Single Image URL Parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Used with the mgGetImages snippet, the single image url parameter determines whether a listing or single image is displayed. This URL parameter will contain the image ID and, if not found, it will send the user to the configured 404 page. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Add Icon to Toolbar';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'When enabled, a "New Gallery" icon will be added to resource toolbar providing quick access to create new Galleries.';

$_lang['setting_moregallery.sanitize_replace'] = 'Sanitize Replacement';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Any characters in the uploaded filenames that do not match the sanitize pattern will be replaced with this character.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Sanitize Pattern';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'Un pattern RegEx per ripulire i nomi dei file al momento dell\'upload.';
$_lang['setting_moregallery.crop_jpeg_quality'] = 'JPEG Crop Quality';
$_lang['setting_moregallery.crop_jpeg_quality_desc'] = 'For JPEG images you can control the quality of the thumbnails being generated by specifying a number between 0 and 100.';
$_lang['setting_moregallery.png_compression_level'] = 'PNG Compression Level';
$_lang['setting_moregallery.png_compression_level_desc'] = 'For PNG images you can control the quality of the thumbnails being generated by specifying a number between 0 and 9 where 9 is the best quality.';
$_lang['setting_moregallery.thumbnail_format'] = 'Formato miniature del manager';
$_lang['setting_moregallery.thumbnail_format_desc'] = 'Impostare il formato (png, gif o jpg) che viene utilizzato per le miniature nel manager (mgr_thumb). Ciò non pregiudica il ritaglio immagine; quelli utilizzeranno lo stesso formato dell\'immagine originale.';
$_lang['setting_moregallery.prefill_from_iptc'] = 'Precompila da IPTC';
$_lang['setting_moregallery.prefill_from_iptc_desc'] = 'When enabled the image will automatically populate the name, description and tags with information stored in the image.';
$_lang['setting_moregallery.vimeo_prefill_description'] = 'Prefill Vimeo Description';
$_lang['setting_moregallery.vimeo_prefill_description_desc'] = 'When enabled videos loaded from Vimeo will get its description set to the description of the video.';
$_lang['setting_moregallery.youtube_prefill_description'] = 'Prefill YouTube Description';
$_lang['setting_moregallery.youtube_prefill_description_desc'] = 'When enabled videos loaded from YouTube will get its description set to the description of the video.';


$_lang['setting_moregallery.translit'] = "Traslitterazione";
$_lang['setting_moregallery.translit_desc'] = "When set to a value that is not \"none\" or empty, this will enable transliteration prior to the sanitization process, enabling translating of invalid characters to valid ones. If this value is empty, it will inherit from the core \"friendly_alias_translit\" setting.";

$_lang['setting_moregallery.translit_class'] = "Classe Translit";
$_lang['setting_moregallery.translit_class_desc'] = "The name of the class to use for transliteration. If this value is empty, it will inherit from the core \"friendly_alias_translit_class\" setting.";
$_lang['setting_moregallery.translit_class_path'] = "Percorso della classe Translit";
$_lang['setting_moregallery.translit_class_path_desc'] = "Il percorso della classe da utilizzare per la traslitterazione. Se questo valore è vuoto, erediterà l'impostazione core \"friendly_alias_translit_class_path\".";
$_lang['setting_moregallery.custom_fields'] = "Campi personalizzati";
$_lang['setting_moregallery.custom_fields_desc'] = "Allows you to add additional options to the image edit modal. This setting requires a JSON object. For more information about how custom fields are defined and used, please <a href=\"https://www.modmore.com/moregallery/documentation/custom-fields/\">read the documentation here</a>.";

$_lang['setting_moregallery.prefetch_image_as_base64'] = "Prefetch Images as Base64";
$_lang['setting_moregallery.prefetch_image_as_base64_desc'] = "Set to a number representing the amount of images that should be preloaded as base64 resources. While loading the images as base64 makes images show up near instant (there is no delay where the browser loads the image), it can slow down filling the gallery in the back-end for slow or remote media sources.";
$_lang['setting_moregallery.allowed_extensions_per_source'] = "Allowed Extensions per Media Source";
$_lang['setting_moregallery.allowed_extensions_per_source_desc'] = "Enable this setting to look at the media source configuration for determining the allowed extensions during upload. When disabled MoreGallery will look at the upload_images setting for allowed extensions instead. ";

$_lang['setting_mgr_tree_icon_mgresource'] = 'Gallery Tree Icon';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'The Font Awesome icon class to add to MoreGallery Resources in the file tree. ';

$_lang['setting_moregallery.vimeo_provide_referer'] = 'Send referer to Vimeo';
$_lang['setting_moregallery.vimeo_provide_referer_desc'] = 'When embedding a Vimeo video with this setting enabled, MoreGallery will send your site url to Vimeo. This allows videos with domain-level privacy to be successfully loaded. If you don\'t use domain-level privacy, this can be disabled.';

$_lang['setting_moregallery.data_consent'] = 'Data Consent Level';
$_lang['setting_moregallery.data_consent_desc'] = 'MoreGallery shares implementation information with modmore automatically. You can configure what data may be shared with this setting. For details on how this works and what levels are supported, please visit: https://docs.modmore.com/en/MoreGallery/v1.x/Data_Sharing.html';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Cache the Gallery output?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Specify a resource ID or comma-separated IDs to get images from.';
$_lang['moregallery.mggetimages.activeonly_desc'] = 'When enabled only active images will be shown. Disable to also show inactive images.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'The field to sort by. Valid values: filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'The direction to sort images by. This can be "asc" or "desc".';
$_lang['moregallery.mggetimages.tags_desc'] = 'A comma separated list of tag names or IDs to filter images on.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Set to the name of a URL parameter to get tags to filter on.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'A string to separate tag templates with for each of the images.';
$_lang['moregallery.mggetimages.gettags_desc'] = 'When enabled tags will be loaded for each image.';
$_lang['moregallery.mggetimages.getresourcecontent_desc'] = 'When enabled, the resource content will be loaded for use in the image template.';
$_lang['moregallery.mggetimages.getresourceproperties_desc'] = 'When enabled, the resource properties will be loaded for use in the image template.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'When enabled, resource fields will be loaded into the image template.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Provide a comma separated list of TV names to load into the image template.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'The name of a Chunk to load for templating tags.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'The name of a Chunk to load for templating images.';
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
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'A string to separate image templates with in gallery view.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggetimages.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'When not empty, the snippet will set a placeholder with the output and will not output content directly.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Used for getPage pagination, set this to a placeholder to set for the total number of results.';
$_lang['moregallery.mggetimages.limit_desc'] = 'The number of images to load in the result set.';
$_lang['moregallery.mggetimages.offset_desc'] = 'he number of images to skip in the result set.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'The scheme to use in generating URLs; defaults to the value of the link_tag_scheme value.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';
$_lang['moregallery.mggetimages.debug_desc'] = 'Enable to show a dump of debug information (useful for bug reports) appended to the snippet output.';
$_lang['moregallery.mggetimages.timing_desc'] = 'Enable to show the total processing time for the snippet at the end of the snippet output.';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Cache the Tag output?';
$_lang['moregallery.mggettags.resource_desc'] = 'Specify a resource ID to get tags from.';
$_lang['moregallery.mggettags.sortby_desc'] = 'The field to sort by. Valid values: display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'The direction to sort tags by. This can be "asc" or "desc".';
$_lang['moregallery.mggettags.tpl_desc'] = 'The name of a Chunk to load for templating tags.';
$_lang['moregallery.mggettags.separator_desc'] = 'Una stringa per separare i tag.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggettags.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'When not empty, the snippet will set a placeholder with the output and will not output content directly.';
$_lang['moregallery.mggettags.includecount_desc'] = 'When set to 1 the [[+image_count]] placeholder will contain the number of active images that are using this tag.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Used for getPage pagination, set this to a placeholder to set for the total number of results.';
$_lang['moregallery.mggettags.limit_desc'] = 'Il numero di immagini da caricare nei risultati.';
$_lang['moregallery.mggettags.offset_desc'] = 'il numero di immagini da ignorare nei risultati.';
$_lang['moregallery.mggettags.where_desc'] = 'E\' possibile aggiungere qui una condizione generica, in formato JSON. Esempio {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';
