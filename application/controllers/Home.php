<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->view('home');
        $this->load->view('templates/footer');
    }

}
