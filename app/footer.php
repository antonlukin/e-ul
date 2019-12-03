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
	<ul class="footer-menu" role="navigation">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'footer_menu',
				'depth' => 2,
				'items_wrap' => '%3$s',
				'container' => false
			) );
		?>
	</ul>

	<div class="footer-info">
		<div class="social">
			<ul class="social-menu" role="navigation">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social_menu',
						'depth' => 1,
						'items_wrap' => '%3$s',
						'container' => false
					) );
				?>
			</ul>

			<p class="social-copy">
				<span>2017 &mdash; <?php echo date( 'Y' ) ?> &copy;</span>
				<span><?php _e( 'ОГКУ «Правительство для граждан»', 'e-ul' ); ?></span>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
