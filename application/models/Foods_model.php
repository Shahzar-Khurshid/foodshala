<?php


class Foods_model extends CI_Model {

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

    public function add_item($data) {

        $this->load->database();

        $date = date('Y-m-d H:i:s');
        $this->load->helper('string');
        $unique_key = random_string('alnum', 13);
        $insert_user_data = [
            'name' => $data['name'],
            'price' => $data['price'],
            'food_type' => $data['food-type'],
            'restaurant_id' => $data['restaurant_id'],
            'unique_key' => $unique_key,
            'created_at' => $date
        ];
        $this->db->insert("foods", $insert_user_data);

        return $this->getFood($unique_key);
    }

    private function getFood($unique_key) {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('foods');
        $this->db->where('unique_key', $unique_key);
        $query = $this->db->get();
        if ($query->result()) {
            $query_result = (array) $query->result()[0];
            return $query_result;
        }
        return FALSE;
    }

    public function get_restaurant_menu($restaurant_id) {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('foods');
        $this->db->where('restaurant_id', $restaurant_id);
        $query = $this->db->get();
        if ($query->result()) {
            $query_result = (array) $query->result();
            return $query_result;
        }
        return FALSE;
    }

    public function get_foods() {
        $this->load->database();
        $this->db->select('foods.id,foods.name,foods.price,foods.food_type,users.name as restaurant_name,users.id as restaurant_id');
        $this->db->from('foods');
        $this->db->join('users', 'users.id = restaurant_id', 'left');
        $query = $this->db->get();
        if ($query->result()) {
            $query_result = (array) $query->result();
            return $query_result;
        }
        return FALSE;
    }

    public function get_similar_food($data) {
        $this->load->database();
        $food_name = "%".$data."%";
        $this->db->select('foods.id,foods.name,foods.price,foods.food_type,users.name as restaurant_name,users.id as restaurant_id');
        $this->db->from('foods');
        $this->db->join('users', 'users.id = restaurant_id', 'left');
        $this->db->where('foods.name like', $food_name);
        $query = $this->db->get();
        if ($query->result()) {
            $query_result = (array) $query->result();
            return $query_result;
        }
        return FALSE;
    }

}
