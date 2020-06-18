var event;
$(document).ready(function () {
//    var base_url = 'http://127.0.0.1/foodshala/';
    cart_success();

    $("#foodie-register-form").submit(function (e) {

        e.preventDefault();

        var url = base_url + "registration/foodie_submit";
        var data = $('#foodie-register-form').serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: success
        });
    });

    $("#restaurant-register-form").submit(function (e) {

        e.preventDefault();

        var url = base_url + "registration/restaurant_submit";
        var data = $('#restaurant-register-form').serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: success
        });
    });

    $("#foodie-login-form").submit(function (e) {

        e.preventDefault();

        var url = base_url + "login/foodie_submit";
        var data = $('#foodie-login-form').serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: success
        });
    });

    $("#restaurant-login-form").submit(function (e) {

        e.preventDefault();

        var url = base_url + "login/restaurant_submit";
        var data = $('#restaurant-login-form').serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: success
        });
    });

    $("#add-menu-form").submit(function (e) {

        e.preventDefault();

        var url = base_url + "Restaurant/submit";
        var data = $('#add-menu-form').serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    $('#food-item-list').prepend(sample_food_item_div);
                    $('.food-item:first .food-name').text(data.food_item['name']);
                    $('.food-item:first .food-price').text(data.food_item['price']);
                    $('.food-item:first .type-icon').attr("src", image_path + data.food_item['food_type'] + ".png");
                    $('.food-item:first .type-icon').attr("alt", data.food_item['food_type']);
                    $('.food-item:first').hide().show('slow');
                    $('.empty-menu').hide('slow', function () {
                        $('.empty-menu').remove();
                    });
                }
            }
        });
    });

    $(".food-list").on("click","#submit-order",function (e) {

        //e.preventDefault();
        var url = base_url + "Foodie/submit";
        $.ajax({
            type: "POST",
            url: url,
            success: success
        });
    });
    
    $('.food-description').on("click", ".add-quantity", function () {
        var current_quantity = $(this).siblings("span").text();
        var quantity = +current_quantity + 1;
        if (quantity > 999) {
            return;
        }
        
        arrange_card_data(this,quantity);
        
    });

    $('.food-description').on("click", ".reduce-quantity", function () {
        var current_quantity = $(this).siblings("span").text();
        var quantity = +current_quantity - 1;
        
        if ( quantity == 0){
            $(this).closest(".food-description").find(".subtotal-amount").text(0);
        }
        
        if (quantity < 0) {
            return;
        }
        
        arrange_card_data(this,quantity);

    });
    
    function arrange_card_data(reference_tag,quantity){
        $(reference_tag).siblings("span").text(quantity);
        $(reference_tag).siblings("form").find(".quantity").val(quantity);
        var form_data = $(reference_tag).siblings("form").serialize();
        food_item_object(form_data);
    }

    var food_item_object = function (data) {
        var url = base_url + "Foodie/cart_submit";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    cart_success();
                }
            }
        });
    };

});

var success = function (data) {
    data = JSON.parse(data);

    if (typeof data.is_redirect !== 'undefined' && data.is_redirect) {
        if (data.errorMessage) {
            alert(data.errorMessage);
        }
        window.location.href = data.redirect_url;
    } else {
        if (data.success) {
            alert(data.successMessage, '/');
        } else {
            alert(data.errorMessage);
        }
    }
}

var cart_success = function () {
    $.ajax({
        type: "POST",
        url: base_url + "Foodie/fetch_cart",
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                var grandTotal = 0;
                $(".cart-total-items").text(data.count);
                var cart_items = data.cart;
                for(let i in cart_items){
                    if(i === "ci_session"){
                        continue;
                    }
                    var eachCartItem = JSON.parse(cart_items[i]);
                    $("#"+i).find(".quantity").text(eachCartItem["quantity"]);
                    $("#"+i).find(".subtotal-amount").text(eachCartItem["quantity"]*eachCartItem["price"]);
                    grandTotal += eachCartItem["quantity"]*eachCartItem["price"]
                }
                $(".grand-total").text(grandTotal);
            }
        }
    });
}