<?php if (!defined('WEBPATH')) die(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_zp_themeroot; ?>/css/main.css" />

		<link href="<?php echo $_zp_themeroot; ?>/css/grid960.css?column_width=60&amp;column_amount=12&amp;gutter_width=20" media="screen" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $_zp_themeroot; ?>/css/page.css" rel="stylesheet" type="text/css"/>		
		<link href="<?php echo $_zp_themeroot; ?>/css/linear.css" rel="stylesheet" type="text/css"/>		

		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery-1.7.1.js"></script>		
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery.mousewheel.js"></script>				
		<script type="text/javascript">
			$(document).ready(function() {
//			   $("#full-image").fadeToggle(400, "linear");
				$('.scrollable').width($(document).innerWidth() - $('.scrollable').offset().left - 15);
				$('.scrollable').css({
				           'cursor' : 'none'
				        });
			 });
			
			jQuery(function($) {
				$('.scrollable').data('scrollLeft', -1).bind('mousewheel', function(event, delta) {
					if ( (!this.scrollLeft && delta > 0) || (this.scrollLeft == $(this).data('scrollLeft') && delta < 0) ) {
					         return true; //данный блок необходим для того, чтобы перестать блокировать вертикальный скролл, если горизонтальный закончился
					}

					$(this).data('scrollLeft', this.scrollLeft); //сохраняем текущий скролл слева

					this.scrollLeft -= (delta * 100); //на сколько прокрутить блок? (размер скролла)
					return false; //отключить вертикальный
				});
			});

/*			
			$("#scrollable-container")..bind("mousewheel",function(ev, delta) {
				alert("1111");
			    var scrollLeft = $(window).scrollLeft();
			    $(this).scrollLeft(scrollLeft - Math.round(delta * 40));
			});			
*/
		</script>
		<?php zp_apply_filter('theme_head'); ?>
		<?php $showsearch=true; ?>
		<?php $hrl_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
		switch ($_zp_gallery_page) {
			case 'index.php':
				require_once (ZENFOLDER."/zp-extensions/image_album_statistics.php");
				$showsearch=false;
				break;
			case 'album.php':
				$hrl_metatitle = getBareAlbumTitle().' | ';
				$hrl_metadesc = truncate_string(getBareAlbumDesc(),150,'...');
				printRSSHeaderLink('Album',getAlbumTitle());
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'image.php':
				$hrl_metatitle = getBareImageTitle().' | ';
				$hrl_metadesc = truncate_string(getBareImageDesc(),150,'...');
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'archive.php':
				$hrl_metatitle = gettext("Archive View").' | ';
				break;
			case 'search.php':
				$hrl_metatitle = gettext('Search')." | ".getSearchWords().' | ';
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'pages.php':
				$hrl_metatitle = getBarePageTitle().' | ';
				$hrl_metadesc = strip_tags(truncate_string(getPageContent(),150,'...'));
				$cbscript = true;
				break;
			case 'news.php':
				if (is_NewsArticle()) {
				$hrl_metatitle = gettext('News').' | '.getBareNewsTitle().' | ';
				$hrl_metadesc = strip_tags(truncate_string(getNewsContent(),150,'...'));
				} else if ($_zp_current_category) {
				$hrl_metatitle = gettext('News').' | '.$_zp_current_category->getTitle().' | ';
				$hrl_metadesc = strip_tags(truncate_string(getNewsCategoryDesc(),150,'...'));
				} else if (getCurrentNewsArchive()) {
				$hrl_metatitle = gettext('News').' | '.getCurrentNewsArchive().' | ';
				} else {
				$hrl_metatitle = gettext('News').' | ';
				}
				$cbscript = true;
				break;
			case 'slideshow.php':
				$hrl_metatitle = getBareAlbumTitle().' | '.gettext('Slideshow').' | ';
				printSlideShowJS(); 
				echo '<link rel="stylesheet" href="'.$_zp_themeroot.'/css/slideshow.css" type="text/css" />';
				$showsearch=false;
				break;
			case 'contact.php':
				$hrl_metatitle = gettext('Contact').' | ';
				break;
			case 'login.php':
				$hrl_metatitle = gettext('Login').' | ';
				break;
			case 'register.php':
				$hrl_metatitle = gettext('Register').' | ';
				break;
			case 'gallery.php':
				$hrl_metatitle = gettext('Gallery Index').' | ';
				$galleryactive = true;
				break;
			case 'password.php':
				$hrl_metatitle = gettext('Password Required').' | ';
				break;
			case '404.php':
				$hrl_metatitle = gettext('404 Not Found...').' | ';
				break;
			default:
				$hrl_metatitle = '';
				$hrl_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
				break;
		} ?>	
		<title><?php echo getGalleryTitle();?></title>
		<meta name="description" content="<?php echo $hrl_metadesc; ?>" />
		
		<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS'));  ?>
		<?php if (function_exists("printZenpageRSSHeaderLink")) { printZenpageRSSHeaderLink("News","", gettext('News RSS'), ""); } ?>
		
		<?php
		$zenpage = getOption('zp_plugin_zenpage');
		//$cb = getOption('zp_plugin_colorbox');
		if (!is_null(getOption('hrl_finallink'))) { $hrl_finallink = getOption('hrl_finallink'); } else { $hrl_finallink = 'nolink'; }
		if (!is_null(getOption('hrl_zpsearchcount'))) { $hrl_zpsearchcount = getOption('hrl_zpsearchcount'); } else { $hrl_zpsearchcount = 2; }
		if (!is_null(getOption('hrl_disablemeta'))) { $hrl_disablemeta = getOption('hrl_disablemeta'); } else { $hrl_disablemeta = false; }
		if (!is_null(getOption('hrl_colorbox'))) { $hrl_colorbox = getOption('hrl_colorbox'); } else { $hrl_colorbox = true; }
		if (!is_null(getOption('hrl_cbstyle'))) { $hrl_cbstyle = getOption('hrl_cbstyle'); } else { $hrl_cbstyle = 'style3'; }
		if (!is_null(getOption('hrl_logo'))) { $hrl_logo = getOption('hrl_logo'); } else { $hrl_logo = ''; }
		if (!is_null(getOption('hrl_menu'))) { $hrl_menu = getOption('hrl_menu'); } else { $hrl_menu = ''; }
		if (!is_null(getOption('hrl_social'))) { $hrl_social = getOption('hrl_social'); } else { $hrl_social = true; }
		if (!is_null(getOption('hrl_switch'))) { $hrl_switch = getOption('hrl_switch'); } else { $hrl_switch = false; }
		$hrl_img_thumb_size=getOption('thumb_size'); 
		if (is_numeric(getOption('hrl_album_thumb_size'))) { $hrl_album_thumb_size = getOption('hrl_album_thumb_size'); } else { $hrl_album_thumb_size = 158; }
		$hrl_thumb_crop=getOption('thumb_crop');
		$hrl_img_thumb_maxspace_w = $hrl_img_thumb_size + 2;
		$hrl_img_thumb_maxspace_h = $hrl_img_thumb_size + 2;
		$hrl_album_thumb_maxspace_w = $hrl_album_thumb_size + 2;
		$hrl_album_thumb_maxspace_h = $hrl_album_thumb_size + 17;
		$cblinks_top = ($hrl_img_thumb_size/2) - 8;
		?>	

		<?php if ( (($hrl_colorbox) || (($hrl_finallink) == 'colorbox')) && ($cbscript) ) { ?>
		<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/zp-extensions/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/cbStyles/<?php echo $hrl_cbstyle; ?>/colorbox.css" type="text/css" media="screen"/>
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