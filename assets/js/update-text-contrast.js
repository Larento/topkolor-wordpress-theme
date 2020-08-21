document.addEventListener("DOMContentLoaded", updateContrast);

function updateContrast() {
  let toSetProperty = document.documentElement.style;
  let toGetProperty = window.getComputedStyle(document.documentElement);
  let textColors = [
    'header-heading',
    'post-heading',
    'post-text',
    'commerce-heading',
    'commerce-text',
    'footer-heading',
  ];
  let mainColors = [
    'header-main',
    'post-main',
    'post-main',
    'commerce-main-1',
    'commerce-main-2',
    'footer-main',
  ];
  let textLight = toGetProperty.getPropertyValue('--text-light');
  let textDark = toGetProperty.getPropertyValue('--text-dark');

  if (textColors.length == mainColors.length) {
    for(var i in mainColors){
      let colorCode = toGetProperty.getPropertyValue('--' + mainColors[i]);
      toSetProperty.setProperty('--' + textColors[i], textColor(colorCode, textDark, textLight));
    };
  };
};

function relativeLuminance(RGB) {
  var sRGB = [];
  for(var i in RGB){
    var channel = RGB [i] / 255;
    if (channel <= 0.03928) {
      sRGB[i] = channel / 12.92;
    } else {
      sRGB[i] = Math.pow((channel + 0.055) / 1.055, 2.4);
    };
  };
  return 0.2126 * sRGB[0] + 0.7152 * sRGB[1] + 0.0722 * sRGB[2];
};

function contrastRatio(mainRGBA, secondaryRGBA) {
  var mainRGB = mainRGBA.match(/[.?\d]+/g).map(x=>+x).slice(0, 3);
  var secondaryRGB = secondaryRGBA.match(/[.?\d]+/g).map(x=>+x).slice(0, 3);
  var L1 = Math.max(relativeLuminance(mainRGB), relativeLuminance(secondaryRGB));
  var L2 = Math.min(relativeLuminance(mainRGB), relativeLuminance(secondaryRGB));
  return (L1 + 0.05) / (L2 + 0.05);
};

function textColor(colorCode, textDark, textLight) {
  return (contrastRatio(colorCode, textDark) > contrastRatio(colorCode, textLight)) ? textDark : textLight;
};

