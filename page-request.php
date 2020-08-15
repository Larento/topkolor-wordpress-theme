<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
    <h4>There will be a form here</h4>
    
    <form>
      <div class="style">
        <p>Стиль</p>
        <?php
        $post_types = get_post_types( ['description'  => 'Product',], 'objects' );
        foreach ( $post_types as $post_type ) {
          $slug = $post_type->slug;
          $label = $post_type->labels->all_items;
          ?>
            <input type="radio" id=<?= $slug ?> name="style" value=<?= $slug ?>>
            <label for=<?= $slug ?>><?= $label ?></label><br>
          <?php
        };
        ?>
      </div>

      <div class="kind">
        <p>Please select your age:</p>
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