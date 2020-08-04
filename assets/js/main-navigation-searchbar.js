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
  });
  searchEmptyButton.addEventListener('click', function() {
    searchField.value = "";
  });
  searchCloseButton.addEventListener('click', function() {
    searchField.value = "";
    searchBar.classList.toggle('shown', 0);
    mainMenuItems.forEach((item) => {
      item.classList.toggle('hidden', 0);
    });
  });
};

document.addEventListener("DOMContentLoaded", hideMenuItems);