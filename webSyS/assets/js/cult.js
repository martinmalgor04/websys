/**
 * cult.js — efectos complementarios para webSyS
 * - Animated stat counters (.cult-stat-count[data-target])
 * - Spotlight mouse tracking (no usado por defecto, disponible)
 * - Nav glow al pasar el threshold de scroll (sumado a .is-fixed existente)
 *
 * No usa jQuery. Compatible con la inicialización existente del nav.
 */
(function () {
  'use strict';

  /* ── Animated counters ─────────────────────────────────────── */
  function initCounters() {
    var els = document.querySelectorAll('.cult-stat-count[data-target]');
    if (!els.length) return;

    if (!('IntersectionObserver' in window)) {
      els.forEach(function (el) {
        var pre = el.dataset.prefix || '';
        var suf = el.dataset.suffix || '';
        el.textContent = pre + el.dataset.target + suf;
        el.classList.add('cult-visible');
      });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          var el  = entry.target;
          var raw = el.dataset.target;
          var pre = el.dataset.prefix || '';
          var suf = el.dataset.suffix || '';
          var isFloat = raw.indexOf('.') !== -1;
          var target  = parseFloat(raw);
          var dur     = parseInt(el.dataset.duration || '1300', 10);
          var t0      = performance.now();

          el.classList.add('cult-visible');

          if (isNaN(target)) {
            /* Si target no es numérico, mostrarlo tal cual */
            el.textContent = pre + raw + suf;
            observer.unobserve(el);
            return;
          }

          function tick(now) {
            var progress = Math.min((now - t0) / dur, 1);
            var ease     = 1 - Math.pow(1 - progress, 3);
            var cur      = target * ease;
            el.textContent =
              pre + (isFloat ? cur.toFixed(1) : Math.floor(cur)) + suf;
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

  /* ── Nav glow al scrollear más de 50px ─────────────────────── */
  function initNavGlow() {
    var nav = document.querySelector('header.header-transparent.sticky-fixed');
    if (!nav) return;

    function update() {
      if (window.scrollY > 50) nav.classList.add('cult-nav-glow');
      else                     nav.classList.remove('cult-nav-glow');
    }

    update();
    window.addEventListener('scroll', update, { passive: true });
  }

  /* ── Family FAB toggle (sin Alpine) ────────────────────────── */
  function initFab() {
    var fab = document.querySelector('.cult-fab');
    if (!fab) return;

    var trigger = fab.querySelector('.cult-fab__trigger');
    if (!trigger) return;

    function setOpen(open) {
      fab.dataset.open = open ? 'true' : 'false';
      trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    trigger.addEventListener('click', function (e) {
      e.stopPropagation();
      setOpen(fab.dataset.open !== 'true');
    });

    document.addEventListener('click', function (e) {
      if (!fab.contains(e.target)) setOpen(false);
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') setOpen(false);
    });

    setOpen(false);
  }

  /* ── Spotlight (CSS vars on mousemove) ─────────────────────── */
  function initSpotlight() {
    var els = document.querySelectorAll('.cult-spotlight');
    if (!els.length) return;
    els.forEach(function (el) {
      el.addEventListener('mousemove', function (e) {
        var rect = el.getBoundingClientRect();
        var x = ((e.clientX - rect.left) / rect.width)  * 100;
        var y = ((e.clientY - rect.top)  / rect.height) * 100;
        el.style.setProperty('--cult-sx', x + '%');
        el.style.setProperty('--cult-sy', y + '%');
      });
    });
  }

  /* ── Init ──────────────────────────────────────────────────── */
  function init() {
    initCounters();
    initNavGlow();
    initFab();
    initSpotlight();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
