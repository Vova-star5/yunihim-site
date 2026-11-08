/* Header: past the hero it becomes a compact bar (on phones — after the first scroll) */
(function () {
  'use strict';

  var header = document.querySelector('.site-header');
  if (!header) return;

  var hero = document.querySelector('.hero');
  var ticking = false;

  function update() {
    ticking = false;
    var mobile = window.matchMedia('(max-width: 960px)').matches;
    var limit = mobile ? 8 : (hero ? hero.offsetTop + hero.offsetHeight - 68 : 400);
    header.classList.toggle('site-header--stuck', window.pageYOffset > limit);
  }

  window.addEventListener('scroll', function () {
    if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
  }, { passive: true });
  window.addEventListener('resize', update);
  update();
})();
