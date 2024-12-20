<?php
session_start();
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planting Guide</title>
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Header Section -->
    <header>

        <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#">Home</a>
            <a href="tool/index.html">Plant Recommendation Tool</a>
            <a href="about_us/index.html">About Us</a>
            <a href="user manual/index.html">User manual</a>
            <a href="#">Bookmarks</a>
          </div>
          <button class="openbtn" onclick="openNav()">&#9776; </button>

        <div class="logo-container">
          <a href="#" class="logo">
            <img src="plant_logo.png" alt="Planting Guide Logo">
            <span>Planting Guide</span>
          </a>
        </div>
        <nav class="nav-center">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="tool/index.html">Plant Recommendation Tool</a></li>
            <li><a href="about_us/index.html">About Us</a></li>
          </ul>
        </nav>
        <div class="auth-container">
    <?php if ($isLoggedIn): ?>
        <p class="user-log">Welcome, <?php echo htmlspecialchars($username); ?>!</p>
        <a href="logout.php" class="logout-button">Logout</a>
    <?php else: ?>
        <button class="sign-up" onclick="window.location.href='register.html'">Sign Up</button>
        <button class="sign-in" onclick="window.location.href='login.html'">Sign In</button>
    <?php endif; ?>
</div>


      </header>

      <!-- hero section -->

      <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Find the Perfect Plants for Your Environment</h1>
            <p class="hero-subheading">Explore tailored plant recommendations based on your location and soil type.</p>
            <button class="hero-button" onclick="getStarted()">Get Started</button>
        </div>
    </div>
    <!-- how it works section -->
    <section class="how-it-works">
      <div class="section-header">
        <h2>How It Works</h2>
        <p>Follow these steps to get personalized plant recommendations based on your location and soil type.</p>
      </div>
      <div class="steps-container">
        <div class="step">
          <div class="icon">🌍</div>
          <h3>Select Your Region</h3>
          <p>Choose your location to get plant recommendations suited for your area's climate and soil.</p>
        </div>
        <div class="step">
          <div class="icon">🌱</div>
          <h3>Choose Soil Type</h3>
          <p>Identify the type of soil you have to ensure the recommended plants will thrive.</p>
        </div>
        <div class="step">
          <div class="icon">🔍</div>
          <h3>Get Plant Suggestions</h3>
          <p>Receive a list of plants that are best suited for your region and soil type.</p>
        </div>
      </div>
    </section>

    <!-- feature section -->
    <section class="features-section" id="features">
  <div class="features-container">
    <div class="feature-item">
      <img src="plant_photo_3.png" alt="Plant Recommendations" class="feature-icon">
      <h3 class="feature-title">Plant Recommendations</h3>
      <p class="feature-description">Get personalized plant suggestions based on your location and environment.</p>
    </div>
    <div class="feature-item">
      <img src="plant_photo_1.png" alt="Care Tips" class="feature-icon">
      <h3 class="feature-title">Care Tips</h3>
      <p class="feature-description">Receive expert advice on how to care for your plants for optimal growth.</p>
    </div>
    <div class="feature-item">
      <img src="plant_photo_2.png" alt="Bookmark Your Plants" class="feature-icon">
      <h3 class="feature-title">Bookmark Your Plants</h3>
      <p class="feature-description">Save and track the plants you're interested in for future reference.</p>
    </div>
  </div>
</section>

 <!-- testimonials section -->
<section class="testimonial-section">
  <!-- Slideshow container -->
  <div class="slideshow-container">
    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
      <div class="profile-container">
        <img src="meloni.jpg" alt="Meloni">
        <div class="profile-name">Meloni G.</div>
        <div class="review-text">🌸 "I decided to create a garden for Modi, partly because I’m tired of only seeing his face in selfies. I used this plant recommendation website to turn his garden into a floral wonderland. Now, every time he steps outside, he’s greeted by flowers that are almost as vibrant as his Twitter feed! The best part? I finally have a garden where I can practice my ‘Look at me, I’m gardening!’ selfies. Ciao, and thanks for the help!" 🌸📸</div>
      </div>
    </div>

    <div class="mySlides fade">
      <div class="profile-container">
        <img src="modi.jpg" alt="Modi">
        <div class="profile-name">Modi J.</div>
        <div class="review-text">"Meloni’s idea of a garden makeover was truly a surprise—mostly because I was expecting her to just bring me another selfie stick! Thanks to this website, I received a garden that’s bursting with colors, making my outdoor space look like it’s in a Bollywood movie. And the flowers? They’re practically singing 'Jai Ho!' every time I walk by. I guess this is what happens when international diplomacy meets horticulture—gardens and selfies for everyone!" 🌻🤳</div>
      </div>
    </div>

    <div class="mySlides fade">
      <div class="profile-container">
        <img src="putin.jpg" alt="Putin">
        <div class="profile-name">Putin V.</div>
        <div class="review-text">"Planting a garden was a radical change from my usual activities, but after using this plant recommendation website, I’ve finally created something that doesn’t involve breaking things. My new garden is like a peace treaty with Mother Nature herself—no tanks, just tulips! Who knew that planting could be so... relaxing? I might even start a new trend: ‘From Destruction to Daffodils.’ Thanks for making my green thumb a reality!" 🌲🚀</div>
      </div>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>

  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>
</section>


      <!-- Footer Section -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-column">
      <h3>About Us</h3>
      <p>Learn more about our mission to help you grow the perfect plants for your environment.</p>
    </div>
    <div class="footer-column">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">How It Works</a></li>
        <li><a href="#">Features</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>Contact Info</h3>
      <p><strong>Email:</strong> support@plantguide.com</p>
      <p><strong>Phone:</strong> +91 0000 8888 99</p>
      <p><strong>Location:</strong> Sion East, near KJ Somaiya Hospital 400022</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2024 Planting Guide. All Rights Reserved.</p>
    <ul class="social-icons">
      <li><a href="#"><i class="fab fa-facebook"></i></a></li>
      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
      <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
    </ul>
  </div>
</footer>
<script src="landing_page.js"></script>
</body>
</html>