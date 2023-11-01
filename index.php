<?php
include 'config.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <title>Royale Bakery &mdash;  </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700,800|Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

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
    <link rel="stylesheet" href="css/darkmode.css">
    <link rel="stylesheet" type="text/css" href="css/basket.css">
    <link rel="stylesheet" type="text/css" href="css/animation.css">

</head>
<body class="bg-light">

<div class="preloader">
    <div class="animation royale-bakery">
        <span>R</span><span>o</span><span>y</span><span>a</span><span>l</span><span>e</span> <span>B</span><span>a</span><span>k</span><span>e</span><span>r</span><span>y</span><span>🍰</span>
    </div>
    <!-- You can still add more animations if needed -->
</div>

    <body data-spy="scroll" data-target=".navbar" data-offset="50">

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="index.php">🍰</a>
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
                    <a class="nav-link" href="#section-reservation" onclick="collapseNavbar()">Reserve A Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section-contact" onclick="collapseNavbar()">Contact</a>
                </li>
            </ul>
        </div>
         <!-- Add the dark mode toggle icon
    <div class="dark-mode-toggle" onclick="toggleDarkMode()">
        <i class="fas fa-moon"></i>
    </div> -->
</nav>


    <script>
//         function toggleDarkMode() {
//           var body = document.body;

// if (body.classList.contains('dark-mode')) {
//     console.log("Removing dark-mode class...");
//     body.classList.remove('dark-mode');
// } else {
//     console.log("Adding dark-mode class...");
//     body.classList.add('dark-mode');
// }
// }

