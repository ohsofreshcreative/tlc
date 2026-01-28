import Swiper from 'swiper';
import { Navigation, FreeMode } from 'swiper/modules';


document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.offer-swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        spaceBetween: 30,
        loop: true,
        breakpoints: {
          0: { slidesPerView: 1, spaceBetween: 20 },
          768: { slidesPerView: 2.5, spaceBetween: 30 },
          1024: { slidesPerView: 3.2, spaceBetween: 32 },
        },
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
      });
    });
  }
});