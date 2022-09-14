<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'MoreGallery';
$_lang['moregallery.new'] = 'Nieuwe Galerij';
$_lang['moregallery.new_description'] = 'Maak een nieuwe Galerij aan om afbeeldingen naar te uploaden.';
$_lang['moregallery.name'] = 'Galerij';
$_lang['moregallery.name_here'] = 'Maak een nieuwe galerij hier';
$_lang['moregallery.permission_denied'] = 'Sorry, je hebt niet de benodigde machtiging om deze galerij te beheren.';
$_lang['moregallery.new_tags_not_allowed'] = 'Sorry, je hebt niet de juiste machtiging om nieuwe tags toe te voegen. Selecteer een reeds bestaande tag uit de lijst om door te gaan.';
$_lang['moregallery.please_save_first'] = 'Om afbeeldingen aan de galerij toe te kunnen voegen dient deze eerst opgeslagen te worden. Na het uploaden is het hier mogelijk om afbeeldingen te uploaden.';



$_lang['moregallery.inherit'] = 'Erven';
$_lang['moregallery.inherit.desc'] = 'Gebruik the systeem standaarden.';
$_lang['moregallery.source'] = 'Media Source';
$_lang['moregallery.source.desc'] = 'De media source om afbeeldingen in op te slaan. <b>Let op:</b> reeds geuploade afbeeldingen worden na het veranderen van deze instelling NIET automatisch verplaatst, dit dient handmatig te gebeuren.';
$_lang['moregallery.relative_url'] = 'Relatieve URL';
$_lang['moregallery.relative_url.desc'] = 'De relatieve URL om afbeeldingen in de media source in op te slaan. Begint niet met een slash. <b>Let op:</b> reeds geuploade afbeeldingen worden na het veranderen van deze instelling NIET automatisch verplaatst, dit dient handmatig te gebeuren.';
$_lang['moregallery.content_position'] = 'Content Positie';
$_lang['moregallery.content_position.desc'] = 'Deze instelling bepaalt waar het Document Content veld getoond word.';

$_lang['moregallery.content_position.above'] = 'Boven Afbeeldingen';
$_lang['moregallery.content_position.below'] = 'Onder Afbeeldingen';
$_lang['moregallery.content_position.tab'] = 'In een nieuwe "Content" Tab';
$_lang['moregallery.content_position.hide'] = 'Verberg Content';

