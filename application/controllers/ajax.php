<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


    }

    public function get_categories() {
        if(!$this->ion_auth->logged_in()) {
            show_error('Unauthorized access');
        }

        echo json_encode($this->web_simulados_model->get_all_categories()->result_array());
    }
}