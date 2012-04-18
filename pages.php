<?php include ("inc-header.php"); ?>
			
			</div> <!-- close #header -->
			<div id="content" class="grid_12">
				<div id="sidebar" class="grid_3 alpha">
					<?php include ("inc-sidemenu.php"); ?>
					<?php if (getPageExtraContent()) { ?>
					<div class="sidebar-divide">
						<div class="extra-content"><?php printPageExtraContent(); ?></div>
					</div>
					<?php } ?>					
				</div>
				
				<div id="post" class="grid_9 omega">
					<h1><?php printPageTitle(); ?></h1>
					<?php printPageContent(); printCodeblock(1); ?>
				</div>

			</div>

<?//php include ("inc-footer.php"); ?>	