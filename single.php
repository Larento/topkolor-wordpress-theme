<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
      <p>this is single post</p>
    <?php
      $attachments = tk_get_product_media();
      echo var_dump($attachments);
      if ( strpos($attachments, 'Error') === false ) {
        foreach ( $attachments as $attachment ) {
          $URL = wp_get_attachment_image_url( $attachment, 'full' );
          ?>
            <img src=<?= $URL ?> alt="kinky"></img> 
          <?php
        };
      };
    ?>
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>