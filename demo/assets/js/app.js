/**
 * Demo – Servicios y Sistemas
 * IntersectionObserver reveals + smooth scroll anchors
 */
(function () {
  'use strict';

  var reveals = document.querySelectorAll('.reveal');
  if (!reveals.length) return;

  if (!('IntersectionObserver' in window)) {
    reveals.forEach(function (el) { el.classList.add('visible'); });
    return;
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.01, rootMargin: '200px 0px 0px 0px' }
  );

  function checkReveals() {
    reveals.forEach(function (el) {
      if (el.classList.contains('visible')) return;
      var rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight + 100) {
        el.classList.add('visible');
        observer.unobserve(el);
      }
    });
  }

  if (window.location.hash) {
    reveals.forEach(function (el) { el.classList.add('visible'); });
  } else {
    reveals.forEach(function (el) {
      var rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight + 100) {
        el.classList.add('visible');
      } else {
        observer.observe(el);
      }
    });
  }

  requestAnimationFrame(checkReveals);

  document.addEventListener('click', function (e) {
    var a = e.target.closest('a[href^="#"]');
    if (!a) return;
    var id = a.getAttribute('href');
    if (!id || id === '#') return;
    var target = document.querySelector(id);
    if (!target) return;
    e.preventDefault();
    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    history.pushState(null, '', id);
    setTimeout(checkReveals, 600);
  });
})();
