<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'MoreGallery';
$_lang['moregallery.new'] = 'Nytt galleri';
$_lang['moregallery.new_description'] = 'Skapa ett nytt gallery som du kan ladda upp bilder till.';
$_lang['moregallery.name'] = 'Galleri';
$_lang['moregallery.name_here'] = 'Skapa ett galleri här';
$_lang['moregallery.permission_denied'] = 'Tyvärr, du har inte de nödvändiga rättigheterna för att hantera detta galleri.';
$_lang['moregallery.new_tags_not_allowed'] = 'Tyvärr, du har inte de nödvändiga rättigheterna för att lägga till nya taggar. Vänligen välj en existerande tagg genom att börja skriva i inmatningsfältet.';
$_lang['moregallery.please_save_first'] = 'Du måste spara galleriet innan du kan börja lägga till bilder. Efter att du har sparat galleriet kan du ladda upp bilder här.';



$_lang['moregallery.inherit'] = 'Ärv';
$_lang['moregallery.inherit.desc'] = 'Använd systemstandardvärdena.';
$_lang['moregallery.source'] = 'Mediakälla';
$_lang['moregallery.source.desc'] = 'Den mediakälla som bilderna ska sparas i. <b>Obs:</b> Om du ändrar denna efter att du har lagt till bilder kommer de bilderna INTE att flyttas automatiskt. Du måste flytta dem själv.';
$_lang['moregallery.relative_url'] = 'Relativ URL';
$_lang['moregallery.relative_url.desc'] = 'Den relativa URL:en till mediakällan där bilderna ska sparas. Börja inte med ett snedstreck (slash). <b>Obs:</b> Om du ändrar denna efter att du har lagt till bilder kommer de bilderna INTE att flyttas automatiskt. Du måste flytta dem själv.';
$_lang['moregallery.content_position'] = 'Innehållsfältets position';
$_lang['moregallery.content_position.desc'] = 'Flytta resursens innehållsfält till en annan, mer praktisk plats.';

$_lang['moregallery.content_position.above'] = 'Ovanför bilderna';
$_lang['moregallery.content_position.below'] = 'Nedanför bilderna';
$_lang['moregallery.content_position.tab'] = 'På fliken innehåll';
$_lang['moregallery.content_position.hide'] = 'Dölj';

$_lang['moregallery.view_full_size_image'] = 'Visa bilden i full storlek';
$_lang['moregallery.delete'] = 'Delete';
$_lang['moregallery.delete_image'] = 'Ta bort bilden';
$_lang['moregallery.deactivate_image'] = 'Dölj bild från galleriet';
$_lang['moregallery.activate_image'] = 'Märk bilden som synlig';
$_lang['moregallery.upload_image'] = 'Ladda upp bilder till galleriet';
$_lang['moregallery.upload'] = 'Ladda upp';
$_lang['moregallery.import_image'] = 'Importera bilder från andra källor';
$_lang['moregallery.import'] = 'Importera';
$_lang['moregallery.import_media'] = 'Importera från Media';
$_lang['moregallery.images_selected'] = 'bilder valda'; // is prefixed with a number for the bulk feature, e.g. "5 images selected"
$_lang['moregallery.mediamanager_not_loaded'] = 'Media Manager är för närvarande inte tillgänglig.';
$_lang['moregallery.add_video'] = 'Lägg till video';
$_lang['moregallery.add_video_instructions'] = 'Ange videons URL nedan för att importera den till galleriet.';
$_lang['moregallery.refresh'] = 'Uppdatera';
$_lang['moregallery.drop_to_upload'] = 'Dra och släpp bilder för att ladda upp dem till galleriet';
$_lang['moregallery.images_count'] = 'bilder';
$_lang['moregallery.edit_image_header'] = 'Redigera bilden';
$_lang['moregallery.name_field'] = 'Namn';
$_lang['moregallery.description'] = 'Beskrivning';
$_lang['moregallery.url'] = 'URL (eller resursens ID)';
$_lang['moregallery.save'] = 'Spara';
$_lang['moregallery.saving'] = 'Sparar..';
$_lang['moregallery.saved_at'] = 'Sparad (kl [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Är du säker på att du vill ta bort "[[+name]]"? Bilden kommer att raderas från servern.';
$_lang['moregallery.confirm_media_remove'] = 'Är du säker på att du vill radera "[[+name]]" från galleriet? Bilderna kommer att finnas kvar i Media Manager.';
$_lang['moregallery.confirm_video_remove'] = 'Är du säker på att du vill ta bort "[[+name]]"? Miniatyrbilden kommer att raderas från servern.';
$_lang['moregallery.confirm_bulk_remove'] = 'Är du säker på att du vill ta bort [[+amount]] bilder? Relaterade bildfiler kommer att raderas från servern.';
$_lang['moregallery.preupload_very_big'] = 'Filen "[[+file]]" är väldigt stor. Det kan ta lång tid att ladda upp den, och servern har kanske inte tillräckligt med minne för att bearbeta den sen. Är du säker på att du vill fortsätta?';
$_lang['moregallery.upload_error'] = 'Aj då, ett fel uppstod när bilden [[+file]] skulle laddas upp: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Den uppladdade bilden var över [[+size]]MB i storlek, vilken kan ha varit för mycket för servern att hantera. Prova att minska storleken på bilden innan du laddar upp den igen.';
$_lang['moregallery.model_error'] = 'Ett oväntat fel uppstod, bildens typ kunde inte hittas. Prova med att uppdatera sidan.';
$_lang['moregallery.video_load_error'] = 'Videons information kunde inte hämtas. Det beror antagligen på att videon inte existerar, eller att den är markerad som privat.';

