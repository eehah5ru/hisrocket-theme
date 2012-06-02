<?php include ("inc-header.php"); ?>

			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<?php 
					$show_description = !(strlen(getAlbumDesc()) == 0);

					makeImageCurrent($_zp_current_album->getImage(0));							
					?>
					
					<?/*php if ($has_description) { ?>

					<?php } */?>

					<div class="image-nav grid_9 omega">
						<?php 
							if (hasPrevImage()) { 
								$prev_url = getPrevImageURL();
							}
							else {
								$prev_url = getLastImageURL();

							 } 
						?>
						<a class="image-prev" href="<?php echo html_encode($prev_url);?>">&lt;</a>
						<?php 
							if ($show_description) {
								$next_url = getFirstImageURL();
							}
							else {
								$next_url = getNextImageURL();
							}
						?>
						<a class="image-next" href="<?php echo html_encode($next_url);?>">&gt;</a>
						<span id="album-title"><?php echo printAlbumTitle(true); ?></span>												
					</div>

					<div id="image-wrap" class="grid_9 omega">
						<?php
							if ($show_description) {
						?>
							<div id="post" class="post grid_6 suffix_2 alpha omega">
								<?php echo getAlbumDesc() ?>
							</div>
						<?php
							}
							else {
						?>
							<div id="full-image"  style="display:none">
								<?php if (($hrsi_finallink)=='colorbox') { ?><a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
								<?php if (($hrsi_finallink)=='nolink') { printCustomSizedImage("",620); } ?>
								<?php if (($hrsi_finallink)=='standard') { ?><a href="<?php echo html_encode(getFullImageURL());?>"><?php printCustomSizedImage("",620); ?></a><?php } ?>
								<?php if (($hrsi_finallink)=='standard-new') { ?><a target="_blank" href="<?php echo html_encode(getFullImageURL());?>"><?php printCustomSizedImage("",620); ?></a><?php } ?>
							</div>
						<?php
							}
						?>

					</div>
			</div>

<?php include ("inc-footer.php"); ?>			
