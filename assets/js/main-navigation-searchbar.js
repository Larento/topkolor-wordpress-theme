function hideMenuItems() {
  let searchOpenButton = document.querySelector('.header-main-navigation .search a');
  let mainMenu = document.querySelector('.header-main-navigation .main-menu');
  searchOpenButton.addEventListener("click", function() {
    mainMenu.classList.toggle('hidden');
  });
};

document.addEventListener("DOMContentLoaded", hideMenuItems);