$_lang['moregallery.error_invalid_resource'] = 'Ett oväntat fel uppstod, resursen "[[+resource]]" är inte ett giltigt galleri.';
$_lang['moregallery.error_loading_source'] = 'Ett fel uppstod när galleriets mediakälla skulle laddas.';
$_lang['moregallery.error_invalid_filetype'] = 'Filer av typen .[[+extension]] är inte tillåtna.';
$_lang['moregallery.error_upload_failed'] = 'filen kunde inte laddas upp (Fel [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Bildens taggar';
$_lang['moregallery.tags.add'] = 'Lägg till';
$_lang['moregallery.tags.remove'] = 'Remove';
$_lang['moregallery.tags.cant_be_empty'] = 'Taggen kan inte vara tom.';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Filen som ska importeras verkar inte existera eller är inte läsbar: [[+file]]';
$_lang['moregallery.edit_crop'] = 'Redigera klipp';
$_lang['moregallery.save_crop'] = 'Spara klipp';
$_lang['moregallery.preview_crop'] = 'Förhandsgranska klipp';
$_lang['moregallery.processing_crop'] = 'Bearbetar...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'Relativ URL till källa';
$_lang['setting_moregallery.source_relative_url_desc'] = 'Relativ URL till roten för vald mediakälla som bilder skall laddas upp till. Kan åsidosättas per galleri resurs under fliken Inställningar.';

$_lang['setting_moregallery.source'] = 'Mediakälla';
$_lang['setting_moregallery.source_desc'] = 'Välj mediakälla att ladda upp bilder till. Kan åsidosättas per galleri resurs under fliken Inställningar.';

$_lang['setting_moregallery.image_id_in_name'] = 'Bild-ID i filnamn';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Sätt till antingen "prefix" eller "suffix" för att lägga till bild-ID i filnamnet vid uppladdning. Detta försäkrar att filnamnet är unikt.';
$_lang['setting_moregallery.image_id_separator'] = 'Avgränsare för bild-ID';
$_lang['setting_moregallery.image_id_separator_desc'] = 'Den avgränsare som ska användas mellan filnamnet och bild-ID för nyligen uppladdade eller importerade bilder.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Resurs-ID i sökväg';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'När aktiverat kommer galleriets resurs-ID att läggas till i slutet av källans relativa URL så att varje galleri har en egen mapp.';
$_lang['setting_moregallery.content_position'] = 'Innehållsposition';
$_lang['setting_moregallery.content_position_desc'] = 'Sätt till "över", "under", "flik" eller "dölj" för att bestämma hur innehållsfältet visas, om alls.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Använd Rich Text redigerare';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'När aktiverat kommer den aktiva rich text redigeraren att laddas in i bild beskrivningsfältet. Vi rekommenderar att man använder Redactor, men andra redigerare stöds också.';
$_lang['setting_moregallery.crops'] = 'Klipp';
$_lang['setting_moregallery.crops_desc'] = 'Ange konfigurationen för Crops här för att aktivera beskärning av bilderna så att det intressanta området visas. Ett exempel kan vara <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. Eftersom det här är en avancerad funktion så hänvisas du till den <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">fullständiga dokumentationen för Crops</a> för mer information om syntax och funktionalitet.';
$_lang['setting_moregallery.single_image_url_param'] = 'URL parameter för enstaka bild';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'URL parametern för enstaka bild används tillsammans med mgGetImages snippeten för att avgöra om en enstaka bild eller en full listning ska visas. Den här URL parametern kommer att innehålla ID:t för bilden, och om det inte hittas kommer användaren att skickas till 404-felsidan. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Lägg till ikon i verktygsfältet';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'När den är aktiverad, kommer ikonen för "Nytt Galleri" att läggas till verktygsfältet för resurser för att ge snabb åtkomst till att skapa nya gallerier.';

