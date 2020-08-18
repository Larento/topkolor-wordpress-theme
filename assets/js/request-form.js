document.addEventListener("DOMContentLoaded", setForm);

function setForm() {
  let form = document.querySelector(".request-form");
  let kindContainer = form.querySelector("div.kind");
  let styleContainer = form.querySelector("div.style");
  let styleRadioInputs = styleContainer.querySelectorAll("input[type='radio']");
  updateForm(styleContainer, kindContainer);
  //Shows the right container
  styleRadioInputs.forEach((radio_button) => {
    radio_button.addEventListener('click', function() {
      updateForm(styleContainer, kindContainer);
    });
  });
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

