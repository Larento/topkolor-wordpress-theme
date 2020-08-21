document.addEventListener("DOMContentLoaded", setForm);

function setForm() {
  params = formData[0];
  product_types = formData[1];
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
  let selectedOption = styleSelect.options[styleSelect.selectedIndex];
  Array.from(product_types[selectedOption.value]['kinds']).forEach((kind) => {
    let selected = false;
    if ((kind['slug'] == params['kind']) && (selectedOption == params['style'])) {
      selected = true;
    };
    kindSelect.options.length = 0;
    let newOption = new Option(kind['label'], kind['slug'], selected, selected);
    kindSelect.append(newOption);
  });
  styleSelect.addEventListener("change", function() {
    console.log(this.options[this.selectedIndex]);
    let selectedOption = this.options[this.selectedIndex];
    Array.from(product_types[this.value]['kinds']).forEach((kind) => {
      let selected = false;
      if ((kind['slug'] == params['kind']) && (selectedOption == params['style'])) {
        selected = true;
      };
      kindSelect.options.length = 0;
      let newOption = new Option(kind['label'], kind['slug'], selected, selected);
      kindSelect.append(newOption);
    });
  });
};


