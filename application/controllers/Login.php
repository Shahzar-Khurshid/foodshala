<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (isset($_SESSION['type'])) {
            $redirect_page = "";
            if ($_SESSION['type'] == 1) {
                $redirect_page = base_url() . "Foodie";
            } else if ($_SESSION['type'] == 2) {
                $redirect_page = base_url() . "Restaurant";
            }
            header('Location: ' . $redirect_page);
            return;
        }

        $this->load->view('templates/header');
        $this->load->view('login_page');
        $this->load->view('templates/footer');
    }

    public function foodie_submit() {
        $post_input = [
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'type' => 1
        ];
        $data = $this->submit($post_input);
        $this->load->view('json_response', array('data' => $data));
    }

    public function restaurant_submit() {
        $post_input = [
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'type' => 2
        ];
        $data = $this->submit($post_input);
        $this->load->view('json_response', array('data' => $data));
    }

    private function submit($post_input) {
        $this->load->model('users_model');
        $user_id = $this->users_model->validate_email_and_password($post_input);

        if ($this->users_model->has_error()) {
            $data = array(
                "success" => false,
                "errorMessage" => $this->users_model->error()
            );
            return $data;
        }

        $redirect_page = "Foodie";
        if ($post_input['type'] === 2) {
            $redirect_page = "Restaurant";
        }

        $data = array(
            "is_redirect" => true,
            "redirect_url" => base_url() . $redirect_page
        );

        $user = $this->users_model->get_user($user_id);

        $user_session_data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'type' => $user['type'],
            'preference' => $user['preferences']
        ];

        $this->session->set_userdata($user_session_data);

        if ($_COOKIE) {
            foreach ($_COOKIE as $key => $item) {
                if ($key == "ci_session") {
                    continue;
                }
                $item = (array) json_decode($item);
                $item += [
                    "user_id" => $_SESSION['id']
                ];
                $this->load->model('orders_model');
                $this->orders_model->add_or_update_cart($item);
            }
        }

        return $data;
    }

    public function logout() {
        session_destroy();
        header('Location: ' . base_url() . 'Login');
    }

}
