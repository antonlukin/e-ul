(function(){
  document.querySelector('.topline__button--menu').addEventListener('click', function(e) {
    e.preventDefault();

    this.classList.toggle('toggle--expand');
    document.querySelector('.menu').classList.toggle('menu--expand');
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
})();
