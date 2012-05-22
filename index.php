<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="image-wrap" class="grid_9 omega">
					<div id="full-image" style="display:none">
						<?php 
						switch (getOption('hrlfh_homeoption')) {
							case "album-latest":
							$hrlfh_albumorimage = 'album'; $hrlfh_functionoption = 'latest';
						break;
							case "album-latestupdated":
							$hrlfh_albumorimage = 'album'; $hrlfh_functionoption = 'latestupdated';
						break;
							case "album-mostrated":
							$hrlfh_albumorimage = 'album'; $hrlfh_functionoption = 'mostrated';
						break;
							case "album-toprated":
							$hrlfh_albumorimage = 'album'; $hrlfh_functionoption = 'toprated';
						break;
							case "image-latest":
							$hrlfh_albumorimage = 'image'; $hrlfh_functionoption = 'latest';
						break;
							case "image-latest-date":
							$hrlfh_albumorimage = 'image'; $hrlfh_functionoption = 'latest-date';
						break;
							case "image-latest-mtime":
							$hrlfh_albumorimage = 'image'; $hrlfh_functionoption = 'latest-mtime';
						break;
							case "image-popular":
							$hrlfh_albumorimage = 'image'; $hrlfh_functionoption = 'popular';
						break;
							case "image-mostrated":
							$hrlfh_albumorimage = 'image'; $hrlfh_functionoption = 'mostrated';
						break;
							case "image-toprated":
							$hrlfh_albumorimage = 'image'; $hrlfh_functionoption = 'toprated';
						break;
							case "random-daily":
							$hrlfh_albumorimage = ''; $hrlfh_functionoption = 'daily';
						break;
							case "none":
							$hrlfh_albumorimage = 'none'; $hrlfh_functionoption = 'none';
						break;						
						} ?>
						<?php 
						
						if ($hrlfh_albumorimage == 'image') {
							printImageStatistic(1,$hrlfh_functionoption,'',true,true,false,40,'',535,535,false);
						} 
						else if ($hrlfh_albumorimage == 'album') {
							printAlbumStatistic(1,$hrlfh_functionoption,true,true,false,40,'',535,535,false);
						} 
						else if ($hrlfh_albumorimage == 'none') {
							// print nothing
						}						
						else {
							$randomImage = getRandomImages($hrlfh_functionoption);
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
