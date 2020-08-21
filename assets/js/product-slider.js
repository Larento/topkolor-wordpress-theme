document.addEventListener("DOMContentLoaded", function() {
  Flickity.prototype._touchActionValue = 'pan-y pinch-zoom';
  let slider = document.querySelectorAll('.tk-slider.product');
  var flickSlider = new Flickity( '.tk-slider.product', {
    setGallerySize: false,
    wrapAround: true,
    fullscreen: true,
  });
  let fullscreenImages = document.querySelectorAll('.is-fulscreen .slide img');
    // assign wheelzoom
  //wheelzoom(fullscreenImages);

  // assign and set the zoom increment percentage
  //wheelzoom(fullscreenImages, {zoom: 0.05});

  // set a maximum zoom amount
  //wheelzoom(fullscreenImages, {maxZoom: 2});

  // zooming out can be triggered by calling 'wheelzoom.reset'
  //document.querySelector('img').dispatchEvent(new CustomEvent('wheelzoom.reset'));

  // wheelzoom can be removed from an element by calling 'wheelzoom.destroy'
  //document.querySelector('img').dispatchEvent(new CustomEvent('wheelzoom.destroy'));

});
