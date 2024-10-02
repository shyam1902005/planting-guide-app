/* Set the width of the sidebar to 250px (show it) */
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}

/* Set the width of the sidebar to 0 (hide it) */
function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}

// hero section
function getStarted() {
  window.location.href = "tool/index.html"; // Replace with actual URL
}

let slideIndex = 1;
let slideInterval;

showSlides(slideIndex);

// Function to show slides
function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");

  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none"; // Hide all slides
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex - 1].style.display = "block"; // Show the current slide
  dots[slideIndex - 1].className += " active";
}

// Function to move to the next or previous slide
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Function to set the current slide
function currentSlide(n) {
  showSlides(slideIndex = n);
}

// Function to start the slideshow
function startSlideShow() {
  slideInterval = setInterval(function() {
    plusSlides(1);
  }, 10000); // Change image every 10 seconds
}

// Function to stop the slideshow
function stopSlideShow() {
  clearInterval(slideInterval);
}

// Start the slideshow
startSlideShow();

// Add event listeners to the slideshow container for hover effects
const slideshowContainer = document.querySelector('.slideshow-container');
slideshowContainer.addEventListener('mouseover', stopSlideShow); // Stop slideshow on hover
slideshowContainer.addEventListener('mouseout', startSlideShow); // Restart slideshow on mouse out

window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  
  if (window.scrollY > 50) {
    header.style.backgroundColor = 'rgba(0, 0, 0, 0.8)'; // Darker when scrolled
  } else {
    header.style.backgroundColor = 'rgba(0, 0, 0, 1)'; // More transparent at the top
  }
});

