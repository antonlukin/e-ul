<?php
/**
 * Search form template part
 *
 * @since 1.0
 * @version 1.2
 */
?>

<form class="search" action="<?php echo esc_url ( home_url( '/' ) ); ?>" role="search">
	<?php
		printf(
			'<input class="search-input" type="text" name="s" placeholder="%s" value="%s" required>',
			__( 'Поиск по новостям', 'e-ul' ),
			get_search_query()
		);
	?>

	<button class="search-button" type="submit">
		<span class="search-button-loop"></span>
		<span class="search-button-right"></span>
	</button>
</form>