<?php get_header(); ?>

<div class="page-content">
	<div class="container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="main-content">
					<h1>Search Results for "<?php echo $_GET['s']; ?>"</h1>
					<?php if($posts): ?>
						<?php
							foreach($posts as $p):
							$content = apply_filters('the_content', $p->post_content);
							$content = truncate(strip_tags($content, ''),200);
						?>
							<h3><a href="<?php echo get_permalink($p->ID); ?>"><?php echo $p->post_title; ?></a></h3>
							<p><?php echo $content; ?></p>
						<?php endforeach; ?>
					<?php else: ?>
						<p>No results found.</p>
					<?php endif; ?>
				</div><!-- /main-content -->
			</div><!-- col -->
		</div><!-- row -->

	</div><!-- /container -->
</div><!-- /page content -->

<?php get_footer(); ?>