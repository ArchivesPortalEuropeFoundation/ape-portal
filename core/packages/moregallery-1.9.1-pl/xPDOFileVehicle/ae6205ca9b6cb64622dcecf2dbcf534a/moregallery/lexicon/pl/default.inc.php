<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'Galeria MoreGallery';
$_lang['moregallery.new'] = 'Nowy dokument z galerią';
$_lang['moregallery.new_description'] = 'Utwórz nową galerię aby móc wgrywać zdjęcia';
$_lang['moregallery.name'] = 'Dokument z galerią';
$_lang['moregallery.name_here'] = 'Utwórz tu Galerię';
$_lang['moregallery.permission_denied'] = 'Sorry, you do not have the necessary permission to manage this gallery.';
$_lang['moregallery.new_tags_not_allowed'] = 'Sorry, you do not have the necessary permission to add new tags. Please select an existing tag from the typeahead search.';
$_lang['moregallery.please_save_first'] = 'Zapisz nowy dokument, aby móc wgrać zdjęcia do galerii';



$_lang['moregallery.inherit'] = 'Odziedzicz (użyj domyślnych)';
$_lang['moregallery.inherit.desc'] = 'Użyj domyślnych ustawień systemowych.';
$_lang['moregallery.source'] = 'Źródło plików';
$_lang['moregallery.source.desc'] = 'Źródło plików do przechowywania obrazów. <b>Uwaga:</b> Po zmianie źródła plików wcześniej wgrane obrazy nie zostaną automatycznie przeniesione - prosimy zrobić to ręcznie';
$_lang['moregallery.relative_url'] = 'Relatywny URL';
$_lang['moregallery.relative_url.desc'] = 'Relatywny URL do przechowywania obrazów w źródle plików. Ścieżka nie może zaczynać od ukośnika (/).';
$_lang['moregallery.content_position'] = 'Położenie treści';
$_lang['moregallery.content_position.desc'] = 'Przenosi edycję dokumentu do oddzielnej zakładki.';

$_lang['moregallery.content_position.above'] = 'Powyżej obrazów';
$_lang['moregallery.content_position.below'] = 'Poniżej obrazów';
$_lang['moregallery.content_position.tab'] = 'Jako zakładka';
$_lang['moregallery.content_position.hide'] = 'Ukryj';

$_lang['moregallery.view_full_size_image'] = 'Pokaż obraz w pełnych rozmiarach';
$_lang['moregallery.delete'] = 'Delete';
$_lang['moregallery.delete_image'] = 'Usuń obraz';
$_lang['moregallery.deactivate_image'] = 'Ukryj obraz w galerii';
$_lang['moregallery.activate_image'] = 'Zaznacz obraz jako widoczny';
$_lang['moregallery.upload_image'] = 'Wgraj obrazy do galerii';
$_lang['moregallery.upload'] = 'Wgraj';
$_lang['moregallery.import_image'] = 'Importuj obrazy z innych źródeł';
$_lang['moregallery.import'] = 'Importuj';
$_lang['moregallery.import_media'] = 'Import from Media';
$_lang['moregallery.images_selected'] = 'images selected'; // is prefixed with a number for the bulk feature, e.g. "5 images selected"
$_lang['moregallery.mediamanager_not_loaded'] = 'The Media Manager is not currently available.';
$_lang['moregallery.add_video'] = 'Add Video';
$_lang['moregallery.add_video_instructions'] = 'Enter the video url below to import it to the gallery.';
$_lang['moregallery.refresh'] = 'Odśwież';
$_lang['moregallery.drop_to_upload'] = 'Przeciągnij tu obrazy aby wgrać je do galerii';
$_lang['moregallery.images_count'] = 'obrazy/obrazów';
$_lang['moregallery.edit_image_header'] = 'Edytuj obraz';
$_lang['moregallery.name_field'] = 'Nazwa';
$_lang['moregallery.description'] = 'Opis';
$_lang['moregallery.url'] = 'Odnośnik (lub Id)';
$_lang['moregallery.save'] = 'Zapisz';
$_lang['moregallery.saving'] = 'Zapisywanie..';
$_lang['moregallery.saved_at'] = 'Zapisane (w ciągu [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Czy na pewno chcesz usunąć "[[+name]]"? Obraz zostanie usunięty z serwera';
$_lang['moregallery.confirm_media_remove'] = 'Are you sure you want to remove "[[+name]]" from the gallery? The image will remain available in the Media Manager.';
$_lang['moregallery.confirm_video_remove'] = 'Are you sure you want to remove "[[+name]]"? The thumbnail image will be removed from the server.';
$_lang['moregallery.confirm_bulk_remove'] = 'Are you sure you want to remove [[+amount]] images? Related image files will be removed from the server.';
$_lang['moregallery.preupload_very_big'] = 'Plik "[[+file]]" jest bardzo duży. Wgrywanie może zając dużo czasu oraz serwer może nie mieć wystarczającej ilości pamięci aby obsłużyć proces. Czy na pewno chcesz kontynuować?';
$_lang['moregallery.upload_error'] = 'Podczas wgrywania pliku [[+file]] pojawił się błąd: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Wgrywany obraz przekracza rozmiar [[+size]]MB. Zmniejsz obraz przed wgrywaniem';
$_lang['moregallery.model_error'] = 'Nieznany błąd. Nie można załadować modelu obrazu. Spróbuj odświeżyć stronę. ';
$_lang['moregallery.video_load_error'] = 'The video information could not be loaded. This is most likely because the video does not exist, or that it is marked as private.';

