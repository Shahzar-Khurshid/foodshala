<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="restaurant-register-page">
    <div class="restaurant-register-form-container row">
        <div class="restuarant-user-form col-12 d-flex justify-content-center flex-column">
            <h3>Register as Restaurant</h3>
            <form class="form" id="restaurant-register-form" method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputCity">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Full Name" required>
                    </div>
                </div>
                <button type="submit" value="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="new-existing-choice my-3">
                <a href="#" class="danger">Already a member? Login</a>
            </div>
        </div>
    </div>
</div>