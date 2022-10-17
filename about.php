<?php

  include("config/session.php");
  include('config/fetch.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" href="images/favicon-32x32.png" sizes="32x32">
  <link rel="icon" href="images/favicon-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon" href="images/favicon-180x180.png">
  <!-- HEADER & FOOTER CSS -->
  <link rel="stylesheet" href="styles/header-and-footer.css?v=<?php echo time(); ?>">
  <!-- PAGE CSS -->
  <link rel="stylesheet" href="styles/about.css?v=<?php echo time(); ?>"/>
  <!-- FONT AWESOME ICONS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>About Us - Doppell</title>
    
</head>
<body>

  <?php include('includes/header.php'); ?>
  
  <main>
    <section class="who-we-are">
      <div class="inner-container overlay">
        <div class="container-box container">
          <div class="inner-col">
            <h3>who we are</h3>
            <p>Lorem ipsum dolor sit amet adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. dolor sit amet consectetuer adipiscing elit</p>
            <div class="social-icons">
              <a href=""><i class="fab fa-facebook-f"></i></a>
              <a href=""><i class="fab fa-instagram"></i></a>
              <a href=""><i class="fab fa-twitter"></i></a>
              <a href=""><i class="fas fa-envelope"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="about-us">
      <div class="small-gap"></div>
      <div class="container">
        <div class="image-box">
          <div class="box-container">
            <img src="images/pexels-pixabay-41008.jpg" alt="">
          </div>
        </div>
        <div class="image-box">
          <div class="box-container">
            <img src="images/pexels-alana-sousa-3284344.jpg" alt="">
          </div>
        </div>
        <div>
          <div class="col-inner">
            <h2>about us</h2>
            <p>Lorem ipsum dolor sit amet diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpateic tem iditi omnim volestium con nis sitae alit est, offictaecus saperum cum none con poriaspero exerum nonummy nibh euismod tincidunt te nulliqui volorio.</p>
            <div>
              <button type="button">read more<i class="fas fa-arrow-right"></i></button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="team">
      <div class="inner-container container">
        <div class="small-gap"></div>
        <div class="join-us">
          <div class="inner-col">
            <h6>join us now</h6>
            <h3>Meet the team</h3>
          </div>
        </div>

        <div class="team-profile">
          <div class="team-member">
            <div class="image-box">
              <img src="images/pexels-andrea-piacquadio-3760339.jpg" alt="">
            </div>
            <div class="text-box">
              <span class="member-name">OLA NORMAN</span>
              <span class="member-position">CEO AND FOUNDER</span>
              <div class="social-icons">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fas fa-phone"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="team-member">
            <div class="image-box">
              <img src="images/pexels-italo-melo-2379004.jpg" alt="">
            </div>
            <div class="text-box">
              <span class="member-name">TOM HAMPTON</span>
              <span class="member-position">CO FOUNDER</span>
              <div class="social-icons">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fas fa-phone"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="team-member">
            <div class="image-box">
              <img src="images/pexels-emmy-e-2381069.jpg" alt="">
            </div>
            <div class="text-box">
              <span class="member-name">JULY WOOD</span>
              <span class="member-position">HEAD MARKETING</span>
              <div class="social-icons">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fas fa-phone"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="team-member">
            <div class="image-box">
              <img src="images/pexels-justin-shaifer-1222271.jpg" alt="">
            </div>
            <div class="text-box">
              <span class="member-name">JOSH MITCHELL</span>
              <span class="member-position">GRAPHIC DESIGN</span>
              <div class="social-icons">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fas fa-phone"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="testimonial">
      <div class="inner-container container">
        <div class="testimonial-text">
          <div class="col-inner">
            <h2>You're in good company</h2>
            <p>Donec augue justo venenatis quis sapien consequat hendrerit.</p>
          </div>
        </div>

        <div class="developers">
          <div class="developer">
            <div class="col-inner">
              <blockquote>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In est sem, ultrices ornare molestie sit amet, placerat vel arcu. Phasellus quis massa id sem pretium dictum. Donec sed sollicitudin est, sit amet eleifend ipsum. Vivamus nec pretium turpis.
                </p>
              </blockquote>
              <div class="developer-profile">
                <div class="image-box">
                  <img src="images/testimonial-avatar-male-1-ux-builder.jpg" alt="">
                </div>
                <div class="developer-details">
                  <h3>Andy Guscott</h3>
                  <p>Developer, Doppell</p>
                </div>
              </div>
            </div>
          </div>

          <div class="developer">
            <div class="col-inner">
              <blockquote>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In est sem, ultrices ornare molestie sit amet, placerat vel arcu. Phasellus quis massa id sem pretium dictum. Donec sed sollicitudin est, sit amet eleifend ipsum. Vivamus nec pretium turpis.
                </p>
              </blockquote>
              <div class="developer-profile">
                <div class="image-box">
                  <img src="images/testimonial-avatar-female-2-ux-builder-element.jpg" alt="">
                </div>
                <div class="developer-details">
                  <h3>Kirstin W. Everton</h3>
                  <p>Graphic Designer, Doppell</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="sponsors">
          <div class="sponsor">
            <img src="images/landingpage-clean-studio-logo-1-flatsome-theme-uxbuilder.png" alt="">
          </div>
          <div class="sponsor">
            <img src="images/landingpage-clean-studio-logo-2-flatsome-theme-uxbuilder.png" alt="">
          </div>
          <div class="sponsor">
            <img src="images/landingpage-clean-studio-logo-3-flatsome-theme-uxbuilder.png" alt="">
          </div>
          <div class="sponsor">
            <img src="images/landingpage-clean-studio-logo-4-flatsome-theme-uxbuilder.png" alt="">
          </div>
          <div class="sponsor">
            <img src="images/landingpage-clean-studio-logo-5-flatsome-theme-uxbuilder.png" alt="">
          </div>
          <div class="sponsor">
            <img src="images/landingpage-clean-studio-logo-6-flatsome-theme-uxbuilder.png" alt="">
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>