$_lang['setting_moregallery.sanitize_replace'] = 'Saneringsersättning';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Alla tecken i de uppladdade filnamnen som inte matchar saneringsmönstret kommer att ersättas med detta tecken.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Saniteringsmönster';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'Ett RegEx mönster för att rensa upp filnamn vid uppladdning.';
$_lang['setting_moregallery.crop_jpeg_quality'] = 'Kvalitet för JPEG Crop';
$_lang['setting_moregallery.crop_jpeg_quality_desc'] = 'Du kan kontrollera kvaliteten för de tumnaglar som genereras för JPEG-bilder genom att ange ett nummer mellan 0 och 100.';
$_lang['setting_moregallery.png_compression_level'] = 'Komprimeringsnivå för PNG';
$_lang['setting_moregallery.png_compression_level_desc'] = 'Du kan kontrollera kvaliteten för de tumnaglar som genereras för PNG-bilder genom att ange ett nummer mellan 0 och 9 där 9 innebär högst kvalitet.';
$_lang['setting_moregallery.thumbnail_format'] = 'Format för tumnaglar i hanteraren';
$_lang['setting_moregallery.thumbnail_format_desc'] = 'Ange det format (png, gif eller jpg) som ska användas för tumnaglar i hanteraren (mgr_thumb). Detta påverkar inte beskärning av bilder; där kommer samma format att användas som för originalbilden.';
$_lang['setting_moregallery.prefill_from_iptc'] = 'Förifyll från IPTC';
$_lang['setting_moregallery.prefill_from_iptc_desc'] = 'När aktiverad kommer namn, beskrivning och taggar att förifyllas med information lagrad i bildfilen.';
$_lang['setting_moregallery.vimeo_prefill_description'] = 'Förifyll beskrivning från Vimeo';
$_lang['setting_moregallery.vimeo_prefill_description_desc'] = 'När aktiverad, kommer filmer som hämtas från Vimeo att få sin beskrivning satt till beskrivningen på filmen där.';
$_lang['setting_moregallery.youtube_prefill_description'] = 'Förifyll beskrivning från YouTube';
$_lang['setting_moregallery.youtube_prefill_description_desc'] = 'När aktiverad, kommer filmer som hämtas från YouTube att få sin beskrivning satt till beskrivningen på filmen där.';


$_lang['setting_moregallery.translit'] = "Transkribering";
$_lang['setting_moregallery.translit_desc'] = "När värdet inte är \"none\" eller tomt aktiverar detta transkribering innan saneringsprocessen, som översätter felaktiga tecken till tillåtna sådana. Om detta värde är tomt, ärver den det från kärnans \"friendly_alias_translit\" inställning.";

$_lang['setting_moregallery.translit_class'] = "Klass för transkribering";
$_lang['setting_moregallery.translit_class_desc'] = "Namnet på den klass som skall användas för transkribering. Om detta värde är tomt, ärver den det från kärnans \"friendly_alias_translit_class\" inställning.";
$_lang['setting_moregallery.translit_class_path'] = "Sökväg till klass för transkribering";
$_lang['setting_moregallery.translit_class_path_desc'] = "Sökvägen till klassen att använda för transkribering. Om detta värde är tomt ärver det från kärnans \"friendly_alias_translit_class_path\" inställning.";
$_lang['setting_moregallery.custom_fields'] = "Anpassade fält";
$_lang['setting_moregallery.custom_fields_desc'] = "Tillåter dig att lägga till ytterligare alternativ till dialogrutan frö att editera en bild. Den här inställningen kräver ett JSON-objekt. För ytterligare information om hur anpassade fält definieras och används, vänligen <a href=\"https://www.modmore.com/moregallery/documentation/custom-fields/\">läs dokumentationen här</a>.";

