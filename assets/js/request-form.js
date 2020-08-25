document.addEventListener("DOMContentLoaded", setForm);
let params = formData[0];
let productTypes = formData[1];
let selectedKind = [];
Object.entries(productTypes).forEach((style) => {
  const [key, value] = style;
  selectedKind[key] = false;
});

function setForm() {
  getFormParams();
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
    selectedKind[styleSelect.options[styleSelect.selectedIndex].value] = this.options[this.selectedIndex].value;
  });
};

function updateForm(styleSelect, kindSelect) {
  let selectedStyle = styleSelect.options[styleSelect.selectedIndex].value;
  kindSelect.options.length = 0;
  Array.from(productTypes[selectedStyle]['kinds']).forEach((kind) => {
    let selected = false;
    if ((kind['slug'] == params['kind']) && (selectedStyle == params['style']) && selectedKind[selectedStyle] == false) {
      selected = true;
    };
    if (kind['slug'] == selectedKind[selectedStyle]) {
      selected = true;
    };
    let newOption = new Option(kind['label'], kind['slug'], selected, selected);
    kindSelect.append(newOption);
  });
};

function getFormParams() {
  const queryString = window.location.search;
  const domain = window.location.hostname;
  const urlParams = new URLSearchParams(queryString);
  const postID = urlParams['post_id'];

  fetch('./wp-json/tk-wordpress-plugin/v1/functions/get_request_form_params/' + postID)  
  .then(  
    function(response) {  
      if (response.status !== 200) {  
        console.log('Looks like there was a problem. Status Code: ' +  
          response.status);  
        return;  
      }

      response.json().then(function(data) {  
        console.log(data);  
      });  
    }  
  )  
  .catch(function(err) {  
    console.log('Fetch Error :-S', err);  
  });
}
