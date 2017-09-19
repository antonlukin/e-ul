(function(){
  document.querySelector('.toggle').addEventListener('click', function(e) {
    e.preventDefault();

    this.classList.toggle('toggle--expand');
    document.querySelector('.menu').classList.toggle('menu--expand');
  })

  var slider = tns({
    container: '.slider__list',
    items: 1,
    loop: false,
    slideBy: 'page',
    nav: false,
    controlsContainer: ".slider__control"
  });
})();
