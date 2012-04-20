<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="image-wrap" class="grid_9 omega">
					<div id="full-image" style="display:none">
						<?php 
						switch (getOption('hrl_homeoption')) {
							case "album-latest":
							$hrl_albumorimage = 'album'; $hrl_functionoption = 'latest';
						break;
							case "album-latestupdated":
							$hrl_albumorimage = 'album'; $hrl_functionoption = 'latestupdated';
						break;
							case "album-mostrated":
							$hrl_albumorimage = 'album'; $hrl_functionoption = 'mostrated';
						break;
							case "album-toprated":
							$hrl_albumorimage = 'album'; $hrl_functionoption = 'toprated';
						break;
							case "image-latest":
							$hrl_albumorimage = 'image'; $hrl_functionoption = 'latest';
						break;
							case "image-latest-date":
							$hrl_albumorimage = 'image'; $hrl_functionoption = 'latest-date';
						break;
							case "image-latest-mtime":
							$hrl_albumorimage = 'image'; $hrl_functionoption = 'latest-mtime';
						break;
							case "image-popular":
							$hrl_albumorimage = 'image'; $hrl_functionoption = 'popular';
						break;
							case "image-mostrated":
							$hrl_albumorimage = 'image'; $hrl_functionoption = 'mostrated';
						break;
							case "image-toprated":
							$hrl_albumorimage = 'image'; $hrl_functionoption = 'toprated';
						break;
							case "random-daily":
							$hrl_albumorimage = ''; $hrl_functionoption = 'daily';
						break;
						} ?>
						<?php if ($hrl_albumorimage == 'image') {
							printImageStatistic(1,$hrl_functionoption,'',true,true,false,40,'',535,535,false);
						} else if ($hrl_albumorimage == 'album') {
							printAlbumStatistic(1,$hrl_functionoption,true,true,false,40,'',535,535,false);
						} else {
						$randomImage = getRandomImages($hrl_functionoption);
						if (is_object($randomImage) && $randomImage->exists) {
							$randomImageURL = html_encode(getURL($randomImage));
							echo '<a href="' . $randomImageURL . '">';
							$html =  "<img src=\"".html_encode($randomImage->getCustomImage(620, NULL, NULL, NULL, NULL, NULL, NULL, TRUE))."\" alt=\"" . html_encode($randomImage->getTitle()) . "\" />\n";
							echo zp_apply_filter('custom_image_html', $html, false);
							echo "</a>";
						}
						} ?>
					</div>
				</div>			

<?php //include ("inc-footer.php"); ?>			
