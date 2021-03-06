<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= base_url()?>static/css/external/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= base_url()?>static/css/style.css" />
        <title>FoodShala | End to all your cravings!</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
            <a class="navbar-brand" href="<?= base_url()?>home">
                <img src="<?= base_url()?>static/images/logo.png" alt="FoodShala Logo" class="foodshala-logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link py-1 my-1 text-center" href="<?= base_url()?>Foodie">Surprise!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger py-1 px-3 hover-white my-1" href="<?= base_url()?>Login">
                            Login
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-outline-danger py-1 hover-white my-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url()?>Registration/foodie">As a foodie</a>
                            <a class="dropdown-item" href="<?= base_url()?>Registration/restaurant">As a restaurant</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