$_lang['moregallery.view_full_size_image'] = 'Bekijk afbeelding op volledige grootte';
$_lang['moregallery.delete'] = 'Verwijder';
$_lang['moregallery.delete_image'] = 'Verwijder afbeelding';
$_lang['moregallery.deactivate_image'] = 'Verberg afbeelding';
$_lang['moregallery.activate_image'] = 'Maak afbeelding zichtbaar';
$_lang['moregallery.upload_image'] = 'Upload afbeeldingen naar de Galerij';
$_lang['moregallery.upload'] = 'Upload';
$_lang['moregallery.import_image'] = 'Importeer afbeeldingen van andere bronnen';
$_lang['moregallery.import'] = 'Importeer';
$_lang['moregallery.import_media'] = 'Import van Media';
$_lang['moregallery.images_selected'] = 'afbeeldingen geselecteerd'; // is prefixed with a number for the bulk feature, e.g. "5 images selected"
$_lang['moregallery.mediamanager_not_loaded'] = 'De Media Manager is op het moment niet beschikbaar.';
$_lang['moregallery.add_video'] = 'Video toevoegen';
$_lang['moregallery.add_video_instructions'] = 'Voer hieronder een link in naar een video om deze aan de galerij toe te voegen.';
$_lang['moregallery.refresh'] = 'Ververs';
$_lang['moregallery.drop_to_upload'] = 'Laat bestanden los om deze naar de Galerij te uploaden.';
$_lang['moregallery.images_count'] = 'afbeeldingen';
$_lang['moregallery.edit_image_header'] = 'Bewerk Afbeelding';
$_lang['moregallery.name_field'] = 'Naam';
$_lang['moregallery.description'] = 'Omschrijving';
$_lang['moregallery.url'] = 'Url (of Document ID)';
$_lang['moregallery.save'] = 'Opslaan';
$_lang['moregallery.saving'] = 'Wordt opgeslagen..';
$_lang['moregallery.saved_at'] = 'Opgeslagen (om [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Weet je zeker dat je de afbeelding "[[+name]]" wilt verwijderen? De afbeelding zal van de server worden verwijderd.';
$_lang['moregallery.confirm_media_remove'] = 'Weet je zeker dat je "[[+name]]" wilt verwijderen uit de galerij? De afbeelding blijft in de Media Manager beschikbaar.';
$_lang['moregallery.confirm_video_remove'] = 'Weet je zeker dat je "[[+name]]" wilt verwijderen? De video preview zal van de server worden verwijderd.';
$_lang['moregallery.confirm_bulk_remove'] = 'Weet je zeker dat je [[+amount]] afbeeldingen wilt verwijderen? De relevante afbeeldingen zullen ook van de server worden verwijderd.';
$_lang['moregallery.preupload_very_big'] = 'Het betand [[+file]] is erg groot. Het uploaden kan een redelijke tijd duren, en na de upload heeft de server mogelijk niet genoeg geheugen om de afbeelding te verwerken. Weet je zeker dat je deze afbeelding wilt uploaden?';
$_lang['moregallery.upload_error'] = 'Oeps, er is iets niet goed gegaan tijdens het uploaden van het bestand [[+file]]: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Het geuploade bestand was ruim [[+size]]mb in grootte, wat mogelijk te groot is geweest voor de server om te uploaden of te verwerken. Probeer om het bestand te verkleinen voor deze te uploaden.';
$_lang['moregallery.model_error'] = 'Een onverwachte fout is opgetreden, de afbeelding representatie kon niet worden gevonden. Probeer de pagina te verversen.';
$_lang['moregallery.video_load_error'] = 'De video informatie kon niet worden geladen. Dit kan zijn omdat de video niet bestaat, of omdat deze als privé is gemarkeerd.';

$_lang['moregallery.error_invalid_resource'] = 'Een onverwachte fout is opgetreden, document "[[+resource]]" is geen Galerij.';
$_lang['moregallery.error_loading_source'] = 'Er is een fout opgetreden bij het laden van de Media Source voor deze Galerij.';
$_lang['moregallery.error_invalid_filetype'] = 'Sorry, .[[+extension]] bestanden zijn niet toegestaan.';
$_lang['moregallery.error_upload_failed'] = 'het bestand kon niet geüpload worden (foutmelding [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tags';
$_lang['moregallery.tags.add'] = 'Toevoegen';
$_lang['moregallery.tags.remove'] = 'Verwijder';
$_lang['moregallery.tags.cant_be_empty'] = 'Het label mag niet leeg zijn.';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Het bestand wat geïmporteerd moet worden lijkt niet te bestaan of is niet leesbaar: [[+file]]';
$_lang['moregallery.edit_crop'] = 'Bewerk uitsnede';
$_lang['moregallery.save_crop'] = 'Uitsnede opslaan';
$_lang['moregallery.preview_crop'] = 'Uitsnede bekijken';
$_lang['moregallery.processing_crop'] = 'Verwerken...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'Mediabron Relatieve URL';
$_lang['setting_moregallery.source_relative_url_desc'] = 'De URL relatief van de root van de geselecteerde media bron waar de afbeeldingen naar geüpload moeten worden. Dit kan per Galerij document overschreven worden op het Instellingen tabje.';

$_lang['setting_moregallery.source'] = 'Mediabron';
$_lang['setting_moregallery.source_desc'] = 'Kies een mediabron om de afbeelding naar toe te uploaden. Dit kan per Galerij document overschreven worden op het tabblad Instellingen.';

