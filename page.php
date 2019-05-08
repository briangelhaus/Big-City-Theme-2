<?php get_header(); ?>

<?php include('includes/banner.php'); ?>

<section class="basic-content py-40">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1><?php the_title(); ?></h1>
				<?php echo apply_filters('the_content', $post->post_content); ?>
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- /container -->
</section><!-- /basic content -->

<?php get_footer(); ?>