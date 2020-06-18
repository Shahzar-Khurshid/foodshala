<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container my-5">
    <?php
    if ($my_orders) {
        ?>
        <div class='mb-3'>
            <h3>All Foods you sent are here!</h3>
        </div>
        <div class="food-list">
            <?php
            $total_amount = 0;
            foreach ($my_orders as $order) {
                $each_order = (array) $order;
                $subtotal = $each_order['quantity'] * $each_order['price'];
                $total_amount += $subtotal;
                ?>
                <div class="card col-12 mb-2 food-description">
                    <div class="card-header text-muted restaurant-and-quantity">
                        <div class='buyer-name'><?= $each_order['buyer_name'] ?></div>
                        <div class="">
                            <div> Quantity : <span class="item-quantity"> <?= $each_order['quantity'] ?></span></div>
                        </div>
                    </div>
                    <div class="card-body each-food-item d-flex">
                        <div class="left p-0">
                            <img src="<?= base_url() ?>static/images/<?= $each_order['food_type'] ?>.png" alt="<?= $each_order['food_type'] ?>-icon" class="type-icon" >
                            <span class="food-name"><?= $each_order['food_name'] ?></span> 
                        </div>
                        <div class="col p-0 px-2">
                            <hr>
                        </div>
                        <div class="right p-0">
                            ₹<?= $each_order['price'] ?>
                        </div>
                    </div>
                    <div class="card-footer text-muted subtotal">
                        <p class="my-0 mx-3">Sub total:  ₹<span class="subtotal-amount"><?= $subtotal ?></span></p>
                    </div>
                </div>
                <?php
            }
            ?>
            <p class="float-right text-success mr-4">Total amount : <?= $total_amount ?></p>
            <?php
        } else {
            ?>
            <div class="no-orders">
                <center>
                    <img src="<?= base_url() ?>static/images/sad.png" alt="Why no food in Menu" style="width: 40%" />
                    <h2>Why No Order?</h2>
                </center>
            </div>
            <?php
        }
        ?>
    </div>
</div>