$_lang['moregallery.error_invalid_resource'] = 'Pojawił się nieoczekiwany błąd. Dokument "[[+resource]]" nie jest Dokumentem z galerią';
$_lang['moregallery.error_loading_source'] = 'Pojawił się błąd podczas ładowania Źródła plików dla tej Galerii.';
$_lang['moregallery.error_invalid_filetype'] = 'Pliki z rozszerzeniami .[[+extension]] są niedozwolone.';
$_lang['moregallery.error_upload_failed'] = 'plik nie może zostać przesłany (Błąd [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tagi';
$_lang['moregallery.tags.add'] = 'Dodaj';
$_lang['moregallery.tags.remove'] = 'Remove';
$_lang['moregallery.tags.cant_be_empty'] = 'The tag can\'t be empty.';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Plik "[[+file]]" nie istnieje lub nie da się go odczytać';
$_lang['moregallery.edit_crop'] = 'Edytuj kadr';
$_lang['moregallery.save_crop'] = 'Zapisz kadr';
$_lang['moregallery.preview_crop'] = 'Podgląd kadru';
$_lang['moregallery.processing_crop'] = 'Przetwarzanie...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'URL w obrębie źródła plików';
$_lang['setting_moregallery.source_relative_url_desc'] = 'Ścieżka w obrębie źródła plików zasobu, do której mają być wgrywane pliki.  Wartość ta może być nadpisana w dokumencie galerii w zakładc e ustawienia.';

$_lang['setting_moregallery.source'] = 'Źródło plików';
$_lang['setting_moregallery.source_desc'] = 'Wybierz źródło plików gdzie mają być wgrywane obrazy. Ustawienie może być zmieniane dla każdego dokumentu w zakładce Ustawienia';