$_lang['setting_moregallery.image_id_in_name'] = 'Afbeelding ID in de bestandsnaam';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Stel deze instelling in op "prefix" of "suffix" om de afbeelding ID aan de bestandsnaam toe te voegen tijdens de upload. Hierdoor weet je zeker dat de bestandsnaam uniek is. ';
$_lang['setting_moregallery.image_id_separator'] = 'Afbeelding ID scheidingsteken';
$_lang['setting_moregallery.image_id_separator_desc'] = 'Het scheidingsteken dat gebruikt moet worden tussen de bestandsnaam en het afbeelding nummer op nieuwe afbeeldingen.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Document ID in pad';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'Als dit ingeschakeld is zal het ID van de Galerij aan de Mediabron Relatieve URL worden toegevoegd waardoor elke galerij zijn eigen map heeft. ';
$_lang['setting_moregallery.content_position'] = 'Content Positie';
$_lang['setting_moregallery.content_position_desc'] = 'Stel in op "above", "below", "tab" of "hide" om aan te geven hoe het inhoudsveld getoond moet worden, of helemaal niet.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Gebruik Rich Text Editor';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'Als deze instelling ingeschakeld is zal de huidige rich text editor geladen worden voor de omschrijving van afbeeldingen. We raden Redactor aan, maar andere editors zijn ook ondersteund. ';
$_lang['setting_moregallery.crops'] = 'Uitsneden';
$_lang['setting_moregallery.crops_desc'] = 'Stel hier de crops configuratie in om zogenaamde "Region of Interest" cropping in te schakelen. Een voorbeeld van een geldige waarde is: <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. Aangezien dit een geavanceerde functie in raden we aan de <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">volledige documentatie</a> te lezen voor meer informatie over de syntax en ondersteunde functionaliteit. ';
$_lang['setting_moregallery.single_image_url_param'] = 'Afbeelding URL parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Deze instelling wordt gebruikt met de mgGetImages snippet, waarbij het beschikbaar zijn van de deze parameter aangeeft dat enkel de aangegeven afbeelding getoond  moet worden. Mocht de afbeelding niet gevonden zijn dan wordt de gebruiker naar de 404 pagina gestuurd. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Icoon aan Toolbar toevoegen';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'Indien ingeschakeld zal een "Nieuwe Galerij" icoon aan de resource toolbar worden toegevoegd, waarmee je eenvoudig een nieuwe galerij kunt aanmaken.';

$_lang['setting_moregallery.sanitize_replace'] = 'Opschoon Vervanging';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Alle tekens in de naam van geüploade afbeeldingen die niet aan het opschoon patroon voldoen worden vervangen door het karakter in deze instelling. ';
$_lang['setting_moregallery.sanitize_pattern'] = 'Opschoon Patroon';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'Een RegEx patroon waar de naam van een afbeelding aan moet voldoen.';
$_lang['setting_moregallery.crop_jpeg_quality'] = 'JPEG Crop Kwaliteit';
$_lang['setting_moregallery.crop_jpeg_quality_desc'] = 'Voor JPEG afbeeldingen is het mogelijk de kwaliteit van de gegenereerde thumbnails aan te geven, met een nummer tussen 0 en 100.';
$_lang['setting_moregallery.png_compression_level'] = 'PNG Compressieniveau';
$_lang['setting_moregallery.png_compression_level_desc'] = 'Voor PNG afbeeldingen is het mogelijk de kwaliteit van gegenereerde thumbnails te bepalen met een nummer tussen 0 en 9, waarbij 9 de hoogste kwaliteit is.';
$_lang['setting_moregallery.thumbnail_format'] = 'Manager Thumbnail Format';
$_lang['setting_moregallery.thumbnail_format_desc'] = 'De indeling (png, gif of jpg) dat gebruikt wordt voor thumbnails in de manager (mgr_thumb waarde). Dit heeft geen effect op image crops; die gebruiken altijd dezelfde indeling als het originele bestand.';
$_lang['setting_moregallery.prefill_from_iptc'] = 'Voorvullen uit IPTC';
$_lang['setting_moregallery.prefill_from_iptc_desc'] = 'Wanneer deze instelling is ingeschakeld zullen de naam, omschrijving en tags automatisch worden voorgevuld met Iptc gegevens uit de afbeelding.';
$_lang['setting_moregallery.vimeo_prefill_description'] = 'Vimeo omschrijving voorvullen';
$_lang['setting_moregallery.vimeo_prefill_description_desc'] = 'Als deze instelling is ingeschakeld zal de omschrijving van videos die vanuit Vimeo ingeladen zijn, automatisch worden gevuld met de omschrijving van de video op Vimeo.';
$_lang['setting_moregallery.youtube_prefill_description'] = 'YouTube omschrijving voorvullen';
$_lang['setting_moregallery.youtube_prefill_description_desc'] = 'Als deze instelling is ingeschakeld zal de omschrijving van videos die vanuit YouTube ingeladen zijn, automatisch worden gevuld met de omschrijving van de video op YouTube.';