function collapseNavbar() {
    var navbar = document.querySelector('.navbar-collapse');
    navbar.classList.remove('show');
}
    </script>
    <div class="site-wrap">
        
        <!--
        <header class="site-header">
            <div class="row align-items-center">
                <div class="col-5 col-md-3">
                     
                </div>
                <div class="col-2 col-md-6 text-center site-logo-wrap">
                    <a href="index.php" class="site-logo">🍰</a>
                </div>
                <div class="col-5 col-md-3 text-right menu-burger-wrap">
                    <a href="#" class="site-nav-toggle js-site-nav-toggle"><i></i></a>

                </div>
            </div>
         
        </header> < site-header -->
      
      <div class="main-wrap " id="section-home">
        <div class="cover_1 overlay bg-slant-white bg-light">
          <div class="img_logo" style="background-image: url(images/logo.jpg);" data-stellar-background-ratio="0.5"> 
            <div class="container" style="padding-top: 100px;">
              <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10" data-aos="fade-up">
                  <h2 class="heading mb-5">Royale Bakery </h2>
                  <h2 class="heading mb-5">The Taste of royalty,at your fingertips</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
                  <!-- .<p><a href="#section-reservation" class="smoothscroll btn btn-outline-white px-5 py-3">Reserve A Table</a></p>
                  <p><a href="#section-menu" class="smoothscroll btn btn-outline-white px-5 py-3">Menu</a></p>-->
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- I have removef this section temporarily to see what it looks like wthiout - umama)

        <div class="section"  data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Find your best food</h2>
                <p class="sub-heading mb-5">Subheading here</p>  
              </div>
            </div>
            <div class="row">

              <div class="ftco-46">
                <div class="ftco-46-row d-flex flex-column flex-lg-row">
                  <div class="ftco-46-image" style="background-image: url(images/img_1.jpg);"></div>
                  <div class="ftco-46-text ftco-46-arrow-left">
                    <h4 class="ftco-46-subheading">Vegies</h4>
                    <h3 class="ftco-46-heading">Beef Empanadas</h3>
                    <p class="mb-5">Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                  <div class="ftco-46-image" style="background-image: url(images/img_2.jpg);"></div> 
                </div>

                <div class="ftco-46-row d-flex flex-column flex-lg-row">
                  <div class="ftco-46-text ftco-46-arrow-right">
                    <h4 class="ftco-46-subheading">Food</h4>
                    <h3 class="ftco-46-heading">Buttermilk Chicken Jibaritos</h3>
                    <p class="mb-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                  <div class="ftco-46-image" style="background-image: url(images/img_3.jpg);"></div>
                  <div class="ftco-46-text ftco-46-arrow-up">
                    <h4 class="ftco-46-subheading">Food</h4>
                    <h3 class="ftco-46-heading">Chicken Chimichurri Croquettes</h3>
                    <p class="mb-5">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>  section -->

        <div class="section pb-3 bg-white" id="section-about" data-aos="fade-up">
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-12 col-lg-8 section-heading">
                <h2 class="heading mb-5">The Restaurant</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
              </div>
            </div>
          </div>
        </div> <!-- .section -->
        

        <div class="section bg-white pt-2 pb-2 text-center" data-aos="fade">
          <p><img src="images/bg_hero.png" alt="" class="img-fluid"></p>
        </div> <!-- 
          UMAMA HAS REMOVED MEET THE CHEFS SECTION

        <div class="section bg-white" data-aos="fade-up">
          <div class="container">
            <div class="row mb-5">
              <div class="col-md-12 section-heading text-center">
                <h2 class="heading mb-5">Meet The Chefs</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-md-5 text-center mb-5">
                <div class="ftco-38">
                  <div class="ftco-38-img">
                    <div class="ftco-38-header">
                      <img src="images/chef_1.jpg" alt="">
                      <h3 class="ftco-38-heading">Daniel Graham</h3>
                      <p class="ftco-38-subheading">Master Chef</p>
                    </div>
                    <div class="ftco-38-body">
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                      <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. It is a paradisematic country.</p>
                      <p>
                        <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                      </p>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 pl-md-5 text-center mb-5">
                <div class="ftco-38">
                  <div class="ftco-38-img">
                    <div class="ftco-38-header">
                      <img src="images/chef_2.jpg" alt="">
                      <h3 class="ftco-38-heading">Nick Browning</h3>
                      <p class="ftco-38-subheading">Master Chef</p>
                    </div>
                    .section -->
                    <div class="ftco-38-body">
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                      <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. It is a paradisematic country.</p>
                      <p>
                        <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-4"></div> -->
            </div>
          </div>
        </div> <!-- .section -->
    
        <div id="floatingBasket">
        <!-- <div id="bakeryLogo"></div>  Add this line for the bakery logo -->
    <!-- ... -->
    <!-- <div id="chatBubbleIcon">💬</div> -->
  <div id="basketIcon">🛒 <span id="itemCount">0</span></div>
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




        <div class="section bg-light" id="section-menu" data-aos="fade-up">
    <div class="container">
        <div class="row section-heading justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Menu</h2>
                <p class="sub-heading mb-5">Subheading here</p>
            </div>
        </div>
        <div class="row justify-content-center">
    <div class="col-md-8">
        <ul class="nav site-tab-nav" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-starters-tab" data-toggle="pill" href="#pills-starters" role="tab" aria-controls="pills-starters" aria-selected="true">Starters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-meal-tab" data-toggle="pill" href="#pills-meal" role="tab" aria-controls="pills-meal" aria-selected="false">Meal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-desserts-tab" data-toggle="pill" href="#pills-desserts" role="tab" aria-controls="pills-desserts" aria-selected="false">Desserts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-drinks-tab" data-toggle="pill" href="#pills-drinks" role="tab" aria-controls="pills-drinks" aria-selected="false">Drinks</a>
            </li>
        </ul>

                <div class="tab-content" id="pills-tabContent">
                    <?php 
                   include 'config.php';

                   $query = "SELECT * FROM menu_items WHERE in_stock = 1 ORDER BY category";

                   $result = $pdo->query($query);
                   $menu_items = $result->fetchAll(PDO::FETCH_ASSOC);                   
                    ?>

                    <?php
                    //echo "Categories in database: " . implode(", ", array_keys($menu_items));
                    $grouped_items = [];
                    foreach ($menu_items as $item) {
                        $grouped_items[$item['category']][] = $item;
                    }
                    $sections = [
                      'Starters' => 'pills-starters',
                      'Meal' => 'pills-meal',
                      'Desserts' => 'pills-desserts',
                      'Drinks' => 'pills-drinks'
                  ];
                
                    
                foreach ($sections as $sectionName => $sectionId):
                  ?>
                      <div class="tab-pane fade <?= $sectionName === 'Starters' ? 'show active' : ''; ?>" id="<?= $sectionId ?>" role="tabpanel" aria-labelledby="<?= $sectionId ?>-tab">
                          <?php if (isset($grouped_items[$sectionName])): ?>
                            <?php foreach ($grouped_items[$sectionName] as $item): ?>
    <div class="d-flex justify-content-between align-items-center menu-food-item">
        <div class="text">
            <img src="data:image/jpeg;base64,<?= base64_encode($item['image_data']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="max-width: 100px;"> <!-- adjust the max-width as per your needs -->
            <h3><a href="#"><?= htmlspecialchars($item['name']) ?></a></h3>
            <p><?= htmlspecialchars($item['description']) ?></p>
        </div>
        <div class="d-flex align-items-center">
            <strong class="mr-3">£<?= htmlspecialchars($item['price']) ?></strong>
            <button class="btn btn-primary addToBasket" data-id="<?= $item['id'] ?>" data-name="<?= htmlspecialchars($item['name']) ?>" data-price="<?= htmlspecialchars($item['price']) ?>">Add to Basket</button>
        </div>
    </div> <!-- .menu-food-item -->
<?php endforeach; ?>

                            <?php else: ?>
                                <p>No items available in this section.</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .section -->


