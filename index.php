<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="image-wrap" class="grid_9 omega">
					<div id="full-image" style="display:none">
						<?php 
						switch (getOption('zpmin_homeoption')) {
							case "album-latest":
							$zpmin_albumorimage = 'album'; $zpmin_functionoption = 'latest';
						break;
							case "album-latestupdated":
							$zpmin_albumorimage = 'album'; $zpmin_functionoption = 'latestupdated';
						break;
							case "album-mostrated":
							$zpmin_albumorimage = 'album'; $zpmin_functionoption = 'mostrated';
						break;
							case "album-toprated":
							$zpmin_albumorimage = 'album'; $zpmin_functionoption = 'toprated';
						break;
							case "image-latest":
							$zpmin_albumorimage = 'image'; $zpmin_functionoption = 'latest';
						break;
							case "image-latest-date":
							$zpmin_albumorimage = 'image'; $zpmin_functionoption = 'latest-date';
						break;
							case "image-latest-mtime":
							$zpmin_albumorimage = 'image'; $zpmin_functionoption = 'latest-mtime';
						break;
							case "image-popular":
							$zpmin_albumorimage = 'image'; $zpmin_functionoption = 'popular';
						break;
							case "image-mostrated":
							$zpmin_albumorimage = 'image'; $zpmin_functionoption = 'mostrated';
						break;
							case "image-toprated":
							$zpmin_albumorimage = 'image'; $zpmin_functionoption = 'toprated';
						break;
							case "random-daily":
							$zpmin_albumorimage = ''; $zpmin_functionoption = 'daily';
						break;
						} ?>
						<?php if ($zpmin_albumorimage == 'image') {
							printImageStatistic(1,$zpmin_functionoption,'',true,true,false,40,'',535,535,false);
						} else if ($zpmin_albumorimage == 'album') {
							printAlbumStatistic(1,$zpmin_functionoption,true,true,false,40,'',535,535,false);
						} else {
						$randomImage = getRandomImages($zpmin_functionoption);
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