$_lang['setting_moregallery.translit'] = "Transliteratie";
$_lang['setting_moregallery.translit_desc'] = "Indien je hier geen lege waarde of \"none\" opgeeft zal transliteratie worden ingeschakeld voordat bestandsnamen worden opgeschoond, waarmee ongeschikte karakters omgezet kunnen worden naar geschikte karakters. Als deze setting leeg is zal de core \"friendly_alias_translit\" setting gebruikt worden.";

$_lang['setting_moregallery.translit_class'] = "Transliteratie Class";
$_lang['setting_moregallery.translit_class_desc'] = "De naam van de class om te gebruiken voor transliteratie. Indien deze setting leeg is zal de core \"friendly_alias_translit_class\" setting worden gebruikt.";
$_lang['setting_moregallery.translit_class_path'] = "Transliteratie Class Pad";
$_lang['setting_moregallery.translit_class_path_desc'] = "Het pad naar de class om te gebruiken voor transliteratie. Indien deze setting leeg is zal de core \"friendly_alias_translit_class_path\" setting worden gebruikt.";
$_lang['setting_moregallery.custom_fields'] = "Extra Velden";
$_lang['setting_moregallery.custom_fields_desc'] = "Maakt het mogelijk om extra velden of opties toe te voegen aan de window waarin afbeeldingen worden bewerkt. Deze setting verwacht een JSON object. Voor meer informatie over hoe custom velden gedefinieerd en gebruikt worden <a href=\"https://www.modmore.com/moregallery/documentation/custom-fields/\">kunt u de documentatie hier vinden</a>.";

$_lang['setting_moregallery.prefetch_image_as_base64'] = "Prefetch afbeeldingen als Base64";
$_lang['setting_moregallery.prefetch_image_as_base64_desc'] = "Stel hier het aantal afbeeldingen in die ingeladen moeten worden als base64 documenten. Tijdens het laden van afbeeldingen in de manager zijn afbeeldingen die als base64 zijn ingeladen vrijwel direct zichtbaar. Dit kan wel het laden van de galerij in de back-end trager maken in het geval van langzame of externe mediabronnen.";
$_lang['setting_moregallery.allowed_extensions_per_source'] = "Toegestane bestandsformaten per mediabron";
$_lang['setting_moregallery.allowed_extensions_per_source_desc'] = "Schakel deze instelling in om per mediabron te bepalen welke afbeeldingsformaten toegestaan zijn tijdens upload. Als deze instelling uit staat zal naar de upload_images instelling worden gekeken. ";

$_lang['setting_mgr_tree_icon_mgresource'] = 'Galerij Icoon';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'De Font Awesome icoon class om te gebruiken in de document tree om een Galerij toe te voegen. ';

$_lang['setting_moregallery.vimeo_provide_referer'] = 'Stuur verzoekdomein naar Vimeo';
$_lang['setting_moregallery.vimeo_provide_referer_desc'] = 'Als een video van Vimeo wordt geïmporteerd met deze instelling aan, dan zal MoreGallery de site url meesturen naar Vimeo. Hierdoor kunnen video\'s met domain-level privacy succesvol geladen worden. Gebruik je geen domain-level privacy? Dan kan deze instelling uit.';

