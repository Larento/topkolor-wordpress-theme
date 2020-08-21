<main role="main">
	<section class="tk-section post document">
		<div class="container">
    <?php
      $attachments = tk_get_product_media();
      //if ( strpos($attachments, 'Error') === false ) {
        foreach ( $attachments as $attachment ) {
          $URL = wp_get_attachment_image_url( $attachment, 'full' );
          ?>
            <img src=<?= $URL ?> alt="kinky"> 
          <?php
        };
     // };
    ?>
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		</div>
	</section>
</main>