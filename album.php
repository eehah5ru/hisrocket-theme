<?php include ("inc-header.php"); ?>

			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>

				<div id="thumbs-wrap" class="grid_9 omega">
							<div id="post" class="album-desc post grid_8 suffix_1 alpha omega">
								<h2 class="top"><?php printAlbumTitle(true); ?></h2>
								<?php if (!(strlen(getAlbumDesc()) == 0)) { ?>								
									<?php echo getAlbumDesc() ?>
								<?php } ?>
							</div>
							
						<?php $image_number = 0; ?>
												
						<?php while (next_image()): ?>
						<?php $image_number = $image_number + 1; ?>
							<div id="full-image-<?php echo $image_number; ?>" class="alpha grid_8 suffix_1 omega an-image <?php echo $image_number==1 ? 'top' : ''; ?>">
								<?php if (($hrv_finallink)=='colorbox') { ?><a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
								<?php if (($hrv_finallink)=='nolink') { printCustomSizedImage(NULL, NULL, 620); } ?>
								<?php if (($hrv_finallink)=='standard') { ?><a href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
								<?php if (($hrv_finallink)=='standard-new') { ?><a target="_blank" href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
							</div>


						<?php endwhile; ?>
						<div class="alpha grid_8 suffix_1 omega bottom-space">
						</div>
				</div>	
			</div>

<?php include ("inc-footer.php"); ?>			
