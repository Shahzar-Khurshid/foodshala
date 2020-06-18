<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!(isset($_SESSION['type']) && $_SESSION['type'] == 2)) {
            header('Location: ' . base_url() . 'Login');
            return;
        }
    }

    public function index() {
        
        $this->load->model('foods_model');

        $my_menu = $this->foods_model->get_restaurant_menu($_SESSION['id']);
        
        
        $this->load->view('templates/restaurant_header');
        $this->load->view('add_menu',array('my_menu' => $my_menu));
        $this->load->view('templates/footer');
    }

    public function view_orders() {
        
        $this->load->model('orders_model');

        $my_orders = $this->orders_model->get_restaurant_orders($_SESSION['id']);
        
        $this->load->view('templates/restaurant_header',array('my_orders' => $my_orders));
        $this->load->view('view_orders');
        $this->load->view('templates/footer');
    }
    
    public function submit() {
        $post_input = [
            'name' => $this->input->post('food-name'),
            'price' => $this->input->post('price'),
            'food-type' => $this->input->post('food-type'),
            'restaurant_id' => $_SESSION['id']
        ];

        $this->load->model('foods_model');

        $food_item = $this->foods_model->add_item($post_input);
        
        
        $data = array(
            "success" => true,
            "food_item" => $food_item
        );

        $this->load->view('json_response', array('data' => $data));
        return;
    }

}
