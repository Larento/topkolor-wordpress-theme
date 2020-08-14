function hideMenuItems() {
  let searchOpenButton = document.querySelector('.header-main-navigation .search a');
  let mainMenuItems = document.querySelectorAll('.header-main-navigation .main-menu>.menu-item');
  let searchBar = document.querySelector('.header-main-navigation .search-bar');
  let searchField = searchBar.querySelector('.search-field');
  let searchCloseButton = searchBar.querySelector('.search-button-close');
  searchOpenButton.addEventListener("click", function() {
    mainMenuItems.forEach((item) => {
      item.classList.toggle('hidden', 1);
    });
    searchBar.classList.toggle('shown', 1);
    searchField.focus();
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