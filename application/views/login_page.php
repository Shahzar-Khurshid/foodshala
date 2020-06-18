<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="login-page">
    <div class="login-form-container row">
        <div class="type-selection col-12 d-flex justify-content-between ">
            <div class="foodie-user ">
                <a href="#" class="text-success">Foodie</a>
            </div>
            <div class="restaurant-user">
                <a href="#" class="">Restaurant</a>
            </div>
        </div>
        <div class="foodie-user-form col-12 d-flex justify-content-center flex-column">
            <h3>Login as <span id="user-type">Foodie</span></h3>
            <form class="form" id="foodie-login-form" method="POST" action="">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" value="submit" class="btn btn-primary w-100">Log-in</button>
            </form>
            <form class="form d-none" id="restaurant-login-form" method="POST" action="">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" value="submit" class="btn btn-primary w-100">Log-in</button>
            </form>
            <div class="new-existing-choice my-3">
                <a href="#" class="danger">Forgot Password</a>
            </div>
        </div>
    </div>
</div>
