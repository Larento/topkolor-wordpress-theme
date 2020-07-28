function setSlidesCount() {
    let slider = document.getElementsByClassName('tk-slider')[0];
    let slides = [...document.getElementsByClassName('slide')];
    let slidesCount = slides.length;
    slider.style.setProperty('--slides-count', `${slidesCount}`);
    for (var i = 1; i <= slidesCount; ++i) {
        let slideNthChild = document.querySelector(`.slide:nth-child(${i})`);
        slideNthChild.style.setProperty('animation-delay', `calc(var(--slide-time) * calc(${i} - 1))`);
        console.log(window.getComputedStyle(slideNthChild).getPropertyValue('animation-delay'));
    };
    let slideNthLastChild = document.querySelector(`.slide:nth-last-child(${slidesCount}):first-child, .slide:nth-last-child(${slidesCount}):first-child ~ .slide`);
    slideNthLastChild.style.setProperty('animation-duration', `var(--animation-time)`);
    console.log(window.getComputedStyle(slideNthLastChild).getPropertyValue('animation-duration'));
  };

document.addEventListener("DOMContentLoaded", setSlidesCount);