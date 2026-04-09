<!DOCTYPE html>
<html>

<body>
<div class="container">
	<div class="ProductNav_Wrapper">
	
	<nav id="ProductNav" class="ProductNav dragscroll mouse-scroll" role="tablist">
		<div id="ProductNavContents" class="nav ProductNav_Contents">
		  <a class="ProductNav_Link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home </a>
		  <a class="ProductNav_Link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
		  <a class="ProductNav_Link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
       
		  
		<span id="Indicator" class="ProductNav_Indicator"></span>
    </div>
</nav>
	
	<button id="AdvancerLeft" class="Advancer Advancer_Left" type="button">
		<svg class="Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M445.44 38.183L-2.53 512l447.97 473.817 85.857-81.173-409.6-433.23v81.172l409.6-433.23L445.44 38.18z"/></svg>
	</button>
	<button id="AdvancerRight" class="Advancer Advancer_Right" type="button">
		<svg class="Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"/></svg>
	</button>

</div>
	<div class="card">
		<div class="card-body">
			<div class="tab-content" id="myTabContent">
            </div>
		</div>
	</div>
</div>


<!--------------------- SECOND INSTANCE ------------------------->
<div class="container">
	<div class="ProductNav_Wrapper">
	
	<nav id="ProductNav2" class="ProductNav dragscroll mouse-scroll" role="tablist">
		<div id="ProductNavContents2" class="nav ProductNav_Contents">
		  <a class="ProductNav_Link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true">Home</a>
		  <a class="ProductNav_Link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false">Profile</a>
		  <a class="ProductNav_Link" id="contact-tab2" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Contact</a>
          
       
		<span id="Indicator2" class="ProductNav_Indicator"></span>
    </div>
</nav>
	
	<button id="AdvancerLeft2" class="Advancer Advancer_Left" type="button">
		<svg class="Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M445.44 38.183L-2.53 512l447.97 473.817 85.857-81.173-409.6-433.23v81.172l409.6-433.23L445.44 38.18z"/></svg>
	</button>
	<button id="AdvancerRight2" class="Advancer Advancer_Right" type="button">
		<svg class="Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"/></svg>
	</button>

</div>
	
	</div>



</body>

</html>
<style>
/*---- Don't Copy this Custom Styling ----*/
body {font-family:'Montserrat'; font-size:0.85rem; font-weight:500;}

/*--- Remove Bootstrap's styling for Nav Class if needed ---*/
#ProductNav .nav, #ProductNav2 .nav {
	display: inherit;
	flex-wrap: inherit;
	padding-left: inherit;
	margin-bottom: inherit;
	list-style: inherit;
}

/*--- Wrap Up ---*/
.ProductNav_Wrapper {
	position: relative;
	padding: 0 11px;
	box-sizing: border-box;
}

.ProductNav {
    /* Make this scrollable when needed */
    overflow-x: auto;
    /* We don't want vertical scrolling */
    overflow-y: hidden;
    /* For WebKit implementations, provide inertia scrolling */
    -webkit-overflow-scrolling: touch;
    /* We don't want internal inline elements to wrap */
    white-space: nowrap;
    /* If JS present, let's hide the default scrollbar */
    .js & {
        /* Make an auto-hiding scroller for the 3 people using a IE */
        -ms-overflow-style: -ms-autohiding-scrollbar;
        /* Remove the default scrollbar for WebKit implementations */
        &::-webkit-scrollbar {
            display: none;
        }
    }
	/* positioning context for advancers */
	position: relative;
	// Crush the whitespace here
	font-size: 0;
}

.ProductNav_Contents {
	float: left;
	transition: transform .2s ease-in-out;
	position: relative;
}

.ProductNav_Contents-no-transition {
	transition: none;
}

.ProductNav_Link {
	text-decoration: none;
	color: #7f868b;
	// Reset the font Size
	font-size: 0.85rem;
	font-weight:500;
	display: table-cell;
	vertical-align:middle;
	padding: 8px 12px;
	line-height:1.35;
	// & + & {
	// 	border-left-color: #eee;
	// }
	&[aria-selected="true"] {
		color: #6a2c79;
	}
}

.Advancer {
	/* Reset the button */
	appearance: none;
	background: transparent;
	padding: 0;
	border: 0;
	&:focus {
		outline: 0;
	}
	&:hover {
		cursor: pointer;
	}
	/* Now style it as needed */
	position: absolute;
	top: 0;
	bottom: 0;
	/* Set the buttons invisible by default */
	opacity: 0;
	transition: opacity .3s;
}

