<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="add-menu-page container my-5 px-md-5">
    <div class="add-menu mx-md-5 px-md-5">
        <h2 class="mx-md-5 px-md-5">
            Add food here 
        </h2>
        <form class="mx-md-5 px-md-5" id="add-menu-form">
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label>Food Name</label>
                    <input type="text" name="food-name" class="form-control" required>
                </div>
                <div class="form-group col-lg-3 col-6">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="form-group col-lg-3 col-6">
                    <label>Type</label>
                    <select name="food-type" class="form-control">
                        <option value="veg" selected>Veg</option>
                        <option value="non-veg" > Non-veg </option>
                    </select>
                </div>
                <div class="form-group col-lg-2 align-self-md-end">
                    <button type="submit" class="btn btn-primary w-100">submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="menu-list d-flex mx-md-5 px-md-5 flex-column" id="food-item-list">
        <?php
        if ($my_menu) {
            foreach ($my_menu as $food_item) {
                $each_item = (array) $food_item;
                ?>
                <div class="card col-12 mb-2 food-item">
                    <div class="card-body each-food-item d-flex">
                        <div class="left p-0">
                            <img src="<?= base_url() ?>static/images/<?= $each_item['food_type'] ?>.png" alt="<?= $each_item['food_type'] ?>-icon" class="type-icon" >
                            <span class="food-name"><?= $each_item['name'] ?></span> 
                        </div>
                        <div class="col p-0 px-2">
                            <hr>
                        </div>
                        <div class="right p-0 food-price">
                            ₹<?= $each_item['price'] ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="empty-menu">
                <img src="<?= base_url() ?>static/images/empty-menu.jpeg" alt="Why no food in Menu" style="width: 100%" />
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    var sample_food_item_div = `
    <div class="card col-12 mb-2 food-item">
        <div class="card-body each-food-item d-flex">
            <div class="left p-0">
                <img src="<?= base_url() ?>static/images/non-veg.png" alt="non-veg-icon" class="type-icon" >
                <span class="food-name">Food Name</span> 
            </div>
             <div class="col p-0 px-2">
                <hr>
            </div>
            <div>₹</div>
            <div class="right p-0 food-price">
                500
            </div>
        </div>
    </div>
`;
    var image_path = "<?= base_url() ?>static/images/";
</script>