<?php
	get_header();

	$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
	$pageURL = get_the_permalink($post->ID);
	$pageTitle = get_the_title($post->ID);

/* if you want to show the last few posts
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status' => 'publish',
		'post__not_in'   => array(get_the_ID()), // grab any post besides the current one
	);
	$query = new WP_Query($args);
	$related_posts = $query->posts;
*/

/* if you want to show next or prev post only
	$next_post = get_previous_post();
	$prev_post = get_next_post();
*/
?>

<?php include('includes/banner.php'); ?>

<section class="basic-content py-40">
	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div <?php post_class('main-content'); ?>>

					<div class="social-share">
						<span class="social-share-text">SHARE: </span>
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $pageURL; ?>&amp;src=sdkpreparse">
							<i class="fab fa-facebook-square"></i>
						</a>
						<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $pageTitle; ?>&url=<?php echo $pageURL; ?>">
							<i class="fab fa-twitter-square"></i>
						</a>
						<a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?php echo $pageURL; ?>&media=<?php echo $featuredImage[0]; ?>&description=<?php echo $pageTitle; ?>...">
							<i class="fab fa-pinterest-square"></i>
						</a>
						<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $pageURL; ?>">
							<i class="fab fa-linkedin"></i>
						</a>
					</div><!-- /social share -->

					<?php echo apply_filters('the_content', $post->post_content); ?>
				</div><!-- /main content -->
			</div><!-- col -->
		</div><!-- row -->

<?php /* if you want to show next or prev post only

		<?php if($prev_post): ?>
		<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="prev post-link">&lt; Previous Post</a>
		<?php else: ?>
		<a href="<?php echo home_url(); ?>/blog" class="prev post-link"> &lt; Back to Blog</a>
		<?php endif; ?>

		<?php if($next_post): ?>
		<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="next post-link">Next Post &gt;</a>
		<?php else: ?>
		<a href="<?php echo home_url(); ?>/blog" class="next post-link">Back to Blog &gt;</a>
		<?php endif; ?>
*/ ?>

<?php /* if you want to show the last few posts

		<?php if($related_posts): ?>
			<div class="row">
				<div class="col-sm-12">
					<h3>More Posts</h3>
				</div><!-- /col -->
			</div><!-- /row -->
			<div class="related-posts blog-posts row">
			<?php
				foreach($related_posts as $p):
				$pid = $p->ID;
				$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($pid), 'medium' );
				$featuredImageURL = $featuredImage[0];
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
			</div><!-- row -->
		<?php endif; ?>
*/ ?>

	</div><!-- /container -->
</section><!-- /basic content -->

<?php get_footer(); ?>