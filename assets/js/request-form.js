document.addEventListener("DOMContentLoaded", setForm);
params = formData[0];
product_types = formData[1];

function setForm() {
  let form = document.querySelector(".request-form");
  let styleSelect = form.querySelector("select#style-select");
  let kindSelect = form.querySelector("select#kind-select");
  if (params['style'] != 'none') {
    Array.from(styleSelect.options).forEach((option) => {
      if (option.value == params['style']) {
        option.selected = true;
      }; 
    });
  };
  updateForm(styleSelect, kindSelect);
  styleSelect.addEventListener("change", function() {
    updateForm(this, kindSelect);
  });
  kindSelect.addEventListener("change", function() {
    updateForm.hasChosen = true;
  });
};

function updateForm(styleSelect, kindSelect) {
  let selectedStyle = styleSelect.options[styleSelect.selectedIndex];
  let selectedKind = kindSelect.options[kindSelect.selectedIndex];
  if (updateForm.hasChosen == 'undefined') {
    updateForm.hasChosen = false;
  };
  kindSelect.options.length = 0;
  Array.from(product_types[selectedStyle.value]['kinds']).forEach((kind) => {
    let selected = false;
    if ((kind['slug'] == params['kind']) && (selectedStyle.value == params['style']) && updateForm.hasChosen == false) {
      selected = true;
    };
    if (kind['slug'] == selectedKind.value) {
      selected = true;
    };
    let newOption = new Option(kind['label'], kind['slug'], selected, selected);
    kindSelect.append(newOption);
  });
};
