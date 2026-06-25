import Swiper from 'swiper';
import { Autoplay } from 'swiper/modules';

import 'swiper/css';

const initLogosSwiper = () => {
  const logosSlider = document.querySelector('.logos-swiper');
  if (!logosSlider) {
    return;
  }

  new Swiper(logosSlider, {
    modules: [Autoplay],
    loop: true,
    slidesPerView: 'auto',
    spaceBetween: 60,
    allowTouchMove: false,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
    speed: 4000,
  });
};

document.addEventListener('DOMContentLoaded', initLogosSwiper);