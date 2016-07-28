/* vars for photoshuffler */
var gblImg = JSON.parse("$imagearray");
var gblPauseSeconds = $gblPauseSeconds;
var gblFadeSeconds = $gblFadeSeconds;
var gblDeckSize = gblImg.length;
var gblImageRotations = gblDeckSize * (gblRotations+1);
window.onload = photoShufflerLaunch;
