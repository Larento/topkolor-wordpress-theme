function homepageSlideshow() {
  var homeSwiper = new Swiper('.tk-slider', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    autoplay: {
      delay: 5000,
    },
    autoplayDisableOnInteraction: false,
    slidesPerView: 1,
    lazy: true,
    lazy: {
      loadPrevNext: true,
    },
    preloadImages: false,
  });
};

document.addEventListener("DOMContentLoaded", homepageSlideshow);