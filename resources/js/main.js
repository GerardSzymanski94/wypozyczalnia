import Swiper from 'swiper';

$( document ).ready(function() {
  var swiper = new Swiper('.Main-items.swiper-container', {
    slidesPerView: 1,
    slidesPerColumn: 1,
    spaceBetween: 30,
    navigation: {
      nextEl: '.Main-items .swiper-button-next',
      prevEl: '.Main-items .swiper-button-prev',
    },
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
        slidesPerColumn: 1,
      },
      // when window width is >= 640px
      768: {
        slidesPerView: 3,
        slidesPerColumn: 2,
      },
      // when window width is >= 640px
      1200: {
        slidesPerView: 4,
        slidesPerColumn: 2,
      }
    }
  });
});