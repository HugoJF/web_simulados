<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    public function index() {
        redirect('accounts/login', 'refresh');
    }

    public function login() {
        if($this->ion_auth->logged_in()) {
            redirect('/', 'refresh');
        }
        if($this->input->post('logging_in') === FALSE) {
            $this->not_logging_in();
        } else {
            $this->logging_in();
        }
    }

    private function not_logging_in() {
        $this->load->view('login/index');
    }

    private function logging_in() {
        $remember = (bool) $this->input->post('remember');

        if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember)) {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('/', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            print_r($this->ion_auth->errors());
            $this->load->view('accounts/login');
        }

    }

    public function logout() {
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('accounts/login', 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */