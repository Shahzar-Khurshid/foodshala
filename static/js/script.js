var event;
$(document).ready(function () {

    $('.login-page').on("click", '.foodie-user a', function () {
        $('#foodie-login-form').removeClass("d-none");
        $('#restaurant-login-form').addClass("d-none");
        $('#user-type').text("Foodie");
        $('.foodie-user a').addClass("text-success");
        $('.restaurant-user a').removeClass("text-success");
    });


    $('.login-page').on("click", '.restaurant-user a', function () {
        $('#restaurant-login-form').removeClass("d-none");
        $('#foodie-login-form').addClass("d-none");
        $('#user-type').text("Restaurant");
        $('.restaurant-user a').addClass("text-success");
        $('.foodie-user a').removeClass("text-success");

    });

    $('.search-food-form').on("click", "#search-food", function () {
        var food_item = $(".food-item").val();
        console.log(food_item);
        var new_href = `${$(this).attr("href")}?food_name=${food_item}`;
        $(this).attr("href", new_href);
    });

});
