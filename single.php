<?php get_header(); ?>

<div class="main-container">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div <?php post_class('main-content'); ?>>
					<h1><?php the_title(); ?></h1>
					<?php echo apply_filters('the_content', $post->post_content); ?>
				</div><!-- /main content -->
			</div><!-- col -->
		</div><!-- row -->

	</div><!-- /container -->
</div><!-- /main container -->

<?php get_footer(); ?>