<?php get_header(); ?>

<div class="main-container">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div <?php post_class('main-content'); ?>>
					<h1>
						<?php
							if ( is_category() ){
								single_cat_title();
							}elseif( is_tag() ){
								single_tag_title();
							}
						?>
					</h1>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div <?php post_class(); ?>>
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<?php the_content(); ?>
						</div>

					<?php endwhile; else: ?>

						<p>No content yet.</p>

					<?php endif; ?>
				</div><!-- /main content -->
			</div><!-- col -->
		</div><!-- row -->

	</div><!-- /container -->
</div><!-- /main container -->

<?php get_footer(); ?>