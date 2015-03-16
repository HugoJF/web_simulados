<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Questions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


    }

    public function index()
    {
        $query = $this->db->get_where('category', array('type' => 0));

        foreach ($query->result() as $row) {
            echo '<p>' . $row->category_name . '</p>';
        }
    }

    public function bycategory($categoryId)
    {
        echo '<pre>';
        print_r($this->web_simulados_model->get_questions_by_category($categoryId)->result_array());
        echo '</pre>';
    }

    public function id($id)
    {
        $this->load->view('modular/header');
        $this->load->view('single_question', array(
            'question' => $this->web_simulados_model->get_question_by_id($id)->result()[0],
            'categories' => $this->web_simulados_model->get_category_from_question($id)->result()));
        $this->load->view('modular/footer');
    }

    public function answer($id)
    {
        if ($this->input->post('answer') === FALSE) {
            redirect('questions/id/' . $id);
        }

        $data = array(
            'question_id' => $id,
            'user_id' => $this->ion_auth->user()->row()->id,
            'answer' => $this->input->post('answer'),
            'time' => time()
        );

        $this->db->insert('answers', $data);

        $this->load->view('modular/header');
        $this->load->view('single_question_answer', array(
            'question' => $this->web_simulados_model->get_question_by_id($id)->result()[0],
            'categories' => $this->web_simulados_model->get_category_from_question($id)->result()));
        $this->load->view('modular/footer');
    }

    public function categories()
    {
        $this->load->view('modular/header');
        $this->load->view('category', array('categories' => $this->web_simulados_model->get_categories()->result()));
        $this->load->view('modular/footer');
    }

    public function search($categories, $perCategory)
    {
        $this->output->enable_profiler(TRUE);
        $questionIds = array();
        foreach (explode('-', $categories) as $category) {
            $query = $this->web_simulados_model->get_all_sub_categories_from($category);
            foreach ($query as $id) {
                $questions = $this->web_simulados_model->get_questions_by_category($id, intval($perCategory))->result();
                foreach ($questions as $question) {
                    if(!in_array($question->id, $questionIds)) {
                        array_push($questionIds, $question->id);
                    }
                }
            }
        }
        redirect(base_url('questions/view/' .implode('/', $questionIds)), 'refresh');
    }

    public function view()
    {
        $questions = func_get_args();
        $this->load->view('modular/header');
        foreach ($questions as $question) {
            $this->load->view('modular/question', array(
                'question' => $this->web_simulados_model->get_question_by_id($question)->result()[0],
                'categories' => $this->web_simulados_model->get_category_from_question($question)->result()));
        }
        $this->load->view('modular/footer');
    }

    public function view_answer()
    {
        $questions = func_get_args();
        $this->load->view('modular/header');
        foreach ($questions as $question) {
            $this->load->view('modular/question_answer', array(
                'question' => $this->web_simulados_model->get_question_by_id($question)->result()[0],
                'categories' => $this->web_simulados_model->get_category_from_question($question)->result()));
        }
        $this->load->view('modular/footer');
    }


}