var slideIndex = 0;
var slides = document.querySelectorAll('[class*="mySlides"]');
var container = document.querySelectorAll('[class*="w3-display-container"]');
var leftButton = document.querySelectorAll('[class*="w3-display-left"]');
var rightButton = document.querySelectorAll('[class*="w3-display-right"]');
var timer = 5000;
var imgWidth;
var siteContentWidth;
var imgWidthPercent;
var rightButtonPos;			
var slideInterval;
var initialized;

jQuery(document).ready(function($) {
	
///////////////////////////
// checking if the mySlide class exists
//////////////////////////
if (slides.length == 0 || undefined) {
//	alert(localStorage.getItem(siteContentWidth));
//	alert(siteContentWidth);
//	document.querySelectorAll('[class*="site-content"]')[0].style.width = localStorage.getItem(siteContentWidth) + "%";
	$('.site-content').css('width', localStorage.getItem(siteContentWidth) + "%");
	$('.site-footer').css('width', localStorage.getItem(siteContentWidth) + "%");
//	siteContentWidth[0].style.width = imgWidth+"px";
}	
	
var $images = $('.w3-display-container img');	
$images.css('visibility','hidden');  //temporaly	
//$images.css('display','none');
	
});	


//Slide Container invisible for initializing (until the fist img has loaded)
//container[0].style.visibility = 'hidden';


