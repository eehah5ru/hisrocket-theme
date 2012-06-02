<?php include ("inc-header.php"); ?>

			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				
				<div id="canvas-container" class="grid_9 omega">
				<div id="canvas" style="<?php echo printHCACSSForAlbum(); ?>">
					<input type="hidden" name="album_folder" value="<?php echo $_zp_current_album->getFolder()?>">
					
					<?php if (!(strlen(getAlbumDesc()) == 0)) { ?>
						<div id="post" class="post grid_6 suffix_2 alpha">
							<h2 class="top"><?php printAlbumTitle(true); ?></h2>
							<?php echo getAlbumDesc() ?>
							</div>
					<?php } ?>
										
					<?php $image_number = 0; ?>
					<?php while (next_image()): ?>
						<?php $image_number = $image_number + 1; ?>
						<div id="image-<?php echo $image_number; ?>" class="an-image" style="<?php echo printHCACSSForImage(); ?>">
							<input type="hidden" value="<?php echo $_zp_current_image->getFileName(); ?>">
							<?php printCustomSizedImage(getAnnotatedImageTitle(), NULL, getHCAWidth(), NULL, NULL, NULL, NULL, NULL, NULL, "img-".$image_number); ?>
						</div>
					<?php endwhile; ?>
				</div>
				</div>
			</div>

<?php include ("inc-footer.php"); ?>			
