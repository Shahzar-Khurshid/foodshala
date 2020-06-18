<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
    <form class="form-inline my-2 my-lg-5 row justify-content-center search-food-form" action="foodie">
        <input name="food_name" class="form-control mr-sm-2 col-6 mx-2 food-item" type="search" placeholder="What would you like to have?" aria-label="Search">
        <a href="<?= base_url() ?>Foodie" class="btn btn-outline-success my-2 my-sm-0 col-3 col-md-1" id="search-food">Search</a>
    </form>
</div>
<div class="categories-list px-5 my-5">
    <h4>
        Popular Cities
    </h4>
    <div class="categories-card row justify-content-center justify-content-sm-between">
        <a href="#" class="categories-card-item">
            <div class="categories-img-container">
                <img src="static/images/hyderabad.svg" alt="Hyderabad" class="categories-img" />
            </div>
            <div class="categories-text text-center">
                Hyderabad
            </div>
        </a>
        <a href="#">
            <div class="categories-img-container">
                <img src="static/images/mumbai.svg" alt="Mumbai" class="categories-img" />
            </div>
            <div class="categories-text text-center">
                Mumbai
            </div>
        </a>
        <a href="#">
            <div class="categories-img-container">
                <img src="static/images/delhi_ncr.svg" alt="Delhi" class="categories-img" />
            </div>
            <div class="categories-text text-center">
                Delhi
            </div>
        </a>
        <a href="#">
            <div class="categories-img-container">
                <img src="static/images/bangalore.svg" alt="Bangalore" class="categories-img" />
            </div>
            <div class="categories-text text-center">
                Bangalore
            </div>
        </a>
        <a href="#">
            <div class="categories-img-container">
                <img src="static/images/chennai.svg" alt="Chennai" class="categories-img" />
            </div>
            <div class="categories-text text-center">
                Chennai
            </div>
        </a>
        <a href="#">
            <div class="categories-img-container">
                <img src="static/images/kolkata.svg" alt="Kolkata" class="categories-img" />
            </div>
            <div class="categories-text text-center">
                Kolkata
            </div>
        </a>
    </div>
</div>
<div class="categories-list px-5 my-5">
    <h4>
        Popular Foods
    </h4>
    <div class="categories-card row justify-content-md-between justify-content-center">
        <a href="#" class="categories-card-item my-3 mx-1">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="static/images/pizza.jpeg" alt="Food Item Pizza" >
                <div class="card-body">
                    <p class="card-text">A chessy delicious pizza .</p>
                </div>
            </div>
        </a>
        <a href="#" class="categories-card-item my-3 mx-1">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="static/images/biryani.jpg" alt="Food Item Biryani" >
                <div class="card-body">
                    <p class="card-text">Kadhai Biryani Specially For you.</p>
                </div>
            </div>
        </a>
        <a href="#" class="categories-card-item my-3 mx-1">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="static/images/thali.jpg" alt="Food Item Thali" >
                <div class="card-body">
                    <p class="card-text">A mega Thali for all your cravings.</p>
                </div>
            </div>
        </a>
        <a href="#" class="categories-card-item my-3 mx-1">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="static/images/dessert.jpg" alt="Food Item Dessert" >
                <div class="card-body">
                    <p class="card-text">There is always space for Dessert</p>
                </div>
            </div>
        </a>
    </div>

</div>
