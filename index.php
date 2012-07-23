<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="image-wrap" class="grid_9 omega">
					<div id="full-image" style="display:none">
						<?php 
						switch (getOption('hrv_homeoption')) {
							case "album-latest":
							$hrv_albumorimage = 'album'; $hrv_functionoption = 'latest';
						break;
							case "album-latestupdated":
							$hrv_albumorimage = 'album'; $hrv_functionoption = 'latestupdated';
						break;
							case "album-mostrated":
							$hrv_albumorimage = 'album'; $hrv_functionoption = 'mostrated';
						break;
							case "album-toprated":
							$hrv_albumorimage = 'album'; $hrv_functionoption = 'toprated';
						break;
							case "image-latest":
							$hrv_albumorimage = 'image'; $hrv_functionoption = 'latest';
						break;
							case "image-latest-date":
							$hrv_albumorimage = 'image'; $hrv_functionoption = 'latest-date';
						break;
							case "image-latest-mtime":
							$hrv_albumorimage = 'image'; $hrv_functionoption = 'latest-mtime';
						break;
							case "image-popular":
							$hrv_albumorimage = 'image'; $hrv_functionoption = 'popular';
						break;
							case "image-mostrated":
							$hrv_albumorimage = 'image'; $hrv_functionoption = 'mostrated';
						break;
							case "image-toprated":
							$hrv_albumorimage = 'image'; $hrv_functionoption = 'toprated';
						break;
							case "random-daily":
							$hrv_albumorimage = ''; $hrv_functionoption = 'daily';
						break;
							case "none":
							$hrv_albumorimage = 'none'; $hrv_functionoption = 'none';
						break;						
						} ?>
						<?php 
						
						if ($hrv_albumorimage == 'image') {
							printImageStatistic(1,$hrv_functionoption,'',true,true,false,40,'',535,535,false);
						} 
						else if ($hrv_albumorimage == 'album') {
							printAlbumStatistic(1,$hrv_functionoption,true,true,false,40,'',535,535,false);
						} 
						else if ($hrv_albumorimage == 'none') {
							// print nothing
						}						
						else {
							$randomImage = getRandomImages($hrv_functionoption);
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
