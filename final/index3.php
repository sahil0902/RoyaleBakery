<?php
include 'config.php';
include 'search_results.php';
include 'cookies.php';

$searchQuery = $_GET['query'] ?? '';
$searched_items = [];

if (!empty($searchQuery)) {
    $searched_items = getSearchResults($pdo, $searchQuery);
}
?>


<!doctype html>
<html lang="en">
  <head>

  title>Royale Bakery &mdash; Delight in Every Bite</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Royale Bakery - Experience the exquisite taste of traditional and contemporary baked goods crafted with love.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://yourwebsite.com/">
    <meta property="og:title" content="Royale Bakery &mdash; Delight in Every Bite">
    <meta property="og:description" content="Delve into the world of delectable bakery delights at Royale Bakery. From classic pastries to innovative creations, we've got something for every taste.">
    <meta property="og:image" content="https://yourwebsite.com/path/to/image.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://yourwebsite.com/">
    <meta property="twitter:title" content="Royale Bakery &mdash; Delight in Every Bite">
    <meta property="twitter:description" content="Delve into the world of delectable bakery delights at Royale Bakery. From classic pastries to innovative creations, we've got something for every taste.">
    <meta property="twitter:image" content="https://yourwebsite.com/path/to/image.jpg">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700,800|Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menufood2.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <link rel="stylesheet" type="text/css" href="css/basket.css">
    <link rel="stylesheet" type="text/css" href="css/animation.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/adminmenu.css"> -->
    <link rel="stylesheet" type="text/css" href="css/intro.css">
    <link rel="stylesheet" type="text/css" href="css/cookies.css">
    <link rel="stylesheet" type="text/css" href="css/search.css">

</head>
<body class="bg-black" >
    <body data-spy="scroll" data-target=".navbar" data-offset="50">

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="index3.php">👑</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#section-home" onclick="collapseNavbar()">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section-about" onclick="collapseNavbar()">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section-menu" onclick="collapseNavbar()">Our Menu</a>
                </li>
                <li class="nav-item">
  <a class="nav-link" href="#section-reservation" onclick="showReservationNotification()">Reserve A Table</a>
</li>

                <li class="nav-item">
  <a class="nav-link" href="#feedback-section" onclick="collapseNavbar()">Contact</a>
</li>

            </ul>
        </div>
  
</nav>
        <!-- END nav -->
    <div class="site-wrap">
  
      
        <div class="main-wrap" id="section-home">
  <div class="img_logo" style="background-image: url(images/paint.png); background-size: cover; background-repeat: no-repeat; background-position: center center;" data-stellar-background-ratio="0.5"> 
    <div class="container" style="padding-top: 600px;">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-10" data-aos="fade-up">
          <h2 class="heading mb-5" style="color: gold; text-shadow: 0 0 10px gold, 0 0 20px gold, 0 0 30px gold, 0 0 40px #000, 0 0 70px #000, 0 0 80px #000, 0 0 100px #000;"> </h2>
          <h2 class="heading mb-5" style="color: gold; text-shadow: 0 0 10px gold, 0 0 20px gold, 0 0 30px gold, 0 0 40px #000, 0 0 70px #000, 0 0 80px #000, 0 0 100px #000;"></h2>
        </div>
      </div>
    </div>
  </div>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>
                    <div class="ftco-38-body">
    <p class="introduction">Welcome to Royale Bakery - where tradition meets taste.</p>
    <p class="address" itemscope itemtype="http://schema.org/PostalAddress">
        Visit Us: <span itemprop="streetAddress">203 Otley Road</span>,
        <span itemprop="addressLocality">Bradford</span>,
        <span itemprop="addressRegion">BD3 0JF</span>
        <a href="https://www.google.com/maps?q=203+Otley+Road,+Bradford,+BD3+0JF" target="_blank" rel="noopener noreferrer">View on Google Maps</a>
    </p>
    <div class="social-links">
      Stay connected with our latest offerings and events:
      <a href="https://www.facebook.com/RoyaleBakeryPage" class="p-2 social-icon" target="_blank" rel="noopener noreferrer" aria-label="Royale Bakery on Facebook"><span class="fa fa-facebook" alt="Facebook icon"></span></a>
      <a href="https://www.instagram.com/rb_bakeryuk?igshid=OGQ5ZDc2ODk2ZA%3D%3D" class="p-2 social-icon" target="_blank" rel="noopener noreferrer" aria-label="Royale Bakery on Instagram"><span class="fa fa-instagram" alt="Instagram icon"></span></a>
      <a href="https://www.tiktok.com/@royale.bakery?_t=8hSXnm0GT5O&_r=1" class="p-2 social-icon" target="_blank" rel="noopener noreferrer" aria-label="Royale Bakery on TikTok"><span class="fa fa-tiktok" alt="TikTok icon"></span></a>
    </div>
