<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
    <h4>There will be a form here</h4>
    <?php
      $args = [
        'description'  => 'Product',
      ];
      $post_types = get_post_types( $args, 'objects' ); 
      echo '<ul>';
      foreach ( $post_types as $post_type ) {
        echo '<li>' . $post_type->labels->all_items . '</li>';
      };
      echo '</ul>';
    ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>