<?php

  include("config/session.php");
  $conn = $pdo->open();

  $p_title = $_GET['potitle'] ?? '3_accessories_you_need_to_get_for_your_laptop_fast';

  if(isset($p_title)) {

    $stmt = $conn->prepare("SELECT * FROM posts WHERE post_slug = :post_name");
    $stmt->execute([':post_name' => $p_title]);
    $current_post = $stmt->fetch();

  }

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
    <link rel="stylesheet" href="styles/post-details.css?v=<?php echo time(); ?>"/>
    <!-- SIDEBAR CSS -->
    <link rel="stylesheet" href="styles/posts-side-bar.css?v=<?php echo time(); ?>"/>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title><?php echo $current_post['post_title']; ?> - Doppell</title>
    
</head>
<body>

    <?php include('includes/header.php'); ?>
    
    <main>
        <div class="inner-container">
            <div id="post-content">
                <div class="entry-header-text">
                    <span class="post-tags">
                        <a href="">accessories</a>, <a href="">laptops</a>
                    </span>
                    <h1 class="post-title"><?php echo $current_post['post_title'] ?? 'heya'; ?></h1>
                    <div class="hor-divider"></div>
                    <div class="post-details">
                        <span>posted on</span>
                        <span><?php echo $current_post['post_month']  ?> <?php echo $current_post['post_day']  ?>, 2022</span>
                        <span>by</span>
                        <span><?php echo $current_post['post_author']; ?></span>
                    </div>
                </div>

                <div class="post-image-box">
                    <div class="image-cover">
                        <img src="images/<?php echo $current_post['post_image']; ?>" alt="">
                    </div>
                    <div class="post-date">
                        <div>
                            <!-- PHP HERE -->
                            <span class="post-day"><?php echo $current_post['post_day']  ?></span><br>
                            <span class="post-month"><?php echo $current_post['post_month']  ?></span>
                        </div>
                    </div>
                </div>

                <div class="post-content-words">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto iure possimus magnam laboriosam repellat eius voluptatem ullam illum inventore natus doloribus, culpa quia tempora sint est odio exercitationem. Perferendis nobis architecto rerum repudiandae atque, autem cumque fugiat. Distinctio, non corrupti?</p>

                    <h2>1. Perferendis nobis</h2>

                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt fugiat vel asperiores quibusdam aperiam nostrum explicabo, recusandae consectetur laudantium tempora voluptas eius praesentium inventore facilis itaque enim in totam rem error numquam aliquam laborum. Natus asperiores aliquid esse quas dolorum ut fugit aut, delectus itaque doloremque numquam nam sapiente libero nobis suscipit fuga praesentium qui nisi ab nulla a hic rerum ducimus? Illo, quaerat commodi?</p>

                    <div class="image-container">
                        <img src="images/HP-Omen-15-1024x576.jpg" alt="">
                    </div>

                    <h3>Pros</h3>
                    <ul>
                        <li>Ernatur ut voluptatum quis.</li>
                        <li>Voluptatum nostrum perferendis</li>
                        <li>Ipsam debitis laboriosam</li>
                    </ul>
                    <h3>Cons</h3>
                    <ul>
                        <li>Repellat quae</li>
                        <li>Sunt quidem quo</li>
                    </ul>

                    <h2>2. Doloremque numquam nam sapiente</h2>

                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit libero mollitia amet sequi harum tenetur, aliquid voluptatibus nulla perspiciatis! Facere culpa deleniti itaque, aspernatur qui earum architecto reprehenderit optio sed libero mollitia animi cupiditate suscipit laboriosam blanditiis enim at impedit eius distinctio nihil ipsa vitae hic error quos! Dicta laborum repellat repudiandae praesentium vero ullam sequi facere?</p>

                    <div class="image-container">
                        <img src="images/ASUS-Zephyrus-Duo-15-SE-review-1.webp" alt="">
                    </div>

                    <h2>3. Impedit eius distinctio</h2>

                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore soluta quidem magnam minus, suscipit corrupti reiciendis ullam ipsam quisquam voluptas nesciunt doloribus possimus commodi saepe fuga deserunt, ducimus eligendi. Tenetur praesentium animi eveniet distinctio, laboriosam pariatur. Magnam rem exercitationem veniam, fuga modi alias pariatur asperiores doloremque sit iusto dolorem soluta quo ad culpa ducimus aperiam aspernatur nesciunt quos.</p>

                    <div class="blog-share">
                        <div class="hor-divider"></div>
                        <div class="social-icons">
                            <a href="" class="whatsapp"><div><i class="fab fa-whatsapp"></i></div></a>
                            <a href="" class="facebook"><div><i class="fab fa-facebook-f"></i></div></a>
                            <a href="" class="twitter"><div><i class="fab fa-twitter"></i></div></a>
                            <a href="" class="pinterest"><div><i class="fab fa-pinterest"></i></div></a>
                        </div>
                    </div>
                    
                </div>

                <div class="comments">
                    <h3>Comments</h3>

                    <div class="comment-box">
                        <div class="col-inner">
                            <div class="image-box">
                                <img src="images/gravatar.png" alt="">
                            </div>
                            <div class="comment-text-box">
                                <p><span>Wale</span> says:</p>
                                <p>Thanks for this. Now I know what and what I should get for my laptop.</p>
                                <span>JUNE 7, 2022 AT 10:34 PM</span>
                            </div>
                        </div>
                    </div>

                    <div class="smaller-gap"></div>
                </div>

                <div class="comment-form">
                    <h3>Leave a Reply</h3>
                    <form action="" class="form">
                        <p>Your email address will not be published. Required fields are marked *</p>
                            <div class="comment-form-comment">
                                <label for="comment">
                                    Comment <span class="required">*</span>
                                </label>
                                <textarea name="comment" id="comment" required></textarea>
                            </div>
                            <div class="comment-form-name">
                                <label for="name">
                                    Name <span class="required">*</span>
                                </label>
                                <input type="text" name="name" id="name" required>
                            </div>
                            <div class="comment-form-email">
                                <label for="email">
                                    Email <span class="required">*</span>
                                </label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div class="comment-form-button">
                                <button type="submit">POST COMMENT</button>
                            </div>
                    </form>
                </div>

                <div class="small-gap"></div>
            </div>

            <?php include('includes/posts-side-bar.php') ?>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>