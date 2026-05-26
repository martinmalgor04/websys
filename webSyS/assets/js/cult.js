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

  /* ── Custom select (reemplaza dropdown nativo del OS) ──────── */
  function initCustomSelects() {
    var wraps = document.querySelectorAll('.cult-form-select-wrap');
    if (!wraps.length) return;

    wraps.forEach(function (wrap) {
      if (wrap.dataset.cultSelectInit === 'true') return;

      var select = wrap.querySelector('select.form-select');
      if (!select || select.multiple) return;

      wrap.dataset.cultSelectInit = 'true';
      select.classList.add('cult-form-select-native');
      select.tabIndex = -1;

      var trigger = document.createElement('button');
      trigger.type = 'button';
      trigger.className = 'cult-form-select-trigger';
      trigger.setAttribute('aria-haspopup', 'listbox');
      trigger.setAttribute('aria-expanded', 'false');
      if (select.id) trigger.setAttribute('aria-labelledby', select.id + '-label');

      var valueEl = document.createElement('span');
      valueEl.className = 'cult-form-select-value';
      trigger.appendChild(valueEl);

      var chevron = document.createElement('i');
      chevron.className = 'bx bx-chevron-down cult-form-select-chevron';
      chevron.setAttribute('aria-hidden', 'true');
      trigger.appendChild(chevron);

      var menu = document.createElement('ul');
      menu.className = 'cult-form-select-menu';
      menu.setAttribute('role', 'listbox');
      menu.hidden = true;

      var options = [];
      Array.prototype.forEach.call(select.options, function (opt, index) {
        var item = document.createElement('li');
        item.className = 'cult-form-select-option';
        item.setAttribute('role', 'option');
        item.dataset.value = opt.value;
        item.textContent = opt.textContent;
        item.tabIndex = -1;
        if (opt.disabled) {
          item.setAttribute('aria-disabled', 'true');
          item.classList.add('is-disabled');
        }
        menu.appendChild(item);
        options.push({ el: item, native: opt, index: index });
      });

      wrap.appendChild(trigger);
      wrap.appendChild(menu);

      function currentOption() {
        for (var i = 0; i < options.length; i++) {
          if (options[i].native.selected) return options[i];
        }
        return options[0];
      }

      function syncDisplay() {
        var cur = currentOption();
        if (!cur) return;
        valueEl.textContent = cur.native.textContent;
        valueEl.classList.toggle('is-placeholder', !cur.native.value);
        options.forEach(function (o) {
          var on = o.native.selected;
          o.el.classList.toggle('is-selected', on);
          o.el.setAttribute('aria-selected', on ? 'true' : 'false');
        });
      }

      function setOpen(open) {
        wrap.classList.toggle('is-open', open);
        trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
        menu.hidden = !open;
        if (open) {
          var sel = menu.querySelector('.cult-form-select-option.is-selected');
          if (sel) sel.scrollIntoView({ block: 'nearest' });
        }
      }

      function choose(option) {
        if (!option || option.native.disabled) return;
        select.selectedIndex = option.index;
        select.dispatchEvent(new Event('change', { bubbles: true }));
        syncDisplay();
        setOpen(false);
        trigger.focus();
      }

      trigger.addEventListener('click', function (e) {
        e.preventDefault();
        setOpen(!wrap.classList.contains('is-open'));
      });

      menu.addEventListener('click', function (e) {
        var item = e.target.closest('.cult-form-select-option');
        if (!item || item.classList.contains('is-disabled')) return;
        for (var i = 0; i < options.length; i++) {
          if (options[i].el === item) {
            choose(options[i]);
            break;
          }
        }
      });

      trigger.addEventListener('keydown', function (e) {
        var idx = select.selectedIndex;
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
          e.preventDefault();
          if (!wrap.classList.contains('is-open')) {
            setOpen(true);
            return;
          }
          var next = e.key === 'ArrowDown' ? idx + 1 : idx - 1;
          while (next >= 0 && next < options.length && options[next].native.disabled) {
            next += e.key === 'ArrowDown' ? 1 : -1;
          }
          if (next >= 0 && next < options.length) choose(options[next]);
        } else if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          setOpen(!wrap.classList.contains('is-open'));
        } else if (e.key === 'Escape') {
          setOpen(false);
        }
      });

      document.addEventListener('click', function (e) {
        if (!wrap.contains(e.target)) setOpen(false);
      });

      select.addEventListener('change', syncDisplay);
      syncDisplay();
    });
  }

  /* ── Init ──────────────────────────────────────────────────── */
  function init() {
    initCounters();
    initNavGlow();
    initFab();
    initSpotlight();
    initCustomSelects();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
