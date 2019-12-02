<?php
/**
 * Single template sidebar
 *
 * @package knife-theme
 * @since 1.1
 * @version 1.2
 */
?>

<aside class="sidebar">
	<?php
		if ( is_active_sidebar( 'eul-sidebar' ) ) :
			dynamic_sidebar( 'eul-sidebar' );
		endif;
	?>
</aside>