</div>

                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </div> <!-- .section -->
    
        <div id="floatingBasket">
      
    <div id="basketIcon">
  <img src="images/basketicon.png" alt="Basket" style="height:50px; width:50px;"> 
  <span id="itemCount">0</span>
</div>

  <div id="basketDropdown" class="hidden">
    <h4>Your Basket</h4>
    <ul id="basketItemsList"></ul>
    <strong>Total: £<span id="basketTotal">0.00</span></strong>
    <!-- Checkout Area -->
    <div id="checkoutArea">
      <h3>Checkout</h3>
      <form>
        <div class="form-group">
          <label for="customerEmail">Email address</label>
          <input type="email" class="form-control" id="customerEmail" aria-describedby="emailHelp" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="customerName">Name</label>
          <input type="text" class="form-control" id="customerName" placeholder="Enter your name">
        </div>
        <button id="checkoutButton" type="button">Checkout</button>

      </form>
    </div>
  </div>
</div>


<div class="section bg-black" id="section-menu" data-aos="fade-up">
    <div class="container">
        
        <!-- Adding the search bar with icon -->
       <!-- Adding the search bar with icon -->
        <div class="row section-heading justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Menu</h2>
                <p class="sub-heading mb-5">Deliciously curated just for you. Dive into our diverse selection.</p>
            </div>
        </div>
        <div id="parent-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <form id="ajax-search-form" class="text-center mb-4">
                <input type="text" id="search-query" name="query" placeholder="Search for menu items..." value="">
                <button type="submit" id="search-button">Search</button>
                <button type="button" id="clear-search" style="display: none;">Clear</button>
              </form>
              <div id="loading">
        <div class="dual-ring"></div>
    </div>
</div>
              </div>
              <div id="search-results"></div>
            </div>

             <?php
include 'config.php';

$query = "SELECT * FROM menu_items WHERE in_stock = 1 ORDER BY category";
$result = $pdo->query($query);
$menu_items = $result->fetchAll(PDO::FETCH_ASSOC);

$grouped_items = [];
foreach ($menu_items as $item) {
    $grouped_items[$item['category']][] = $item;
}

$sections = [
  'ALL' => 'pills-all',
  'Starters' => 'pills-starters',
  'Meal' => 'pills-meal',
  'Desserts' => 'pills-desserts',
  'Drinks' => 'pills-drinks'
];
?>

<ul class="nav site-tab-nav" id="pills-tab" role="tablist">
    <?php foreach ($sections as $sectionName => $sectionId): ?>
    <li class="nav-item">
        <a class="nav-link <?= $sectionName === 'ALL' ? 'active' : ''; ?>" id="<?= $sectionId ?>-tab" data-toggle="pill" href="#<?= $sectionId ?>" role="tab" aria-controls="<?= $sectionId ?>" aria-selected="<?= $sectionName === 'ALL' ? 'true' : 'false'; ?>"><?= $sectionName ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<div class="tab-content" id="pills-tabContent">
    <?php foreach ($sections as $sectionName => $sectionId): ?>
    <div class="tab-pane fade <?= $sectionName === 'ALL' ? 'show active' : ''; ?>" id="<?= $sectionId ?>" role="tabpanel" aria-labelledby="<?= $sectionId ?>-tab">
        <?php
        $items_to_display = $sectionName === 'ALL' ? $menu_items : $grouped_items[$sectionName];
        if (isset($items_to_display) && !empty($items_to_display)):
          echo '<div class="menu-container">';
            foreach ($items_to_display as $item):
            ?>
          <div class="menu-food-item">
  <!-- Food Image -->
  <img src="data:image/jpeg;base64,<?= base64_encode($item['image_data']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="menu-item-img">
  
  <!-- Food Details -->
  <div class="menu-item-details">
    <h3 class="menu-item-title"><?= htmlspecialchars($item['name']) ?></h3>
    <p class="menu-item-description"><?= htmlspecialchars($item['description']) ?></p>
  </div>
  
  <!-- Price and Add to Basket -->
  <div class="menu-item-action">
       <strong class="mr-3">£<?= htmlspecialchars($item['price']) ?></strong>
                   <i class="fas fa-shopping-basket btn btn-primary addToBasket" data-id="<?= $item['id'] ?>" data-name="<?= htmlspecialchars($item['name']) ?>" data-price="<?= htmlspecialchars($item['price']) ?>"></i>
  </div>