$_lang['setting_moregallery.prefetch_image_as_base64'] = "Förladda bilder som Base64";
$_lang['setting_moregallery.prefetch_image_as_base64_desc'] = "Ange ett tal som representerar det antal bilder som ska förladdas som Base64-resurser. Vi inläsning av bilder som Base64 kommer bilderna att visas i nära realtid (det blir ingen fördröjning när webbläsaren laddar in bilden). Det kan ta längre tid att fylla galleriet i hanteraren för långsamma eller avlägsna mediekällor.";
$_lang['setting_moregallery.allowed_extensions_per_source'] = "Tillåtna filändelser per mediakälla";
$_lang['setting_moregallery.allowed_extensions_per_source_desc'] = "Aktivera den här inställningen för att använda mediekällans inställningar över tillåtna filändelser vid uppladdning. Om den är inaktiverad kommer MoreGallery att titta på inställningen upload_images istället.";

$_lang['setting_mgr_tree_icon_mgresource'] = 'Galleri trädikon';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'Font Awesome ikonklassen att lägga till för MoreGallery resurser i filträdet. ';

$_lang['setting_moregallery.vimeo_provide_referer'] = 'Send referer to Vimeo';
$_lang['setting_moregallery.vimeo_provide_referer_desc'] = 'When embedding a Vimeo video with this setting enabled, MoreGallery will send your site url to Vimeo. This allows videos with domain-level privacy to be successfully loaded. If you don\'t use domain-level privacy, this can be disabled.';