$_lang['setting_moregallery.image_id_in_name'] = 'ID obrazu w nazwie pliku';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Ustaw gdzie ma być dodane ID w nazwie pliku podczas wgrywania (wartość "prefix" lub "suffix"). Dzięki temu nazwa pliku będzie unikalna';
$_lang['setting_moregallery.image_id_separator'] = 'Image ID Separator';
$_lang['setting_moregallery.image_id_separator_desc'] = 'The separator to use between the file name and the image ID on newly uploaded or imported images.';
$_lang['setting_moregallery.resource_id_in_path'] = 'ID dokumentu w ścieżce';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'Gdy aktywne, ID dokumentu będzie dodane do URL w obrębie źródła plików';
$_lang['setting_moregallery.content_position'] = 'Pozycja treści w panelu';
$_lang['setting_moregallery.content_position_desc'] = 'Ustaw "above", "below", "tab" lub "hide" aby zdefiniowac jak ma być wyświetlana treść';
$_lang['setting_moregallery.use_rte_for_images'] = 'Użyj edytora RTE';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'Aktywuje edytor RTE w polu opis obrazu';
$_lang['setting_moregallery.crops'] = 'Kadrowanie';
$_lang['setting_moregallery.crops_desc'] = 'Wstaw tu swoją konfigurację kadrowania obrazu. Na przykład <code>mall:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. Jako, że jest to opcja zaawansowana, proszę skorzystać z <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">pełnej dokumentacji przycinania</a> aby dowiedzieć się więcej o składni oraz dostępnej funkcjonalności.';
$_lang['setting_moregallery.single_image_url_param'] = 'Parametr URL pojedynczego obrazu ';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Parametr używany ze snippetem mgGetImages. Określa czy jest wyświetlana lista, czy pojedynczy obraz. Parametr URL będzie zawierał ID obrazu i jeśli nie zostanie odnaleziony,. użytkownik będzie przeniesiony do strony 404';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Dodaj ikonę na pasku narzędzi';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'Gdy aktywne, w pasku narzędzi (lewe menu ) zostanie dodana ikona Nowy dokument z galerią';

$_lang['setting_moregallery.sanitize_replace'] = 'Znak transliteracji';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Niedozwolone znaki w nazwach plików zostaną zastąpione tym znakiem';
$_lang['setting_moregallery.sanitize_pattern'] = 'Wzór transliteracji';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'Wzór RegEx do zmiany nazw plików przy wgrywaniu';
$_lang['setting_moregallery.crop_jpeg_quality'] = 'Jakość kadrowania JPEG';
$_lang['setting_moregallery.crop_jpeg_quality_desc'] = 'Dla plików JPEG możesz ustawić jakość generowanej miniaturki poprzez wprowadzenie wartości od 0 do 100.';
$_lang['setting_moregallery.png_compression_level'] = 'PNG Compression Level';
$_lang['setting_moregallery.png_compression_level_desc'] = 'For PNG images you can control the quality of the thumbnails being generated by specifying a number between 0 and 9 where 9 is the best quality.';
$_lang['setting_moregallery.thumbnail_format'] = 'Format (rozszerzenie) miniatury w Menedżerze';
$_lang['setting_moregallery.thumbnail_format_desc'] = 'Ustaw format (png, gif lub jpg) który zostanie użyty podczas generowania miniaturek w menadżerze. Ta opcja nie wpływa na przycięcie oryginalnego obrazu; przycinany obraz pozostanie w takim formacie, jak obraz wejściowy (oryginalny).';
$_lang['setting_moregallery.prefill_from_iptc'] = 'Prefill from IPTC';
$_lang['setting_moregallery.prefill_from_iptc_desc'] = 'When enabled the image will automatically populate the name, description and tags with information stored in the image.';
$_lang['setting_moregallery.vimeo_prefill_description'] = 'Prefill Vimeo Description';
$_lang['setting_moregallery.vimeo_prefill_description_desc'] = 'When enabled videos loaded from Vimeo will get its description set to the description of the video.';
$_lang['setting_moregallery.youtube_prefill_description'] = 'Prefill YouTube Description';
$_lang['setting_moregallery.youtube_prefill_description_desc'] = 'When enabled videos loaded from YouTube will get its description set to the description of the video.';


$_lang['setting_moregallery.translit'] = "Transliteracja";
$_lang['setting_moregallery.translit_desc'] = "When set to a value that is not \"none\" or empty, this will enable transliteration prior to the sanitization process, enabling translating of invalid characters to valid ones. If this value is empty, it will inherit from the core \"friendly_alias_translit\" setting.";

