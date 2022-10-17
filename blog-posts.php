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
    <link rel="stylesheet" href="styles/blog-posts.css?v=<?php echo time(); ?>"/>
    <!-- SIDEBAR CSS -->
    <link rel="stylesheet" href="styles/posts-side-bar.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="vendor/fontawesome-free-6.1.2-web/css/all.min.css">


    <title>Blog - Doppell</title>
    
</head>
<body>

    <?php include('includes/header.php'); ?>
    
    <main>
        <div class="inner-container">
            <div id="posts">

                <?php foreach($posts as $post): ?>
                    <div class="post">
                        <a href="post-details.php?potitle=<?php echo $post['post_slug']; ?>">
                            <div class="image-box">
                                <div class="image-cover">
                                    <img src="images/<?php echo $post['post_image']; ?>" alt="">   
                                </div>
                                <div class="post-date">
                                    <div>
                                        <!-- PHP HERE -->
                                        <span class="post-day"><?php echo $post['post_day']  ?></span><br>
                                        <span class="post-month"><?php echo $post['post_month']  ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-content">
                                <h5><?php echo $post['post_title']; ?></h5>
                                <div class="hor-divider"></div>
                                <p>
                                    <?php $first_15_words = implode(' ',array_slice(explode(' ', $post['post_content']), 0, 15));
                                                echo "$first_15_words [...]"; ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>

            <?php include('includes/posts-side-bar.php') ?>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>