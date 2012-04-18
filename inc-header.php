<?php if (!defined('WEBPATH')) die(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_zp_themeroot; ?>/css/main.css" />
		<link href="<?php echo $_zp_themeroot; ?>/css/grid960.css?column_width=60&amp;column_amount=12&amp;gutter_width=20" media="screen" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery-1.7.1.js"></script>		
		<script type="text/javascript">
			$(document).ready(function() {
			   $("#full-image").fadeToggle(400, "linear");
			 });
		</script>
		<?php zp_apply_filter('theme_head'); ?>
		<?php $showsearch=true; ?>
		<?php $zpmin_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
		switch ($_zp_gallery_page) {
			case 'index.php':
				require_once (ZENFOLDER."/zp-extensions/image_album_statistics.php");
				$showsearch=false;
				break;
			case 'album.php':
				$zpmin_metatitle = getBareAlbumTitle().' | ';
				$zpmin_metadesc = truncate_string(getBareAlbumDesc(),150,'...');
				printRSSHeaderLink('Album',getAlbumTitle());
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'image.php':
				$zpmin_metatitle = getBareImageTitle().' | ';
				$zpmin_metadesc = truncate_string(getBareImageDesc(),150,'...');
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'archive.php':
				$zpmin_metatitle = gettext("Archive View").' | ';
				break;
			case 'search.php':
				$zpmin_metatitle = gettext('Search')." | ".getSearchWords().' | ';
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'pages.php':
				$zpmin_metatitle = getBarePageTitle().' | ';
				$zpmin_metadesc = strip_tags(truncate_string(getPageContent(),150,'...'));
				$cbscript = true;
				break;
			case 'news.php':
				if (is_NewsArticle()) {
				$zpmin_metatitle = gettext('News').' | '.getBareNewsTitle().' | ';
				$zpmin_metadesc = strip_tags(truncate_string(getNewsContent(),150,'...'));
				} else if ($_zp_current_category) {
				$zpmin_metatitle = gettext('News').' | '.$_zp_current_category->getTitle().' | ';
				$zpmin_metadesc = strip_tags(truncate_string(getNewsCategoryDesc(),150,'...'));
				} else if (getCurrentNewsArchive()) {
				$zpmin_metatitle = gettext('News').' | '.getCurrentNewsArchive().' | ';
				} else {
				$zpmin_metatitle = gettext('News').' | ';
				}
				$cbscript = true;
				break;
			case 'slideshow.php':
				$zpmin_metatitle = getBareAlbumTitle().' | '.gettext('Slideshow').' | ';
				printSlideShowJS(); 
				echo '<link rel="stylesheet" href="'.$_zp_themeroot.'/css/slideshow.css" type="text/css" />';
				$showsearch=false;
				break;
			case 'contact.php':
				$zpmin_metatitle = gettext('Contact').' | ';
				break;
			case 'login.php':
				$zpmin_metatitle = gettext('Login').' | ';
				break;
			case 'register.php':
				$zpmin_metatitle = gettext('Register').' | ';
				break;
			case 'gallery.php':
				$zpmin_metatitle = gettext('Gallery Index').' | ';
				$galleryactive = true;
				break;
			case 'password.php':
				$zpmin_metatitle = gettext('Password Required').' | ';
				break;
			case '404.php':
				$zpmin_metatitle = gettext('404 Not Found...').' | ';
				break;
			default:
				$zpmin_metatitle = '';
				$zpmin_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
				break;
		} ?>	
		<title><?php echo getGalleryTitle();?></title>
		<meta name="description" content="<?php echo $zpmin_metadesc; ?>" />
		
		<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS'));  ?>
		<?php if (function_exists("printZenpageRSSHeaderLink")) { printZenpageRSSHeaderLink("News","", gettext('News RSS'), ""); } ?>
		
		<?php
		$zenpage = getOption('zp_plugin_zenpage');
		//$cb = getOption('zp_plugin_colorbox');
		if (!is_null(getOption('zpmin_finallink'))) { $zpmin_finallink = getOption('zpmin_finallink'); } else { $zpmin_finallink = 'nolink'; }
		if (!is_null(getOption('zpmin_zpsearchcount'))) { $zpmin_zpsearchcount = getOption('zpmin_zpsearchcount'); } else { $zpmin_zpsearchcount = 2; }
		if (!is_null(getOption('zpmin_disablemeta'))) { $zpmin_disablemeta = getOption('zpmin_disablemeta'); } else { $zpmin_disablemeta = false; }
		if (!is_null(getOption('zpmin_colorbox'))) { $zpmin_colorbox = getOption('zpmin_colorbox'); } else { $zpmin_colorbox = true; }
		if (!is_null(getOption('zpmin_cbstyle'))) { $zpmin_cbstyle = getOption('zpmin_cbstyle'); } else { $zpmin_cbstyle = 'style3'; }
		if (!is_null(getOption('zpmin_logo'))) { $zpmin_logo = getOption('zpmin_logo'); } else { $zpmin_logo = ''; }
		if (!is_null(getOption('zpmin_menu'))) { $zpmin_menu = getOption('zpmin_menu'); } else { $zpmin_menu = ''; }
		if (!is_null(getOption('zpmin_social'))) { $zpmin_social = getOption('zpmin_social'); } else { $zpmin_social = true; }
		if (!is_null(getOption('zpmin_switch'))) { $zpmin_switch = getOption('zpmin_switch'); } else { $zpmin_switch = false; }
		$zpmin_img_thumb_size=getOption('thumb_size'); 
		if (is_numeric(getOption('zpmin_album_thumb_size'))) { $zpmin_album_thumb_size = getOption('zpmin_album_thumb_size'); } else { $zpmin_album_thumb_size = 158; }
		$zpmin_thumb_crop=getOption('thumb_crop');
		$zpmin_img_thumb_maxspace_w = $zpmin_img_thumb_size + 2;
		$zpmin_img_thumb_maxspace_h = $zpmin_img_thumb_size + 2;
		$zpmin_album_thumb_maxspace_w = $zpmin_album_thumb_size + 2;
		$zpmin_album_thumb_maxspace_h = $zpmin_album_thumb_size + 17;
		$cblinks_top = ($zpmin_img_thumb_size/2) - 8;
		?>	

		<?php if ( (($zpmin_colorbox) || (($zpmin_finallink) == 'colorbox')) && ($cbscript) ) { ?>
		<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/zp-extensions/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/cbStyles/<?php echo $zpmin_cbstyle; ?>/colorbox.css" type="text/css" media="screen"/>
		<script type="text/javascript">
			// <!-- <![CDATA[
			$(document).ready(function(){
				$("a.thickbox").colorbox({maxWidth:"90%",maxHeight:"90%",photo:true});
			});
			// ]]> -->
		</script>
		
		<?php } ?>
	</head>
	<body>
		<?php zp_apply_filter('theme_body_open'); ?>
		<div id="wrapper" class="container container_12">
			<div id="header" class="grid_12">
				<h1 id="logo" class="grid_3 alpha">
					<a href="<?php echo htmlspecialchars(getGalleryIndexURL());?>">
						<?php echo getGalleryTitle();?> 
					</a>
				</h1>
				<div id="select-language" class="prefix_8 grid_1 omega">
					<?php echo printLanguageSelector(); ?>
				</div>