<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('login_page');
        $this->load->view('templates/footer');
    }

    public function foodie() {
        $this->load->view('templates/header');
        $this->load->view('register_foodie');
        $this->load->view('templates/footer');
    }

    public function restaurant() {
        $this->load->view('templates/header');
        $this->load->view('register_restaurant');
        $this->load->view('templates/footer');
    }

    public function foodie_submit() {
        $this->load->model('users_model');
        $post_input = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'type' => 1,
            'preferences' => $this->input->post('preferences')
        );
        $data = $this->users_submit($post_input);
        $this->load->view('json_response', array('data' => $data));
    }

    public function restaurant_submit() {
        $this->load->model('users_model');
        $post_input = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'type' => 2,
            'preferences' => $this->input->post('preferences')
        );
        $data = $this->users_submit($post_input);
        $this->load->view('json_response', array('data' => $data));
    }

    private function users_submit($post_input) {
        $user_id = $this->users_model->user_registration($post_input);
        
        $redirect_page = "Foodie";
        if( $post_input['type'] === 2){
            $redirect_page = "Restaurant";
        }
        
        if ($this->users_model->has_error()) {
            $data = array(
                "success" => false,
                "errorMessage" => $this->users_model->error()
            );
            return $data;
        }

        $user = $this->users_model->get_user($user_id);
        
        $user_session_data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'type' => $user['type'],
            'preference' => $user['preferences']
        ];
        
        $this->session->set_userdata($user_session_data);

        $data = array(
            "is_redirect" => true,
            "redirect_url" => base_url().$redirect_page
        );
        return $data;
    }

}
