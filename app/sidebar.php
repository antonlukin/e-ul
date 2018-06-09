<?php
/**
 * Single template sidebar
 *
 * Show last news and related posts
 *
 * @package knife-theme
 * @since 1.1
 */
?>

<aside class="sidebar">

<?php
	if(is_active_sidebar('eul-sidebar')) :
		dynamic_sidebar('eul-sidebar');
	endif;
?>

</aside>
