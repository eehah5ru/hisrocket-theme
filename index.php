<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="image-wrap" class="grid_9 omega">
					<div class="post album-desc">
						<h2 class="top">&nbsp;</h2>
					</div>
					<div id="full-image" style="display:none">
						<?php 
						switch (getOption('hrvb_homeoption')) {
							case "album-latest":
							$hrvb_albumorimage = 'album'; $hrvb_functionoption = 'latest';
						break;
							case "album-latestupdated":
							$hrvb_albumorimage = 'album'; $hrvb_functionoption = 'latestupdated';
						break;
							case "album-mostrated":
							$hrvb_albumorimage = 'album'; $hrvb_functionoption = 'mostrated';
						break;
							case "album-toprated":
							$hrvb_albumorimage = 'album'; $hrvb_functionoption = 'toprated';
						break;
							case "image-latest":
							$hrvb_albumorimage = 'image'; $hrvb_functionoption = 'latest';
						break;
							case "image-latest-date":
							$hrvb_albumorimage = 'image'; $hrvb_functionoption = 'latest-date';
						break;
							case "image-latest-mtime":
							$hrvb_albumorimage = 'image'; $hrvb_functionoption = 'latest-mtime';
						break;
							case "image-popular":
							$hrvb_albumorimage = 'image'; $hrvb_functionoption = 'popular';
						break;
							case "image-mostrated":
							$hrvb_albumorimage = 'image'; $hrvb_functionoption = 'mostrated';
						break;
							case "image-toprated":
							$hrvb_albumorimage = 'image'; $hrvb_functionoption = 'toprated';
						break;
							case "random-daily":
							$hrvb_albumorimage = ''; $hrvb_functionoption = 'daily';
						break;
							case "none":
							$hrvb_albumorimage = 'none'; $hrvb_functionoption = 'none';
						break;						
						} ?>
						<?php 
						

						if ($hrvb_albumorimage == 'image') {
							printImageStatistic(1,$hrvb_functionoption,'',false,false,false, 0,'',620,NULL,false, false, false, true);
						} 
						else if ($hrvb_albumorimage == 'album') {
							printAlbumStatistic(1,$hrvb_functionoption,true,true,false,40,'',535,535,false);
						} 
						else if ($hrvb_albumorimage == 'none') {
							// print nothing
						}						
						else {
							$randomImage = getRandomImages($hrvb_functionoption);
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
