function clearSearch() {
  let searchForms = document.querySelectorAll('.search-form');
  searchForms.forEach((searchForm) => {
    let searchField = searchForm.querySelector('.search-field');
    let searchEmptyButton = searchForm.querySelector('.search-button-empty');
    searchEmptyButton.addEventListener('click', function() {
      searchField.value = "";
      searchField.focus();
    });
  });
};

document.addEventListener("DOMContentLoaded", clearSearch);