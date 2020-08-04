function hideMenuItems() {
  let searchOpenButton = document.querySelector('.header-main-navigation .search a');
  let mainMenuItems = document.querySelectorAll('.header-main-navigation .main-menu>.menu-item');
  let searchBar = document.getElementsByClassName('search-bar')[0];
  let searchCloseButton = document.getElementsByClassName('search-button-close')[0];
  searchOpenButton.addEventListener("click", function() {
    mainMenuItems.forEach((item) => {
      item.classList.toggle('hidden', 1);
    });
    searchBar.classList.toggle('shown', 1);
  });
  searchCloseButton.addEventListener('click', function() {
    searchBar.classList.toggle('shown', 0);
    mainMenuItems.forEach((item) => {
      item.classList.toggle('hidden', 0);
    });
  });
};

document.addEventListener("DOMContentLoaded", hideMenuItems);