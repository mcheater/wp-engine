				<div id="sidebar5" class="sidebar threecol last clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'sidebar5' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar5' ); ?>
						<?php include('connected-sidebar.php'); ?>
					<?php else : ?>

						<?php // This content shows up if there are no widgets defined in the backend. ?>

						<div class="alert alert-help">
							<p><?php _e( 'Please activate some Widgets.', 'bonestheme' );  ?></p>
						</div>

					<?php endif; ?>

				</div>