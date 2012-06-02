<?php include ("inc-header.php"); ?>
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
				</div>
				<div id="albums-wrap" class="grid_9 omega">
						<?php while (next_album()): ?>
						<div class="album-maxspace">
							<a class="thumb-link" href="<?php echo html_encode(getAlbumLinkURL());?>" title="<?php echo getNumAlbums().' '.gettext('subalbums').' / '.getNumImages().' '.gettext('images').' - '.shortenContent(getBareAlbumDesc(),300,'...'); ?>">
								<?php if ($hrl_thumb_crop) {
								printCustomAlbumThumbImage(getAnnotatedAlbumTitle(),null,$hrl_album_thumb_size,$hrl_album_thumb_size,$hrl_album_thumb_size,$hrl_album_thumb_size);
								} else {
								printCustomAlbumThumbImage(getAnnotatedAlbumTitle(),$hrl_album_thumb_size);
								} ?>
								<span class="album-title"><?php echo shortenContent(getBareAlbumTitle(),25,'...'); ?></span>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
					<h3 id="album-title" class="grid_9 omega"><?php printAlbumTitle(true); ?></h3>					

				<div id="thumbs-wrap" class="grid_9 omega">
						<?php $image_number = 0; ?>
						<?php while (next_image()): ?>
						<?php $image_number = $image_number + 1; ?>
						<div class="thumb-maxspace grid_3 <?php echo $image_number % 3 == 1 ? 'alpha' : ($image_number % 3 == 0 ? 'omega' : '') ?>">
							<a class="thumb-link" href="<?php echo html_encode(getImageLinkURL());?>" title="<?php echo getBareImageTitle(); ?>"><?php printImageThumb(getAnnotatedImageTitle()); ?></a>
							<?php if (($hrl_colorbox) && (!isImageVideo())) { ?>
							<div class="cblinks">
								<a class="thickbox" href="<?php echo html_encode(getUnprotectedImageURL());?>" title="<?php echo getBareImageTitle(); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/zoom.png" /></a>
								<a href="<?php echo html_encode(getImageLinkURL());?>" title="<?php echo getBareImageTitle(); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/details.png" /></a>
							</div>
							<?php } ?>
						</div>
						<?php if ($image_number % 3 == 0) { ?>
							<div class="clear">&nbsp;</div>
						<?php } ?>
						<?php endwhile; ?>
					</div>

				<?php if ( (hasPrevPage()) || (hasNextPage()) ) { ?>
				<div id="pagination" class="grid_9 push_3">
					<?php printPageListWithNav("&larr; ".gettext("prev"), gettext("next")." &rarr;"); ?>
				</div>
				<?php } ?>
			</div>

<?php include ("inc-footer.php"); ?>			
