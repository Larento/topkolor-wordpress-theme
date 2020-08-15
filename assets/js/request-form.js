document.addEventListener("DOMContentLoaded", setForm);

function setForm() {
  let form = document.querySelector(".request-form");
  let kindContainer = form.querySelector("div.kind");
  let styleContainer = form.querySelector("div.style");
  let kindRadioInputsContainers = kindContainer.querySelectorAll("div.radio-inputs");
  let styleRadioInputs = styleContainer.querySelectorAll("input[type='radio']");
  
  //Hides all 'choose kind' menus
  kindRadioInputsContainers.forEach((container) => {
    container.classList.toggle('hidden', 1);
  });
  //Shows the right container
  styleRadioInputs.forEach((radio_button) => {
    radio_button.addEventListener('click', function() {
      console.log(radio_button.value);
      let styleRadioValue = styleRadioInputs.querySelector(":checked").value;
      kindRadioInputsContainers.forEach((container) => {
        correctContainer = container.querySelector(styleRadioValue);
        if (correctContainer !== null) {
          correctContainer.classList.toggle("checked");
        };
      });
    });
  });
};