$_lang['setting_moregallery.data_consent'] = 'Data Consent Level';
$_lang['setting_moregallery.data_consent_desc'] = 'MoreGallery shares implementation information with modmore automatically. You can configure what data may be shared with this setting. For details on how this works and what levels are supported, please visit: https://docs.modmore.com/en/MoreGallery/v1.x/Data_Sharing.html';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Cachea galleri utdata?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Ange ett resurs-ID eller flera kommaseparerade ID:n att hämta bilder ifrån.';
$_lang['moregallery.mggetimages.activeonly_desc'] = 'När aktiverad kommer enbart aktiva bilder att visas. Inaktivera för att också visa inaktiva bilder.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Fältet att sortera utifrån. Giltiga värden: filnamn, namn, beskrivning, sorteringsordning, uppladdningsdatum, editeringsdatum';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'Riktningen som bilderna ska sorteras i. Det kan vara "asc" (stigande) eller "desc" (fallande).';
$_lang['moregallery.mggetimages.tags_desc'] = 'En kommaseparerad lista över namn på taggar eller ID: n att filtrera bilderna utifrån.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Ange namnet på en URL-parameter för att få taggar att filtrera utifrån.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'En sträng för att separera mallen för taggar med för var och en av bilderna.';
$_lang['moregallery.mggetimages.gettags_desc'] = 'När aktiverad kommer taggar att laddas in för varje bild.';
$_lang['moregallery.mggetimages.getresourcecontent_desc'] = 'När aktiverad kommer resursens innehåll att laddas in och vara tillgängligt i bildens mall.';
$_lang['moregallery.mggetimages.getresourceproperties_desc'] = 'När aktiverad kommer resursens inställningar att laddas in och vara tillgängligt i bildens mall.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'När aktiverad, kommer resursfält att laddas in till bildmallen.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Ange en kommaseparerad lista över mallvariabler att ladda in i bildmallen.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'Namnet på en Chunk som ska användas som mall för taggar.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'Namnet på en Chunk som ska användas som mall för bilder.';
$_lang['moregallery.mggetimages.mediatpl_desc'] = 'Namnet på en Chunk att ladda in som mall för bilder som importerats från Sterc\'s Media Manager. Defaultvärdet är värdet av imageTpl.';
$_lang['moregallery.mggetimages.youtubetpl_desc'] = 'Namnet på en Chunk att ladda in för att använda som mall för inbäddade filmer från YouTube.';
$_lang['moregallery.mggetimages.vimeotpl_desc'] = 'Namnet på en Chunk att ladda in för att använda som mall för inbäddade filmer från Vimeo.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'Namnet på en Chunk som ska användas som mall då en bild visas i läget för enskild bild.';
$_lang['moregallery.mggetimages.singlemediatpl_desc'] = 'Namnet på en Chunk att ladda in när en bild visas i läget för enskilda bilder, och bilden har importerats från Sterc\'s Media Manager. Defaultvärdet är värdet av singleImageTpl.';
$_lang['moregallery.mggetimages.singleyoutubetpl_desc'] = 'Namnet på en Chunk som ska användas som mall då ett videoklipp från YouTube visas i läget för enskild bild.';
$_lang['moregallery.mggetimages.singlevimeotpl_desc'] = 'Namnet på en Chunk som ska användas som mall då ett videoklipp från Vimeo visas i läget för enskild bild.';
$_lang['moregallery.mggetimages.singleimageenabled_desc'] = 'När värdet är 1, kommer snippeten att svara på anrop med URL -parametern singleImageParam genom att visa vyn för enstaka bilder.';
$_lang['moregallery.mggetimages.singleimageparam_desc'] = 'Kan användas för att överida systeminställningen moregallery.single_image_url_param per snippetanrop. Det är användbart om du vill visa flera gallerier på samma sida.';
$_lang['moregallery.mggetimages.singleimageresource_desc'] = 'Används för att generera länken i platshållaren view_url. Sätt den till en resurs som ska användas för att visa enstaka bilder om det är en annan än den resurs som bilden laddades upp till.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'En sträng för att separera mallarna för bilder med i gallerivyn.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'När den inte är tom, kommer den angivna Chunken att användas för att omsluta hela resultatet.';
$_lang['moregallery.mggetimages.wrapperifempty_desc'] = 'Sätt till 0 för att bara använda wrapperTpl om det finns minst en bild att visa. När den är satt till 1 kommer wrapperTpl alltid användas, även om det inte finns några bilder.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'När den inte är tom, kommer snippeten att placera resultatet i en platshållare istället för att visa resultatet direkt.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Används för sidbrytning via getPage, ange den platshållare som ska användas för det totala antalet resultat.';
$_lang['moregallery.mggetimages.limit_desc'] = 'Antalet bilder att ladda in.';
$_lang['moregallery.mggetimages.offset_desc'] = 'Antal bilder att hoppa över.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'Det schema som ska användas för att generera URL:er; standardvärdet är värdet för link_tag_scheme.';
$_lang['moregallery.mggetimages.where_desc'] = 'Ett generellt villkor att lägga till sökfrågan kan läggas till här, i JSON-format. Till exempel {"uploadedby":4} eller {"name:LIKE":"%train%"}. ';
$_lang['moregallery.mggetimages.debug_desc'] = 'Aktivera för att lägga till en felsökningsinformation (användbar för felrapporter) i slutet på snippetens utdata.';
$_lang['moregallery.mggetimages.timing_desc'] = 'Aktivera för att lägga till den totala hanteringstiden i slutet av snippetens utdata.';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Ska taggresultatet lagras i cachen?';
$_lang['moregallery.mggettags.resource_desc'] = 'Ange ett resurs ID att hämta taggar ifrån.';
$_lang['moregallery.mggettags.sortby_desc'] = 'Fältet att sortera efter. Giltiga värden är display eller createdon.';
$_lang['moregallery.mggettags.sortdir_desc'] = 'Riktningen som taggarna ska sorteras i. Det kan vara "asc" (stigande) eller "desc" (fallande).';
$_lang['moregallery.mggettags.tpl_desc'] = 'Namnet på en Chunk som ska användas som mall för taggar.';
$_lang['moregallery.mggettags.separator_desc'] = 'En sträng att separata taggarna med.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'När den inte är tom, kommer den angivna Chunken att användas för att omsluta hela resultatet.';
$_lang['moregallery.mggettags.wrapperifempty_desc'] = 'Sätt till 0 för att bara använda wrapperTpl om det finns minst ett resultat att visa. När den är satt till 1 kommer wrapperTpl alltid användas, även om det inte finns några resultat.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'När den inte är tom, kommer snippeten att placera resultatet i en platshållare istället för att visa resultatet direkt.';
$_lang['moregallery.mggettags.includecount_desc'] = 'När den är satt till 1 kommer platshållaren [[+image_count]] att innehålla antalet aktiva bilder som använder den här taggen.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Används för sidbrytning via getPage, ange den platshållare som ska användas för det totala antalet resultat.';
$_lang['moregallery.mggettags.limit_desc'] = 'Antal bilder att ladda in.';
$_lang['moregallery.mggettags.offset_desc'] = 'Antal bilder att hoppa över.';
$_lang['moregallery.mggettags.where_desc'] = 'Ett allmänt tillstånd att lägga till i förfrågan kan läggas till här, i JSON-format. Till exempel {"createdon:>=":1390737600} eller {"display:LIKE":"%train%"} ';
