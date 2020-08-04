<form class="search-bar" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search-field" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
    <a <?= tk_icon('007', 'solid') ?>><input class="search-button" type="submit" value=""></a>
</form>
