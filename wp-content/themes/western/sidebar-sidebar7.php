				<div id="sidebar7" class="sidebar threecol last clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'sidebar7' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar7' ); ?>
						<?php include('connected-sidebar.php'); ?>
					<?php else : ?>

						<?php // This content shows up if there are no widgets defined in the backend. ?>

						<div class="alert alert-help">
							<p><?php _e( 'Please activate some Widgets.', 'bonestheme' );  ?></p>
						</div>

					<?php endif; ?>

				</div>