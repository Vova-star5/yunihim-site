/* Mobile menu: the burger opens the satin label with links, phones and the contact button */
(function () {
  'use strict';

  var header = document.querySelector('.site-header');
  var burger = document.querySelector('.burger');
  var nav = document.getElementById('site-nav');
  if (!header || !burger || !nav) return;

  var backdrop = document.querySelector('.site-header__backdrop');

  function setMenu(open) {
    burger.setAttribute('aria-expanded', String(open));
    burger.classList.toggle('burger--active', open);
    nav.classList.toggle('site-nav--open', open);
    header.classList.toggle('site-header--menu-open', open);
  }

  function isOpen() {
    return burger.getAttribute('aria-expanded') === 'true';
  }

  burger.addEventListener('click', function () { setMenu(!isOpen()); });
  nav.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
  if (backdrop) backdrop.addEventListener('click', function () { setMenu(false); });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && isOpen()) { setMenu(false); burger.focus(); }
  });
})();
