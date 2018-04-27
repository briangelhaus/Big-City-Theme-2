<?php get_header(); ?>

<?php include('includes/banner.php'); ?>

<div class="page-content">
	<div class="container">

		<div class="row">
			<div class="col-md-3 order-2 order-md-1">
				<div class="blog-sidebar">
					<h3>Categories</h3>
					<ul>
						<?php foreach(get_categories() as $c): ?>

						<li><a href="<?php echo get_category_link($c->term_id); ?>"><?php echo $c->name; ?></a></li>

						<?php endforeach; ?>
					</ul>
				</div><!-- /sidebar -->
			</div><!-- /col -->
			<div class="col-md-9 order-1 order-md-2">
				<div class="row">
					<div class="col-sm-12">
						<h1><?php the_title(); ?></h1>
					</div><!-- col -->
				</div><!-- row -->

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
						$content = apply_filters('the_content', $p->post_content);
						$content = truncate(strip_tags($content, ''),150);
					?>
					<div class="col-md-4 col-sm-6 post">
						<a href="<?php echo get_permalink($pid); ?>" class="post-link">
							<?php if($featuredImage): ?>
								<img class="post-image img-fluid" src="<?php echo $featuredImageURL; ?>" alt="<?php echo get_the_title($pid); ?>">
							<?php else: ?>
								<img class="post-image img-fluid" src="http://placehold.it/600x450"></a>
							<?php endif; ?>
							<h2 class="post-title"><?php echo $p->post_title; ?></h2>
						</a>
						<span class="p post-date"><?php echo get_the_date('', $pid); ?></span>
						<p><?php echo $content; ?>... <a href="<?php echo get_permalink($pid); ?>" class="post-read-more">Read More</a></p>
					</div>
<?php /*
					<?php if($count % 3 == 0): ?>
					</div><!-- /row -->
					<div class="row blog-posts">
					<?php endif; ?>
*/ ?>
					<?php endforeach; ?>
				</div><!-- /row -->

				<div class="row">
					<div class="col-sm-12">
						<div class="blog-pagination">
							<?php
								$big = 999999999; // need an unlikely integer
								echo paginate_links( array(
									//'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									//'format' => '?paged=%#%',
									'current' => max( 1, $paged ),
									'total' => $query->max_num_pages
								) );
							?>
						</div><!-- /pagination -->
					</div><!-- /col -->
				</div><!-- /row -->
			</div><!-- /col 9 -->
		</div><!-- /row -->

	</div><!-- /container -->
</div><!-- /page content -->

<?php get_footer(); ?>
