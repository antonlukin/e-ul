/**
 * Init swiper on DOM load
 */
document.addEventListener('DOMContentLoaded', function () {
  if (typeof Swiper === 'undefined') {
    return;
  }

  var options = {
    navigation: {
      nextEl: '.slider-nav-next',
      prevEl: '.slider-nav-prev',
      disabledClass: 'slider-nav-disabled',
      hiddenClass: 'slider-nav-hidden'
    },

    loop: true,
    a11y: false
  }

  new Swiper('.swiper-container', options);
});