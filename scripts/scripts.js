// STICKY HEADER STARTS HERE
const header = $("#header-container");
const mainContent = $("main");
let hasBeenTrigged = false;

document.addEventListener("scroll", function() {

    if (/* document.body.scrollTop > 150  && hasBeenTrigged === false || */document.documentElement.scrollTop > 150 && hasBeenTrigged === false) {
        header.addClass("stuck");
        mainContent.css({paddingTop: "70px"});
        hasBeenTrigged = true;
    }
    
    if (/* document.body.scrollTop === 0  && hasBeenTrigged === true || */document.documentElement.scrollTop === 0 && hasBeenTrigged === true) {
        header.removeClass("stuck");
        mainContent.css({paddingTop: "0"});
        hasBeenTrigged = false;
    }
})
// STICKY HEADER ENDS HERE



// MOBILE MENU STARTS HERE
const mobileMenuContainer = $(".mobile-menu-container")
const mobileNavDropdown = $(".mobile-menu-container .has-dropdown-mobile button");
const body = $("body");
const hamburger = $("#mobile-hamburger")
const mobileMenuClose = $("#mobile-menu-close")
const mobileMenu = $(".mobile-menu")

hamburger.click(function() {
    $(this).addClass("is-hidden")
    mobileMenuContainer.removeClass("is-inactive")
    mobileMenuContainer.addClass("is-active")
    mobileMenu.addClass("is-active")
    body.addClass("mobile-is-active")
})

mobileNavDropdown.click(function() { 
    $(this).parent().find(".nav-dropdown-mobile").toggleClass("is-hidden");
    $(this).parent().toggleClass("button-active");
    $(this).parent().children("a").toggleClass("button-active");
    $(this).addClass("is-active")
    $(this).toggleClass("clicked")
    $(this).parent().find(".nav-dropdown-mobile").children("a").toggleClass("is-active")
});

mobileMenuClose.click(function() {
    mobileMenu.removeClass("is-active")
    mobileMenuContainer.removeClass("is-active")
    mobileMenuContainer.addClass("is-inactive")
    hamburger.removeClass("is-hidden")
    body.removeClass("mobile-is-active")
})
// MOBILE MENU ENDS HERE


// SEARCH BAR STARTS HERE
$(document).on('submit', '#search-form', function(e){
  let button = $(this).parent().find('button');
  button.html('<i class="fas fa-spinner fa-spin"></i>');

})
// SEARCH BAR ENDS HERE



// WISHLIST BUTTONS START HERE
$(document).on('click', '.wishlist-icon button', function(){

    let p_id = $(this).parent().children('#p_id').val();
    let p_name = $(this).parent().children('#p_name').val();

    $.ajax({
        type: "POST",
        url: "wishlist_add.php",
        data: {
            "p_id": p_id,
            "p_name": p_name
        },
        success: function(response) {
            response = JSON.parse(response);
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
            }
            $("#product-main").css("padding", "0");
            goToTop();
        }
    });
})
// WISHLIST BUTTONS START HERE



// QUICKVIEW STARTS HERE
$(document).on('click', '.open', function(e){
    e.preventDefault();

    let loader = $(this).parent().parent().parent().children('.loading-overlay');
    loader.removeClass('d-none');

    let modalContainerBox = $('#modal-container-box');
    let prod_name = $(this).parent().children('#prd_name').val();

    $(".cart-items-modal").val(1);
    
    $.ajax({
        type: "POST",
        url: "quick-view-modal.php",
        data: {
            "name": prod_name
        },
        success: function(response) {
            $("#modal-box").html(response);
            modalContainerBox.addClass('modal-active');
            modalContainerBox.removeClass('initial');
            $('body').css("overflow","hidden");
            loader.addClass('d-none');
        }
    });
})

document.addEventListener('click', function(event){
    if(event.target.matches("#close") || !event.target.closest("#modal-box")) {
      $('body').css("overflow","auto");
      $('#modal-container-box').removeClass('modal-active');
    }
}, false)
// QUICKVIEW ENDS HERE



// CART FETCH STARTS HERE
function getCart() {
    $.ajax({
        type: 'POST',
        url: 'cart_fetch.php',
        datatype: 'json',
        success: function(response) {
            response = JSON.parse(response);
            $('#cart-count').html(response.count);
            if(response.empty) {
              $('#cart-menu').html(response.empty);
            } else {
              $('#cart-menu').html(response.list);
            }
        }
    })
}

getCart();
// CART FETCH ENDS HERE



// CART DETAILS, TOTAL AND DELETE STARTS HERE
getDetails();
getTotal();

$(function(){
    $(document).on('click', '.cart-delete', function(e){
        e.preventDefault();

        let overlay = $(this).parents('.hoc').find('.loading-overlay');
        overlay.removeClass('d-none');

        let id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'cart_delete.php',
            data: {
                id : id
            },
            dataType: 'json',
            success: function(response){
                if(!response.error){
                    getDetails();
                    getCart();
                    getTotal();
                    overlay.removeClass('d-none');
                }
            }
        });
    });
});

function getDetails(){
    $.ajax({
        type: 'POST',
        url: 'cart_details.php',
        dataType: 'json',
        success: function(response){
            $('#tbody').html(response);
        }
    });
}

function getTotal(){
    $.ajax({
        type: 'POST',
        url: 'cart_total.php',
        dataType: 'json',
        success: function(response){
            $('#total').html(response);
            $('#totals').html(response);
            $('.subtotals').html(response);
        }
    });
}
// CART DETAILS AND DELETE ENDS HERE


//PRICE FILTER STARTS HERE
const rangeInput = document.querySelectorAll(".range-input input");
const progress = document.querySelector(".slider .progress");
const minPrice = document.querySelector(".price-filter-text .from");
const maxPrice = document.querySelector(".price-filter-text .to");

let priceGap = 1000;

rangeInput.forEach(input => {
    input.addEventListener("input", e => {
        $('.fetch-products').html('<p class="loading">Loading...</p>');

        let minVal = parseInt(rangeInput[0].value);
        let maxVal = parseInt(rangeInput[1].value);

        let difference = rangeInput[0].max - rangeInput[0].min;

        if(maxVal - minVal < priceGap) {
            if(e.target.className === "range-min") {
                rangeInput[0].value = maxVal - priceGap;
            } else {
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            minPrice.innerHTML ="₦" + minVal.toLocaleString();
            maxPrice.innerHTML = "₦" + maxVal.toLocaleString();
            progress.style.left = ((minVal - rangeInput[0].min) / difference) * 100 + "%";
            progress.style.right = 100 - ((maxVal - rangeInput[0].min) / difference) * 100 + "%";
        }

        $.ajax({
            type: 'POST',
            url: 'fetch_products.php',
            data: {
                min_price: minVal,
                max_price: maxVal,
                cat_id: $('#cat_id').val()
            },
            success: function(response){
                $('.fetch-products').html(response);
            }
        });
    })
})
//PRICE FILTER ENDS HERE



// BACK TO TOP STARTS HERE
const showOnPx = 400;
const backToTopButton = $(".back-to-top");
const scrollContainer = () => {
    return document.documentElement || document.body;
};

document.addEventListener("scroll", () => {
    if (scrollContainer().scrollTop > showOnPx) {
        backToTopButton[0].classList.remove("hidden")
    } else {
        backToTopButton[0].classList.add("hidden")
    }
})

const goToTop = () => {
    document.body.scrollIntoView({
        behavior: "smooth",
    })
}

backToTopButton[0].addEventListener("click", goToTop);
// BACK TO TOP ENDS HERE