$_lang['setting_moregallery.data_consent'] = 'Gegevensdeling niveau';
$_lang['setting_moregallery.data_consent_desc'] = 'MoreGallery deelt automatisch informatie over de implementatie met modmore. Welke gegevens precies gedeeld worden, kun je met deze instelling beheren. Voor meer informatie over hoe de gegevensdeling werkt, en welke niveaus ondersteund zijn, zie: https://docs.modmore.com/en/MoreGallery/v1.x/Data_Sharing.html';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'De galerij output cachen?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Geef een resource ID, of komma gescheiden lijst van resource IDs, waar afbeeldingen van geladen moeten worden.';
$_lang['moregallery.mggetimages.activeonly_desc'] = 'Met deze optie ingeschakeld worden alleen actieve afbeeldingen getoond. Schakel deze instelling uit om ook inactieve afbeeldingen te tonen.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Het veld waarop afbeeldingen worden gesorteerd. De mogelijk waarden zijn: filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'De richting voor het sorteren van de afbeeldingen. Dit kan "asc" of "desc" zijn. ';
$_lang['moregallery.mggetimages.tags_desc'] = 'Een komma gescheiden lijst met tag namen of IDs om afbeeldingen op te filteren.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Stel de naam van een URL paramater in waarmee op tags gefilterd kan worden.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'Een tekenreeks om tag templates van elkaar te scheiden in de afbeelding templates.';
$_lang['moregallery.mggetimages.gettags_desc'] = 'Als dit is ingeschakeld zullen tags voor elke afbeeldingen worden geladen.';
$_lang['moregallery.mggetimages.getresourcecontent_desc'] = 'Indien ingeschakeld zal de resource content in de afbeeldingstemplate beschikbaar zijn.';
$_lang['moregallery.mggetimages.getresourceproperties_desc'] = 'Indien ingeschakeld zullen de document properties in de afbeeldingstemplate beschikbaar zijn.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'Indien ingeschakeld zullen document velden in de afbeeldingstemplate beschikbaar zijn. ';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Geef een komma gescheiden lijst op van template variabel namen die geladen moeten worden in de afbeelding template.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'De naam van een chunk om voor tags te gebruiken.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'De naam van een chunk om te gebruiken als template voor de afbeeldingen.';
$_lang['moregallery.mggetimages.mediatpl_desc'] = 'De naam van een chunk om te gebruiken voor afbeeldingen die uit Sterc\'s Media Manager zijn geïmporteerd. Als je niks opgeeft zal dit dezelfde chunk gebruiken als de imageTpl.';
$_lang['moregallery.mggetimages.youtubetpl_desc'] = 'De naam van een chunk om te gebruiken als template voor YouTube videos.';
$_lang['moregallery.mggetimages.vimeotpl_desc'] = 'De naam van een chunk om te gebruiken als template voor Vimeo videos.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'De naam van een chunk om te gebruiken wanneer een afbeelding in single-image-view getoond wordt';
$_lang['moregallery.mggetimages.singlemediatpl_desc'] = 'De naam van een chunk om te gebruiken bij het tonen van een enkele afbeelding die uit Sterc\'s Media Manager is geïmporteerd. Als je niks opgeeft zal dit dezelfde chunk gebruiken als de singleImageTpl.';
$_lang['moregallery.mggetimages.singleyoutubetpl_desc'] = 'De naam van een chunk om te gebruiken wanneer een YouTube video in single-image-view getoond wordt.';
$_lang['moregallery.mggetimages.singlevimeotpl_desc'] = 'De naam van een chunk om te gebruiken wanneer een Vimeo video in single-image-view getoond wordt.';
$_lang['moregallery.mggetimages.singleimageenabled_desc'] = 'Wanneer ingesteld op 1 zal de snippet reageren op requests met de singleImageParam URL parameter, door een enkele afbeelding te tonen.';
$_lang['moregallery.mggetimages.singleimageparam_desc'] = 'Kan gebruikt worden om de moregallery.single_image_url_param systeem instelling te overschrijven per snippet call. Handig als je meerdere galerijen op dezelfde pagina wilt tonen.';
$_lang['moregallery.mggetimages.singleimageresource_desc'] = 'Dit wordt gebruikt in de view_url placeholder. Stel hier de resource in waar de single-image-view op getoond moet worden, als dit niet dezelfde resource is waar de afbeelding van geladen wordt.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'Een tekenreeks om afbeelding templates van elkaar te scheiden in de galerijweergave.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'Indien opgegeven zal deze naam van een chunk gebruikt worden als wrapper voor de complete output.';
$_lang['moregallery.mggetimages.wrapperifempty_desc'] = 'Stel in op 0 om de wrapperTpl alleen te gebruiken als er minstens 1 resultaat is. Wanneer deze property is ingesteld op 1 zal de wrapperTpl altijd gebruikt worden, zelfs zonder resultaten.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'Indien opgegeven zal de snippet een placeholder instellen met deze naam, waarin de volledige output wordt opgeslagen.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Gebruikt voor paginatie met getPage, deze placeholder zal het totaal aantal resultaten bevatten.';
$_lang['moregallery.mggetimages.limit_desc'] = 'Het aantal afbeeldingen dat geladen moet worden.';
$_lang['moregallery.mggetimages.offset_desc'] = 'Het aantal afbeeldingen dat aan het begin van de resultaten overgeslagen moet worden.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'Het schema wat gebruikt moet worden voor het generen van URLs; standaard zal dit de waarde zijn van de link_tag_scheme instelling.';
$_lang['moregallery.mggetimages.where_desc'] = 'Een generieke conditie kan door middel van deze parameter worden toegevoegd aan de query, in JSON formaat. Bijvoorbeeld {"uploadedby":4} of {"name:LIKE":"%train%"} ';
$_lang['moregallery.mggetimages.debug_desc'] = 'Indien ingeschakeld zal er een debug log getoond worden (bijvoorbeeld voor bug reports) aan het einde van de snippet output.';
$_lang['moregallery.mggetimages.timing_desc'] = 'Indien ingeschakeld zal de totale verwerkingstijd voor de snippet aan het eind van de uitvoer worden toegevoegd.';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Cache de Tag resultaten?';
$_lang['moregallery.mggettags.resource_desc'] = 'Geef een document ID op om tags van te laden.';
$_lang['moregallery.mggettags.sortby_desc'] = 'Het veld om op te sorteren. Geldige waarden: display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'De richting voor het sorteren van de tags. Dit kan "asc" of "desc" zijn.';
$_lang['moregallery.mggettags.tpl_desc'] = 'De naam van een chunk om te gebruiken als template voor de tags.';
$_lang['moregallery.mggettags.separator_desc'] = 'Een tekenreeks om tussen tags te gebruiken.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'Indien opgegeven zal deze naam van een chunk gebruikt worden als wrapper voor de complete output.';
$_lang['moregallery.mggettags.wrapperifempty_desc'] = 'Stel in op 0 om de wrapperTpl alleen te gebruiken als er minstens 1 resultaat is. Wanneer deze property is ingesteld op 1 zal de wrapperTpl altijd gebruikt worden, zelfs zonder resultaten.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'Indien opgegeven zal de snippet een placeholder instellen met deze naam, waarin de volledige output wordt opgeslagen.';
$_lang['moregallery.mggettags.includecount_desc'] = 'Wanneer ingesteld op 1 zal de [[+image_count]] placeholder het aantal actieve afbeelding dat de tag gebruikt bevatten.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Gebruikt voor paginatie met getPage, deze placeholder zal het totaal aantal resultaten bevatten.';
$_lang['moregallery.mggettags.limit_desc'] = 'Het aantal tags dat geladen moet worden.';
$_lang['moregallery.mggettags.offset_desc'] = 'Het aantal tags dat aan het begin van de resultaten overgeslagen moet worden.';
$_lang['moregallery.mggettags.where_desc'] = 'Een generieke conditie kan door middel van deze parameter worden toegevoegd aan de query, in JSON formaat. {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';
