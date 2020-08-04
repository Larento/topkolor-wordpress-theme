<form class="search-bar" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <button class="search-button" type="submit">
    <a <?= tk_icon('002', 'solid') ?>></a>
  </button>    
  <input type="text" class="search-field" name="s" placeholder="Поиск по сайту" value="<?php echo get_search_query(); ?>">
  <button class="search-button" type="submit">
    <a <?= tk_icon('002', 'solid') ?>></a>
  </button>   
</form>
<button class="close-search-button">
  <a <?= tk_icon('002', 'solid') ?>></a>
</button>