<?php use \tk\functions as tk; ?>
<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <button class="search-button-submit" type="submit">
    <a class="no-text" <?= tk\icon('f002', 'solid') ?>></a>
  </button>    
  <input type="text" class="search-field" name="s" placeholder="Поиск по сайту" value="<?php echo get_search_query(); ?>">
  <button class="search-button-empty" type="button">
    <a class="no-text" <?= tk\icon('f057', 'solid') ?>></a>
  </button>   
</form>