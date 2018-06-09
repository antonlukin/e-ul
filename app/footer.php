<?php
/**
 * Required footer file
 *
 * @package e-ul
 * @since 1.0
 */
?>


<footer class="footer">
	<?php
		wp_nav_menu([
			'theme_location' => 'footer_menu',
			'depth' => 2,
			'items_wrap' => '<ul class="footer__nav block">%3$s</ul>',
			'container' => false
		]);
	?>

	<div class="footer__copy block">
		<div class="footer__copy-inner">
			<p class="footer__copy-info">2017 &copy; ОГКУ &laquo;Правительство для граждан&raquo;</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
