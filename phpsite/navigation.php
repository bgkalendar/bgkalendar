<nav id="nav">
<?php include('menu.php');?>
</nav>
<div id="navspace" style="height: 10px; display: block;">&nbsp;</div> 

<script lang="javascript" charset="UTF-8" type="text/javascript">
/**
 * For some reason the top navigation menu stays on top of othe components and it when 
 * the windows has small width (such as when viewed on a mobile device) or whne it gets
 * resized, then the top navigation menu rerenders and goes over part of the text in the 
 * page. 
 * So in this navigation inclusion, we add one additional component div in front of the 
 * text and we keep its height (with javascript - aghh nasty) the same as the height of 
 * the top navigation menu. So this div component pushes the actual text down not 
 * allowing it to be covered by the top navigation menu.
 * TODO: find out why this happens and resove it with pure CSS.
 *
 * This function is to be called when the page is rendered or the window is resized, 
 * so that the size of the spacer div is kept same as the size of the top nav. menu. 
 */
function rearrangeSizeOnSpacerWhenLoadedOrWindowResized() {
  var navtoptitleObj = document.getElementById("navtoptitle");
  var toptitleObj    = document.getElementById("toptitle");
  var navmenuObj     = document.getElementById("navmenu");
  var navspace       = document.getElementById("navspace");

  if (navtoptitleObj != null && toptitleObj != null && navmenuObj != null && navspace != null) {
    var navtoptitle = navtoptitleObj.clientHeight;
    var toptitle    = toptitleObj.getBoundingClientRect().height;
    var navmenu     = navmenuObj.clientHeight;
//    var offsetHeight = navmenus.offsetHeight;
//    var scrollHeight = navmenus.scrollHeight;
//    var height = clientHeight > offsetHeight ? clientHeight  : offsetHeight;
//    height = height > scrollHeight ? height : scrollHeight;
    var height = toptitle + navmenu - navtoptitle + 5; // 5 added just to look a bit nicer :)
    navspace.style.height = (height) + "px";
  } 
}
/**
 * Trigger rearrangeSizeOnSpacerWhenLoadedOrWindowResized() the first time when the 
 * page gets completely loaded. 
 */
document.addEventListener('DOMContentLoaded', rearrangeSizeOnSpacerWhenLoadedOrWindowResized);
/**
 * This is a global variable to store the id of the new timeout.
 * Essentially you queue up the resize handling code, and then
 * if the window resize occurs again, you cancel it, and re-queue it.
 * This keeps happening until the resize is complete, at which point,
 * your rearrangeSizeOnSpacerWhenLoadedOrWindowResized() function 
 * is actually executed.
 */
var resizeTimeoutIdNavigationMenu = null;

/**
 * Trigger rearrangeSizeOnSpacerWhenLoadedOrWindowResized every time when the window gets
 * resized, which might effect in the top navigation menu going into several rows instead 
 * of just one and thus covering some of the actual text content in the page.
 */
window.addEventListener('resize', function(event){
  window.clearTimeout(resizeTimeoutIdNavigationMenu);
  resizeTimeoutIdNavigationMenu = window.setTimeout('rearrangeSizeOnSpacerWhenLoadedOrWindowResized();', 70);
});

</script>