$_lang['setting_moregallery.translit_class'] = "Klasa Translit";
$_lang['setting_moregallery.translit_class_desc'] = "Nazwa klasy użytej do transliteracji. Jeżeli wartość nie zostanie wprowadzona, zostanie użyte ustawienie \"friendly_alias_translit_class\" z ustawień systemowych.";
$_lang['setting_moregallery.translit_class_path'] = "Ścieżka do klasy Translit";
$_lang['setting_moregallery.translit_class_path_desc'] = "Nazwa klasy użytej do transliteracji. Jeżeli wartość nie zostanie wprowadzona, zostanie użyte ustawienie \"friendly_alias_translit_class\" z ustawień systemowych.";
$_lang['setting_moregallery.custom_fields'] = "Pola dodatkowe";
$_lang['setting_moregallery.custom_fields_desc'] = "Pozwala na dodanie dodatkowych opcji do edycji obrazu. To ustawienie musi być wprowadzone jako obiekt JSON. Aby dowiedzieć się więcej na temat jak definiować i używać pól dodatkowych skorzystaj z <a href=\"https://www.modmore.com/moregallery/documentation/custom-fields/\">dostępnej dokumentacji</a>.";

$_lang['setting_moregallery.prefetch_image_as_base64'] = "Prefetch Images as Base64";
$_lang['setting_moregallery.prefetch_image_as_base64_desc'] = "Set to a number representing the amount of images that should be preloaded as base64 resources. While loading the images as base64 makes images show up near instant (there is no delay where the browser loads the image), it can slow down filling the gallery in the back-end for slow or remote media sources.";
$_lang['setting_moregallery.allowed_extensions_per_source'] = "Allowed Extensions per Media Source";
$_lang['setting_moregallery.allowed_extensions_per_source_desc'] = "Enable this setting to look at the media source configuration for determining the allowed extensions during upload. When disabled MoreGallery will look at the upload_images setting for allowed extensions instead. ";

$_lang['setting_mgr_tree_icon_mgresource'] = 'Ikonka galerii w drzewie plików';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'Klasa ikony Font Awesome dodawana w drzewie plików przed folderem galerii ';

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
$_lang['moregallery.mggetimages.singleimageparam_desc'] = 'Może zastąpić ustawienie systemowe moregallery.single_image_url_param na każde wywołanie snippeta. Użyteczne, jeżeli chcesz pokazać wiele galerii na jednej stronie.';
$_lang['moregallery.mggetimages.singleimageresource_desc'] = 'Used in generating the link in the view_url placeholder. Set this to a resource that should be used for showing single images if it is not the resource the image was uploaded to.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'A string to separate image templates with in gallery view.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggetimages.wrapperifempty_desc'] = 'Ustaw wartość na 0 aby użyć wrapperTpl tylko, jeżeli jest przynajmniej 1 wynik. Jeżeli wartość ustawiona na 1 wrapperTpl będzie używany zawsze, nawet bez wyników.';
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
$_lang['moregallery.mggettags.separator_desc'] = 'A string to separate tags with.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggettags.wrapperifempty_desc'] = 'Ustaw wartość na 0 aby użyć wrapperTpl tylko, jeżeli jest przynajmniej 1 wynik. Jeżeli wartość ustawiona na 1 wrapperTpl będzie używany zawsze, nawet bez wyników.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'When not empty, the snippet will set a placeholder with the output and will not output content directly.';
$_lang['moregallery.mggettags.includecount_desc'] = 'Jeżeli ustawione na 1, placeholder [[+image_count]] będzie zawierał liczbę aktywnych obrazów, które używaj tego tagu.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Used for getPage pagination, set this to a placeholder to set for the total number of results.';
$_lang['moregallery.mggettags.limit_desc'] = 'The number of images to load in the result set.';
$_lang['moregallery.mggettags.offset_desc'] = 'he number of images to skip in the result set.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';
