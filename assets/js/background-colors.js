function backgroundColors(bgSVG)
var fill = window.getComputedStyle(document.documentElement).getPropertyValue('--background-fill');
var accent = window.getComputedStyle(document.documentElement).getPropertyValue('--background-accent');
var stroke = window.getComputedStyle(document.documentElement).getPropertyValue('--background-stroke');
console.log(bgSVG);
//var bgURL = read svg
//document.documentElement.style.setProperty('--background-ornament', bgURL);