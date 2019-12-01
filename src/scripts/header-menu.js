(function () {
	/**
	 * Toggle menu
	 */
	document.getElementById('toggle-menu').addEventListener('click', function (e) {
		e.preventDefault();

		// Update button class first
		this.classList.toggle('toggle-expand');

		// Toggle menu and body
		document.querySelector('.header-menu').classList.toggle('header-menu-expand');
		document.querySelector('body').classList.toggle('is-menu');
	})


	/**
	 * Toggle search bar
	 */
	document.getElementById('toggle-search').addEventListener('click', function (e) {
		e.preventDefault();

		document.querySelector('.header-topline-form').classList.toggle('header-topline-expand');
	})
})();