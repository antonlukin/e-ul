<form class="topline__search-form search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
	<input class="search__input input" name="s" type="text" value="<?php echo get_search_query(); ?>" role="search" placeholder="Поиск по новостям">

	<button class="search__button" type="submit">
		<span class="icon icon--search"></span>
		<span class="icon icon--right"></span>
	</button>
</form>
