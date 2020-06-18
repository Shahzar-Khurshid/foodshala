<?php

class Orders_model extends CI_Model {

    private $error = NULL;

    public function __construct() {
        parent:: __construct();
    }

    public function error() {
        return $this->error;
    }

    public function has_error() {
        return $this->error != NULL;
    }

    public function add_orders($user_id) {
        $this->load->database();

        $date = date('Y-m-d H:i:s');
        $this->load->helper('string');
        $unique_key = random_string('alnum', 13);

        $order = [
            'buyer_id' => $_SESSION['id'],
            'unique_key' => $unique_key,
        ];

        $order_id = $this->db->insert('orders', $order) ? $this->db->insert_id() : false;
        $cart_id = $this->get_current_cart($user_id);
        $cart_items = $this->get_cart_and_items($cart_id);
        $this->change_cart_status($cart_id);
        foreach ($cart_items as $item) {
            $each_item = (array) $item;
            $order_item = [
                'order_id' => $order_id,
                'food_id' => $each_item['food_id'],
                'restaurant_id' => $each_item['restaurant_id'],
                'price' => $each_item['price'],
                'quantity' => $each_item['quantity']
            ];
            $this->db->insert("order_and_foods", $order_item);
        }

        return true;
    }

    public function get_restaurant_orders($restaurant_id) {
        $this->load->database();
        $this->db->select('users.name buyer_name,foods.food_type,foods.name food_name, order_and_foods.quantity quantity, order_and_foods.price');
        $this->db->from('order_and_foods');
        $this->db->join('orders', 'orders.id = order_id', 'left');
        $this->db->join('users', 'users.id = buyer_id', 'left');
        $this->db->join('foods', 'foods.id = food_id', 'left');
        $this->db->where('order_and_foods.restaurant_id', $restaurant_id);
        $query = $this->db->get();
        if ($query->result()) {
            $query_result = (array) $query->result();
            return $query_result;
        }
        return FALSE;
    }

    public function add_or_update_cart($data) {
        $this->load->database();
        if (!$this->get_current_cart($data['user_id'])) {
            $this->db->insert("carts", array("foodie_id" => $data['user_id']));
        }
        $cart_id = $this->get_current_cart($data['user_id']);
        $this->delete_cart_and_foods($cart_id, $data['food_id']);
        $this->insert_cart_and_foods($data, $cart_id);
        return $this->get_cart_and_items($cart_id);
    }

    public function get_current_cart($user_id) {
        $this->load->database();
        $this->db->select('id');
        $this->db->from('carts');
        $this->db->where('foodie_id', $user_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if (!$query->result()) {
            return FALSE;
        }
        $cart_id = $query->result();
        $cart_id = (array) $cart_id[0];
        return $cart_id['id'];
    }

    private function delete_cart_and_foods($cart_id, $food_id) {
        $this->db->where('cart_id', $cart_id);
        $this->db->where('food_id', $food_id);
        $this->db->delete('cart_and_foods');
    }

    private function insert_cart_and_foods($data, $cart_id) {
        if ($data['quantity'] == 0) {
            return;
        }
        $insert_cart_and_foods = [
            'food_id' => $data['food_id'],
            'cart_id' => $cart_id,
            'restaurant_id' => $data['restaurant_id'],
            'price' => $data['price'],
            'quantity' => $data['quantity']
        ];
        $this->db->insert("cart_and_foods", $insert_cart_and_foods);
    }

    public function get_cart_and_items($cart_id) {
        $this->db->select('*');
        $this->db->from('cart_and_foods');
        $this->db->where('cart_id', $cart_id);
        $query = $this->db->get();
        return $query->result();
    }

    private function change_cart_status($cart_id) {
        $this->db->set("status", "0");
        $this->db->where('id', $cart_id);
        $this->db->update("carts");
    }

}
