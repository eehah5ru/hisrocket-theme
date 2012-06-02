<?php include ("inc-header.php"); ?>

			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<?php 
					
					if (is_null($_zp_current_image)) {
						makeImageCurrent($_zp_current_album->getImage(0));	
					}
					?>
					


					<div class="image-nav grid_9 omega">
						<?php if (hasPrevImage()) { 
							$prev_url = getPrevImageURL();
						}
						else {
							$prev_url = getLastImageURL();
						 } ?>
						<a class="image-prev" href="<?php echo html_encode($prev_url);?>">&lt;</a>
						<?php if (hasNextImage()) { 
							$next_url = getNextImageURL();
						} 
						else {
							$next_url = getFirstImageURL();
						} ?>
						<a class="image-next" href="<?php echo html_encode($next_url);?>">&gt;</a>
						<span><?php echo printAlbumTitle(true); ?></span>												
					</div>

					<div id="image-wrap" class="grid_9 omega">

						<div id="full-image"  style="display:none">
							<?php if (($hrsi_finallink)=='colorbox') { ?><a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
							<?php if (($hrsi_finallink)=='nolink') { printCustomSizedImage("",620); } ?>
							<?php if (($hrsi_finallink)=='standard') { ?><a href="<?php echo html_encode(getFullImageURL());?>"><?php printCustomSizedImage("",620); ?></a><?php } ?>
							<?php if (($hrsi_finallink)=='standard-new') { ?><a target="_blank" href="<?php echo html_encode(getFullImageURL());?>"><?php printCustomSizedImage("",620); ?></a><?php } ?>
						</div>

					</div>
			</div>

<?php include ("inc-footer.php"); ?>			
