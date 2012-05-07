<?php include ("inc-header.php"); ?>

			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				
				<h3 id="album-title" class="grid_9 omega"><?php printAlbumTitle(true); ?></h3>					

				<div id="thumbs-wrap" class="grid_9 omega">
					<div class="scrollable">
					<div id="scrollable-container" class="container">
						<?php $image_number = 0; ?>
						<?php while (next_image()): ?>
						<?php $image_number = $image_number + 1; ?>
						<div id="image-wrap-<?php echo $image_number; ?>" class="grid_9 alpha omega">
							<div id="full-image-<?php echo $image_number; ?>">
								<?php if (($hrl_finallink)=='colorbox') { ?><a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
								<?php if (($hrl_finallink)=='nolink') { printCustomSizedImage(getAnnotatedImageTitle(),620); } ?>
								<?php if (($hrl_finallink)=='standard') { ?><a href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
								<?php if (($hrl_finallink)=='standard-new') { ?><a target="_blank" href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
							</div>

						</div>
						<?php endwhile; ?>
					</div>
					</div>
				</div>
			</div>

<?//php include ("inc-footer.php"); ?>			
