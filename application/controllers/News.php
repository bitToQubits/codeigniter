<?php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct(); //Llamando al metodo constructor CI_Controller
                $this->load->model('News_model'); //Cargando el modelo
                $this->load->helper('url_helper'); //Cargando los helper
        }

        public function index()
        {
            $data['news'] = $this->News_model->get_news();
            $data['title'] = 'News archive';
    
            $this->load->view('templates/header', $data);
            $this->load->view('news/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $data['news_item'] = $this->News_model->get_news($slug);
                if (empty($data['news_item'])){
                    show_404();
                }

                $data['title'] = $data['news_item']['title'];

                $this->load->view('templates/header', $data);
                $this->load->view('news/view', $data);
                $this->load->view('templates/footer');
        }
        //Comprobando que se envio el formulario. Estableciendo reglas de validacion.
        public function create(){
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Create a news item';

            //Second parameter: name used for error messages
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');

            }
            else
            {
                $this->News_model->set_news();
                $this->load->view('news/success');
            }
        }

        public function update($slug = NULL){
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Update a news item';

            $data['news'] = $this->News_model->get_news($slug);
            if (empty($data['news'])){
                show_404();
            }

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('news/update', $data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->News_model->update_new($slug);
                $this->index();
            }
        }

        public function remove($slug = NULL){
            $this->News_model->remove_new($slug);
            $this->index();
        }
}