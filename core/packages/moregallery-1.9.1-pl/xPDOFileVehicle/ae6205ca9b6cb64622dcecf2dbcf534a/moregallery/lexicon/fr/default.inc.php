<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'moreGallery';
$_lang['moregallery.new'] = 'Nouvelle galerie';
$_lang['moregallery.new_description'] = 'Créer une nouvelle galerie pour ajouter des images.';
$_lang['moregallery.name'] = 'Galerie';
$_lang['moregallery.name_here'] = 'Créer une nouvelle galerie ici';
$_lang['moregallery.permission_denied'] = 'Sorry, you do not have the necessary permission to manage this gallery.';
$_lang['moregallery.new_tags_not_allowed'] = 'Sorry, you do not have the necessary permission to add new tags. Please select an existing tag from the typeahead search.';
$_lang['moregallery.please_save_first'] = 'Veuillez enregistrer la ressource pour commencer à ajouter des images. ';



$_lang['moregallery.inherit'] = 'Hériter';
$_lang['moregallery.inherit.desc'] = 'Utiliser les valeurs par défaut du système.';
$_lang['moregallery.source'] = 'Media Source';
$_lang['moregallery.source.desc'] = 'Le media source à utiliser pour stocker les images. <b>Note:</b> Si vous changez de media source après avoir ajouté des images, celles-ci ne seront PAS automatiquement déplacées vers le nouveau media source.';
$_lang['moregallery.relative_url'] = 'URL relative';
$_lang['moregallery.relative_url.desc'] = 'L\'URL relative utilisée pour stocker les images dans le media source. Ne commence pas par un slash. <b>Note:</b> Si vous changez ce paramètre après avoir ajouté des images, celles-ci ne seront PAS automatiquement déplacées vers le nouveau media source.';
$_lang['moregallery.content_position'] = 'Position du contenu';
$_lang['moregallery.content_position.desc'] = 'Déplacer le champ de contenu de la ressource vers un endroit plus approprié.';

$_lang['moregallery.content_position.above'] = 'Au dessus des images';
$_lang['moregallery.content_position.below'] = 'En dessous des images';
$_lang['moregallery.content_position.tab'] = 'Dans l\'onglet contenu';
$_lang['moregallery.content_position.hide'] = 'Masquer';

$_lang['moregallery.view_full_size_image'] = 'Voir en taille réelle';
$_lang['moregallery.delete'] = 'Delete';
$_lang['moregallery.delete_image'] = 'Supprimer l\'image';
$_lang['moregallery.deactivate_image'] = 'Masquer l\'image de la Galerie';
$_lang['moregallery.activate_image'] = 'Marquer l\'image comme visible';
$_lang['moregallery.upload_image'] = 'Uploader des images à la galerie';
$_lang['moregallery.upload'] = 'Envoyer';
$_lang['moregallery.import_image'] = 'Importer des images depuis d\'autres sources';
$_lang['moregallery.import'] = 'Importer';
$_lang['moregallery.import_media'] = 'Import from Media';
$_lang['moregallery.images_selected'] = 'images selected'; // is prefixed with a number for the bulk feature, e.g. "5 images selected"
$_lang['moregallery.mediamanager_not_loaded'] = 'The Media Manager is not currently available.';
$_lang['moregallery.add_video'] = 'Add Video';
$_lang['moregallery.add_video_instructions'] = 'Enter the video url below to import it to the gallery.';
$_lang['moregallery.refresh'] = 'Rafraîchir';
$_lang['moregallery.drop_to_upload'] = 'Déposez des Images pour les ajouter à la Galerie';
$_lang['moregallery.images_count'] = 'images';
$_lang['moregallery.edit_image_header'] = 'Éditer l\'image';
$_lang['moregallery.name_field'] = 'Nom';
$_lang['moregallery.description'] = 'Description';
$_lang['moregallery.url'] = 'URL (ou ID de resource)';
$_lang['moregallery.save'] = 'Enregistrer';
$_lang['moregallery.saving'] = 'Enregistrement..';
$_lang['moregallery.saved_at'] = 'Enregistré (à [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Êtes-vous sûr de vouloir supprimer "[[+name]]" ? L\'image sera supprimée du serveur.';
$_lang['moregallery.confirm_media_remove'] = 'Are you sure you want to remove "[[+name]]" from the gallery? The image will remain available in the Media Manager.';
$_lang['moregallery.confirm_video_remove'] = 'Are you sure you want to remove "[[+name]]"? The thumbnail image will be removed from the server.';
$_lang['moregallery.confirm_bulk_remove'] = 'Are you sure you want to remove [[+amount]] images? Related image files will be removed from the server.';
$_lang['moregallery.preupload_very_big'] = 'Le fichier "[[+file]]" est volumineux. L\'upload peut prendre un certain temps. Il se peut également que le serveur n\'ai pas assez de mémoire pour traiter le fichier après l\'upload. Êtes-vous sûr de vouloir continuer ?';
$_lang['moregallery.upload_error'] = 'Oh oh, une erreur est survenue lors de l\'upload de [[+file]]: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Le poids de l\'image est supérieur à [[+size]]mb, ce qui est peut-être trop volumineux pour que le serveur puisse recevoir et traiter l\'image. Essayez de redimenssionner l\'image avant de retenter.';
$_lang['moregallery.model_error'] = 'Une erreur est survenue, le modèle d\'image n\'a pu être trouvé. Veuillez actualiser la page.';
$_lang['moregallery.video_load_error'] = 'The video information could not be loaded. This is most likely because the video does not exist, or that it is marked as private.';

