/*--- GŁÓWNE IMPORTY ---*/
// Importujemy tylko Alpine, resztę bibliotek (GSAP) ładujemy globalnie

import Alpine from 'alpinejs';

// Importy zasobów dla Vite (np. obrazy, fonty)
import.meta.glob(['../images/**', '../fonts/**']);

// Twoje niestandardowe moduły JS
import './menubar.js';
import './footer-accordion.js';
import './swiper.js';
import './blocks/categories.js';
import './blocks/hero-sub.js';
import './blocks/logos.js';
import './blocks/map.js';
import './blocks/locations.js';
import './blocks/catalogues.js';
import './blocks/brands.js';

/*--- INICJALIZACJA BIBLIOTEK ---*/
// Uruchom Alpine.js
window.Alpine = Alpine;
Alpine.start();


/*--- SKRYPTY URUCHAMIANE PO ZAŁADOWANIU STRONY ---*/

function initGsapAnimations() {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    // LiteSpeed Cache może defer'ować GSAP poza DOMContentLoaded — czekamy na window.load
    window.addEventListener('load', initGsapAnimations, { once: true });
    return;
  }
  gsap.registerPlugin(ScrollTrigger);

  // --- TWOJE ISTNIEJĄCE ANIMACJE GSAP (TERAZ POWINNY DZIAŁAĆ) ---
  gsap.utils.toArray("[data-gsap-anim='section']").forEach((section) => {
    const standardImages = section.querySelectorAll("[data-gsap-element='img']");
    standardImages.forEach((img) => {
      gsap.from(img, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: img,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });

    const otherElements = section.querySelectorAll(
      "[data-gsap-element]:not([data-gsap-element*='img']):not([data-gsap-element='stagger'])"
    );
    otherElements.forEach((element, index) => {
      gsap.from(element, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        delay: index * 0.1,
        scrollTrigger: {
          trigger: element,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });

    const staggerElements = section.querySelectorAll("[data-gsap-element='stagger']");
    if (staggerElements.length > 0) {
      const sorted = [...staggerElements].sort((a, b) => {
        const getDelay = (el) => {
          const attr = el.getAttribute('data-gsap-edit');
          return (attr && attr.startsWith('delay-')) ? parseFloat(attr.replace('delay-', '')) || 0 : 0;
        };
        return getDelay(a) - getDelay(b);
      });

      gsap.set(sorted, { opacity: 0, y: 50 });

      gsap.to(sorted, {
        opacity: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 1,
        ease: 'power2.out',
        stagger: { amount: 1.5, each: 0.1 },
        scrollTrigger: {
          trigger: section,
          start: 'top 80%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    }
  });
}

document.addEventListener('DOMContentLoaded', initGsapAnimations);



document.addEventListener('DOMContentLoaded', () => {
  // 1) Odczytaj poprzednio zapisaną "aktualną" stronę => to będzie "poprzednia"
  const prevTitle = sessionStorage.getItem('cf7_curr_title') || '';
  const prevUrl = sessionStorage.getItem('cf7_curr_url') || '';

  // 2) Zapisz obecną stronę jako "aktualną" (na przyszłość)
  sessionStorage.setItem('cf7_curr_title', document.title);
  sessionStorage.setItem('cf7_curr_url', window.location.href);

  // 3) Jeśli jesteśmy na stronie z formularzem i pola istnieją — uzupełnij
  const urlField = document.getElementById('referer_url');
  const titleField = document.getElementById('referer_title');

  if (urlField) urlField.value = prevUrl || document.referrer || '';
  if (titleField) titleField.value = prevTitle || (document.referrer ? 'Strona odsyłająca' : 'Wejście bezpośrednie');
});