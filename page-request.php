<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
    <h4>There will be a form here</h4>
    <form action="/request/success">
      <div class="style">
        <p>Стиль изделия:</p>
        <?php
          $post_types = get_post_types( ['description'  => 'Product',], 'objects' );
          $taxonomy_slug = [];
          foreach ( $post_types as $post_type ) {
            $post_slug = $post_type->name;
            $post_label = $post_type->labels->all_items;
            $taxonomy_slug[$post_slug] = tk_taxonomy_name('', $post_slug);
            ?>
              <input type="radio" id=<?= $post_slug ?> name="style" value=<?= $post_slug ?>>
              <label for=<?= $post_slug ?>><?= $post_label ?></label><br>
            <?php
          };
        ?>
      </div>

      <div class="kind">
        <p>Вид изделия:</p>
        <?php
          foreach ($post_types as $post_slug => $post_type->name) {
            $taxonomy_terms = get_terms($taxonomy_slug[$post_slug]);
            foreach ($taxonomy_terms as $term) {
              ?>
              <span><?= $term ?></span>
              <?php
            };
          };
        ?>



        <input type="radio" id="age1" name="age" value="30">
        <label for="age1">0 - 30</label><br>
        <input type="radio" id="age2" name="age" value="60">
        <label for="age2">31 - 60</label><br>  
        <input type="radio" id="age3" name="age" value="100">
        <label for="age3">61 - 100</label><br>
        <input type="submit" value="Submit"><br>
      </div>
      
    </form>
		</div>
	</section>
</main>
<?php get_footer(); ?>