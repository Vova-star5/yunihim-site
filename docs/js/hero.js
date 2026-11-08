/* Hero headline: measure real lines once the font is in, rise each from a mask, then restore plain text.
   Runs only when the head script has set page--hero-motion (motion is not reduced). */
(function () {
  'use strict';

  var intro = document.querySelector('.hero__intro');
  var title = document.getElementById('hero-title');
  if (!document.documentElement.classList.contains('page--hero-motion') || !intro || !title) return;

  var text = title.textContent.replace(/\s+/g, ' ').trim();
  var started = false;

  function splitLines() {
    title.textContent = '';
    var words = text.split(' ').map(function (w, i) {
      if (i) title.appendChild(document.createTextNode(' '));
      var s = document.createElement('span');
      s.textContent = w;
      title.appendChild(s);
      return s;
    });

    var lines = [];
    var top = null;
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
    return lines.length;
  }

  function play() {
    if (started) return;
    started = true;
    try {
      var count = splitLines();
      intro.style.setProperty('--after', count * 90 + 'ms');
      setTimeout(function () { title.textContent = text; }, count * 90 + 900);
    } catch (err) {
      title.textContent = text;
    }
    intro.classList.add('hero__intro--play');
  }

  setTimeout(play, 300);
  if (document.fonts && document.fonts.load) document.fonts.load('800 64px Commissioner', text).then(play, play);
  else play();
})();
