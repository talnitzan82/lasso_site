<?
if ($_GET['lang']=='') { $_GET['lang']=$lang; }

if (count($languages)>1) { $lang_link = '&lang='.$_GET['lang']; }

switch($_GET['lang']) {	
	case('he'):
		$edit_pages_text = 'עריכת עמודים';
		$edit_products_text = 'עריכת מוצרים';
		$edit_lists_text = 'עריכת קטגוריות';
		$edit_templates_text = 'עריכת תבניות';
		$edit_languages_text = 'עריכת שפות';
		$global_text = 'הגדרות מערכת';
		$logout_text = 'התנתקות';
		$add_text = 'הוסף דף';
		$add_images_text = 'הוסף תמונות';
		$add_lang_text = 'הוסף שפה';
		$add_temp_text = 'הוסף תבנית';
		$save_text = 'שמור';
		$delete_text = 'מחק מסומנים';
		$lang_text = 'בחר שפה:';
		$css = '<link href="stylesheets_he.css" rel="stylesheet" type="text/css">';
		$title = 'דרימקס מערכת ניהול תוכן 1.0';
		$save_changes = 'שמור שינויים';
		$save_close = 'שמור וסגור';
		$edit_page = 'ערוך עמוד:';
		$page_name = 'שם העמוד:';
		$page_olink = 'קישור חיצוני:';
		$page_link = 'קישור:';
		$page_template = 'תבנית:';
		$page_template_select = '-- בחר תבנית --';
		$page_category = 'העבר לקטגוריה';
		$page_category_select = '-- בחר קטגוריה --';
		$page_assign_category = 'שייך לקטרוגיות';
		$page_hide = 'הסתר עמוד:';
		$page_hide_menu = 'הסתר עמוד מהתפריט:';
		$page_front = 'הצג עמוד בראשי:';
		$page_date = 'תאריך:';
		$page_image = 'תמונה';
		$page_image_view = 'הצג תמונה';
		$page_image_delete = 'מחק תמונה';
		$page_image_upload = 'העלה תמונה';
		$page_file = 'קובץ';
		$page_file_view = 'הצג קובץ';
		$page_file_delete = 'מחק קובץ';
		$page_file_upload = 'העלה קובץ';
		$page_title1 = 'כותרת עמוד 1:';
		$page_title2 = 'כותרת עמוד 2:';
		$page_short_content = 'תקציר לעמוד:';
		$page_content1 = 'תוכן העמוד 1:';
		$page_content2 = 'תוכן העמוד 2:';
		$page_content3 = 'קישורים פוטר';
		$page_seo = 'כלי קידום האתרים:';
		$page_friendly = 'שם ידידותי:';
		$page_meta_title = 'כותרת העמוד:';
		$page_meta_keywords = 'מילות חיפוש: (מופרדות על ידי ",")';
		$page_meta_desc = 'תיאור העמוד:';
		$settings_global_text = 'הגדרות כלליות:';
		$settings_perm_title = 'כותרת אתר קבועה: (כותרת זו תתלווה לכל דפי האתר בסוף)';
		$settings_header_scripts ='Header Scripts:(Google Verification,ect...)';
		$settings_footer_scripts = 'Footer Scripts:(Google Analytics,ect...)';
		$settings_footer = 'טקסט בתחתית הדף:';
		$language_global_text = 'הגדרת שפות:';
		break;
		
	default:
		$edit_pages_text = 'Edit Pages';
		$edit_templates_text = 'Edit Templates';
		$edit_languages_text = 'Edit Languages';
		$global_text = 'Global Settings';
		$logout_text = 'Logout';
		$add_text = 'Add new page';
		$add_images_text = 'Add multi Images';
		$add_lang_text = 'Add new Language';
		$add_temp_text = 'Add new Template';
		$save_text = 'Save';
		$delete_text = 'Delete selected';
		$lang_text = 'Change Language:';
		$css = '<link href="stylesheets.css" rel="stylesheet" type="text/css">';
		$title = 'Dreamax CMS 1.0';
		$save_changes = 'Save Changes';
		$save_close = 'Save & Close';
		$edit_page = 'Edit Page:';
		$page_name = 'Page Name:';
		$page_olink = 'Out Link:';
		$page_link = 'Page Link:';
		$page_template = 'Template:';
		$page_template_select = '-- Select Template --';
		$page_category = 'Category';
		$page_category_select = '-- Select Category --';
		$page_hide = 'Hide Page:';
		$page_hide_menu = 'Hide Page From Menu:';
		$page_front = 'Front Page:';
		$page_date = 'Date:';
		$page_image = 'Image';
		$page_image_view = 'View Image';
		$page_image_delete = 'Delete Image';
		$page_image_upload = 'Image upload';
		$page_file = 'File';
		$page_file_view = 'View File';
		$page_file_delete = 'Delete File';
		$page_file_upload = 'File upload';
		$page_title1 = 'Page Title 1:';
		$page_title2 = 'Page Title 2:';
		$page_short_content = 'Short Page Content:';
		$page_content1 = 'Page Content 1:';
		$page_content2 = 'Page Content 2:';
		$page_seo = 'SEO TOOLS (Search Engine Optimization):';
		$page_friendly = 'Friendly Url:';
		$page_meta_title = 'Meta Title:';
		$page_meta_keywords = 'Meta Keywords: (separate each keyword with ",")';
		$page_meta_desc = 'Meta Desctiption:';
		$settings_global_text = 'Global Settings:';
		$settings_perm_title = 'Perm Meta Title: (title that will follow every page on the website at the end. Example: About Us &lt;Perm Meta Title&gt;)';
		$settings_header_scripts ='Header Scripts:(Google Verification,ect...)';
		$settings_footer_scripts = 'Footer Scripts:(Google Analytics,ect...)';
		$settings_footer = 'Footer Text:';
		$language_global_text = 'Languages Settings:';
		break;
	
}
?>