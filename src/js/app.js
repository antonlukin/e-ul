(function(){
  document.querySelector('.toggle').addEventListener('click', function(e) {
    e.preventDefault();

    this.classList.toggle('toggle--expand');
    document.querySelector('.menu').classList.toggle('menu--expand');
  })
})();
