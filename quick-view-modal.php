<?php

  include("config/session.php");
  $conn = $pdo->open();

  if(isset($_POST['name'])) {

    $prod_name = $_POST['name'];

    $stmt = $conn->prepare("SELECT * FROM products JOIN categories ON products.cat_id = categories.cat_id WHERE prd_name = :prd_name");
    $stmt->execute([':prd_name' => $prod_name]);
    $prod_modal = $stmt->fetch();
      
  }

?>

<!-- REMAINS PRODUCT DESCRIPTION AND MAKING SOCIAL ICONS FUNCTIONAL -->

<div class="modal">
    <div class="image-box">
        <img src="images/<?php echo $prod_modal['prd_image']; ?>" alt="">
    </div>

    <div class="product-content">
        <div class="inner-col">
            <a href="product-details.php?prname=<?php echo $prod_modal['prd_slug'];?>">
                <h1><?php echo $prod_modal['prd_name']; ?></h1>
            </a>

            <div class="hor-divider"></div>

            <span class="price"><?php echo '₦' . number_format($prod_modal['prd_price'], 2); ?></span>

            <!-- php here -->
            <p class="product-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, eligendi perspiciatis ad architecto esse a ullam, doloribus eaque voluptatem iure dicta repudiandae accusamus! Ducimus, molestiae! Reiciendis hic facere ipsam deleniti magnam quidem delectus, nulla molestias reprehenderit placeat voluptate repellendus a?</p>

            <form id="product-form-modal">
                <div class="product-cart">
                    <input type="hidden" class="item-stock" value="<?php echo $prod_modal['prd_stock']; ?>">
                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $prod_modal['prd_id']; ?>">
                    <input type="hidden" id="product_name" name="product_name" value="<?php echo $prod_modal['prd_name']; ?>">
                    <input type="button" value="-" class="decrease">
                    <input type="number" id="quantity" name="quantity" id="cart-items" class="cart-items-modal" value="1" disabled>
                    <input type="button" value="+" class="increase">
                </div>
                <button>ADD TO CART</button>
            </form>

            <span class="category">Category: 
                <!-- php here -->
                <a href="categories.php?caname=<?php echo $prod_modal['cat_slug']; ?>"><?php echo $prod_modal['cat_name']; ?></a>
            </span>

            <div class="social-icons">
                <!-- php here -->
                <a href="" class="whatsapp"><div><i class="fab fa-whatsapp"></i></div></a>
                <a href="" class="facebook"><div><i class="fab fa-facebook-f"></i></div></a>
                <a href="" class="twitter"><div><i class="fab fa-twitter"></i></div></a>
                <a href="" class="pinterest"><div><i class="fab fa-pinterest"></i></div></a>
            </div>
        </div>
    </div>
</div>

<script>
  $(function(){
    $('.modal input[type="button"].increase').click(function(){
      let quantity = $('.modal input[type="number"].cart-items-modal').val();
      let stock = $('.modal input[type="hidden"].item-stock').val();
      if( parseInt(quantity) < parseInt(stock) ) {
        quantity++;
      }
      $('.modal input[type="number"].cart-items-modal').val(quantity);
    });
    $('.modal input[type="button"].decrease').click(function(){
      let quantity = $('.modal input[type="number"].cart-items-modal').val();
      if( parseInt(quantity) > 1){
        quantity--;
      }
      $('.modal input[type="number"].cart-items-modal').val(quantity);
    });
  });

  $(function(){
    $('#product-form-modal').submit(function(e){
      e.preventDefault();

      let button = $(this).parent().find('button');
      button.html('<i class="fas fa-spinner fa-spin"></i>');

      let product_id = $(this).parent().find("#product_id").val();
      let product_name = $(this).parent().find("#product_name").val();
      let quantity = $(this).parent().find("#quantity").val();
      $.ajax({
        type: 'POST',
        url: 'cart_add.php',
        data: {
          "product_id": product_id,
          "product_name": product_name,
          "quantity": quantity
        },
        success: function(response){
          response = JSON.parse(response);
          button.html('ADD TO CART');
          $('#callout').show();
          $('.callout-message.first').html(response.message);
          if(response.error){
            $('#callout').removeClass('callout-success').addClass('callout-danger');
            $('.callout-icon').html('<i class="fas fa-x"></i>');
          }
          else{
            $('#callout').removeClass('callout-danger').addClass('callout-success');
            $('.callout-icon').html('<i class="fas fa-check"></i>');
            getCart();
            getTotal();
          }
          $("#product-main").css("padding", "0");
          $('body').css("overflow","auto");
          $('#modal-container-box').removeClass('modal-active');
          goToTop();
        }
      });
    });
  });
</script>