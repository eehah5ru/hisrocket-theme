<?php include ("inc-header.php"); ?>

			</div> <!-- close #header -->
			<div id="content">
				<div id="main"<?php if ($hrlfh_switch) echo ' class="switch"'; ?>>
					<div id="albums-wrap">
						<?php while (next_album()): ?>
						<div class="album-maxspace">
							<a class="thumb-link" href="<?php echo html_encode(getAlbumLinkURL());?>" title="<?php echo getNumAlbums().' '.gettext('subalbums').' / '.getNumImages().' '.gettext('images').' - '.shortenContent(getAlbumDesc(),300,'...'); ?>">
								<?php if ($hrlfh_thumb_crop) {
								printCustomAlbumThumbImage(getAnnotatedAlbumTitle(),null,$hrlfh_album_thumb_size,$hrlfh_album_thumb_size,$hrlfh_album_thumb_size,$hrlfh_album_thumb_size);
								} else {
								printCustomAlbumThumbImage(getAnnotatedAlbumTitle(),$hrlfh_album_thumb_size);
								} ?>
								<span class="album-title"><?php /*echo shortenContent(getBareAlbumTitle(),25,'...');*/ echo getBareAlbumTitle(); ?></span>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
					<?php if ( (hasPrevPage()) || (hasNextPage()) ) { ?>
					<div id="pagination">
						<?php printPageListWithNav("&larr; ".gettext("prev"), gettext("next")." &rarr;"); ?>
					</div>
					<?php } ?>
				</div>
				<div id="sidebar"<?php if ($hrlfh_switch) echo ' class="switch"'; ?>>
					<!--div class="sidebar-divide">
						<?php printGalleryDesc(true); ?>
					</div-->
					<?php include ("inc-sidemenu.php"); ?>
					<!--
					<?php if ($zenpage) { ?>
					<div class="latest">
						<?php printLatestNews(2); ?>
					</div>
					<?php } ?>
					-->
				</div>
			</div>

<?php include ("inc-footer.php"); ?>			
