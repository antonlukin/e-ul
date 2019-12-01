<?php
/**
 * Required footer file
 *
 * @package e-ul
 * @since 1.0
 * @version 1.2
 */
?>

<footer class="footer">
	<div class="footer-menu">
		<ul class="footer-menu-list" role="navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer_menu',
					'depth' => 2,
					'items_wrap' => '%3$s',
					'container' => false
				) );
			?>
		</ul>
	</div>

	<div class="footer-copy">
		<p class="footer-copy-info">2017 &mdash; <?php echo date( 'Y' ) ?> &copy; <?php _e( 'ОГКУ «Правительство для граждан»', 'e-ul' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
