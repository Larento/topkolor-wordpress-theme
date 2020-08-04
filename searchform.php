<form class="search-bar" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search-field" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
    <input class="search-button" type="submit" value=<?= tk_icon('007', 'solid') ?>>
</form>
