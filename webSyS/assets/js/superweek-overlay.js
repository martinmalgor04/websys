/**
 * Tango SuperWeek 2026 — overlay promocional
 * Se abre solo (~0,8 s), audio con mute, cierre automático, un solo pase por sesión.
 */
(function () {
  'use strict';

  var root = document.getElementById('tswOverlay');
  if (!root) return;

  var KEY = 'tswOverlay2026';
  var storage = null;
  try { storage = window.sessionStorage; } catch (e) { /* storage bloqueado */ }
  if (storage && storage.getItem(KEY)) { root.remove(); return; }

  var dialog   = root.querySelector('.tsw-overlay__dialog');
  var audio    = root.querySelector('.tsw-overlay__player');
  var audioBtn = root.querySelector('[data-tsw-audio]');
  var reduced  = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var OPEN_DELAY   = 800;
  var CLOSE_NOAUDIO = reduced ? 8000 : 15000;
  var VOLUME       = 0.25;

  var closeTimer = null;
  var closed = false;
  var lastFocus = null;
  var audioState = 'off'; // off | playing | muted | blocked

  function setCloseTimer(ms) {
    clearTimeout(closeTimer);
    closeTimer = setTimeout(close, ms);
  }

  function setAudioUi(state) {
    audioState = state;
    if (!audioBtn) return;
    var icon = audioBtn.querySelector('i');
    var text = audioBtn.querySelector('span');
    audioBtn.hidden = (state === 'off');
    if (state === 'playing') {
      icon.className = 'bx bx-volume-full';
      text.textContent = 'Silenciar';
      audioBtn.setAttribute('aria-pressed', 'false');
    } else if (state === 'muted') {
      icon.className = 'bx bx-volume-mute';
      text.textContent = 'Activar sonido';
      audioBtn.setAttribute('aria-pressed', 'true');
    } else if (state === 'blocked') {
      icon.className = 'bx bx-volume-mute';
      text.textContent = 'Tocá para escuchar';
      audioBtn.setAttribute('aria-pressed', 'true');
    }
  }

  function onAudioPlayingUnmuted() {
    clearTimeout(closeTimer); // el cierre queda a cargo de "ended"
    setAudioUi('playing');
  }

  function startAudio() {
    if (!audio || reduced) { setCloseTimer(CLOSE_NOAUDIO); return; }
    setCloseTimer(CLOSE_NOAUDIO); // fallback si el audio no arranca o falla
    audio.addEventListener('ended', close);
    audio.addEventListener('error', function () { setAudioUi('off'); setCloseTimer(CLOSE_NOAUDIO); });

    audio.muted = false;
    audio.volume = VOLUME;
    var p = audio.play();
    if (!p || !p.then) { onAudioPlayingUnmuted(); return; }
    p.then(onAudioPlayingUnmuted).catch(function () {
      // Autoplay con sonido bloqueado: arranca muteado y espera un toque
      audio.muted = true;
      var m = audio.play();
      if (m && m.catch) m.catch(function () {});
      setAudioUi('blocked');
    });
  }

  function toggleAudio() {
    if (!audio) return;
    if (audioState === 'blocked' || audioState === 'muted') {
      audio.muted = false;
      audio.volume = VOLUME;
      var p = audio.play();
      if (p && p.then) { p.then(onAudioPlayingUnmuted).catch(function () {}); }
      else { onAudioPlayingUnmuted(); }
    } else if (audioState === 'playing') {
      audio.muted = true;
      setAudioUi('muted');
    }
  }

  function focusables() {
    return Array.prototype.filter.call(
      dialog.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'),
      function (el) { return !el.hidden && el.offsetParent !== null; }
    );
  }

  function onKeydown(e) {
    if (e.key === 'Escape') { e.preventDefault(); close(); return; }
    if (e.key !== 'Tab') return;
    var items = focusables();
    if (!items.length) { e.preventDefault(); dialog.focus(); return; }
    var first = items[0], last = items[items.length - 1];
    if (e.shiftKey && (document.activeElement === first || document.activeElement === dialog)) {
      e.preventDefault(); last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault(); first.focus();
    }
  }

  function lockScroll() {
    var sbw = window.innerWidth - document.documentElement.clientWidth;
    document.body.style.setProperty('--tsw-sbw', sbw > 0 ? sbw + 'px' : '0px');
    document.body.classList.add('tsw-lock');
  }
  function unlockScroll() {
    document.body.classList.remove('tsw-lock');
    document.body.style.removeProperty('--tsw-sbw');
  }

  function open() {
    if (storage) { try { storage.setItem(KEY, '1'); } catch (e) {} }
    lastFocus = document.activeElement;
    root.hidden = false;
    lockScroll();
    void root.offsetWidth; // fuerza reflow para que la transición corra
    root.classList.add('is-open');
    dialog.focus();
    document.addEventListener('keydown', onKeydown);
    startAudio();
  }

  function close() {
    if (closed) return;
    closed = true;
    clearTimeout(closeTimer);
    document.removeEventListener('keydown', onKeydown);
    if (audio) { try { audio.pause(); } catch (e) {} }
    root.classList.remove('is-open');
    var done = false;
    function finish() {
      if (done) return;
      done = true;
      unlockScroll();
      if (root.parentNode) root.parentNode.removeChild(root);
      if (lastFocus && lastFocus.focus) { try { lastFocus.focus(); } catch (e) {} }
    }
    if (reduced) { finish(); return; }
    root.addEventListener('transitionend', finish, { once: true });
    setTimeout(finish, 450);
  }

  Array.prototype.forEach.call(root.querySelectorAll('[data-tsw-close]'), function (el) {
    el.addEventListener('click', close);
  });
  if (audioBtn) audioBtn.addEventListener('click', toggleAudio);

  function schedule() { setTimeout(open, OPEN_DELAY); }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', schedule);
  } else {
    schedule();
  }
})();
