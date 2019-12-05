<?php get_header(); ?>

<?php include('includes/banner.php'); ?>

<section class="basic-content py-40">
	<div class="container">

		<div class="row">
			<div class="col-lg-3 order-2 order-lg-1">
				<?php get_sidebar(); ?>
			</div><!-- /col -->
			
			<div class="col-lg-9 order-1 order-lg-2">

				<div class="row blog-posts">
					<?php
						$pageNumber = ($paged) ? $paged : 1;
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => 10,
							'post_status' => 'publish',
							'paged' => $pageNumber,
						);
						$query = new WP_Query($args);
						//$count = 0;
						foreach($query->posts as $p):
						//$count++;
						$pid = $p->ID;
						$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($pid), 'medium' );
						$featuredImageURL = $featuredImage[0];
						//$cats = get_the_category($pid); // get post cat
						//$cats = get_the_terms($pid, 'CUSTOM_CAT'); // get custom taxonomy cat
						$content = wp_trim_words( $p->post_content, 25, '...' );
					?>
					<div class="col-md-6 post">
						<a href="<?php echo get_permalink($pid); ?>" class="post-link d-block mb-10">
							<?php if($featuredImage): ?>
								<img class="img-fluid" src="<?php echo $featuredImageURL; ?>" alt="<?php echo $p->post_title; ?>">
							<?php else: ?>
								<img class="img-fluid" src="http://placehold.it/600x450"></a>
							<?php endif; ?>
							<h2 class="fs4"><?php echo $p->post_title; ?></h2>
						</a>
						<em class="post-date d-block mb-10"><?php echo get_the_date('', $pid); ?></em>
						<p><?php echo $content; ?> <a href="<?php echo get_permalink($pid); ?>" class="post-read-more">Read More</a></p>
					</div><!-- /post -->
					<?php endforeach; ?>
				</div><!-- /row -->

				<div class="row">
					<div class="col-lg-12">
						<div class="blog-pagination">
							<?php
								echo paginate_links( array(
									'current' => max( 1, $paged ),
									'total' => $query->max_num_pages
								) );
							?>
						</div><!-- /pagination -->
					</div><!-- /col -->
				</div><!-- /row -->
				
			</div><!-- /col -->
		</div><!-- /row -->

	</div><!-- /container -->
</section><!-- /page content -->

<?php get_footer(); ?>
