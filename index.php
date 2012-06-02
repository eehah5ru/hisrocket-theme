<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="image-wrap" class="grid_9 omega">
					<div id="full-image" style="display:none">
						<?php 
						switch (getOption('hrc_homeoption')) {
							case "album-latest":
							$hrc_albumorimage = 'album'; $hrc_functionoption = 'latest';
						break;
							case "album-latestupdated":
							$hrc_albumorimage = 'album'; $hrc_functionoption = 'latestupdated';
						break;
							case "album-mostrated":
							$hrc_albumorimage = 'album'; $hrc_functionoption = 'mostrated';
						break;
							case "album-toprated":
							$hrc_albumorimage = 'album'; $hrc_functionoption = 'toprated';
						break;
							case "image-latest":
							$hrc_albumorimage = 'image'; $hrc_functionoption = 'latest';
						break;
							case "image-latest-date":
							$hrc_albumorimage = 'image'; $hrc_functionoption = 'latest-date';
						break;
							case "image-latest-mtime":
							$hrc_albumorimage = 'image'; $hrc_functionoption = 'latest-mtime';
						break;
							case "image-popular":
							$hrc_albumorimage = 'image'; $hrc_functionoption = 'popular';
						break;
							case "image-mostrated":
							$hrc_albumorimage = 'image'; $hrc_functionoption = 'mostrated';
						break;
							case "image-toprated":
							$hrc_albumorimage = 'image'; $hrc_functionoption = 'toprated';
						break;
							case "random-daily":
							$hrc_albumorimage = ''; $hrc_functionoption = 'daily';
						break;
							case "none":
							$hrc_albumorimage = 'none'; $hrc_functionoption = 'none';
						break;						
						} ?>
						<?php 
						
						if ($hrc_albumorimage == 'image') {
							printImageStatistic(1,$hrc_functionoption,'',true,true,false,40,'',535,535,false);
						} 
						else if ($hrc_albumorimage == 'album') {
							printAlbumStatistic(1,$hrc_functionoption,true,true,false,40,'',535,535,false);
						} 
						else if ($hrc_albumorimage == 'none') {
							// print nothing
						}						
						else {
							$randomImage = getRandomImages($hrc_functionoption);
							if (is_object($randomImage) && $randomImage->exists) {
								$randomImageURL = html_encode(getURL($randomImage));
								$html =  "<img src=\"".html_encode($randomImage->getCustomImage(620, NULL, NULL, NULL, NULL, NULL, NULL, TRUE))."\" alt=\"" . html_encode($randomImage->getTitle()) . "\" />\n";
								echo zp_apply_filter('custom_image_html', $html, false);
							}
						} 
						?>
					</div>
				</div>			

<?php include ("inc-footer.php"); ?>			