<div class="section bg-white services-section" data-aos="fade-up">
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



        <div class="section bg-light" data-aos="fade-up" id="section-reservation">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Reservation</h2>
                <p class="sub-heading mb-5">Sub heading here for making it attractive</p>  
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-10 p-5 form-wrap">
                <form action="#">
                  <div class="row mb-4">
                    <div class="form-group col-md-4">
                      <label for="name" class="label">Name</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-person"></span>
                        <input type="text" class="form-control" id="name">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email" class="label">Email</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-email"></span>
                        <input type="email" class="form-control" id="email">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="phone" class="label">Phone</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-call"></span>
                        <input type="text" class="form-control" id="phone">
                      </div>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="persons" class="label">Number of Persons</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-arrow-dropdown"></span>
                        <select name="persons" id="persons" class="form-control">
                          <option value="">1 person</option>
                          <option value="">2 persons</option>
                          <option value="">3 persons</option>
                          <option value="">4 persons</option>
                          <option value="">5+ persons</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="date" class="label">Date</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-calendar"></span>
                        <input type="text" class="form-control" id="date">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="time" class="label">Time</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-time"></span>
                        <input type="text" class="form-control" id="time">
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                      <input type="submit" class="btn btn-primary btn-outline-primary btn-block" value="Reserve Now">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> <!-- .section -->

         <div class="section bg-white"  data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Customer Reviews</h2>
              </div>
            </div>
            <div class="row justify-content-center text-center" data-aos="fade-up">
              <div class="col-md-8">
                <div class="owl-carousel home-slider-loop-false">

                
                  <div class="item">
                    <blockquote class="testimonial">
                      <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                      <div class="author">
                        <img src="images/person_1.jpg" alt="Image placeholder" class="mb-3">
                        <h4>Maxim Smith</h4>
                        <p>CEO, Founder</p>
                      </div>
                    </blockquote>
                  </div>
                  <div class="item">
                    <blockquote class="testimonial">
                      <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                      <div class="author">
                        <img src="images/person_2.jpg" alt="Image placeholder" class="mb-3">
                        <h4>Geert Green</h4>
                        <p>CEO, Founder</p>
                      </div>
                    </blockquote>
                  </div>
                  <div class="item">
                    <blockquote class="testimonial">
                      <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                      <div class="author">
                        <img src="images/person_3.jpg" alt="Image placeholder" class="mb-3">
                        <h4>Dennis Roman</h4>
                        <p>CEO, Founder</p>
                      </div>
                    </blockquote>
                  </div>
                  <div class="item">
                    <blockquote class="testimonial">
                      <p>&ldquo;The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.&rdquo;</p>
                      <div class="author">
                        <img src="images/person_2.jpg" alt="Image placeholder" class="mb-3">
                        <h4>Geert Green</h4>
                        <p>CEO, Founder</p>
                      </div>
                    </blockquote>
                  </div>
                </div>
              </div>
            </div>
          </div>  
        </div> <!-- .section -->

        <div class="section" data-aos="fade-up" id="section-contact">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Get In Touch</h2>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-10 p-5 form-wrap">
                <form action="#">
                  <div class="row mb-4">
                    <div class="form-group col-md-4">
                      <label for="name" class="label">Name</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-person"></span>
                        <input type="text" class="form-control" id="name">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email" class="label">Email</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-email"></span>
                        <input type="email" class="form-control" id="email">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="phone" class="label">Phone</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-call"></span>
                        <input type="text" class="form-control" id="phone">
                      </div>
                    </div>

                   <div class="form-group col-md-12">
                      <label for="message" class="label">Message</label>
                     <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                   </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                      <input type="submit" class="btn btn-primary btn-outline-primary btn-block" value="Send Message">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> <!-- .section -->

        <div class="map-wrap" id="map"  data-aos="fade"></div>


        <footer class="ftco-footer">
          <div class="container">
            
            <div class="row">
            <div class="col-md-4 mb-5">
              <div class="footer-widget">
                <h3 class="mb-4">About Meal</h3>
                <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. </p>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="footer-widget">
                <h3 class="mb-4">Lunch Service</h3>
                <p>Booking from 12:00pm &mdash; 1:30pm</p>
                <h3 class="mb-4">Dinner Service</h3>
                <p>Everyday: <br> Booking from 6:00pm &mdash; 9:00pm</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="footer-widget">
                <h3 class="mb-4">Follow Along</h3>
                <ul class="list-unstyled social">
                  <li><a href="#"><span class="fa fa-tripadvisor"></span></a></li>
                  <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                  <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                  <li><a href="#"><span class="fa fa-instagram"></span></a></li>
                </ul>
              </div>
              <div class="footer-widget">
                <h3 class="mb-4">Newsletter</h3>
                <form action="#" class="ftco-footer-newsletter">
                  <div class="form-group">
                    <button class="button"><span class="fa fa-envelope"></span></button>
                    <input type="email" class="form-control" placeholder="Enter Email">
                  </div>
                </form>
              </div>
            </div>

            </div>

            <div class="row pt-5">
              <div class="col-md-12 text-center">
                     <div class="text-center bg-dark py-4">
              <p class="text-center text-md-end text-xl-start"> 
                All Rights Reserved
              </p>
	 </div>
              </div>
            </div>
          </div>
        </footer>
      
    </div>
   

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff7a5c"/></svg></div>

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

    <script src="js/aos.js"></script>
    

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>

    <script src="js/main.js"></script>
    <script src = "js/basket.js"></script>

  </body>
</html>