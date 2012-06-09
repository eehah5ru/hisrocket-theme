<?php if (!defined('WEBPATH')) die(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_zp_themeroot; ?>/css/main.css" />

		<link href="<?php echo $_zp_themeroot; ?>/css/grid960.css?column_width=60&amp;column_amount=12&amp;gutter_width=20" media="screen" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $_zp_themeroot; ?>/css/page.css" rel="stylesheet" type="text/css"/>		
		<link href="<?php echo $_zp_themeroot; ?>/css/jquery-ui-1.8.20.custom.css" rel="stylesheet" type="text/css"/>		
		<link href="<?php echo $_zp_themeroot; ?>/css/canvas.css" rel="stylesheet" type="text/css"/>		
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery-1.7.1.js"></script>		
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery-ui-1.8.20.custom.min.js"></script>						

		<?php zp_apply_filter('theme_head'); ?>
		<?php $showsearch=true; ?>
		<?php $hrc_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
		switch ($_zp_gallery_page) {
			case 'index.php':
				require_once (ZENFOLDER."/zp-extensions/image_album_statistics.php");
				$showsearch=false;
				break;
			case 'album.php':
				$hrc_metatitle = getBareAlbumTitle().' | ';
				$hrc_metadesc = truncate_string(getBareAlbumDesc(),150,'...');
				printRSSHeaderLink('Album',getAlbumTitle());
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'image.php':
				$hrc_metatitle = getBareImageTitle().' | ';
				$hrc_metadesc = truncate_string(getBareImageDesc(),150,'...');
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'archive.php':
				$hrc_metatitle = gettext("Archive View").' | ';
				break;
			case 'search.php':
				$hrc_metatitle = gettext('Search')." | ".getSearchWords().' | ';
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'pages.php':
				$hrc_metatitle = getBarePageTitle().' | ';
				$hrc_metadesc = strip_tags(truncate_string(getPageContent(),150,'...'));
				$cbscript = true;
				break;
			case 'news.php':
				if (is_NewsArticle()) {
				$hrc_metatitle = gettext('News').' | '.getBareNewsTitle().' | ';
				$hrc_metadesc = strip_tags(truncate_string(getNewsContent(),150,'...'));
				} else if ($_zp_current_category) {
				$hrc_metatitle = gettext('News').' | '.$_zp_current_category->getTitle().' | ';
				$hrc_metadesc = strip_tags(truncate_string(getNewsCategoryDesc(),150,'...'));
				} else if (getCurrentNewsArchive()) {
				$hrc_metatitle = gettext('News').' | '.getCurrentNewsArchive().' | ';
				} else {
				$hrc_metatitle = gettext('News').' | ';
				}
				$cbscript = true;
				break;
			case 'slideshow.php':
				$hrc_metatitle = getBareAlbumTitle().' | '.gettext('Slideshow').' | ';
				printSlideShowJS(); 
				echo '<link rel="stylesheet" href="'.$_zp_themeroot.'/css/slideshow.css" type="text/css" />';
				$showsearch=false;
				break;
			case 'contact.php':
				$hrc_metatitle = gettext('Contact').' | ';
				break;
			case 'login.php':
				$hrc_metatitle = gettext('Login').' | ';
				break;
			case 'register.php':
				$hrc_metatitle = gettext('Register').' | ';
				break;
			case 'gallery.php':
				$hrc_metatitle = gettext('Gallery Index').' | ';
				$galleryactive = true;
				break;
			case 'password.php':
				$hrc_metatitle = gettext('Password Required').' | ';
				break;
			case '404.php':
				$hrc_metatitle = gettext('404 Not Found...').' | ';
				break;
			default:
				$hrc_metatitle = '';
				$hrc_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
				break;
		} ?>	
		<title><?php echo getBareGalleryTitle();?></title>
		<meta name="description" content="<?php echo $hrc_metadesc; ?>" />
		
		<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS'));  ?>
		<?php if (function_exists("printZenpageRSSHeaderLink")) { printZenpageRSSHeaderLink("News","", gettext('News RSS'), ""); } ?>
		
		<?php
		$zenpage = getOption('zp_plugin_zenpage');
		//$cb = getOption('zp_plugin_colorbox');
		if (!is_null(getOption('hrc_finallink'))) { $hrc_finallink = getOption('hrc_finallink'); } else { $hrc_finallink = 'nolink'; }
		if (!is_null(getOption('hrc_zpsearchcount'))) { $hrc_zpsearchcount = getOption('hrc_zpsearchcount'); } else { $hrc_zpsearchcount = 2; }
		if (!is_null(getOption('hrc_disablemeta'))) { $hrc_disablemeta = getOption('hrc_disablemeta'); } else { $hrc_disablemeta = false; }
		if (!is_null(getOption('hrc_colorbox'))) { $hrc_colorbox = getOption('hrc_colorbox'); } else { $hrc_colorbox = true; }
		if (!is_null(getOption('hrc_cbstyle'))) { $hrc_cbstyle = getOption('hrc_cbstyle'); } else { $hrc_cbstyle = 'style3'; }
		if (!is_null(getOption('hrc_logo'))) { $hrc_logo = getOption('hrc_logo'); } else { $hrc_logo = ''; }
		if (!is_null(getOption('hrc_menu'))) { $hrc_menu = getOption('hrc_menu'); } else { $hrc_menu = ''; }
		if (!is_null(getOption('hrc_social'))) { $hrc_social = getOption('hrc_social'); } else { $hrc_social = true; }
		if (!is_null(getOption('hrc_switch'))) { $hrc_switch = getOption('hrc_switch'); } else { $hrc_switch = false; }
		$hrc_img_thumb_size=getOption('thumb_size'); 
		if (is_numeric(getOption('hrc_album_thumb_size'))) { $hrc_album_thumb_size = getOption('hrc_album_thumb_size'); } else { $hrc_album_thumb_size = 158; }
		$hrc_thumb_crop=getOption('thumb_crop');
		$hrc_img_thumb_maxspace_w = $hrc_img_thumb_size + 2;
		$hrc_img_thumb_maxspace_h = $hrc_img_thumb_size + 2;
		$hrc_album_thumb_maxspace_w = $hrc_album_thumb_size + 2;
		$hrc_album_thumb_maxspace_h = $hrc_album_thumb_size + 17;
		$cblinks_top = ($hrc_img_thumb_size/2) - 8;
		?>	

		<?php if ( (($hrc_colorbox) || (($hrc_finallink) == 'colorbox')) && ($cbscript) ) { ?>
		<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/zp-extensions/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/cbStyles/<?php echo $hrc_cbstyle; ?>/colorbox.css" type="text/css" media="screen"/>
		<script type="text/javascript">
			// <!-- <![CDATA[
			$(document).ready(function(){
				$("a.thickbox").colorbox({maxWidth:"90%",maxHeight:"90%",photo:true});
			});
			// ]]> -->
		</script>
		
		<?php } ?>
		
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $_zp_conf_vars['GOOGLE_ANALYTICS_TOKEN']?>']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); 
				ga.type = 'text/javascript'; 
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; 
				s.parentNode.insertBefore(ga, s);
			})();
		</script>		
	</head>
	<body>
		<?php zp_apply_filter('theme_body_open'); ?>
		<div id="wrapper" class="container container_12">
			<div id="header" class="grid_12">
				<h1 id="logo" class="grid_3 alpha">
					<a href="<?php echo FULLWEBPATH;?>">
						<?php echo getGalleryTitle();?> 
					</a>
				</h1>