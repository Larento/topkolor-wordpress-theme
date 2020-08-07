function hideMenuItems() {
  let searchOpenButton = document.querySelector('.header-main-navigation .search a');
  let mainMenuItems = document.querySelectorAll('.header-main-navigation .main-menu>.menu-item');
  let searchBar = document.querySelector('.header-main-navigation .search-bar');
  let searchField = document.querySelector('.header-main-navigation .search-field');
  let searchCloseButton = document.querySelector('.header-main-navigation .search-button-close');
  let searchEmptyButton = document.querySelector('.header-main-navigation .search-button-empty');
  searchField.value = "";
  searchOpenButton.addEventListener("click", function() {
    mainMenuItems.forEach((item) => {
      item.classList.toggle('hidden', 1);
    });
    searchBar.classList.toggle('shown', 1);
    searchField.focus();
  });
  searchEmptyButton.addEventListener('click', function() {
    searchField.value = "";
    searchField.focus();
  });
  searchCloseButton.addEventListener('click', function() {
    searchField.value = "";
    searchBar.classList.toggle('shown', 0);
    mainMenuItems.forEach((item) => {
      item.classList.toggle('hidden', 0);
    });
  });
  var flkty = new Flickity( '.slideshowbob', {
    // options
    wrapAround: true,
    autoPlay: 5000,
    pauseAutoPlayOnHover: false,
    bgLazyLoad: 1,
    prevNextButtons: false,
    pageDots: false,
    draggable: false,
    fade: true,
    selectedAttraction: 0.04,
    friction: 0.8,
  });
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

document.addEventListener("DOMContentLoaded", hideMenuItems);