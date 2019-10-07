<?php get_header(); ?>

<section class="basic-content py-40">
	<div class="container">
		<div class="row">
			<div class="col-xl-10 mx-auto">
				<h1 class="mb-20">Search Results for "<?php echo get_search_query(); ?>"</h1>
				
				<div class="row">
				<?php if($posts): ?>
					<?php
						foreach($posts as $p):
						$pid = $p->ID;
						$content = apply_filters('the_content', $p->post_content);
						$content = wp_trim_words( $content, 30, '...' );
						$post_type = get_post_type_object( $p->post_type );
					?>
						<div class="col-lg-12">
							<div class="search-result">							
								<h3 class="title"><a href="<?php echo get_permalink($pid); ?>"><?php echo $p->post_title; ?></a></h3>
								<em><?php echo $post_type->labels->singular_name; ?> - <?php echo get_the_date( '', $pid ); ?></em>
								<p><?php echo $content; ?></p>
							</div><!-- /search result -->
						</div><!-- /col -->
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