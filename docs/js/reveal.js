/* Reveal on scroll: only what starts below the fold; static under reduced motion */
(function () {
  'use strict';

  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion || !('IntersectionObserver' in window)) return;

  var vh = window.innerHeight || document.documentElement.clientHeight;
  var io = new IntersectionObserver(function (entries) {
    var n = 0;
    entries.forEach(function (e) {
      if (!e.isIntersecting) return;
      e.target.style.setProperty('--d', Math.min(n, 5) * 90 + 'ms');
      e.target.classList.remove('reveal--hidden');
      io.unobserve(e.target);
      n++;
    });
  }, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });

  Array.prototype.forEach.call(document.querySelectorAll('.reveal'), function (el) {
    if (el.getBoundingClientRect().top < vh * 0.92) return;
    el.classList.add('reveal--hidden');
    io.observe(el);
  });
})();