$_lang['moregallery.error_invalid_resource'] = 'Une erreur est survenue, la ressource "[[+resource]]" n\'est pas une galerie valide.';
$_lang['moregallery.error_loading_source'] = 'Une erreur est survenue lors du chargement du media source de cette galerie.';
$_lang['moregallery.error_invalid_filetype'] = 'Sorry, .[[+extension]] files are not allowed.';
$_lang['moregallery.error_upload_failed'] = 'the file could not be uploaded (Error [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tags';
$_lang['moregallery.tags.add'] = 'Ajouter';
$_lang['moregallery.tags.remove'] = 'Remove';
$_lang['moregallery.tags.cant_be_empty'] = 'The tag can\'t be empty.';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Le fichier à importer ne semble pas exister, ou n\'est pas lisible: [[+file]]';
$_lang['moregallery.edit_crop'] = 'Recadrer';
$_lang['moregallery.save_crop'] = 'Enregistrer le recadrage';
$_lang['moregallery.preview_crop'] = 'Aperçu du recadrage';
$_lang['moregallery.processing_crop'] = 'En cours...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'URL relative à la Source';
$_lang['setting_moregallery.source_relative_url_desc'] = 'L\'URL relative au Media Source sélectionné. Peut être défini par ressource, dans l\'onglet "Paramètres".';

$_lang['setting_moregallery.source'] = 'Media Source';
$_lang['setting_moregallery.source_desc'] = 'Sélectionnez le Media Source à utiliser pour uploader les images. Peut être défini par ressource, dans l\'onglet "Paramètres".';

$_lang['setting_moregallery.image_id_in_name'] = 'ID de l\'image dans le nom de fichier';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Indiquez "prefix" ou "suffix" pour ajouter l\'ID de l\'image dans son nom de fichier, lors de l\'upload. Cela vous permet d\'être certain que le nom de l\'image est unique.';
$_lang['setting_moregallery.image_id_separator'] = 'Image ID Separator';
$_lang['setting_moregallery.image_id_separator_desc'] = 'The separator to use between the file name and the image ID on newly uploaded or imported images.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Resource ID in Path';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'When enabled, the Gallery Resource ID will be suffixed to the Source Relative URL so each gallery has its own directory.';
$_lang['setting_moregallery.content_position'] = 'Position du contenu';
$_lang['setting_moregallery.content_position_desc'] = 'Indiquez "above" (au dessus), "below" (en dessous), "tab" (dans un onglet) ou "hide" (masqué) pour définir comment le champ de contenu sera affiché.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Utilisez l\'éditeur de texte enrichi';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'Activez cette option pour que l\'éditeur de texte enrichi soit utilisé pour le champ de description de l\'image. Nous recommandons l\'utilisation de Redactor, mais d\'autres éditeurs sont également supportés.';
$_lang['setting_moregallery.crops'] = 'Crops';
$_lang['setting_moregallery.crops_desc'] = 'Insert your Crops configuration here to enable region of interest cropping on images. An example could be <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. As this is an advanced feature, please refer to the <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">full Crops documentation</a> for more information about syntax and functionality.';
$_lang['setting_moregallery.single_image_url_param'] = 'Single Image URL Parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Used with the mgGetImages snippet, the single image url parameter determines whether a listing or single image is displayed. This URL parameter will contain the image ID and, if not found, it will send the user to the configured 404 page. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Ajouter l\'icône à la barre d\'outils';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'Activez cette option pour qu\'une icône "Nouvelle Galerie" soit ajoutée à la barre d\'outils des ressources, donnant un accès rapide à la création de nouvelle galeries.';

$_lang['setting_moregallery.sanitize_replace'] = 'Sanitize Replacement';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Any characters in the uploaded filenames that do not match the sanitize pattern will be replaced with this character.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Sanitize Pattern';
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

$_lang['setting_mgr_tree_icon_mgresource'] = 'Icône de Gallerie';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'La classe CSS de Font Awesome à utiliser comme icône des ressources MoreGallery, dans l\'arborescence. ';

