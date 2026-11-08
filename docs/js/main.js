/* Новая Формула — поведение лендинга: шапка, мобильное меню, анимация заголовка, появление блоков при прокрутке */
(function () {
  'use strict';

  var root = document.documentElement;
  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* Header: past the hero it becomes a compact bar (on phones — after the first scroll) */
  var header = document.querySelector('.site-header');
  var hero = document.querySelector('.hero');
  var stuckTick = false;

  function updateStuck() {
    stuckTick = false;
    var mobile = window.matchMedia('(max-width: 960px)').matches;
    var limit = mobile ? 8 : (hero ? hero.offsetTop + hero.offsetHeight - 68 : 400);
    header.classList.toggle('site-header--stuck', window.pageYOffset > limit);
  }

  if (header) {
    window.addEventListener('scroll', function () {
      if (!stuckTick) { stuckTick = true; window.requestAnimationFrame(updateStuck); }
    }, { passive: true });
    window.addEventListener('resize', updateStuck);
    updateStuck();
  }

  /* Mobile menu */
  var burger = document.querySelector('.burger');
  var nav = document.getElementById('site-nav');
  var backdrop = document.querySelector('.site-header__backdrop');

  function setMenu(open) {
    burger.setAttribute('aria-expanded', String(open));
    burger.classList.toggle('burger--active', open);
    nav.classList.toggle('site-nav--open', open);
    header.classList.toggle('site-header--menu-open', open);
  }

  if (header && burger && nav) {
    burger.addEventListener('click', function () { setMenu(burger.getAttribute('aria-expanded') !== 'true'); });
    nav.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
    if (backdrop) backdrop.addEventListener('click', function () { setMenu(false); });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && burger.getAttribute('aria-expanded') === 'true') { setMenu(false); burger.focus(); }
    });
  }

  /* Hero headline: measure real lines once the font is in, rise each from a mask, then restore plain text */
  var intro = document.querySelector('.hero__intro');
  var title = document.getElementById('hero-title');

  if (root.classList.contains('page--hero-motion') && intro && title) {
    var text = title.textContent.replace(/\s+/g, ' ').trim();
    var started = false;
    var play = function () {
      if (started) return;
      started = true;
      try {
        title.textContent = '';
        var words = text.split(' ').map(function (w, i) {
          if (i) title.appendChild(document.createTextNode(' '));
          var s = document.createElement('span');
          s.textContent = w;
          title.appendChild(s);
          return s;
        });
        var lines = [], top = null;
        words.forEach(function (s) {
          var t = s.offsetTop;
          if (top === null || Math.abs(t - top) > 4) { lines.push([]); top = t; }
          lines[lines.length - 1].push(s.textContent);
        });
        title.textContent = '';
        lines.forEach(function (l, i) {
          var line = document.createElement('span');
          var inner = document.createElement('span');
          line.className = 'hero__line';
          inner.className = 'hero__line-inner';
          inner.style.setProperty('--k', i);
          inner.textContent = l.join(' ');
          line.appendChild(inner);
          title.appendChild(line);
        });
        intro.style.setProperty('--after', lines.length * 90 + 'ms');
        setTimeout(function () { title.textContent = text; }, lines.length * 90 + 900);
      } catch (err) { title.textContent = text; }
      intro.classList.add('hero__intro--play');
    };
    setTimeout(play, 300);
    if (document.fonts && document.fonts.load) document.fonts.load('800 64px Commissioner', text).then(play, play);
    else play();
  }

  /* Reveal on scroll: only what starts below the fold; static under reduced motion */
  if (!reduceMotion && 'IntersectionObserver' in window) {
    var vh = window.innerHeight || root.clientHeight;
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
  }
})();
