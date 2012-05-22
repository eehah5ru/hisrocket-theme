<?php include ("inc-header.php"); ?>

			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				
				<div id="thumbs-wrap" class="grid_9 omega">
					<div class="scrollable">
					<div id="scrollable-container" class="container">
						<?php if (!(getAlbumDesc().length == 0)) { ?>
							<div id="post" class="post grid_6 suffix_2 alpha">
								<h2 class="top"><?php printAlbumTitle(true); ?></h2>
								<?php echo getAlbumDesc() ?>
								</div>
						<?php } ?>
						<?php $image_number = 0; ?>
						<?php while (next_image()): ?>
						<?php $image_number = $image_number + 1; ?>
						
						<div id="image-wrap-<?php echo $image_number; ?>" class="an-image suffix_2">
						<?php if ((getAlbumDesc().length == 0)) { ?>
							<div class="alpha image-nav grid_6 omega">
								<span><?php $image_number == 1 ? printAlbumTitle(true) : "&nbsp;"; ?></span>
							</div>
						<?php } ?>						
							<div id="full-image-<?php echo $image_number; ?>">
								<?php if (($hrlfh_finallink)=='colorbox') { ?><a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
								<?php if (($hrlfh_finallink)=='nolink') { printCustomSizedImage(getAnnotatedImageTitle(),620); } ?>
								<?php if (($hrlfh_finallink)=='standard') { ?><a href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
								<?php if (($hrlfh_finallink)=='standard-new') { ?><a target="_blank" href="<?php echo html_encode(getFullImageURL());?>" title="<?php echo getBareImageTitle();?>"><?php printCustomSizedImage(getAnnotatedImageTitle(),620); ?></a><?php } ?>
							</div>

						</div>
						<?php endwhile; ?>
						<div id="last-item" class="grid_1 suffix_3 omega">
							&nbsp;
						</div>
					</div>
					</div>
				</div>
			</div>

<?//php include ("inc-footer.php"); ?>			
