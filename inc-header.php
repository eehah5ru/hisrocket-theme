<?php if (!defined('WEBPATH')) die(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_zp_themeroot; ?>/css/main.css" />

		<link href="<?php echo $_zp_themeroot; ?>/css/grid960.css?column_width=60&amp;column_amount=12&amp;gutter_width=20" media="screen" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $_zp_themeroot; ?>/css/page.css" rel="stylesheet" type="text/css"/>		
		<link href="<?php echo $_zp_themeroot; ?>/css/vertical.css" rel="stylesheet" type="text/css"/>		
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery-1.7.1.js"></script>		
		<!--script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery.mobile-1.1.0.js"></script-->				
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery-ui-1.8.18.custom.min.js"></script>				
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery.mousewheel.js"></script>				
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/javascript/jquery.smoothscroll.js"></script>						
		
		<script type="text/javascript">
			function isTouchDevice(){
		  		return (typeof(window.ontouchstart) != 'undefined') ? true : false;
			}
			
			function setScrollableContainerWidth() {
				var result = 0;
				
				$('#scrollable-container').children().each(function() {
					result += $(this).outerWidth();
				});
				
				$('#scrollable-container').css({
					'width' : result + 500
				});
				
			}
			
			function getScrollableContainerWidth() {
				var result = 0;
				
				$('#scrollable-container').children().each(function() {
					result += $(this).outerWidth();
				});
				
				return result;
			}			
			
			
					
			$(window).load(function() {
//			   $("#full-image").fadeToggle(400, "linear");
/*
				if (!isTouchDevice()) {
					// $('.scrollable').width($(document).innerWidth() - $('.scrollable').offset().left - 15);
					$('.scrollable').css({
						'width' : $(document).innerWidth() - $('.scrollable').offset().left - 15
					});

					setScrollableContainerWidth();
				}
				else {
*/
					setScrollableContainerWidth();					

					$('.scrollable').css({
						'width' : $('#scrollable-container').outerWidth()
					});
/*
				}

				$('.scrollable').css({
				           'cursor' : 'none'
				});
*/
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
		

		</script>
		<?php zp_apply_filter('theme_head'); ?>
		<?php $showsearch=true; ?>
		<?php $hrvb_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
		switch ($_zp_gallery_page) {
			case 'index.php':
				require_once (ZENFOLDER."/zp-extensions/image_album_statistics.php");
				$showsearch=false;
				break;
			case 'album.php':
				$hrvb_metatitle = getBareAlbumTitle().' | ';
				$hrvb_metadesc = truncate_string(getBareAlbumDesc(),150,'...');
				printRSSHeaderLink('Album',getAlbumTitle());
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'image.php':
				$hrvb_metatitle = getBareImageTitle().' | ';
				$hrvb_metadesc = truncate_string(getBareImageDesc(),150,'...');
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'archive.php':
				$hrvb_metatitle = gettext("Archive View").' | ';
				break;
			case 'search.php':
				$hrvb_metatitle = gettext('Search')." | ".getSearchWords().' | ';
				$galleryactive = true;
				$cbscript = true;
				break;
			case 'pages.php':
				$hrvb_metatitle = getBarePageTitle().' | ';
				$hrvb_metadesc = strip_tags(truncate_string(getPageContent(),150,'...'));
				$cbscript = true;
				break;
			case 'news.php':
				if (is_NewsArticle()) {
				$hrvb_metatitle = gettext('News').' | '.getBareNewsTitle().' | ';
				$hrvb_metadesc = strip_tags(truncate_string(getNewsContent(),150,'...'));
				} else if ($_zp_current_category) {
				$hrvb_metatitle = gettext('News').' | '.$_zp_current_category->getTitle().' | ';
				$hrvb_metadesc = strip_tags(truncate_string(getNewsCategoryDesc(),150,'...'));
				} else if (getCurrentNewsArchive()) {
				$hrvb_metatitle = gettext('News').' | '.getCurrentNewsArchive().' | ';
				} else {
				$hrvb_metatitle = gettext('News').' | ';
				}
				$cbscript = true;
				break;
			case 'slideshow.php':
				$hrvb_metatitle = getBareAlbumTitle().' | '.gettext('Slideshow').' | ';
				printSlideShowJS(); 
				echo '<link rel="stylesheet" href="'.$_zp_themeroot.'/css/slideshow.css" type="text/css" />';
				$showsearch=false;
				break;
			case 'contact.php':
				$hrvb_metatitle = gettext('Contact').' | ';
				break;
			case 'login.php':
				$hrvb_metatitle = gettext('Login').' | ';
				break;
			case 'register.php':
				$hrvb_metatitle = gettext('Register').' | ';
				break;
			case 'gallery.php':
				$hrvb_metatitle = gettext('Gallery Index').' | ';
				$galleryactive = true;
				break;
			case 'password.php':
				$hrvb_metatitle = gettext('Password Required').' | ';
				break;
			case '404.php':
				$hrvb_metatitle = gettext('404 Not Found...').' | ';
				break;
			default:
				$hrvb_metatitle = '';
				$hrvb_metadesc = truncate_string(getBareGalleryDesc(),150,'...');
				break;
		} ?>	
		<title><?php echo getBareGalleryTitle();?></title>
		<meta name="description" content="<?php echo $hrvb_metadesc; ?>" />
		
		<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS'));  ?>
		<?php if (function_exists("printZenpageRSSHeaderLink")) { printZenpageRSSHeaderLink("News","", gettext('News RSS'), ""); } ?>
		
		<?php
		$zenpage = getOption('zp_plugin_zenpage');
		//$cb = getOption('zp_plugin_colorbox');
		if (!is_null(getOption('hrvb_finallink'))) { $hrvb_finallink = getOption('hrvb_finallink'); } else { $hrvb_finallink = 'nolink'; }
		if (!is_null(getOption('hrvb_zpsearchcount'))) { $hrvb_zpsearchcount = getOption('hrvb_zpsearchcount'); } else { $hrvb_zpsearchcount = 2; }
		if (!is_null(getOption('hrvb_disablemeta'))) { $hrvb_disablemeta = getOption('hrvb_disablemeta'); } else { $hrvb_disablemeta = false; }
		if (!is_null(getOption('hrvb_colorbox'))) { $hrvb_colorbox = getOption('hrvb_colorbox'); } else { $hrvb_colorbox = true; }
		if (!is_null(getOption('hrvb_cbstyle'))) { $hrvb_cbstyle = getOption('hrvb_cbstyle'); } else { $hrvb_cbstyle = 'style3'; }
		if (!is_null(getOption('hrvb_logo'))) { $hrvb_logo = getOption('hrvb_logo'); } else { $hrvb_logo = ''; }
		if (!is_null(getOption('hrvb_menu'))) { $hrvb_menu = getOption('hrvb_menu'); } else { $hrvb_menu = ''; }
		if (!is_null(getOption('hrvb_social'))) { $hrvb_social = getOption('hrvb_social'); } else { $hrvb_social = true; }
		if (!is_null(getOption('hrvb_switch'))) { $hrvb_switch = getOption('hrvb_switch'); } else { $hrvb_switch = false; }
		$hrvb_img_thumb_size=getOption('thumb_size'); 
		if (is_numeric(getOption('hrvb_album_thumb_size'))) { $hrvb_album_thumb_size = getOption('hrvb_album_thumb_size'); } else { $hrvb_album_thumb_size = 158; }
		$hrvb_thumb_crop=getOption('thumb_crop');
		$hrvb_img_thumb_maxspace_w = $hrvb_img_thumb_size + 2;
		$hrvb_img_thumb_maxspace_h = $hrvb_img_thumb_size + 2;
		$hrvb_album_thumb_maxspace_w = $hrvb_album_thumb_size + 2;
		$hrvb_album_thumb_maxspace_h = $hrvb_album_thumb_size + 17;
		$cblinks_top = ($hrvb_img_thumb_size/2) - 8;
		?>	

		<?php if ( (($hrvb_colorbox) || (($hrvb_finallink) == 'colorbox')) && ($cbscript) ) { ?>
		<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/zp-extensions/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/cbStyles/<?php echo $hrvb_cbstyle; ?>/colorbox.css" type="text/css" media="screen"/>
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