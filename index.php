<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="image-wrap" class="grid_9 omega">
					<div id="full-image" style="display:none">
						<?php 
						switch (getOption('hrsi_homeoption')) {
							case "album-latest":
							$hrsi_albumorimage = 'album'; $hrsi_functionoption = 'latest';
						break;
							case "album-latestupdated":
							$hrsi_albumorimage = 'album'; $hrsi_functionoption = 'latestupdated';
						break;
							case "album-mostrated":
							$hrsi_albumorimage = 'album'; $hrsi_functionoption = 'mostrated';
						break;
							case "album-toprated":
							$hrsi_albumorimage = 'album'; $hrsi_functionoption = 'toprated';
						break;
							case "image-latest":
							$hrsi_albumorimage = 'image'; $hrsi_functionoption = 'latest';
						break;
							case "image-latest-date":
							$hrsi_albumorimage = 'image'; $hrsi_functionoption = 'latest-date';
						break;
							case "image-latest-mtime":
							$hrsi_albumorimage = 'image'; $hrsi_functionoption = 'latest-mtime';
						break;
							case "image-popular":
							$hrsi_albumorimage = 'image'; $hrsi_functionoption = 'popular';
						break;
							case "image-mostrated":
							$hrsi_albumorimage = 'image'; $hrsi_functionoption = 'mostrated';
						break;
							case "image-toprated":
							$hrsi_albumorimage = 'image'; $hrsi_functionoption = 'toprated';
						break;
							case "random-daily":
							$hrsi_albumorimage = ''; $hrsi_functionoption = 'daily';
						break;
							case "none":
							$hrsi_albumorimage = 'none'; $hrsi_functionoption = 'none';
						break;						
						} ?>
						<?php 
						
						if ($hrsi_albumorimage == 'image') {
							printImageStatistic(1,$hrsi_functionoption,'',true,true,false,40,'',535,535,false);
						} 
						else if ($hrsi_albumorimage == 'album') {
							printAlbumStatistic(1,$hrsi_functionoption,true,true,false,40,'',535,535,false);
						}
						else if ($hrsi_albumorimage == 'none') {
							// print nothing
						} 
						else {
							$randomImage = getRandomImages($hrsi_functionoption);
							if (is_object($randomImage) && $randomImage->exists) {
								$randomImageURL = html_encode(getURL($randomImage));
								$html =  "<img src=\"".html_encode($randomImage->getCustomImage(620, NULL, NULL, NULL, NULL, NULL, NULL, TRUE))."\" alt=\"" . html_encode($randomImage->getTitle()) . "\" />\n";
								echo zp_apply_filter('custom_image_html', $html, false);
							}
						} 
						?>
					</div>
				</div>			

<?php //include ("inc-footer.php"); ?>			
