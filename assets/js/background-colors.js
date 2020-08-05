function backgroundColors(bgSVG) {
  var fill = window.getComputedStyle(document.documentElement).getPropertyValue('--background-fill');
  var accent = window.getComputedStyle(document.documentElement).getPropertyValue('--background-accent');
  var stroke = window.getComputedStyle(document.documentElement).getPropertyValue('--background-stroke');
  var parser = new DOMParser();
  var bgDOM = parser.parseFromString(bgSVG, "image/svg+xml");
  elements = bgDOM.getElementsByClassName('st1');
  elements.foreach((element) => {
    element.style.setProperty('fill', fill);
    element.style.setProperty('stroke', accent);
    element.style.setProperty('stroke-width', stroke);
  });
  var bgString = bgDOM.outerHTML;
  console.log(bgString);
  //document.documentElement.style.setProperty('--background-ornament', bgURL);
}
