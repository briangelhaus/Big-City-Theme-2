<div class="sidebar">
	<h3>Categories</h3>
	<ul>
		<?php foreach(get_categories() as $c): ?>
		<li><a href="<?php echo get_category_link($c->term_id); ?>"><?php echo $c->name; ?></a></li>
		<?php endforeach; ?>
	</ul>
	
	
<?php /*
	<?php
		// show category - gives you full control over html
		$tax = 'category_name';
		$terms = get_terms( array(
		    'taxonomy' => $tax,
		    'hide_empty' => false,
		) );
	?>
	
	<ul class="cat-list">
		<?php foreach($terms as $t): ?>

		<?php
			if($t->parent == 0):
			$term_children = get_term_children($t->term_id, $tax);
		?>
			<li>
				<a href="<?php echo get_term_link($t, $tax); ?>"><?php echo $t->name; ?> <span class="count">(<?php echo $t->count; ?>)</span></a>
				<?php if($term_children): ?>
				<ul>
					<?php
						foreach($term_children as $cid):
						$term = get_term_by('id', $cid, $tax);
					?>
					<li><a href="<?php echo get_term_link($term, $tax); ?>"><?php echo $term->name; ?> <span class="count">(<?php echo $term->count; ?>)</span></a></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</li>
		<?php endif; ?>

		<?php endforeach; ?>
	</ul>
*/ ?>

</div><!-- /sidebar -->