let initialSlide = 2;
let duration = 8000;
let animationTime = 600;
let divisions = 4;

document.addEventListener("DOMContentLoaded", () => {
  let i = initialSlide - 1;
  let slider = document.querySelector('.tk-slider.homepage');
  let slides = slider.querySelectorAll('.slide');
  let breadcrumbs = document.querySelectorAll('.container .breadcrumb');

  let ring = document.querySelector('.progress-ring .ring');
  let radius = ring.r.baseVal.value;
  let circumference = radius * 2 * Math.PI;
  ring.style.transition = `stroke-dashoffset ${animationTime}ms`;
  ring.style.strokeDasharray = `${circumference}`;
  ring.style.strokeDashoffset = `${circumference}`;

  function run() {
    slides[i].classList.toggle('shown', 1);
    breadcrumbs[i].classList.toggle('shown', 1);
    drawRing(ring).then( () => {
      slides[i].classList.toggle('shown', 0);
      breadcrumbs[i].classList.toggle('shown', 0);
      i = cycle(i + 1, slides.length);
      run();
    });
  }
  
  run();
});

function cycle(current, length) {
  return (current % length);
};

function setProgress(ring, percent)
{
  let radius = ring.r.baseVal.value;
  let circumference = radius * 2 * Math.PI;
  let offset = circumference - percent / 100 * circumference;
  ring.style.strokeDashoffset = offset;
}

function drawRing(ring) {
  return new Promise((resolve, reject) => {
    let percent = 0;
    let percentIncrease = 100 / divisions;
    let progress = setInterval( () => {
      setProgress(ring, percent);
      percent += percentIncrease;
        if (percent > 100) {
          setTimeout( () => {
            clearInterval(progress);
            resolve();
          }, animationTime);
        }
    }, duration / divisions);
  });
}