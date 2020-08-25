document.addEventListener("DOMContentLoaded", function() {
  Flickity.prototype._touchActionValue = 'pan-y pinch-zoom';
  var flickSlider = new Flickity( '.tk-slider.product', {
    setGallerySize: false,
    wrapAround: true,
    fullscreen: true,
  });
});
