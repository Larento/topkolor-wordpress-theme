<div class="search-bar">  
  <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <button class="search-button-submit" type="submit">
      <a <?= tk_icon('002', 'solid') ?>></a>
    </button>    
    <input type="text" class="search-field" name="s" placeholder="Поиск по сайту" value="<?php echo get_search_query(); ?>">
    <button class="search-button-empty">
      <a <?= tk_icon('057', 'solid') ?>></a>
    </button>   
  </form>
  <button class="search-button-close">
    <a <?= tk_icon('00d', 'solid') ?>></a>
  </button>
</div>