.Advancer_Left {
	left: 0;
	[data-overflowing="both"] ~ &,
	[data-overflowing="left"] ~ & {
		opacity: 1;
	}
}

.Advancer_Right {
	right: 0;
	[data-overflowing="both"]  ~ &,
	[data-overflowing="right"] ~ & {
		opacity: 1;
	}
}

.Advancer_Icon {
	width: 12px;
	height: 44px;
	fill: #bbb;
}

.ProductNav_Indicator {
	position: absolute;
	bottom: 0;
	left: 0;
	height: 3px;
	width: 100px;
	background-color: transparent;
	transform-origin: 0 0;
	transition: transform .2s ease-in-out, background-color .2s ease-in-out;
}</style>
<script>
var SETTINGS = {
	navBarTravelling: false,
	navBarTravelDirection: "",
 	navBarTravelDistance: 150
}

var colours = {
    0: "#fead00"
/*
Add Numbers And Colors if you want to make each tab's indicator in different color for eg:
1: "#FF0000",
2: "#00FF00", and so on...
*/
}

document.documentElement.classList.remove("no-js");
document.documentElement.classList.add("js");

// Out advancer buttons
var AdvancerLeft = document.getElementById("AdvancerLeft");
var AdvancerRight = document.getElementById("AdvancerRight");

var AdvancerLeft2 = document.getElementById("AdvancerLeft2");
var AdvancerRight2 = document.getElementById("AdvancerRight2");

// the indicator
var Indicator = document.getElementById("Indicator");
var ProductNav = document.getElementById("ProductNav");
var ProductNavContents = document.getElementById("ProductNavContents");

var Indicator2 = document.getElementById("Indicator2");
var ProductNav2 = document.getElementById("ProductNav2");
var ProductNavContents2 = document.getElementById("ProductNavContents2");

ProductNav.setAttribute("data-overflowing", determineOverflow(ProductNavContents, ProductNav));

ProductNav2.setAttribute("data-overflowing", determineOverflow(ProductNavContents2, ProductNav2));

// Set the indicator
moveIndicator(ProductNav.querySelector("[aria-selected=\"true\"]"), colours[0]);

moveIndicator2(ProductNav2.querySelector("[aria-selected=\"true\"]"), colours[0]);

// Handle the scroll of the horizontal container
var last_known_scroll_position = 0;
var ticking = false;

function doSomething(scroll_pos) {
    ProductNav.setAttribute("data-overflowing", determineOverflow(ProductNavContents, ProductNav));
    ProductNav2.setAttribute("data-overflowing", determineOverflow(ProductNavContents2, ProductNav2));
}

ProductNav.addEventListener("scroll", function() {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(function() {
            doSomething(last_known_scroll_position);
            ticking = false;
        });
    }
    ticking = true;
});

ProductNav2.addEventListener("scroll", function() {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(function() {
            doSomething(last_known_scroll_position);
            ticking = false;
        });
    }
    ticking = true;
});


AdvancerLeft.addEventListener("click", function() {
// If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }
    // If we have content overflowing both sides or on the left
    if (determineOverflow(ProductNavContents, ProductNav) === "left" || determineOverflow(ProductNavContents, ProductNav) === "both") {
        // Find how far this panel has been scrolled
        var availableScrollLeft = ProductNav.scrollLeft;
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollLeft < SETTINGS.navBarTravelDistance * 2) {
            ProductNavContents.style.transform = "translateX(" + availableScrollLeft + "px)";
        } else {
            ProductNavContents.style.transform = "translateX(" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        ProductNavContents.classList.remove("ProductNav_Contents-no-transition");
        // Update our settings
        SETTINGS.navBarTravelDirection = "left";
        SETTINGS.navBarTravelling = true;
    }
    // Now update the attribute in the DOM
    ProductNav.setAttribute("data-overflowing", determineOverflow(ProductNavContents, ProductNav));
});
AdvancerLeft2.addEventListener("click", function() {
// If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }
    // If we have content overflowing both sides or on the left
    if (determineOverflow(ProductNavContents2, ProductNav2) === "left" || determineOverflow(ProductNavContents2, ProductNav2) === "both") {
        // Find how far this panel has been scrolled
        var availableScrollLeft = ProductNav2.scrollLeft;
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollLeft < SETTINGS.navBarTravelDistance * 2) {
            ProductNavContents2.style.transform = "translateX(" + availableScrollLeft + "px)";
        } else {
            ProductNavContents2.style.transform = "translateX(" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        ProductNavContents2.classList.remove("ProductNav_Contents-no-transition");
        // Update our settings
        SETTINGS.navBarTravelDirection = "left";
        SETTINGS.navBarTravelling = true;
    }
    // Now update the attribute in the DOM
    ProductNav2.setAttribute("data-overflowing", determineOverflow(ProductNavContents2, ProductNav2));
});

