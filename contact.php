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
    <link rel="stylesheet" href="styles/header-and-footer.css?v=<?php echo time(); ?>"/>
    <!-- PAGE CSS -->
    <link rel="stylesheet" href="styles/contact.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Title - Doppell</title>
    
</head>
<body>

    <?php include('includes/header.php'); ?>
    
    <main>

        <?php

            if(isset($_POST['submit'])) {
                echo '
                    <div id="callout" class="container callout-success" style="display: block;">
                        <p class="callout-box">
                            <span class="callout-icon"><i class="fas fa-check"></i></span>
                            <span class="callout-message">Message sent. We will get back to you shortly.</span>
                        </p>
                    </div>
                ';
            }

        ?>

        <section id="contact-hero">
            <div class="contact-image">
                <div class="image-overlay"></div>
            </div>
        </section>

        <section id="contact-main">
            <div class="container">
                <div class="col-inner">
                    <div class="contact-info">
                        <div class="info-card">
                            <div class="col-inner">
                                <div class="image-box">
                                    <img src="images/contact-page-for-flatsome-wordpress-theme-pointed-icon-phone.png" alt="">
                                </div>
                                <div class="text-box">
                                    <h4>Talk to sales</h4>
                                    <p>Interested in our hosting? Just pick up the phone and call us.</p>
                                </div>
                                <div class="small-gap"></div>
                                <button>+2348109185403</button>
                                <div class="smaller-gap"></div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="col-inner">
                                <div class="image-box">
                                    <img src="images/contact-page-for-flatsome-wordpress-theme-pointed-icon-chat.png" alt="">
                                </div>
                                <div class="text-box">
                                    <h4>Contact support</h4>
                                    <p>Sometimes you need a little help. Don't worry, We're here for you.</p>
                                </div>
                                <div class="small-gap"></div>
                                <button>contact support</button>
                                <div class="smaller-gap"></div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form">
                        <div class="col-inner">
                            <h3>Ask a question</h3>
                            <div class="hor-divider"></div>
                            <div class="contact-form-details">
                                <div class="inner-col">
                                    <form action="" class="form" method="POST" id="contact-form">
                                        <div>
                                            <label for="name">Your name</label>
                                            <input type="text" name="name" id="name" required>
                                        </div>
                                        <div>
                                            <label for="email">Your email</label>
                                            <input type="text" name="email" id="email" required>
                                        </div>
                                        <div>
                                            <label for="subject">Subject</label>
                                            <input type="text" name="subject" id="subject" required>
                                        </div>
                                        <div>
                                            <label for="question">Your message</label>
                                            <textarea name="question" id="question" required></textarea>
                                        </div>
                                        <div>
                                            <button type="submit" name="submit">send message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h4>Company details</h4>
                        <p>We are amazing!</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="get-in-touch">
            <div class="container">
                <h2>Get in touch</h2>
                <p>Want to get in touch? We'd love to hear from you. Here's how you can reach us…</p>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <script>
      $(document).on('submit', '#contact-form', function(e){
        $(this).find('button').html('<i class="fas fa-spinner fa-spin"></i>');
      });
    </script>

</body>
</html>