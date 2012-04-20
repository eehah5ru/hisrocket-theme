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
		<?php $hrsi_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
		switch ($_zp_gallery_page) {
			case 'index.php':
				require_once (ZENFOLDER."/zp-extensions/image_album_statistics.php");
				$showsearch=false;
				break;
			case 'album.php':
				$hrsi_metatitle = getBareAlbumTitle().' | ';
				$hrsi_metadesc = truncate_string(getBareAlbumDesc(),150,'...');
				printRSSHeaderLink('Album',getAlbumTitle());
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'image.php':
				$hrsi_metatitle = getBareImageTitle().' | ';
				$hrsi_metadesc = truncate_string(getBareImageDesc(),150,'...');
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'archive.php':
				$hrsi_metatitle = gettext("Archive View").' | ';
				break;
			case 'search.php':
				$hrsi_metatitle = gettext('Search')." | ".getSearchWords().' | ';
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'pages.php':
				$hrsi_metatitle = getBarePageTitle().' | ';
				$hrsi_metadesc = strip_tags(truncate_string(getPageContent(),150,'...'));
				$cbscript = true;
				break;
			case 'news.php':
				if (is_NewsArticle()) {
				$hrsi_metatitle = gettext('News').' | '.getBareNewsTitle().' | ';
				$hrsi_metadesc = strip_tags(truncate_string(getNewsContent(),150,'...'));
				} else if ($_zp_current_category) {
				$hrsi_metatitle = gettext('News').' | '.$_zp_current_category->getTitle().' | ';
				$hrsi_metadesc = strip_tags(truncate_string(getNewsCategoryDesc(),150,'...'));
				} else if (getCurrentNewsArchive()) {
				$hrsi_metatitle = gettext('News').' | '.getCurrentNewsArchive().' | ';
				} else {
				$hrsi_metatitle = gettext('News').' | ';
				}
				$cbscript = true;
				break;
			case 'slideshow.php':
				$hrsi_metatitle = getBareAlbumTitle().' | '.gettext('Slideshow').' | ';
				printSlideShowJS(); 
				echo '<link rel="stylesheet" href="'.$_zp_themeroot.'/css/slideshow.css" type="text/css" />';
				$showsearch=false;
				break;
			case 'contact.php':
				$hrsi_metatitle = gettext('Contact').' | ';
				break;
			case 'login.php':
				$hrsi_metatitle = gettext('Login').' | ';
				break;
			case 'register.php':
				$hrsi_metatitle = gettext('Register').' | ';
				break;
			case 'gallery.php':
				$hrsi_metatitle = gettext('Gallery Index').' | ';
				$galleryactive = true;
				break;
			case 'password.php':
				$hrsi_metatitle = gettext('Password Required').' | ';
				break;
			case '404.php':
				$hrsi_metatitle = gettext('404 Not Found...').' | ';
				break;
			default:
				$hrsi_metatitle = '';
				$hrsi_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
				break;
		} ?>	
		<title><?php echo getGalleryTitle();?></title>
		<meta name="description" content="<?php echo $hrsi_metadesc; ?>" />
		
		<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS'));  ?>
		<?php if (function_exists("printZenpageRSSHeaderLink")) { printZenpageRSSHeaderLink("News","", gettext('News RSS'), ""); } ?>
		
		<?php
		$zenpage = getOption('zp_plugin_zenpage');
		//$cb = getOption('zp_plugin_colorbox');
		if (!is_null(getOption('hrsi_finallink'))) { $hrsi_finallink = getOption('hrsi_finallink'); } else { $hrsi_finallink = 'nolink'; }
		if (!is_null(getOption('hrsi_zpsearchcount'))) { $hrsi_zpsearchcount = getOption('hrsi_zpsearchcount'); } else { $hrsi_zpsearchcount = 2; }
		if (!is_null(getOption('hrsi_disablemeta'))) { $hrsi_disablemeta = getOption('hrsi_disablemeta'); } else { $hrsi_disablemeta = false; }
		if (!is_null(getOption('hrsi_colorbox'))) { $hrsi_colorbox = getOption('hrsi_colorbox'); } else { $hrsi_colorbox = true; }
		if (!is_null(getOption('hrsi_cbstyle'))) { $hrsi_cbstyle = getOption('hrsi_cbstyle'); } else { $hrsi_cbstyle = 'style3'; }
		if (!is_null(getOption('hrsi_logo'))) { $hrsi_logo = getOption('hrsi_logo'); } else { $hrsi_logo = ''; }
		if (!is_null(getOption('hrsi_menu'))) { $hrsi_menu = getOption('hrsi_menu'); } else { $hrsi_menu = ''; }
		if (!is_null(getOption('hrsi_social'))) { $hrsi_social = getOption('hrsi_social'); } else { $hrsi_social = true; }
		if (!is_null(getOption('hrsi_switch'))) { $hrsi_switch = getOption('hrsi_switch'); } else { $hrsi_switch = false; }
		$hrsi_img_thumb_size=getOption('thumb_size'); 
		if (is_numeric(getOption('hrsi_album_thumb_size'))) { $hrsi_album_thumb_size = getOption('hrsi_album_thumb_size'); } else { $hrsi_album_thumb_size = 158; }
		$hrsi_thumb_crop=getOption('thumb_crop');
		$hrsi_img_thumb_maxspace_w = $hrsi_img_thumb_size + 2;
		$hrsi_img_thumb_maxspace_h = $hrsi_img_thumb_size + 2;
		$hrsi_album_thumb_maxspace_w = $hrsi_album_thumb_size + 2;
		$hrsi_album_thumb_maxspace_h = $hrsi_album_thumb_size + 17;
		$cblinks_top = ($hrsi_img_thumb_size/2) - 8;
		?>	

		<?php if ( (($hrsi_colorbox) || (($hrsi_finallink) == 'colorbox')) && ($cbscript) ) { ?>
		<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/zp-extensions/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/cbStyles/<?php echo $hrsi_cbstyle; ?>/colorbox.css" type="text/css" media="screen"/>
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