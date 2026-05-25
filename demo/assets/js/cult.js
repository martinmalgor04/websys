/**
 * cult.js — efectos complementarios
 * Animated counters · Spotlight mouse tracking
 */
(function () {
  'use strict';

  /* ── Animated number counters ─────────────────────────────────
     Elementos: .stat-count[data-target][data-prefix][data-suffix]
     Se activan con IntersectionObserver cuando entran al viewport
  ──────────────────────────────────────────────────────────── */
  function initCounters() {
    var els = document.querySelectorAll('.stat-count[data-target]');
    if (!els.length) return;

    if (!('IntersectionObserver' in window)) {
      els.forEach(function (el) {
        el.textContent =
          (el.dataset.prefix || '') +
          el.dataset.target +
          (el.dataset.suffix || '');
        el.classList.add('visible');
      });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          var el    = entry.target;
          var raw   = el.dataset.target;          /* "99.9", "33", "100" */
          var pre   = el.dataset.prefix  || '';
          var suf   = el.dataset.suffix  || '';
          var isFloat = raw.indexOf('.') !== -1;
          var target  = parseFloat(raw);
          var dur     = 1300;
          var t0      = performance.now();

          el.classList.add('visible');

          function tick(now) {
            var progress = Math.min((now - t0) / dur, 1);
            var ease     = 1 - Math.pow(1 - progress, 3); /* ease-out cubic */
            var cur      = target * ease;
            el.textContent =
              pre +
              (isFloat ? cur.toFixed(1) : Math.floor(cur)) +
              suf;
            if (progress < 1) {
              requestAnimationFrame(tick);
            } else {
              el.textContent = pre + raw + suf;
            }
          }

          requestAnimationFrame(tick);
          observer.unobserve(el);
        });
      },
      { threshold: 0.4 }
    );

    els.forEach(function (el) { observer.observe(el); });
  }

  /* ── Non-animated stat numbers (fade-in only) ────────────────
     Elementos: .stat-fade — sólo transición de opacidad
  ──────────────────────────────────────────────────────────── */
  function initStatFades() {
    var els = document.querySelectorAll('.stat-fade');
    if (!els.length) return;

    if (!('IntersectionObserver' in window)) {
      els.forEach(function (el) { el.classList.add('visible'); });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        });
      },
      { threshold: 0.35 }
    );

    els.forEach(function (el) { observer.observe(el); });
  }

  /* ── Spotlight mouse tracking ─────────────────────────────────
     Elementos: .card--spotlight
     Actualiza --spotlight-x y --spotlight-y con la pos del mouse
  ──────────────────────────────────────────────────────────── */
  function initSpotlight() {
    var cards = document.querySelectorAll('.card--spotlight');
    if (!cards.length) return;

    cards.forEach(function (card) {
      card.addEventListener('mousemove', function (e) {
        var rect = card.getBoundingClientRect();
        var x    = ((e.clientX - rect.left) / rect.width)  * 100;
        var y    = ((e.clientY - rect.top)  / rect.height) * 100;
        card.style.setProperty('--spotlight-x', x + '%');
        card.style.setProperty('--spotlight-y', y + '%');
      });
    });
  }

  /* ── Init ─────────────────────────────────────────────────── */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  function init() {
    initCounters();
    initStatFades();
    initSpotlight();
  }
})();