$_lang['setting_moregallery.vimeo_provide_referer'] = 'Send referer to Vimeo';
$_lang['setting_moregallery.vimeo_provide_referer_desc'] = 'When embedding a Vimeo video with this setting enabled, MoreGallery will send your site url to Vimeo. This allows videos with domain-level privacy to be successfully loaded. If you don\'t use domain-level privacy, this can be disabled.';

$_lang['setting_moregallery.data_consent'] = 'Data Consent Level';
$_lang['setting_moregallery.data_consent_desc'] = 'MoreGallery shares implementation information with modmore automatically. You can configure what data may be shared with this setting. For details on how this works and what levels are supported, please visit: https://docs.modmore.com/en/MoreGallery/v1.x/Data_Sharing.html';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Mettre en cache l\'affichage de la Galerie ?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Specify a resource ID or comma-separated IDs to get images from.';
$_lang['moregallery.mggetimages.activeonly_desc'] = 'When enabled only active images will be shown. Disable to also show inactive images.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Le champ sur lequel Trier. Les valeurs valides : filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'La direction dans laquelle trier les images. Cela peut être « asc » ou « desc ».';
$_lang['moregallery.mggetimages.tags_desc'] = 'Une liste, séparée par des virgules, de noms de tags ou d\'ID, utilisée pour filtrer les images.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Indiquez le nom du paramètre d\'URL à utiliser pour filtrer par tags.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'Une chaîne de caractère(s) à utiliser pour séparer les tags des modèles, pour chacune des images.';
$_lang['moregallery.mggetimages.gettags_desc'] = 'When enabled tags will be loaded for each image.';
$_lang['moregallery.mggetimages.getresourcecontent_desc'] = 'When enabled, the resource content will be loaded for use in the image template.';
$_lang['moregallery.mggetimages.getresourceproperties_desc'] = 'When enabled, the resource properties will be loaded for use in the image template.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'Activez cette option pour les champs de la ressource soient chargés dans le modèle de l\'image.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Indiquez une liste, séparée par des virgules, de noms de TV à charger dans le modèle de l\'image.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'Le nom du chunk à charger pour mettre en page/formatter les tags.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'Le nom du chunk à charger pour mettre en page/formater les images.';
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
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'Une chaîne de caractère(s) à utiliser pour séparer les modèles d\'image dans la "vue galerie".';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'Indiquez un nom de chunk (optionnel) à utiliser pour envelopper l\'affichage complet.';
$_lang['moregallery.mggetimages.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'Lorsque cette option est définie, le snippet ajoutera l\'affichage complet du contenu dans un placeholder, au lieu de le retourner.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Indiquez le placeholder dans lequel insérer le nombre total de résultats, afin de l\'utiliser avec la pagination de getPage.';
$_lang['moregallery.mggetimages.limit_desc'] = 'Le nombre d\'images à charger dans le jeu de résultats.';
$_lang['moregallery.mggetimages.offset_desc'] = 'Le nombre de résultats à omettre dans le jeu de résultats.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'Le schéma à utiliser pour générer les URLs; par défaut, la valeur de link_tag_scheme est utilisée.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';
$_lang['moregallery.mggetimages.debug_desc'] = 'Enable to show a dump of debug information (useful for bug reports) appended to the snippet output.';
$_lang['moregallery.mggetimages.timing_desc'] = 'Enable to show the total processing time for the snippet at the end of the snippet output.';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Mettre en cache le tag ?';
$_lang['moregallery.mggettags.resource_desc'] = 'Indiquez un ID de ressource depuis laquelle obtenir les tags.';
$_lang['moregallery.mggettags.sortby_desc'] = 'Le champ à utiliser pour le classement. Les valeurs valides sont : display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'La direction dans laquelle classer les tags. Les valeurs valides sont "asc" ou "desc".';
$_lang['moregallery.mggettags.tpl_desc'] = 'Le nom du chunk à charger pour mettre le forme les tags.';
$_lang['moregallery.mggettags.separator_desc'] = 'Le caractère à utiliser pour séparer les tags.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'Indiquez un nom de chunk (optionnel) à utiliser pour envelopper l\'affichage complet.';
$_lang['moregallery.mggettags.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'Lorsque cette option est définie, le snippet ajoutera l\'affichage complet du contenu dans un placeholder, au lieu de le retourner.';
$_lang['moregallery.mggettags.includecount_desc'] = 'When set to 1 the [[+image_count]] placeholder will contain the number of active images that are using this tag.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Indiquez le placeholder dans lequel insérer le nombre total de résultats, afin de l\'utiliser avec la pagination de getPage.';
$_lang['moregallery.mggettags.limit_desc'] = 'Le nombre d\'images à charger dans le jeu de résultats.';
$_lang['moregallery.mggettags.offset_desc'] = 'Le nombre de résultats à omettre dans le jeu de résultats.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';
