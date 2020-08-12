function cycle(current, length) {
  return (current % length);
};

function homepageSlideshow() {
  let initialSlide = 1;
  let duration = 5000;
  let slider = document.querySelector('.tk-slider.homepage');
  let slides = slider.querySelectorAll('.slide');
  var i = initialSlide - 1;
  slides[i].classList.toggle('shown', 1);
  setInterval(function() {
      console.log(i);
      slides[cycle(i, slides.length)].classList.toggle('shown', 0);
      i = cycle(i + 1, slides.length);
      console.log(i);
      slides[cycle(i, slides.length)].classList.toggle('shown', 1);
  }, duration);
};

document.addEventListener("DOMContentLoaded", homepageSlideshow);