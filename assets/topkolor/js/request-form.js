document.addEventListener("DOMContentLoaded", initForm);

function initForm() {
  console.log(getFormParams());
}

function getFormParams() {
  let queryString = window.location.search.substring(1);
  let urlParams = new URLSearchParams(queryString);
  let postID = urlParams.get('post_id');
  return(postID);
  //return customAPIRequest( `get_request_form_params/${postID}` );
}

function getProducts() {
  return customAPIRequest( 'get_products' );
}

async function customAPIRequest( functionName ) {
  let hostname = window.location.hostname;
  let protocol = window.location.protocol;
  let restURL = `/wp-json/tk-wordpress-plugin/v1/functions/${functionName}`;
  let fetchURL = protocol + '//' + hostname + restURL;
  let promise = await fetch(fetchURL)
    .then( (response) => {
        if ( response.ok ) {
          response.json().then( (data) => {
            return data;
          });
        } else {
          console.log( 'Looks like there was a problem. Status Code: ' + response.status );
        }
      }
    )
    .catch( (err) => {
      console.log( 'Fetch Error :-S', err );
    });
  return await promise;
}



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