AdvancerRight.addEventListener("click", function() {
    // If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }
    // If we have content overflowing both sides or on the right
    if (determineOverflow(ProductNavContents, ProductNav) === "right" || determineOverflow(ProductNavContents, ProductNav) === "both") {
        // Get the right edge of the container and content
        var navBarRightEdge = ProductNavContents.getBoundingClientRect().right;
        var navBarScrollerRightEdge = ProductNav.getBoundingClientRect().right;
        // Now we know how much space we have available to scroll
        var availableScrollRight = Math.floor(navBarRightEdge - navBarScrollerRightEdge);
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollRight < SETTINGS.navBarTravelDistance * 2) {
            ProductNavContents.style.transform = "translateX(-" + availableScrollRight + "px)";
        } else {
            ProductNavContents.style.transform = "translateX(-" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        ProductNavContents.classList.remove("ProductNav_Contents-no-transition");
        // Update our settings
        SETTINGS.navBarTravelDirection = "right";
        SETTINGS.navBarTravelling = true;
    }
    // Now update the attribute in the DOM
    ProductNav.setAttribute("data-overflowing", determineOverflow(ProductNavContents, ProductNav));
});
AdvancerRight2.addEventListener("click", function() {
    // If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }
    // If we have content overflowing both sides or on the right
    if (determineOverflow(ProductNavContents2, ProductNav2) === "right" || determineOverflow(ProductNavContents2, ProductNav2) === "both") {
        // Get the right edge of the container and content
        var navBarRightEdge = ProductNavContents2.getBoundingClientRect().right;
        var navBarScrollerRightEdge = ProductNav2.getBoundingClientRect().right;
        // Now we know how much space we have available to scroll
        var availableScrollRight = Math.floor(navBarRightEdge - navBarScrollerRightEdge);
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollRight < SETTINGS.navBarTravelDistance * 2) {
            ProductNavContents2.style.transform = "translateX(-" + availableScrollRight + "px)";
        } else {
            ProductNavContents2.style.transform = "translateX(-" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        ProductNavContents2.classList.remove("ProductNav_Contents-no-transition");
        // Update our settings
        SETTINGS.navBarTravelDirection = "right";
        SETTINGS.navBarTravelling = true;
    }
    // Now update the attribute in the DOM
    ProductNav2.setAttribute("data-overflowing", determineOverflow(ProductNavContents2, ProductNav2));
});

ProductNavContents.addEventListener(
    "transitionend",
    function() {
        // get the value of the transform, apply that to the current scroll position (so get the scroll pos first) and then remove the transform
        var styleOfTransform = window.getComputedStyle(ProductNavContents, null);
        var tr = styleOfTransform.getPropertyValue("-webkit-transform") || styleOfTransform.getPropertyValue("transform");
        // If there is no transition we want to default to 0 and not null
        var amount = Math.abs(parseInt(tr.split(",")[4]) || 0);
        ProductNavContents.style.transform = "none";
        ProductNavContents.classList.add("ProductNav_Contents-no-transition");
        // Now lets set the scroll position
        if (SETTINGS.navBarTravelDirection === "left") {
            ProductNav.scrollLeft = ProductNav.scrollLeft - amount;
        } else {
            ProductNav.scrollLeft = ProductNav.scrollLeft + amount;
        }
        SETTINGS.navBarTravelling = false;
    },
    false
);
ProductNavContents2.addEventListener(
    "transitionend",
    function() {
        // get the value of the transform, apply that to the current scroll position (so get the scroll pos first) and then remove the transform
        var styleOfTransform = window.getComputedStyle(ProductNavContents2, null);
        var tr = styleOfTransform.getPropertyValue("-webkit-transform") || styleOfTransform.getPropertyValue("transform");
        // If there is no transition we want to default to 0 and not null
        var amount = Math.abs(parseInt(tr.split(",")[4]) || 0);
        ProductNavContents2.style.transform = "none";
        ProductNavContents2.classList.add("ProductNav_Contents-no-transition");
        // Now lets set the scroll position
        if (SETTINGS.navBarTravelDirection === "left") {
            ProductNav2.scrollLeft = ProductNav2.scrollLeft - amount;
        } else {
            ProductNav2.scrollLeft = ProductNav2.scrollLeft + amount;
        }
        SETTINGS.navBarTravelling = false;
    },
    false
);