///////////////////////////
// Starts when the whole window has loaded
//////////////////////////
jQuery(window).load(function() {
	

///////////////////////////
// Image preloader in order of use 
//////////////////////////	
//slides = jQuery('.mySlides');	
var $images = jQuery('.w3-display-container img');	
var lastLoadIndex = 0;	
	
var loadNextImage = function () {	  

	$images.eq(lastLoadIndex).css('visibility','visible');	
	
	if(lastLoadIndex === 0){
		// sets onlye the 1st img visible		
		$images.eq(lastLoadIndex).css('position','absolute');
		$images.eq(lastLoadIndex).css('z-index','2');	
	}
	else{
		$images.eq(lastLoadIndex).css('position','absolute');
		$images.eq(lastLoadIndex).css('z-index','0');
	}
	
	
	// goes on with the script after 3 images has loaded
	if(lastLoadIndex === 3 && initialized !== true){
			// by some reason it needed that switch for not hitting shoSlides more than once
			initialized = true;
			slideInterval = setInterval(showSlides, timer); // Change image every 5 seconds
			showSlides();
	}
	
	
	//stops the function by the last image
	if ($images.length === lastLoadIndex) {
		
		return;
	}
	console.log('loading image at index ' + lastLoadIndex);
	   
	//the normal wp featuer image have the src attribute set already
	if( $images.eq(lastLoadIndex).attr('src') ){
		console.log('src defined already:' + lastLoadIndex);
		lastLoadIndex += 1;
		loadNextImage();
	}
	//exchanges the data-src trhough the src attribute  
	$images.eq(lastLoadIndex).attr('src', $images.eq(lastLoadIndex).attr('data-src'));
	lastLoadIndex += 1;
 };
	
$images.on('load', loadNextImage);
loadNextImage();
//});	
	
	
/*	
var images = [
	jQuery('.mySlides').each(function() {  
    var imgsrc = jQuery(this).attr('src');
	if(imgsrc == undefined){
			imgsrc = jQuery(this).attr('data-src');
		}
   return imgsrc + ",";
  })
//    "http://sebastianfehr.com/wp/wp-content/uploads/2017/11/jm-01.jpg",
//	"http://sebastianfehr.com/wp/wp-content/uploads/2017/11/jpplakate_4.jpg"
];	
*/


///////////////////////////
// Image slider Starts the DOM build up before the preloader
//////////////////////////
//jQuery(document).ready(function($) {
// jQuery(window).load(function() {
	

	


///////////////////////////
// proper event listener function for window resize
//////////////////////////
var addEvent = function(object, type, callback) {
    if (object == null || typeof(object) == 'undefined') return;
    if (object.addEventListener) {
        object.addEventListener(type, callback, false);
    } else if (object.attachEvent) {
        object.attachEvent("on" + type, callback);
    } else {
        object["on"+type] = callback;
    }
};

addEvent(window, "resize", containerWidth);


///////////////////////////
// Slide Show
//////////////////////////	
function showSlides() { 
	console.log('showSlides being hit, slideIndex1:  ' + slideIndex);
	var i;    
    for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none"; 
    }
	
    slideIndex++;
	
    if (slideIndex > slides.length) {
		slideIndex = 1;
	} 
	
	// Having 2 slieds displayed to avoid white flickering. position and zindex needed for stacking order
	//1st image
	slides[slideIndex-1].style.display = "block";
	slides[slideIndex-1].style.position = "absolute";
	slides[slideIndex-1].style.zIndex = "2";
	
	//2nd image (and looping check)
	if (slideIndex > slides.length) {
		slides[0].style.display = "block";
		slides[0].style.zIndex = "1";
	}
	else{
		slides[slideIndex].style.display = "block";
		slides[slideIndex].style.zIndex = "1";	
	}
	
	containerWidth();
}


//Switching the slides between visible and invisible
function currentSlide(no) {
    var i;    
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    slideIndex = no;
	
	//1st image
	slides[no-1].style.display = "block"; 
	slides[no-1].style.position = "absolute";
	slides[no-1].style.zIndex = "2";
	
	//2nd image (and looping check)
	if (no == slides.length) {
		slides[0].style.display = "block";
		slides[0].style.zIndex = "1";
	}
	else{
		slides[no].style.display = "block";
		slides[no].style.zIndex = "1";	
	}
	
	containerWidth();
}
	
///////////////////////////
// Prev next button
//////////////////////////	

function plusSlides(n) {	
	
  var newslideIndex = slideIndex + n;   
	
  if(newslideIndex < slides.length+1 && newslideIndex > 0){
     currentSlide(newslideIndex);
  }
  else if (newslideIndex == slides.length+1)
  {
  currentSlide(1);
  }
  else if (newslideIndex == 0)
  {
  currentSlide(slides.length);
  }
	clearInterval(slideInterval);
	console.log ("intervall cleared: " + clearInterval)
	if(initialized){
		slideInterval = setInterval(showSlides, timer);
	}
	
	containerWidth();
}

// Button Click Event Listening
jQuery('.w3-display-left').click(function(){
	plusSlides(-1);
});	

jQuery('.w3-display-right').click(function(){
	plusSlides(1);
});		

	
///////////////////////////
// Button reposition according to child IMG (to get the prev and next buttons place correclty)
//////////////////////////
function containerWidth(){	
	
	if(slides[slideIndex-1] == undefined){
		console.log("it was undefined -> " + slides[0]);	
		
	imgWidth = slides[slideIndex].clientWidth;
	
	// button position and height
	rightButton[0].style.height = parseInt(slides[slideIndex].clientHeight) + "px";
	leftButton[0].style.height = parseInt(slides[slideIndex].clientHeight) + "px";
	
	rightButton[0].style.width = parseInt(slides[slideIndex].clientWidth * 30 / 100) + "px";
	leftButton[0].style.width = parseInt(slides[slideIndex].clientWidth * 30 / 100) + "px";
		
	}
	
	else{
		
	imgWidth = slides[slideIndex-1].clientWidth;
	
	// button position and height
	rightButton[0].style.height = parseInt(slides[slideIndex-1].clientHeight) + "px";
	leftButton[0].style.height = parseInt(slides[slideIndex-1].clientHeight) + "px";
	
	rightButton[0].style.width = parseInt(slides[slideIndex-1].clientWidth * 30 / 100) + "px";
	leftButton[0].style.width = parseInt(slides[slideIndex-1].clientWidth * 30 / 100) + "px";			
		
	}
	
	imgWidthPercent = 100 * parseInt(imgWidth) / parseInt(window.outerWidth);
	localStorage.setItem(siteContentWidth, imgWidthPercent);
	
	rightButtonPos = parseInt(imgWidth) - parseInt(rightButton[0].clientWidth);
	rightButton[0].style.left = rightButtonPos+"px";
	
	

}


///////////////////////////
// Adding Keyboard listener
//////////////////////////

jQuery(document).keydown(function(e){
	if (e.keyCode == 37) {
		// Left Button
		jQuery('.w3-display-left').addClass('pulsuate');
		plusSlides(-1);
	}
	if (e.keyCode == 39) {
		// Right Button
		jQuery('.w3-display-right').addClass('pulsuate');
		plusSlides(1);
	}
});	
	
jQuery(document).keyup(function(){
	// Left and Right Button
	jQuery('.w3-button').removeClass('pulsuate');
});	
	
	
///////////////////////////
// Swipe functionality
//////////////////////////	
	
// create a simple instance
var mc = new Hammer(container[0]);

// listen to events...
mc.on("swipeleft swiperight", function(ev) {
//	alert( ev.type +" gesture detected.");
	if (ev.type == "swipeleft"){		
//		$('.w3-display-left').addClass('pulsuate');
		plusSlides(1);
	}
	if (ev.type == "swiperight"){		
//		$('.w3-display-right').addClass('pulsuate');
		plusSlides(-1);
	}
//	$('.w3-button').removeClass('pulsuate');
});

	
		
containerWidth();
	
});	
