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
    if (kind['slug'] == params['kind']) {
      selected = true;
    };
    let newOption = new Option(kind['label'], kind['slug'], selected, selected);
    kindSelect.append(newOption);
  });
  styleSelect.addEventListener("change", function() {
    console.log(this.options[this.selectedIndex]);
  });
  //updateForm(styleContainer, kindContainer);
  //Shows the right container
  //styleRadioInputs.forEach((radio_button) => {
  //   radio_button.addEventListener('click', function() {
  //     updateForm(styleContainer, kindContainer);
  //   });
  // });
};

function updateForm(styleContainer, kindContainer) {
  let styleRadioValue = styleContainer.querySelector("input[type='radio']:checked").value;
  let kindRadioInputsContainers = kindContainer.querySelectorAll("div.radio-inputs");
  kindRadioInputsContainers.forEach((container) => {
    container.classList.toggle('shown', 0);
    let correctContainer = kindContainer.querySelector("div.radio-inputs." + styleRadioValue);
    if (correctContainer !== null) {
      correctContainer.classList.toggle('shown', 1);
    };
  });
};

