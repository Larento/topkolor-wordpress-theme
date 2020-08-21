document.addEventListener("DOMContentLoaded", function() {
  var flickSlider = new Flickity( '.tk-slider.product', {
    setGallerySize: false,
    wrapAround: true,
    fullscreen: true,
  });
  let header = document.querySelector(".tk-section.header");
  flickSlider.on( 'fullscreenChange', function( isFullscreen ) {
    if (isFullscreen == true) {
      header.style.setProperty('display', 'none');
    } else {
      header.style.setProperty('display', 'block');
    };
  });
});
