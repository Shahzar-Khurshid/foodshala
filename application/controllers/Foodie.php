<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Foodie extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $header_page = "header";
        if (isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 1) {
                $header_page = "foodie_header";
            } else if ($_SESSION['type'] == 2) {
                $header_page = "restaurant_header";
            }
        }

        $get_input = [
            'food_name' => $this->input->get('food_name')
        ];

        $this->load->model('foods_model');


        if ($get_input['food_name']) {
            $food_items = $this->foods_model->get_similar_food($get_input['food_name']);
        } else {
            $food_items = $this->foods_model->get_foods();
        }

        $this->load->view('templates/' . $header_page);
        $this->load->view('menu_page', array('food_items' => $food_items));
        $this->load->view('templates/footer');
    }

    public function submit() {

        if (!(isset($_SESSION['type']) && $_SESSION['type'] == 1)) {
            $data = array(
                "success" => false,
                "errorMessage" => "Please login to order food as foodie",
                "is_redirect" => true,
                "redirect_url" => base_url() . "Login"
            );

            $this->load->view('json_response', array('data' => $data));
            return;
        }

        $this->load->model('orders_model');
        $this->orders_model->add_orders($_SESSION['id']);

        if ($this->orders_model->has_error()) {
            $data = array(
                "success" => false,
                "errorMessage" => $this->orders_model->error()
            );

            $this->load->view('json_response', array('data' => $data));
            return;
        }
        $data = array(
            "success" => true,
            "successMessage" => "Order Successfully Placed!! Will be delivered soon!"
        );

        $this->load->view('json_response', array('data' => $data));
    }

    public function cart() {
        $header_page = "header";
        if (isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 1) {
                $header_page = "foodie_header";
            } else if ($_SESSION['type'] == 2) {
                $header_page = "restaurant_header";
            }
        }

        $this->load->view('templates/' . $header_page);
        $this->load->view("cart_page", array('cart_items' => $_COOKIE));
        $this->load->view('templates/footer');
    }

    public function cart_submit() {
        $post_input = [
            'food_id' => $this->input->post('food_id'),
            'restaurant_id' => $this->input->post('restaurant_id'),
            'quantity' => $this->input->post('quantity'),
            'price' => $this->input->post("price")
        ];
        $data = [];
        if ((isset($_SESSION['type']) && $_SESSION['type'] == 1)) {

            $post_input += [
                'user_id' => $_SESSION['id'],
            ];

            $this->load->model('orders_model');
            $cart_items = $this->orders_model->add_or_update_cart($post_input);

            $data = array(
                "success" => true,
            );
        } else {
            $duration = 86400 * 30;
            $value = json_encode($post_input);
            if ($post_input['quantity'] == 0) {
                $duration = 3600;
                $value = "";
            }
            setcookie($post_input['food_id'], $value, time() + (86400 * 30), "/"); // 86400 = 1 day
            $data = array(
                "success" => true,
            );
        }
        $this->load->view('json_response', array('data' => $data));
    }

    public function fetch_cart() {
        if ((isset($_SESSION['type']) && $_SESSION['type'] == 1)) {

            $this->load->model('orders_model');
            $cart_id = $this->orders_model->get_current_cart($_SESSION['id']);
            if ($cart_id) {
                $result = $this->orders_model->get_cart_and_items($cart_id);
                $cart = [];
                foreach ($result as $i) {
                    $i = (array) $i;
                    $cart += [
                        $i['food_id'] => json_encode($i),
                    ];
                }
                $data = array(
                    "success" => true,
                    "cart" => $cart,
                    "count" => count($cart)
                );
            } else {
                $data = array(
                   "success" => true
                );
            }
            $this->delete_cookie();
        } else {
            $data = array(
                "success" => true,
                "cart" => $_COOKIE,
                "count" => count($_COOKIE) - 1
            );
        }
        $this->load->view('json_response', array('data' => $data));
    }

    public function delete_cookie() {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                if ($name == "ci_session") {
                    continue;
                }
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }
    }

}
