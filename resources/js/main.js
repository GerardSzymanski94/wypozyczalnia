import Swiper from 'swiper';

$( document ).ready(function() {
  var single_column  = new Swiper('.single-column.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    navigation: {
      nextEl: '.single-column .swiper-button-next',
      prevEl: '.single-column .swiper-button-prev',
    },
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1
      },
      // when window width is >= 640px
      768: {
        slidesPerView: 2
      },
      // when window width is >= 1024px
      1024: {
        slidesPerView: 3
      },
      // when window width is >= 1200px
      1200: {
        slidesPerView: 4
      }
    }
  });

  var double_column  = new Swiper('.two-column.swiper-container', {
    slidesPerView: 1,
    slidesPerColumn: 1,
    spaceBetween: 30,
    navigation: {
      nextEl: '.two-column .swiper-button-next',
      prevEl: '.two-column .swiper-button-prev',
    },
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
        slidesPerColumn: 1,
      },
      // when window width is >= 640px
      768: {
        slidesPerView: 2,
        slidesPerColumn: 2
      },
      // when window width is >= 1024px
      1024: {
        slidesPerView: 3,
        slidesPerColumn: 2
      },
      // when window width is >= 1200px
      1200: {
        slidesPerView: 4,
        slidesPerColumn: 2
      }
    }
  });
});