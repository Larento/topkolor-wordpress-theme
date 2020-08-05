function backgroundColors(bgSVG) {
  var fill = window.getComputedStyle(document.documentElement).getPropertyValue('--background-fill');
  var accent = window.getComputedStyle(document.documentElement).getPropertyValue('--background-accent');
  var stroke = window.getComputedStyle(document.documentElement).getPropertyValue('--background-stroke');
  var parser = new DOMParser();
  var bgDOM = parser.parseFromString(bgSVG, "image/svg+xml");
  var elements = bgDOM.querySelectorAll('#Слой_2');
  elements.forEach((element) => {
    element.style.setProperty("style", `fill: ${fill}; stroke: ${accent}; stroke-width: ${stroke}`);
  });
  var bgString = bgDOM.outerHTML;
  console.log(bgDOM);
  console.log(fill,accent,stroke);
  //document.documentElement.style.setProperty('--background-ornament', bgURL);
}
