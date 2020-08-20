document.addEventListener("DOMContentLoaded", setForm);

function setForm() {
  params = formData[0];
  product_types = formData[1];
  console.log(params);
  console.log(product_types);
  let form = document.querySelector(".request-form");
  let styleSelect = form.querySelector("select#style-select");
  let kindSelect = form.querySelector("select#kind-select");
  if ($params['style'] != 'none') {
    styleSelect.options.forEach((option) => {
      if (option.value == $params['style']) {
        option.selected = true;
        option.value = option.value + 'sdffs';
      }; 
    });
  };
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

