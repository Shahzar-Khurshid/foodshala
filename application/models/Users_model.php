<?php


class Users_model extends CI_Model {

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

    public function user_registration($data) {
        // code...
        $this->load->database();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $data['email']);
        $this->db->where('type', $data['type']);
        $query = $this->db->get();
        if ($query->result()) {
            $this->error = "Email already exist please login";
            return;
        }

        $date = date('Y-m-d H:i:s');
        $this->load->helper('string');
        $unique_key = random_string('alnum', 255);
        $insert_user_data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => sha1($data['password']),
            'preferences' => $data['preferences'],
            'type' => $data['type'],
            'unique_key' => $unique_key,
            'created_at' => $date
        ];
        $this->db->insert("users", $insert_user_data);
        $userId = $this->getUserId($data['email'], $data['type']);
        if (!$userId) {
            $this->error = "There is some error submit again or contact admin";
            return;
        }
        return $userId;
    }

    public function validate_email_and_password($data) {
        $this->load->database();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $data['email']);
        $this->db->where('type', $data['type']);
        $query = $this->db->get();
        if (!$query->result()) {
            $this->error = "Email doesn't exist please Register";
            return;
        }
        

        $entered_password = sha1($data['password']);
        $query_result = (array) $query->result()[0];
        $stored_password = $query_result['password'];
        if ($entered_password != $stored_password) {
            $this->error = "You seem to have entered an incorrect password";
            return;
        }
        return $this->getUserId($data['email'],$data['type']);
    }

    public function get_user($id) {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->result()) {
            $query_result = (array) $query->result()[0];
            return $query_result;
        }
        return FALSE;
    }

    
    private function getUserId($email, $type) {
        $this->load->database();
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('type', $type);
        $query = $this->db->get();
        if ($query->result()) {
            $query_result = (array) $query->result()[0];
            $user_id = $query_result['id'];
            return $user_id;
        }
        return FALSE;
    }

}