</div>

            <?php
            endforeach;
            echo '</div>';
        else:
        ?>
        <p>No items available in this section.</p>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>




<div class="section bg-black services-section" data-aos="fade-up">
    <div class="container">
        <div class="row section-heading justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Desi Bakery Delights</h2>
                <p class="sub-heading mb-5">Experience the taste of traditional baked goods</p>  
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <div class="media feature-icon d-block text-center">
                    <div class="icon">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div class="media-body">
                        <h3>Traditional Cakes</h3>
                        <p>Delicious cakes baked with love, using age-old recipes passed down through generations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
    <div class="media feature-icon d-block text-center">
        <div class="icon">
         <i class="fas fa-cookie-bite"></i>

        </div>
        <div class="media-body">
            <h3>Desi Pastries</h3>
            <p>Experience the crispy and savory pastries, a perfect companion for your tea.</p>
        </div>
    </div>
</div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="media feature-icon d-block text-center">
                    <div class="icon">
                        <i class="fas fa-bread-slice"></i>
                    </div>
                    <div class="media-body">
                        <h3>Fresh Breads</h3>
                        <p>Soft, fluffy, and fresh breads baked daily, perfect for your breakfast or sandwiches.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="media feature-icon d-block text-center">
                    <div class="icon">
                        <i class="fas fa-cookie"></i>
                    </div>
                    <div class="media-body">
                        <h3>Handmade Cookies</h3>
                        <p>Crunchy, delightful cookies that melt in your mouth. Perfect with a cup of chai.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <div class="media feature-icon d-block text-center">
                    <div class="icon">
                        <i class="fas fa-candy-cane"></i>
                    </div>
                    <div class="media-body">
                        <h3>Desi Sweets</h3>
                        <p>Sweeten your moments with our range of traditional desi sweets.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                <div class="media feature-icon d-block text-center">
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="media-body">
                        <h3>Place Your Order</h3>
                        <p>Order your favorite bakery items and get them delivered to your doorstep.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .section -->

<footer class="ftco-footer" id = "feedback-section">
  <div class="container">
    <div class="row">
      <!-- About Us Section -->
      <div class="col-md-4 mb-5">
        <div class="footer-widget">
          <h3 class="mb-4">About Royale Bakery</h3>
          <p>At Royale Bakery, we blend tradition with the taste of homemade goodness. Our artisanal bakery delights are crafted with the finest ingredients and a pinch of love. Come visit us and indulge in the sweet symphony of our baked creations.</p>
        </div>
      </div>

      <!-- Feedback Form Section -->
        <div class="col-md-8">
          <div class="footer-widget">
            <h3 class="mb-4">We'd Love Your Feedback</h3>
            <p>Share your thoughts with us. Your feedback helps us serve you better!</p>
            <form id="feedback-form" method="POST">
              <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send Feedback">
              </div>
            </form>
            <p>Currently, we are experiencing some issues with sending feedback. Please <a href="mailto:royalbakery.co.uk">click here</a> to send us an email with your feedback.</p>
          </div>
        </div>
      </div>

    <!-- Social and CopyRight Section -->
    <div class="row pt-5">
      <div class="col-md-12 text-center">
        <ul class="list-unstyled social">
          <li><a href="#"><span class="fa fa-tripadvisor"></span></a></li>
          <li><a href="#"><span class="fa fa-twitter"></span></a></li>
          <li><a href="#"><span class="fa fa-facebook"></span></a></li>
          <li><a href="#"><span class="fa fa-instagram"></span></a></li>
        </ul>
        <p>All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>

   
<!-- Consent Banner (placed at the end of your body tag) -->
<div id="cookieConsentOverlay">
<div id="cookieConsentBanner">
    <p>This website uses cookies to enhance your experience. By continuing to use our website, you agree to our use of cookies.</p>
    <button id="acceptCookies">Accept</button>
    <button id="declineCookies">Decline</button>
</div>
        </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>

    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    <script src="js/jquery.easing.1.3.js"></script>    

    <script src="js/aos.js" defer></script>
    <script src="js/notification.js" defer></script>
    <script src="js/main.js" defer></script>
    <script src="js/basket.js" defer></script>
    <script src="js/scrollPosition.js" defer></script>
    <script src="js/test.js" defer></script>
    <script src="js/search_results.js" defer></script>
    <script src="js/cookieConsent.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.7.0/dist/umd/popper.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
  </body>
</html>