<?php 

    include('config/session.php');
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
    <!-- Swiper's CSS -->
    <link rel="stylesheet" href="vendor/swiper/swiper.css"/>
    <!-- HEADER & FOOTER CSS -->
    <link rel="stylesheet" href="styles/header-and-footer.css?v=<?php echo time(); ?>"/>
    <!-- PAGE CSS -->
    <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Doppell - Get stuff fast</title>
</head>
<body>

    <?php include("includes/header.php") ?>

    <!-- HERO -->
    <main>
        <div id="callout" class="container">
            <p class="callout-box">
                <span class="callout-icon"></span>
                <span class="callout-message first"></span>
            </p>
        </div>

        <?php

            if(isset($_SESSION['error'])) {
                echo '
                    <div id="callout" class="container callout-danger" style="display: block;">
                        <p class="callout-box">
                            <span class="callout-message">' . $_SESSION['error'] . '</span>
                        </p>
                    </div>
                ';
                unset($_SESSION['error']);
            }

        ?>       

        <section id="hero-background">
            <div id="hero-container">
              <div id="hero-text">
                <p>Space just got personal</p>
                <h1>The new Galaxy S20 Ultra</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                <h2>₦420,000.00</h2>
                <div id="hero-buttons">
                  <a href="product-details.php?prname=samsung_galaxy_s20_ultra"><button type="button"><i class="fas fa-shopping-cart"></i>Buy now</button></a>
                  <!-- php here -->
                  <a href="product-details.php?prname=samsung_galaxy_s20_ultra#product-tabs"><button type="button">More info<i class="fas fa-arrow-right"></i></button></a>
                </div>
              </div>

              <div class="hero-product-img"><img src="images/samsung_bgImg.png" alt=""></div>
            </div>
        </section>
    
        <div class="main-container">

            <!-- FIRST SECTION -->
            <section id="first-section">
                <div>
                    <img src="images/priority shipping.png" alt="priority shipping">
                    <h2>Priority Shipping</h2>
                    <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit.</p>
                </div>
                <div>
                    <img src="images/fuss free returns.png" alt="fuss free returns">
                    <h2>Fuss Free returns</h2>
                    <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit.</p>
                </div>
                <div>
                    <img src="images/in-home setup.png" alt="in-home setup">
                    <h2>In-home Setup</h2>
                    <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit.</p>
                </div>
            </section>
    
            <div class="large-gap"></div>
    
            <!-- SHOP NOW -->
            <section id="shop-now">
                <div class="box box-1">
                    <div class="content">
                        <div class="smaller-gap"></div>
                        <h2>laptops</h2>
                        <a href="categories.php?caname=laptops">shop now</a>
                    </div>
                </div>
                <div class="box box-2">
                    <div class="content">
                        <div class="smaller-gap half-off"></div>
                        <h2>50% off now</h2>
                        <p>Lorem ipsum dolor sit dolore magna erat volutpat.</p>
                    </div>
                </div>
                <div class="box box-3">
                    <div class="content">
                        <div class="smaller-gap"></div>
                        <h2>phones</h2>
                        <a href="categories.php?caname=phones">shop now</a>
                    </div>
                </div>
            </section>
    
            <div class="small-gap"></div>
    
            <!-- FEATURED PRODUCTS TITLE -->
            <div class="title">
                <div class="featured-products-title">
                    <div class="divider"></div>
                    <h2>featured products</h2>
                    <div class="divider"></div>
                </div>

                <div class="small-gap"></div>
            </div>

            <!-- FEATURED PRODUCTS -->
            <section id="featured-products">

                <?php for( $i = 0; $i < 8; $i++): ?>
                    <div class="product">
                        <div class="product-inner">
                            <div class="image-box">
                                <a href="product-details.php?prname=<?php echo $products[$i]['prd_slug']; ?>">
                                    <img src="images/<?php echo $products[$i]['prd_image']; ?>" alt="">
                                </a>
                                <div class="wishlist-icon">
                                    <button type="submit"><i class="fas fa-heart"></i></button>
                                    <input type="hidden" id="p_id" name="p_id" value="<?php echo $products[$i]['prd_id']; ?>">
                                    <input type="hidden" id="p_name" name="p_name" value="<?php echo $products[$i]['prd_name']; ?>">
                                </div>
                                <div class="quick-view">
                                    <form>
                                        <input type="hidden" class="prod_data" id="prd_name" value="<?php echo $products[$i]['prd_name']; ?>">
                                        <button type="button" class="open">
                                            quick view
                                        </button>
                                    </form>
                                </div>
                                <div class="loading-overlay d-none">
                                  <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>
                            <div class="text-box">
                                <div class="title-wrapper">
                                    <p class="product-category"><?php echo $products[$i]['prd_category']; ?></p>
                                    <a href="product-details.php?prname=<?php echo $products[$i]['prd_slug']; ?>" class="product-name"><p><?php echo $products[$i]['prd_name']?></p></a>
                                </div>
                                <div class="price-wrapper">
                                    <span class="product-price"><?php echo '₦' . number_format($products[$i]['prd_price'], 2) ?? 'Not available'; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>

                <!-- QUICK VIEW MODAL -->
                <div id="modal-container-box" class="initial">
                    <div class="modal-background"></div>

                    <div class="modal-container" id="modal-container">
                        <div class="inner-container">
                            <div class="modal-box" id="modal-box">
                                
                            </div>
                        </div>
                    </div>

                    <button type="button" id="close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </section>
    
            <div class="large-gap"></div>
        </div>
    
        <!-- NEWSLETTER -->
        <section id="newsletter">
            <div id="newsletter-overlay">
                <div class="content-container">
                    <div class="content">
                        <div class="smaller-gap"></div>
                        <h2>Sign up now</h2>
                        <h4>Lorem ipsum dolor sit ametadipiscing elit, sed diam nonummy nibh tincidunt ut laoreet dolore magna aliquam erat volutpat.</h4>

                        <!-- php here -->
                        <form action="">
                            <label for="your-email">
                                Your email
                            </label>
                            <input type="text" name="your-email" id="your-email">
                            <button type="submit">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    
        <div class="main-container">                   
            <!-- BLOG POSTS TITLE -->
            <div class="title">
                <div class="medium-gap"></div>

                <div class="blog-posts-title">
                    <div class="divider"></div>
                    <h2>posts</h2>
                    <div class="divider"></div>
                </div>

                <div class="medium-gap"></div>
            </div>
    
            <!-- BLOG POSTS -->
            <section id="blog-posts-container" class="noselect swiper mySwiper">
                <div id="blog-posts" class="swiper-wrapper">

                    <?php foreach($posts as $post): ?>

                        <div class="swiper-slide">
                            <a href="post-details.php?potitle=<?php echo $post['post_slug']; ?>">
                                <div class="post">
                                    <div class="image-cover">
                                        <img src="images/<?php echo $post['post_image']; ?>" alt="">
                                    </div>

                                    <div class="post-content">
                                        <h2><?php echo $post['post_title']; ?></h2>
                                        <div class="hor-divider-center"></div>
                                        <p>
                                            <?php $first_15_words = implode(' ',array_slice(explode(' ', $post['post_content']), 0, 15));
                                                echo "$first_15_words [...]"; ?>
                                        </p>
                                    </div>

                                    <div class="post-date">
                                        <div>
                                            <!-- PHP HERE -->
                                            <span class="post-day"><?php echo $post['post_day']  ?></span><br>
                                            <span class="post-month"><?php echo $post['post_month']  ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php endforeach; ?>

                </div>
                <!-- POST NAVIGATION BUTTONS -->
                <button type="button" class="post-hidden swiper-button-prev">
                    <i class="fas fa-angle-left"></i>
                </button>
                <button type="button" class="post-hidden swiper-button-next">
                    <i class="fas fa-angle-right"></i>
                </button>
                <div class="buttons-for-mobile">
                    <button type="button" class=" swiper-button-prev">
                        <i class="fas fa-angle-left"></i>
                    </button>
                    <button type="button" class=" swiper-button-next">
                        <i class="fas fa-angle-right"></i>
                </div>
            </section>
        </div>
            
    </main>

    <?php include("includes/footer.php") ?>

    <!-- Blog Posts JS -->
    <script>
        const blogPostsContainer = $("#blog-posts-container");
        const postMovementButtons = $("#blog-posts-container > button");

        blogPostsContainer.hover(function() {
            postMovementButtons.removeClass("post-hidden");
            postMovementButtons.removeClass("not-active");
            postMovementButtons.addClass("active");
        }, function() {
            postMovementButtons.removeClass("active");
            postMovementButtons.addClass("not-active");
        });
    </script>

    <!-- Swiper JS -->
    <script src="vendor/swiper/swiper.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            speed: 600,
            loop: true,
            slidesPerView: '"auto',
            autoplay: {
                delay: 5000,
                disableOnInteraction: true
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                250: {
                    slidesPerView: 1,
                },

                850: {
                    slidesPerView: 3,
                }
            }
        });
    </script>
</body>
</html>