// Handle setting the currently active link
ProductNavContents.addEventListener("click", function(e) {
var links = [].slice.call(document.querySelectorAll("#ProductNavContents .ProductNav_Link"));
links.forEach(function(item) {
item.setAttribute("aria-selected", "false");
})
e.target.setAttribute("aria-selected", "true");
// Pass the clicked item and it's colour to the move indicator function
moveIndicator(e.target, colours[links.indexOf(e.target)]);
});
ProductNavContents2.addEventListener("click", function(e) {
var links = [].slice.call(document.querySelectorAll("#ProductNavContents2 .ProductNav_Link"));
links.forEach(function(item) {
item.setAttribute("aria-selected", "false");
})
e.target.setAttribute("aria-selected", "true");
// Pass the clicked item and it's colour to the move indicator function
moveIndicator2(e.target, colours[links.indexOf(e.target)]);
});

// var count = 0;
function moveIndicator(item, color) {
    var textPosition = item.getBoundingClientRect();
    var container = ProductNavContents.getBoundingClientRect().left;
    var distance = textPosition.left - container;
 var scroll = ProductNavContents.scrollLeft;
    Indicator.style.transform = "translateX(" + (distance + scroll) + "px) scaleX(" + textPosition.width * 0.01 + ")";
// count = count += 100;
// Indicator.style.transform = "translateX(" + count + "px)";

    if (color) {
        Indicator.style.backgroundColor = color;
    }
}

// var count = 0;
function moveIndicator2(item, color) {
    var textPosition = item.getBoundingClientRect();
    var container = ProductNavContents2.getBoundingClientRect().left;
    var distance = textPosition.left - container;
 var scroll = ProductNavContents2.scrollLeft;
    Indicator2.style.transform = "translateX(" + (distance + scroll) + "px) scaleX(" + textPosition.width * 0.01 + ")";
// count = count += 100;
// Indicator.style.transform = "translateX(" + count + "px)";

    if (color) {
        Indicator2.style.backgroundColor = color;
    }
}

function determineOverflow(content, container) {
    var containerMetrics = container.getBoundingClientRect();
    var containerMetricsRight = Math.floor(containerMetrics.right);
    var containerMetricsLeft = Math.floor(containerMetrics.left);
    var contentMetrics = content.getBoundingClientRect();
    var contentMetricsRight = Math.floor(contentMetrics.right);
    var contentMetricsLeft = Math.floor(contentMetrics.left);
 if (containerMetricsLeft > contentMetricsLeft && containerMetricsRight < contentMetricsRight) {
        return "both";
    } else if (contentMetricsLeft < containerMetricsLeft) {
        return "left";
    } else if (contentMetricsRight > containerMetricsRight) {
        return "right";
    } else {
        return "none";
    }
}

/*------------------- ACTIVE LINK POSITION ------------------------*/
$("#ProductNav .ProductNav_Link").click(function() {
   
   centerLI(this, '#ProductNav');

 });

$("#ProductNav2 .ProductNav_Link").click(function() {
   
   centerLI(this, '#ProductNav2');

 });

 //http://stackoverflow.com/a/33296765/350421
 function centerLI(target, outer) {
   var out = $(outer);
   var tar = $(target);
   var x = out.width() - 50;
   var y = tar.outerWidth(true);
   var z = tar.index();
   var q = 0;
   var m = out.find('.ProductNav_Link');
   for (var i = 0; i < z; i++) {
     q += $(m[i]).outerWidth(true);
   }
   
 //out.scrollLeft(Math.max(0, q - (x - y)/2));
 var xy = x - y;
 if(q > xy){
out.animate({
  scrollLeft: Math.max(0, q - (x - y) + 100)
}, 500);
 } else {
 out.animate({
  scrollLeft: Math.max(0, q/2 - 50)
}, 500);	  
 }

 }


$(document).ready(function() {
$('.mouse-scroll').mousewheel(function(e, delta) {
this.scrollLeft -= (delta * 50);
e.preventDefault();
});
});
</script>
