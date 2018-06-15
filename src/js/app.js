(function(){
	document.querySelector('.topline__button--menu').addEventListener('click', function(e) {
	e.preventDefault();

	this.classList.toggle('toggle--expand');
		document.querySelector('.menu').classList.toggle('menu--expand');
		document.querySelector('body').classList.toggle('locked');
	})

	document.querySelector('.topline__button--search').addEventListener('click', function(e) {
		e.preventDefault();

		document.querySelector('.topline__search').classList.toggle('topline__search--expand');
	})

	var slider = tns({
		container: '.slider__list',
		items: 1,
		loop: false,
		slideBy: 'page',
		nav: false,
		loop: true,
		controlsContainer: ".slider__control"
	});

	var findAncestor = function(el, selector) {
		while ((el = el.parentElement) && !((el.matches || el.matchesSelector).call(el, selector))) {}
		return el;
	};

	var fields = document.querySelectorAll('input[name="q"][data-search-input]');

	fields.forEach(function(field) {
		var form = findAncestor(field, 'form[data-simplesearch-form]'),
			location = field.getAttribute('data-search-input'),
			separator = field.getAttribute('data-search-separator');

		form.addEventListener('submit', function(event) {
			event.preventDefault();

			if (field.checkValidity()) {
				window.location.href = location + separator + field.value;
			}
		});
	});
})();
