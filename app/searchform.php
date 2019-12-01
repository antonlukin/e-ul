<form class="search" action="<?php echo esc_url ( home_url( '/' ) ); ?>" role="search" >
	<input class="search__input" type="text" name="s" value="<?php echo get_search_query(); ?>" required placeholder="<?php _e( 'Поиск по новостям', 'e-ul' ) ?>">

	<button class="search__button" type="submit">
		<span class="search__button-search"></span>
		<span class="search__button-right"></span>
	</button>
</form>