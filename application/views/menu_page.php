<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container my-5 menu-page">
    <div class='mb-3 d-flex justify-content-between'>
        <h3>We can't wait to serve you!</h3>
        <a href="<?= base_url() ?>Foodie/cart" class="align-self-md-end align-self-end d-flex mr-md-5">
            <img src="<?= base_url() ?>static/images/cart_icon.png" alt="shopping cart" class="cart-icon"/>
            <p class="ml-2 cart-total-items">0</p>
        </a>
    </div>
    <div class="food-list">
        <?php
        if ($food_items) {
            foreach ($food_items as $food_item) {
                $each_item = (array) $food_item;
                ?>
                <div class="card col-12 mb-2 food-description" id="<?= $each_item['id'] ?>">
                    <div class="card-header text-muted restaurant-and-quantity">
                        <div class='restaurant-name'><?= $each_item['restaurant_name'] ?></div>
                        <div class="change-quantity">
                            <img src="<?= base_url() ?>static/images/minus.png" alt="subtract quantity" class="reduce-quantity">
                            <span class="quantity">0</span>
                            <img src="<?= base_url() ?>static/images/plus1.png" alt="add quantity" class="add-quantity">
                            <form class="pl-2 py-0 order-form d-none">
                                <input type="hidden" name="food_id" value="<?= $each_item['id'] ?>" class="food_id" hidden />
                                <input type="hidden" name="restaurant_id" value="<?= $each_item['restaurant_id'] ?>" class="restaurant_name" hidden />                                            
                                <input type="hidden" name="price" value="<?= $each_item['price'] ?>" class="food-price" hidden />
                                <input type="hidden" name="quantity" value="" class="quantity" hidden />
                            </form>
                        </div>
                    </div>
                    <div class="card-body each-food-item d-flex">
                        <div class="left p-0">
                            <img src="<?= base_url() ?>static/images/<?= $each_item['food_type'] ?>.png" alt="<?= $each_item['food_type'] ?>-icon" class="type-icon" >
                            <span class="food-name"><?= $each_item['name'] ?></span> 
                        </div>
                        <div class="col p-0 px-2">
                            <hr>
                        </div>
                        <div class="right p-0">
                            ₹<?= $each_item['price'] ?>
                        </div>
                    </div>
                    <div class="card-footer text-muted subtotal">
                        <p class="my-0 mx-3">Sub total:  ₹<span class="subtotal-amount">0</span></p>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="text-muted bg-light py-2 px-2 d-flex justify-content-end border rounded">
                <p class="px-1 my-0 mx-4">Grand total:  ₹<span class="grand-total">0</span></p>
            </div>
            <div class="d-flex w-100 my-2">
                <button class="btn btn-primary w-100" id="submit-order">Order</button>
            </div>
            <?php
        } else {
            ?>
            <center>
                <h2>Sorry that item is not available</h2>
            </center>
            <?php
        }
        ?>
    </div>
</div>