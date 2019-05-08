<?php get_header(); ?>

<section class="basic-content py-40">
	<div class="container">
		<div class="row">
			<div class="col-xl-10 mx-auto">
				<h1>Search Results for "<?php echo $_GET['s']; ?>"</h1>
				
				<div class="row">
				<?php if($posts): ?>
					<?php
						foreach($posts as $p):
						$content = apply_filters('the_content', $p->post_content);
						$content = wp_trim_words( $content, 25, '...' );
					?>
						<div class="col-lg-12 search-result">
							<h3><a href="<?php echo get_permalink($p->ID); ?>"><?php echo $p->post_title; ?></a></h3>
							<p><?php echo $content; ?></p>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p>No results found.</p>
				<?php endif; ?>
				</div><!-- /row -->
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- /container -->
</section><!-- /basic content -->

<?php get_footer(); ?>