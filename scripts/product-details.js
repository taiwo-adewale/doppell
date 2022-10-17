// CURRENT PRODUCT CART STARTS HERE
$(function(){
    $('#product-description input[type="button"].increase').click(function(){
        let quantity = $('#product-description input[type="number"]').val();
        let stock = $('#product-description input[type="hidden"].item-stock').val();
        if( quantity < parseInt(stock) ) {
            quantity++;
        }
        $('#product-description input[type="number').val(quantity);
    });
    $('#product-description input[type="button"].decrease').click(function(){
        let quantity = $('#product-description input[type="number"]').val();
        if(quantity > 1){
            quantity--;
        }
        $('#product-description input[type="number').val(quantity);
    });

});
// CURRENT PRODUCT CART ENDS HERE



// ADD TO CART STARTS HERE
$(function(){
    $('#product-form').submit(function(e){
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
                goToTop();
            }
        });
    });
});
// ADD TO CART ENDS STARTS HERE




// TABBED CONTENT STARTS HERE
const tabs = document.querySelectorAll('[data-tab-target]');
const tabContents = document.querySelectorAll('[data-tab-content]');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget);
        tabContents.forEach(tabContent => {
            tabContent.classList.remove('active');
        })
        tabs.forEach(tab => {
            tab.classList.remove('active');
        })
        tab.classList.add('active');
        target.classList.add('active');
    })
})
// TABBED CONTENT ENDS HERE